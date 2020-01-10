@extends('Painel.layoutPainel')

@section('conteudo')
<div class="container-view bg-light borda-container">
	<div class="row">
		<div class="col-3">
			@if(is_null($animal->imagem))
			<!-- Animal sem imagem-->

			<img id="img-animal" src="{{url('/img/imagemGenerica.png')}}">
			@else
			<!-- Animal com imagem-->
			<img id="img-animal" src="/storage/uploadImg/{{$animal->imagem}}">
			@endif
		</div>
		<div class="col-9">
			<p class="text"> Nome: {{$animal->nome}}</p>
			<p class="text"> Peso: {{$animal->peso}}</p>
			<p class="text"> Altura: {{$animal->altura}}</p>
			<p class="text"> Tipo de Animal: {{$animal->tipo->nome}}</p>
			<p class="text"> Raça: {{$animal->raca}}</p>
			<p class="text">Situação Médica: {{$animal->situacao_medica}}</p>
			<p class="text">Situação de Adoção: {{$animal->situacao_adocao == "N" ? "Não adotado" : "Adotado"}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<a href="{{route($cvRoute.'.index')}}" class="btn btn-primary"> Voltar </a>			
			<a href="{{route($cvRoute.'.destroyOne', $animal->id)}}" class="btn btn-danger"> Deletar </a>
		</div>
	</div>
</div>
@endsection