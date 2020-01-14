@extends('Painel.layoutPainel')
@section('conteudo')
    <div class="container bg-light borda-container" style="padding-top: 10px">
        <div class="row">
            <div class="col-4">
                <section class='container-dashboard'>
                    <h2 class='text text-center'> Dados Gerais </h2>
                    <hr class='linha-titulo'>
                    <p class='text text-dashboard'>Total de animais cadastrados : {{$totalAnimais}}</p>
                    <p class='text text-dashboard'>Total de animais adotados: {{$nAnimaisAdotados}}</p>
                    <p class='text text-dashboard'>Total de pedidos: {{$totalPedidos}}</p>
                    <p class='text text-dashboard'>Total de novos pedidos: {{$nNovosPedidos}}</p>                
                </section>
            </div>
            <div class="col-4">
                <section class='container-dashboard'>
                    <h2 class='text text-center'> Usuário logado </h2>
                    <hr class='linha-titulo'>
                </section>
            </div>
            <div class="col-4">
                <section class='container-dashboard'>
                    <h2 class='text text-center'> Hoje </h2>
                    <hr class='linha-titulo'>
                    <p class='text text-dashboard'>Total de animais adotados hoje: {{$nAnimaisAdotadosHoje}}</p>
                    <p class='text text-dashboard'>Total de novos pedidos hoje: {{$nNovosPedidosHoje}}</p> 
                </section>
            </div>
        </div>
    </div>
@endsection