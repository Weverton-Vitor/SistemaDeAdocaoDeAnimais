<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeloController extends Controller {

    private $total_page = 10;
    private $cvData;
    private $model;

    public function __construct(HealthInsurance $model) {
        $this->model = $model;
        $this->cvData['cvRoute'] = 'healthInsurance';
        $this->cvData['cvViewDirectory'] = 'painel.admin.health_insurance';
        $this->cvData['cvHeaderPage'] = "Plano de Saúde";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
    }

    /**
     *  Display a listing of the resource.
     * @return type
     */
    public function index() {
        $this->cvData['cvMenuPage']['index'] = 'active';
        $this->cvData['vcObjects'] = $this->model::orderBy('name')->paginate($this->total_page);

        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
    }

    /**
     * Show the form for creating a new resource.
     * @return type
     */
    public function create() {
        $this->cvData['cvMenuPage']['create'] = 'active';
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $dataForm = $request->all();

        //Checando se há algum registro com o mesmo nome
        if ($this->model::where('name', $dataForm['name'])->first()) {
            return redirect()->
                            route($this->cvData['cvRoute'] . '.create')->
                            with('error', 'Já existe um registro com este nome: ' . $dataForm['name']);
        }

        $insert = $this->model->create($dataForm);

        if ($insert)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao registrar [ ' . $dataForm['name'] . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.create')->
                            with('error', 'Falha ao adicionar [ ' . $dataForm['name'] . ' ]');
    }

    /**
     * Display the specified resource.
     * @param type $id
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $this->cvData['cvMenuPage']['create'] = 'active';
        $this->cvData['vcObject'] = $this->model->find($id);
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request, $id) {
        $dataForm = $request->all();

        $this->model = $this->model->find($id);

        $update = $this->model->update($dataForm);

        if ($update)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao editar [ ' . $dataForm['name'] . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.edit', $id)->
                            with('errors', 'Falha ao editar [ ' . $dataForm['name'] . ' ]');
    }

    /**
     * Remove the specified resource from storage.
     * @param type $id
     * @return type
     */
    public function destroy($id) {

        $arr = explode(',', $id);
        $total_itens = count($arr);
        
        if ($total_itens > 1) {
            $delete = $this->model::whereRaw("ID IN ({$id})")->delete();
            $msg = $total_itens . " itens";
            
        } elseif ($total_itens == 1) {
            
            $obj = $this->model::find($id);
            $delete = $obj->delete();
            $msg = $obj['name'];
            
        }else{
            $msg=$id;
        }

        if ($delete)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao excluir [ ' . $msg . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir [ ' . $msg . ' ]');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function searchGrid(Request $request) {
        $searchCriteria = $request->except('_token'); // pega todos os campos, exceto o token

        if (isset($searchCriteria['total_page'])) {
            $total_page = $searchCriteria['total_page'];
        } else {
            $total_page = $this->total_page;
        }

        $this->cvData['cvMenuPage']['index'] = 'active';
        $this->cvData['cvSearchCriteria'] = $searchCriteria;
        $this->cvData['vcObjects'] = $this->model->searchGrid($searchCriteria, $total_page);

        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
//        dd($request->all());
    }

}
