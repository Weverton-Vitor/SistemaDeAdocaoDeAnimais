@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container bg-light container-create borda-container">
	<div id="aviso" class="collapse show">
		<div class="alert alert-danger">
			<div class="row">
				<div class="col-11">
					Ao adicionar um pedido manualmente, todos os pedidos que se referem ao animal selecionado neste cadastro serão negados
				</div>
				<div class="1">
				<a class="btn-fechar-aviso" data-toggle="collapse" data-target="#aviso" href="#">
					<span>X</span>
				</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<form class="form" action="{{route($cvRoute.'.validarDados')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                
                <h3 class="text"> Dados do adotante</h3>
				
				<label class="text" for="nome_adotante">Nome do adotante:</label>
				<input type="text" name="nome_adotante" class="form-control" placeholder="Nome:" value="{{old('nome_adotante')}}" required maxlength="40">

                <label class="text" for="cpf_adotante">CPF do adotante:</label>
                <input id="cpf" type="text" name="cpf_adotante" class="form-control" placeholder="000.000.000-00" value="{{old('cpf_adotante')}}" required maxlength="14">

				<label class="text" for="email_adotante">Email do adotante:</label>
				<input type="email" name="email_adotante" class="form-control" placeholder="Email:" value="{{old('email_adotante')}}" required maxlength="50">

				<label class="text" for="telefone_adotante">Telefone do adotante:</label>
				<input id="telefone" type="text" name="telefone_adotante" class="form-control" placeholder="99999-9999" value="{{old('telefone_adotante')}}" required maxlength="11">

				<label class="text" for="cidade">Cidade:</label>
				<input type="text" name="cidade" class="form-control" placeholder="Cidade:" value="{{old('cidade')}}" required maxlength="70">	
				
				<label class="text" for="cep">CEP:</label>
				<input id="cep" type="text" name="cep" class="form-control" placeholder="00000-000" value="{{old('cep')}}" required maxlength="8">

				<label class="text" for="bairro">Bairro:</label>
				<input type="text" name="bairro" class="form-control" placeholder="Bairro:" value="{{old('bairro')}}" required maxlength="70">

				<label class="text" for="rua">Rua:</label>
				<input type="text" name="rua" class="form-control" placeholder="Rua:" value="{{old('rua')}}" required maxlength="70">

				<label class="text" for="numero_casa">Numero da casa:</label>
				<input id='casa' type="text" name="numero_casa" class="form-control" placeholder="Nº:" value="{{old('numero_casa')}}" required maxlength="3">
                        
                <label class="text" for="informacoes_adicionais ">Informações adicionais(opcional):</label>
                <textarea class="form-control" name="informacoes_adicionais" cols="30" rows="5" placeholder="Informações adicionais sobre a adoção:"></textarea>

				<a href="{{route($cvRoute.'.index')}}" class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px"> Voltar </a>
				@if(isset($animal))
				<button class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px">
					Editar
                </button>
            	@else
				<button class="btn btn-primary" style="margin-top:20px; margin-bottom: 20px">
		    		Confirmar
                </button>
            	@endif
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#cpf').mask('000.000.000-00');//Máscara para o cpf
		$('#telefone').mask('0000-00009');//Máscara para o telefone
		$('#cep').mask('00000-000'); // Máscara para o cep
		$('#casa').mask('099')// Máscara para o número da casa
	})
</script>
@endsection