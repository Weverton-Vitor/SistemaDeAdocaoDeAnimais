<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoAdocao;
use App\Models\Animal;

class PainelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Pegando dados gerais do sistema  
        $nNovosPedidos = count(PedidoAdocao::orderBy('data_pedido')->where('situacao', 'P')->get());
        

        $request->session()->put('nNovosPedidos', $nNovosPedidos);
        //Redirecionando para o dashboard
        return view('Painel.dashboard');
    }

}
