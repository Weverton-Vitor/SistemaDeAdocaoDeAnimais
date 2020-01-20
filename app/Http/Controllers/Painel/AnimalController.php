<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Tipo;
use App\Models\PedidoAdocao;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FormRequestAnimais;

class AnimalController extends Controller{

    protected  $total_page = 10; // total de páginas para a paginaçãp
    protected $cvData; // Array que conterá as variáveis enviadas para as views, cada index do array vira uma váriavel na view
    protected $model; // Model princiapal

    public function __construct(Animal $model) 
    {
        $this->model = $model; // Setando a model
        $this->cvData['cvRoute'] = 'Animais'; //Prefixo da rota
        $this->cvData['cvViewDirectory'] = 'Painel.Animais'; // Diretório quem contém as views
        $this->cvData['cvHeaderPage'] = "Animais"; // Título principal da view
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage']; // Título da aba do navegador
    }

    // Grid para a admistração dos animais
    public function index(Request $request) 
    {           
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        $this->cvData['activeAnimal'] = true;                 
        $this->cvData['nNovosPedidos'] = count($this->cvData['vcObjects'] = PedidoAdocao::where('situacao', 'P')->orderBy('data_pedido')->get());
        $this->cvData['cvObjects'] = $this->model::orderBy('nome')->with('tipo')->paginate($this->total_page);
        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
    }

    // Redireciona para a pagina de cadastro
    public function create(Request $request)
    {   
        $this->cvData['activeAnimal'] = true;
        $this->cvData['tipos'] = Tipo::all();        
        $this->cvData['cvHeaderPage'] = "Novo animal";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    // Fazendo o insert no banco de dados
    public function store(FormRequestAnimais $request) 
    {
        $dataForm = $request->all();        

        //Checando se há algum registro com o mesmo nome
        if ($this->model::where('nome', $dataForm['nome'])->first()) {
            return redirect()->
                            route($this->cvData['cvRoute'] . '.create')->
                            with('error', 'Já existe um registro com este nome: ' . $dataForm['nome']);
        }

        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        $dataForm['situacao_adocao'] = 'N';
        $store = $this->model->create($dataForm);
        
        // Sucesso ao salvar no banco de dados
        if ($store)
        { 
            //Salvando imagem
            if (!is_null($request->file('imagem'))) {  // Testando se foi feito upload de uma imagem                 
                $request->file($request->input('imagem')); // Pegando a imagem
                
                //Salvando em a imagem com o nome: imagem + id do animal + extensão da imagem
                $upload = $request->imagem->storeAs('uploadImg', 'imagem'.$store->id.'.'.$request->imagem->extension());
                $dataForm = $this->model->find($store->id); // Resgatando o animal já castrado
                $dataForm->imagem = 'imagem'.$store->id.'.'.$request->imagem->extension(); // Setando a propriedade imagem
                $dataForm->save(); // Salvando                      
            }
            return redirect()->
                        route($this->cvData['cvRoute'] . '.index')->
                        with('success', 'Sucesso ao registrar animal [ ' . $dataForm['nome'] . ' ]');

        }
        else{ // Falha ao salvar no banco de dados
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Falha ao adicionar animal [ ' . $dataForm['nome'] . ' ]');
        }
    }

    // Visualização individual de cada animal
    public function show($id, Request $request) 
    {        
        $this->cvData['activeAnimal'] = true;
        $this->cvData['animal'] = $this->model->with('tipo')->find($id);         
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        $this->cvData['cvHeaderPage'] = $this->cvData['animal']->nome;
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];        
        return view('Painel.Animais.show', $this->cvData);
    }

    //Preparando a página de edição
    public function edit($id, Request $request) 
    {        
        $this->cvData['tipos'] = Tipo::all();  
        $this->cvData['animal'] = $this->model->find($id);
        $this->cvData['cvHeaderPage'] = "Editar dados de: " .  $this->cvData['animal']->nome;
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    // Atualizando a imagem
    public function update(Request $request, $id) 
    {
        $dataForm = $request->all();        
        $this->model = $this->model->find($id);

        if (!is_null($request->file('imagem'))) {                
            $dataForm['imagem'] = 'imagem'. $id.'.'.$request->imagem->extension();
            $request->imagem->storeAs('uploadImg', 'imagem'.$store->id.'.'.$request->imagem->extension());
        }

        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        $update = $this->model->update($dataForm);

        if ($update)
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao editar [ ' . $this->model->nome . ' ]');
        else
            return redirect()->
                            route($this->cvData['cvRoute'] . '.edit', $id)->
                            with('errors', 'Falha ao editar [ ' . $this->model->nome . ' ]');
    }

    // Realizando a exlusão de um animal
    public function destroyOne($id, Request $request)
    {       
        $obj = $this->model::find($id);
        $msg = $obj['nome'];
        $delete = $obj->delete();    
        
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        if ($delete)//Sucesso ao realizar delete
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao excluir [ ' . $msg . ' ]');
        else //Falha ao realizar delete
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir [ ' . $msg . ' ]');
    }

    // Deletando vários animais
    public function destroyMany(Request $request)
    {
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        $ids = ($request->input("id"));//Array com os ids
        if (!$ids == null) {// Se os ids não forem nulos
            $total_itens = count($ids);              
            if ($total_itens > 1) {// Caso existe mais de um id                     
                $delete = DB::table('animais')->whereIn('id', $ids)->delete(); 
                $msg = $total_itens . " animais";
            
            } else {// Caso exista apenas um id
                $delete =$this->model->find($ids[0])->delete();
                $msg = "1 animal";
            } 
        } else{// Caso nenhum animal seja selecionado
             return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Nem um item selecionado!');
        }
        if ($delete)//Sucesso ao realizar delete
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao excluir [ ' . $msg . ' ]');
        else//Falha ao realizar delete
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir [ ' . $msg . ' ]');   
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
        $this->cvData['cvObjects'] = $this->model->searchGrid($searchCriteria, $total_page);

        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);        
    }

}
