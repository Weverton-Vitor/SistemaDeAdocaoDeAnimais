<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoAdocao;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class PainelController extends Controller
{
    private $cvData;

    public function index(Request $request)
    {
        //Pegando dados gerais do sistema  
        $this->cvData['nNovosPedidos'] = count(PedidoAdocao::where('situacao', 'P')->get());
        $this->cvData['totalPedidos'] = count(PedidoAdocao::all());    
        $this->cvData['nAnimaisAdotados'] = count(Animal::where('situacao_adocao', 'S')->get());
        $this->cvData['totalAnimais'] = count(Animal::all());
        $this->cvData['nAnimaisAdotadosHoje'] = count(PedidoAdocao::where('data_aprovacao', date('Y-m-d'))->get());
        $this->cvData['nNovosPedidosHoje'] = count(PedidoAdocao::where('data_pedido', date('Y-m-d'))->get());
        //dd(PedidoAdocao::where('situacao', 'P')->raw('and where data_pedido = ' . date('Y-m-d'))->get());

        $request->session()->put('nNovosPedidos', $this->cvData['nNovosPedidos']);
        // Direcionando para o dashboard
        $this->cvData['activeDashboard'] = true;
        $this->cvData['cvHeaderPage'] = "Página inicial";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        $this->cvData['cvRoute'] = 'Painel';
        return view('Painel.dashboard', $this->cvData);
    }

    public function createUser()
    {
        $this->cvData['cvHeaderPage'] = "Novo usuário com acesso ao painel de controller";
        $this->cvData['cvTitlePage'] = $this->cvData['cvHeaderPage'];
        $this->cvData['cvRoute'] = 'Painel';        
        return view('Painel.createUser', $this->cvData);
    }

}
