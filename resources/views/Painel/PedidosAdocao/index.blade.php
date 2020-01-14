@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container bg-light container-pedidos">
    <div class="row" style="border: #bfbcbc 1px solid; border-right: #bfbcbc 1px solid; padding: 10px">
        <div class="col-12">
        @if(!isset($activeIndexTodosPedidos))
            <a href="{{route($cvRoute.'.create', ['novosPedidos' => true])}}" class="btn btn-primary"> Adicionar pedido manualmente</a>
        @else
            <a href="{{route($cvRoute.'.create')}}" class="btn btn-primary"> Adicionar pedido manualmente</a>
        @endif
        </div>
    </div>
    @foreach($pedidos as $pedido)
        <div class="row borda-container pedidos" style="border-bottom: #bfbcbc 1px solid; border-radius: 0px">            
            <div class="col-7">
                <p class="text">Nome do adotante: {{$pedido->dadosAdotante->nome_adotante}}</p>
                <p class="text">CPF do adotante: {{$pedido->dadosAdotante->cpf_adotante}}</p>
                <p class="text">Telefone do adotante: {{$pedido->dadosAdotante->telefone_adotante}}</p>
                <p class="text">Email do adotante: {{$pedido->dadosAdotante->email_adotante}}</p>
                <p class="text">Nome do Animal: {{$pedido->animal->nome}}</p>
                <p class="text">Data do pedido: {{date("d/m/Y", (strtotime($pedido->data_pedido)))}}</p>
            </div>
            <div class="col-5">
                <div class="float-right" style="margin-top: 200px">
                    @if(!isset($activeIndexTodosPedidos))
                    <a class="btn btn-primary" href="{{route($cvRoute.'.show', $pedido->id)}}">Ver detalhes</a>
                    <a class="btn btn-success" href="{{route($cvRoute.'.aceitarPedido', $pedido->id)}}">Aprovar</a>
                    <a class="btn btn-danger" href="{{route($cvRoute.'.recusarPedido', $pedido->id)}}">Não aprovar</a>
                    @else
                    @if($pedido->situacao == "A")
                    <h4 class="badge badge-success situacao-pedido">Pedido aprovado</h4>
                    @elseif($pedido->situacao == "N")
                    <h4 class="badge badge-danger situacao-pedido">Pedido recusado</h4>
                    @else
                    <h4 class="badge badge-secondary situacao-pedido">Pedido não analizado</h4>
                    @endif
                    <a class="btn btn-primary" href="{{route($cvRoute.'.show', ['PedidosAdocao' => $pedido->id, 'activeIndexTodosPedidos' => 'true'])}}">Ver detalhes</a>
                    <a class="btn btn-danger" href="{{route($cvRoute.'.destroy', $pedido->id)}}">Excluir</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection