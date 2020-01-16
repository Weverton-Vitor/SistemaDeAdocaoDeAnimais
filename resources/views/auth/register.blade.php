@extends('Site.layoutSite')

@section('conteudo')
<style>
    body{
        background-color:  #c09174;
    }
</style>
<div class="container"  style="padding-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card box-login-register">
                <div class="card-header text-center box-header-login-register">{{ __('Registrar-se') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Nome do adotante:') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nome:" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Endereço de E-Mail do adotante:') }}</label>                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email:" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="cpf_adotante">CPF do adotante:</label>
                                <input id="cpf" type="text" name="cpf_adotante" class="form-control" placeholder="000.000.000-00" value="{{old('cpf_adotante')}}" required maxlength="14">                            
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="telefone_adotante">Telefone do adotante:</label>
                                <input id="telefone" type="text" name="telefone_adotante" class="form-control" placeholder="99999-9999" value="{{old('telefone_adotante')}}" required maxlength="11">
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="cidade">Cidade:</label>
                                <input id="cidade" type="text" name="cidade" class="form-control" placeholder="Cidade:" value="{{old('cidade')}}" required maxlength="70">	                            
                        </div>
                        
                        <div class="form-group">                            
                                <label class="text" for="cep">CEP:</label>
                                <input id="cep" type="text" name="cep" class="form-control" placeholder="00000-000" value="{{old('cep')}}" required maxlength="8">                            
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="bairro">Bairro:</label>
                                <input id="bairro" type="text" name="bairro" class="form-control" placeholder="Bairro:" value="{{old('bairro')}}" required maxlength="70">                            
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="rua">Rua:</label>
                                <input id="rua" type="text" name="rua" class="form-control" placeholder="Rua:" value="{{old('rua')}}" required maxlength="70">                            
                        </div>

                        <div class="form-group">                            
                                <label class="text" for="numero_casa">Numero da casa:</label>
                                <input id='casa' type="text" name="numero_casa" class="form-control" placeholder="Nº:" value="{{old('numero_casa')}}" required maxlength="3">                            
                        </div>
                        
                        <div class="form-group">
                            <label for="password">{{ __('Senha:') }}</label>                            
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha:" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror            
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmar Senha:') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repetir a senha:" required autocomplete="new-password">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-1">
                                <div class="float-left">
                                    <button type="submit" class="btn btn-login-register">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
