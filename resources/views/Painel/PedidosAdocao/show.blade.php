@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container-view bg-light borda-container container-pedidos">
    <div class="row">
        <div class="col-6">
            <section class="dados-pedidos" style=" margin-bottom: 30px; padding-bottom: 20px">
                <h3 class="text text-center">Dados do adotante</h3>
                <hr class="linha-titulo">
                <div class="row">      
                    <div class="col-7">
                        <p class="text">Nome do adotante:<br> {{$pedido->dadosAdotante->nome_adotante}}</p>
                        <p class="text">CPF do adotante:<br> {{$pedido->dadosAdotante->cpf_adotante}}</p>
                        <p class="text">Telefone do adotante:<br> {{$pedido->dadosAdotante->telefone_adotante}}</p>
                        <p class="text">Email do adotante:<br> {{$pedido->dadosAdotante->email_adotante}}</p>
                        <p class="text">Data do pedido:<br> {{date("d/m/Y", (strtotime($pedido->data_pedido)))}}</p>
                    </div>
                    <div class="col-5">
                        <p class="text">Cidade:<br> {{$enderecoAdotante->cidade}}</p>
                        <p class="text">CEP:<br> {{$enderecoAdotante->cep}}</p>
                        <p class="text">Bairro:<br> {{$enderecoAdotante->bairro}}</p>
                        <p class="text">Rua:<br> {{$enderecoAdotante->rua}}</p>
                        <p class="text">Número da casa:<br> {{$enderecoAdotante->numero_casa}}</p>
                    </div>                       		
                </div>
            </section>
            @if(isset($activeIndexTodosPedidos))
            <a class="btn btn-danger" href="{{route($cvRoute.'.destroy', $pedido->id)}}">Excluir</a>
            @endif
        </div>
        <div class="col-6">
            <section class="dados-pedidos">
                <h3 class="text text-center">Dados do animal</h3>
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
                        <p class="text"> Situação Médica: {{$pedido->animal->situacao_medica}}</p>	                        		
                    </div>
                </div>
            </section>
            @if(isset($activeIndexTodosPedidos))
            <section class="dados-pedidos">
                <h3 class="text text-center"> Situação do pedido</h3>
                <hr class="linha-titulo">            
                @if($pedido->situacao == 'A')
                <p class="text"> Situação do pedido: Aprovado</p>
                @elseif($pedido->situacao == 'P')
                <p class="text"> Situação do pedido: Não analizado</p>
                @else
                <p class="text"> Situação do pedido: Não aprovado}}</p>
                @endif               
                <p class="text"> Informações adicionais: {{empty($pedido->informacoes_adicionais) ? 'Sem informações adicionais' : $pedido->informacoes_adicionais}}</p>
            </section>
            @endif
        </div>
    </div>   
	<div class="row">
        <div class="col-12">					
            @if(!isset($activeIndexTodosPedidos)) 
            <a class="btn btn-success" href="{{route($cvRoute.'.aceitarPedido', $pedido->id)}}">Aprovar</a>
            <a class="btn btn-danger" href="{{route($cvRoute.'.recusarPedido', $pedido->id)}}">Não aprovar</a>                        
            @endif
		</div>
    </div>
</div>
@endsection