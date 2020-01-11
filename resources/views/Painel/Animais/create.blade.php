@extends('Painel.layoutPainel')  
@section('conteudo')             
<div class="container bg-light container-create borda-container">
	@if(isset($animal))
	<!--div id="aviso-imagem" class="collapse show">
		<div class="row alert alert-info" style="margin-left: 0px; margin-right: 0px">			
			<div class="col-11">
				Para editar a imagem de um animal basta acessar a página de visualização individual dele!
			</div>
			<div class="col-1">				
				<a class="btn-fechar-aviso" data-toggle="collapse" data-target="#aviso-imagem" href="#">
					<span>X</span>
				</a>
			</div>				
		</div>
	</div -->	
	@endif
	<div class="row">
		<div class="col-12">
			@if(isset($animal))
			<form class="form" action="{{route($cvRoute.'.update', $animal->id)}}" method="post" enctype="multipart/form-data">						
            {!! method_field('PUT')!!}
			@else
			<form class="form" action="{{route($cvRoute.'.store')}}" method="post" enctype="multipart/form-data">
			@endif
				{!! csrf_field() !!}
				<label class="text" for="nome">Nome do animal:</label>
				<input type="text" name="nome" class="form-control input" placeholder="Ex: Max" value="{{ $animal->nome  ??old('nome')}}" required="" maxlength="30">

                <label class="text" for="peso">Peso:</label>
                <input type="text" name="peso" class="form-control peso input" placeholder="Ex: 001.20(1kg e 20g)" value="{{ $animal->peso  ?? old('peso')}}" required="">

				<label class="text" for="altura">Altura:</label>
				<input type="text" name="altura" class="form-control altura input" placeholder="Ex: 63 cm(não é necessário a unidade de medida)" value="{{ $animal->altura  ?? old('altura')}}" required="">
					
				@if(!isset($animal))
				<label class="text" for="imagem">Imagem(Opcional):</label><br>
				<input type="file" name="imagem" class="input" file-accept="jpg, jpeg, png, gif" value="{{ $animal->imagem  ?? old('imagem')}}"><br>				
				@endif

                <label class="text" for="tipo_id">Tipo de Animal:</label>
                <select name="tipo_id" class="form-control">
					@foreach($tipos as $tipo)
						@if(isset($animal))
							@if($animal->tipo->id == $tipo->id)
								<option value="{{$tipo->id}}" selected=""> {{$tipo->nome}}</option>
							@else
								<option value="{{$tipo->id}}"> {{$tipo->nome}}</option>
							@endif
						@else
							<option value="{{$tipo->id}}"> {{$tipo->nome}}</option>
						@endif
					@endforeach

				</select>

                <label class="text" for="raca">Raça:</label>
                <input type="text" name="raca" class="form-control input" placeholder="Ex: Labrador retriever" value="{{ $animal->raca  ?? old('raca')}}" required="" maxlength="40">
                        
                <label class="text" for="situacao_medica">Situação Médica:</label>
                <input type="text" name="situacao_medica" class="form-control" placeholder="Ex: Saúdavel ou Descrição da doença" value="{{ $animal->situacao_medica  ?? old('situacao_medica')}}" required="" maxlength="100">

				<a href="{{route($cvRoute.'.index')}}" class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px"> Voltar </a>
				@if(isset($animal))
				<button class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px">
					Editar
                </button>
            	@else
				<button class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px">
		    		Cadastrar
                </button>
            	@endif
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.peso').mask('0.00');//Máscara para o peso
		$('.altura').mask('000');//Máscara para a altura
	})
</script>
@endsection