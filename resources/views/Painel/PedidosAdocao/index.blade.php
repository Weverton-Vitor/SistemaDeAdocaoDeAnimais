@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container bg-light container-pedidos">
    @foreach($pedidos as $pedido)
        <div class="row borda-container pedidos">            
            <div class="col-8">
                <p class="text">Nome do adotador: {{$pedido->nome_adotador}}</p>
                <p class="text">CPF do adotador: {{$pedido->cpf_adotador}}</p>
                <p class="text">Telefone do adotador: {{$pedido->telefone_adotador}}</p>
                <p class="text">Email do adotador: {{$pedido->email_adotador}}</p>
                <p class="text">Nome do Animal: {{$pedido->animal->nome}}</p>
            </div>
            <div class="col-4">
                <div class="float-right" style="margin-top: 160px">
                    <a class="btn btn-primary" href="{{route($cvRoute.'.show', $pedido->id)}}">Ver detalhes</a>
                    <a class="btn btn-success" href="{{route($cvRoute.'.aceitarPedido', $pedido->id)}}">Aprovar</a>
                    <a class="btn btn-danger" href="{{route($cvRoute.'.recusarPedido', $pedido->id)}}">Não aprovar</a>
                </div>
            </div>
        </div>
    @endforeach
</div
@endsection