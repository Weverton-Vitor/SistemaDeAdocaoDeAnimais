@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container bg-light container-pedidos">
    @foreach($pedidos as $pedido)
        <div class="row borda-container pedidos">            
            <div class="col-8">
                <p class="text">Nome do adotante: {{$pedido->nome_adotante}}</p>
                <p class="text">CPF do adotante: {{$pedido->cpf_adotante}}</p>
                <p class="text">Telefone do adotante: {{$pedido->telefone_adotante}}</p>
                <p class="text">Email do adotante: {{$pedido->email_adotante}}</p>
                <p class="text">Nome do Animal: {{$pedido->animal->nome}}</p>
                <p class="text">Data do pedido: {{date("d/m/Y", (strtotime($pedido->data_pedido)))}}</p>
            </div>
            <div class="col-4">
                <div class="float-right" style="margin-top: 200px">
                    <a class="btn btn-primary" href="{{route($cvRoute.'.show', $pedido->id)}}">Ver detalhes</a>
                    <a class="btn btn-success" href="{{route($cvRoute.'.aceitarPedido', $pedido->id)}}">Aprovar</a>
                    <a class="btn btn-danger" href="{{route($cvRoute.'.recusarPedido', $pedido->id)}}">Não aprovar</a>
                </div>
            </div>
        </div>
    @endforeach
</div
@endsection