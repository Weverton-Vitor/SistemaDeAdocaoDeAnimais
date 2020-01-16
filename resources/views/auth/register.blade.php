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
                                <label for="cpf_adotante">CPF do adotante:</label>
                                <input id="cpf_adotante" type="text" name="cpf_adotante" class="form-control" placeholder="000.000.000-00" value="{{old('cpf_adotante')}}" required maxlength="14">                            
                        </div>

                        <div class="form-group">                            
                                <label for="telefone_adotante">Telefone do adotante:</label>
                                <input id="telefone_adotante" type="text" name="telefone_adotante" class="form-control" placeholder="99999-9999" value="{{old('telefone_adotante')}}" required maxlength="11">
                        </div>

                        <div class="form-group">                            
                                <label for="cidade">Cidade:</label>
                                <input id="cidade" type="text" name="cidade" class="form-control" placeholder="Cidade:" value="{{old('cidade')}}" required maxlength="70">	                            
                        </div>
                        
                        <div class="form-group">                            
                                <label for="cep">CEP:</label>
                                <input id="cep" type="text" name="cep" class="form-control" placeholder="00000-000" value="{{old('cep')}}" required maxlength="8">                            
                        </div>

                        <div class="form-group">                            
                                <label for="bairro">Bairro:</label>
                                <input id="bairro" type="text" name="bairro" class="form-control" placeholder="Bairro:" value="{{old('bairro')}}" required maxlength="70">                            
                        </div>

                        <div class="form-group">                            
                                <label for="rua">Rua:</label>
                                <input id="rua" type="text" name="rua" class="form-control" placeholder="Rua:" value="{{old('rua')}}" required maxlength="70">                            
                        </div>

                        <div class="form-group">                            
                                <label for="numero_casa">Numero da casa:</label>
                                <input id='numero_casa' type="text" name="numero_casa" class="form-control" placeholder="Nº:" value="{{old('numero_casa')}}" required maxlength="3">                            
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

                        <input name="adotante" type="hidden" value="1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$('#cpf_adotante').mask('000.000.000-00');//Máscara para o cpf
		$('#telefone_adotante').mask('0000-00009');//Máscara para o telefone
		$('#cep').mask('00000-000'); // Máscara para o cep
		$('#numero_casa').mask('099')// Máscara para o número da casa
	})
</script>
@endsection
