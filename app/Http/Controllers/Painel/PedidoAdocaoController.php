<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PedidoAdocao;
use App\Models\Animal;
use App\Models\DadosAdotante;
use App\Http\Requests\FormRequestDadosPedidoAdocao;
use Illuminate\Support\Facades\Auth;

class PedidoAdocaoController extends Controller {

    private $total_page = 6;
    private $cvData;
    private $model;

    public function __construct(PedidoAdocao $model) {
        $this->model = $model;
        $this->cvData['cvRoute'] = 'PedidosAdocao';
        $this->cvData['cvViewDirectory'] = 'Painel.PedidosAdocao';
        $this->cvData['cvHeaderPage'] = "Pedidos de adoção";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
    }

    //
    public function index(Request $request) 
    {              
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        if (!is_null($request->input('novosPedidos')))// Resgata apenas novos registros
        {
            $this->cvData['pedidos'] = $this->model::orderBy('data_pedido')->where('situacao', 'P')->with('animal', 'dadosAdotante')->paginate($this->total_page);   
            $this->cvData['activeIndexNovoPedido'] = true;
        } else {
            $this->cvData['pedidos'] = $this->model::orderBy('data_pedido')->with('animal', 'dadosAdotante')->paginate($this->total_page);   
            $this->cvData['activeIndexTodosPedidos'] = true;
        }
        //Total de novos pedidos       
        return view($this->cvData['cvViewDirectory'] . '.index', $this->cvData);
    }

    // Mostra um formulário para a primeira do cadastro manual de pedidos de adoção
    public function create(Request $request) {
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        if (!is_null($request->input('novosPedidos')))
        {            
            $this->cvData['activeIndexNovoPedido'] = true;
        } else {            
            $this->cvData['activeIndexTodosPedidos'] = true;
        }
        $this->cvData['cvMenuPage']['create'] = 'active';        
        $this->cvData['cvHeaderPage'] = "Novo pedido de adoção";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view($this->cvData['cvViewDirectory'] . '.create', $this->cvData);
    }

    // Efetua a cadastro de novos pedidos de adoção
    public function store(Request $request) 
    {        

        if (is_null(Auth::user()->dados_adotante_id)) //Procedimentetos para cadastro manual de pedidos
        {           
            // Recuperando dados da sessão
            $dataForm = $request->session()->all();      
                        
            //Dados do formulario hidden da página de seleção do animal
            $dataForm['animal_id'] = $request->input('animal_id');     
            $dataForm['situacao'] = "A";
            $dataForm['data_pedido'] = date('Y-m-d');    
    
            $insertDadosAdotante = DadosAdotante::create($dataForm);
            $dataForm['dados_adotante_id'] = $insertDadosAdotante->id; //Pegando o id dos dados do adotante        
            $insertPedido = $this->model->create($dataForm);

        } else // Procedimentos para cadastro pelo site com usuário logado
        {                                
            $dataForm['animal_id'] = $request->input('animal_id');     
            $dataForm['situacao'] = "P";               
            $dataForm['data_pedido'] = date('Y-m-d');
            $dataForm['user_id'] = Auth::user()->id; // Id do usuário
            $dataForm['dados_adotante_id'] =Auth::user()->dados_adotante_id ; // Id dos dados do usuário            
            $insertPedido = $this->model->create($dataForm);
            $this->cvData['cvRoute'] = 'Site';
        }

        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        if ($insertPedido)
        {

            if (is_null(Auth::user()->dados_adotante_id)) //Procedimentetos para cadastro manual de pedidos
            {
                // Mudando a situaçao de adoção do animal
                $animal = Animal::find($dataForm['animal_id']);
                $animal->situacao_adocao = "S";
                $animal->save();                

                // Negando todos os pedidos do animal selecionado
                $pedidos = PedidoAdocao::where('animal_id',  $dataForm['animal_id'])->get();
                foreach ($pedidos as $pedido)
                {
                    if ($pedido->situacao == "P" && $pedido->id !=  $insertPedido->id)
                    {
                        $pedido->situacao = "N";
                        $pedido->save();
                    }
                } 
            }   
            else
            {
                // Mudando a situaçao de adoção do animal para reservado
                $animal = Animal::find($dataForm['animal_id']);
                $animal->situacao_adocao = "R";
                $animal->save();
            }
            
            // Apagando os dados da sessão
            $request->session()->forget(['nome_adotante', 'cpf_adotante', 'email_adotante', 'telefone_adotante', 'cidade', 'cep', 'bairro', 'rua', 'numero_casa', 'informacoes_adicionais']);            

            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                                              with('success', 'Sucesso ao registrar pedido de adoção');
        } 
        else        
        {            
            // Apagando os dados da sessão
            $request->session()->forget(['nome_adotante', 'cpf_adotante', 'email_adotante', 'telefone_adotante', 'cidade', 'cep', 'bairro', 'rua', 'numero_casa', 'informacoes_adicionais']);            
        }
            return redirect()->
                            route($this->cvData['cvRoute'] . '.create')->
                            with('error', 'Falha ao adicionar pedido de adoção');
    }

    // Página individual de cada pedido de adoção
    public function show($id, Request $request) 
    {                
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        if (!is_null($request->input('activeIndexTodosPedidos'))) {
            $this->cvData['activeIndexTodosPedidos'] = true;
        } else {
            $this->cvData['activeIndexNovoPedido'] = true;
        }
        $this->cvData['pedido'] = $this->model->with('animal', 'dadosAdotante')->find($id);        
        $this->cvData['cvHeaderPage'] = "Pedido de adoção: ".$this->cvData['pedido']->animal->nome;
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        return view($this->cvData['cvViewDirectory'] .'.show', $this->cvData);
    }

    //Deleta 1 pedido de adoção do banco de dados
    public function destroyOne($id, Request $request) 
    {
        $pedido = $this->model->with('animal')->find($id);
        $delete = $pedido->delete();
        $animal = $pedido->animal()->get()->first();          

        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        if ($delete)
        {
            // Mudando a situação da adoção do animal
            if($pedido->situacao == "A" && $animal->situacao_adocao == "S")
            {
                $animal->situacao_adocao = "N";
                $animal->save();
            }
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('success', 'Sucesso ao excluir pedido');
        }                            
        else
        {
            return redirect()->
                            route($this->cvData['cvRoute'] . '.index')->
                            with('error', 'Erro ao excluir pedido');
        }
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

    // Valida os dados do cadastro manual e redireciona para para o método selecionarAnimal
    public function validarDados(FormRequestDadosPedidoAdocao $request)
    {
        // Guardando os dados na sessão
        $dataForm = $request->except('_token');
        $request->session()->put('nome_adotante', $dataForm['nome_adotante']);
        $request->session()->put('cpf_adotante', $dataForm['cpf_adotante']);
        $request->session()->put('email_adotante', $dataForm['email_adotante']);
        $request->session()->put('telefone_adotante', $dataForm['telefone_adotante']);
        $request->session()->put('cidade', $dataForm['cidade']);
        $request->session()->put('cep', $dataForm['cep']);
        $request->session()->put('bairro', $dataForm['bairro']);
        $request->session()->put('rua', $dataForm['rua']);
        $request->session()->put('numero_casa', $dataForm['numero_casa']);
        if (!is_null( $dataForm['informacoes_adicionais'])) {       
            $request->session()->put('informacoes_adicionais', $dataForm['informacoes_adicionais']);
        }
        return redirect()->route($this->cvData['cvRoute'].'.selecionarAnimal');
    }

    // Mostra uma tela para a escolha de animal do pedido de adoção manual
    public function selecionarAnimal()
    {   
        $this->cvData['animais'] = Animal::orderby('nome')->where('situacao_adocao', "N")->with('tipo')->paginate(6);                
        $this->cvData['cvHeaderPage'] = "Selecionar animal";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];        
        return view($this->cvData['cvViewDirectory'] .'.selecionarAnimal', $this->cvData);
    }

    // Aceita o pedido de adoção
    public function aceitarPedidoAdocao($id, Request $request)
    {                
        // Alterando a situação do pedido para aprovado
        $pedidoAceito = $this->model->find($id);        
        $pedidoAceito->situacao = "A";
        $pedidoAceito->data_aprovacao = date('Y-m-d');
        $pedidoAceito->save();

        // Alterano o situação de adoção do animal para adotado
        $animal = Animal::find($pedidoAceito->animal_id);
        $animal->situacao_adocao = "S";
        $animal->save();

        // Negando todos os pedidos do animal selecionado
        $pedidos = PedidoAdocao::where('animal_id',  $animal->id)->get();
        foreach ($pedidos as $pedido)
        {
            if ($pedido->situacao == "P" && $pedido->id !=  $pedidoAceito->id)
            {
                $pedido->situacao = "N";
                $pedido->save();
            }
        } 

        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        return redirect()->
                        route($this->cvData['cvRoute'] . '.index')->
                        with('success', 'Pedido aceito com sucesso!');

    }

    // Recusa o pedido de adoção
    public function recusarPedidoAdocao($id, Request $request)
    {
        $pedido = $this->model->find($id);
        $pedido->situacao = "N";
        $pedido->save();
        $nNovosPedidos = count(PedidoAdocao::where('situacao', 'P')->get());
        $request->session()->put('nNovosPedidos', $nNovosPedidos);

        // Alterano o situação de adoção do animal para não adotado
        $animal = Animal::find($pedido->animal_id);
        $animal->situacao_adocao = "N";
        $animal->save();

        return redirect()->
                route($this->cvData['cvRoute'] . '.index')->
                with('success', 'Pedido recusado com sucesso!');
    }

}
