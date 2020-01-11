@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container-view bg-light borda-container container-pedidos">
    <div class="row">
        <div class="col-6">
            <section class="dados-pedidos">
                <h2 class="text text-center">Dados do adotador</h2>
                <hr class="linha-titulo">
                <div class="row">      
                    <div class="col-7">
                        <p class="text">Nome do adotador:<br> {{$pedido->nome_adotador}}</p>
                        <p class="text">CPF do adotador:<br> {{$pedido->cpf_adotador}}</p>
                        <p class="text">Telefone do adotador:<br> {{$pedido->telefone_adotador}}</p>
                        <p class="text">Email do adotador:<br> {{$pedido->email_adotador}}</p>
                        <p class="text">Data do pedido:<br> {{date("d/m/Y", (strtotime($pedido->data_pedido)))}}</p>
                    </div>
                    <div class="col-5">
                        <p class="text">Cidade:<br> {{$pedido->enderecoAdotador->cidade}}</p>
                        <p class="text">Bairro:<br> {{$pedido->enderecoAdotador->bairro}}</p>
                        <p class="text">Rua:<br> {{$pedido->enderecoAdotador->rua}}</p>
                        <p class="text">Número da casa:<br> {{$pedido->enderecoAdotador->numero_casa}}</p>
                    </div>                       		
                </div>
            </section>
        </div>
        <div class="col-6">
            <section class="dados-pedidos">
                <h2 class="text text-center">Dados do animal</h2>
                <hr class="linha-titulo">
                <div class="row">
                    <div class="col-6">                
                        @if(is_null($pedido->animal->imagem))
                        <!-- Animal sem imagem-->
                        <img id="img-animal-pedido" src="{{url('/img/imagemGenerica.png')}}">
                        @else
                        <!-- Animal com imagem-->
                        <img id="img-animal-pedido" src="/storage/uploadImg/{{$pedido->animal->imagem}}">
                        @endif
                    </div>
                    <div class="col-6">                    
                        <p class="text"> Nome: {{$pedido->animal->nome}}</p>
                        <p class="text"> Peso: {{$pedido->animal->peso}} Kg</p>
                        <p class="text"> Altura: {{$pedido->animal->altura}} cm</p>
                        <p class="text"> Tipo de Animal: {{$pedido->animal->tipo->nome}}</p>
                        <p class="text"> Raça: {{$pedido->animal->raca}}</p>
                        <p class="text">Situação Médica: {{$pedido->animal->situacao_medica}}</p>			
                    </div>
                </div>
            </section>
        </div>
    </div>    
	<div class="row">
		<div class="col-12">					
            <a class="btn btn-success" href="{{route($cvRoute.'.aceitarPedido', $pedido->id)}}">Aprovar</a>
            <a class="btn btn-danger" href="{{route($cvRoute.'.recusarPedido', $pedido->id)}}">Não aprovar</a>
		</div>
	</div>
</div>
@endsection