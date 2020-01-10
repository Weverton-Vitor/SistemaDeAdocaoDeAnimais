<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PedidoAdocao;

class PedidoAdocaoController extends Controller {

    private $total_page = 10;
    private $cvData;
    private $model;

    public function __construct(PedidoAdocao $model) {
        $this->model = $model;
        $this->cvData['cvRoute'] = 'PedidosAdocao';
        $this->cvData['cvViewDirectory'] = 'Painel.PedidosAdocao';
        $this->cvData['cvHeaderPage'] = "Pedidos de adoçao";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
    }

    //
    public function index() {        
        $this->cvData['pedidos'] = $this->model::orderBy('data_pedido')->with('animal')->paginate($this->total_page);
        //Total de novos pedidos
        $this->cvData['nNovosPedidos'] = count( $this->cvData['vcObjects'] = $this->model::orderBy('data_pedido')->where('situacao', 'P')->get());
        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
    }

    //
    public function create() {
        $this->cvData['cvMenuPage']['create'] = 'active';
        $this->cvData['nNovosPedidos'] = count($this->cvData['vcObjects'] = PedidoAdocao::where('situacao', 'P')->orderBy('data_pedido')->get());
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    //
    public function store(Request $request) 
    {
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

    //
    public function show($id) {
        //
    }

    //
    public function edit($id) {
        $this->cvData['cvMenuPage']['create'] = 'active';
        $this->cvData['vcObject'] = $this->model->find($id);
        $this->cvData['nNovosPedidos'] = count($this->cvData['vcObjects'] = PedidoAdocao::where('situacao', 'P')->orderBy('data_pedido')->get());
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    //
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

    //
    public function destroy($id) 
    {

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

    public function exibirPedidosPendentes()
    {
        $this->cvData['vcObjects'] = $this->model::orderBy('data_pedido')->where('situacao', 'P')->paginate($this->total_page);
    }

    //
    public function searchGrid(Request $request) 
    {
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
    }

}
