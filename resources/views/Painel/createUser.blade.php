@extends('Painel.layoutPainel')

@section('conteudo')
<div class="container borda-container">
    <div class="row">
        <div class="col-12" style="padding: 0px;">
            <div class="card">
                <div class="card-header text-center box-header-login-register text">{{ __('Registrar') }}</div>

                <div class="card-body text">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Nome:') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nome:" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Endereço de E-Mail:') }}</label>                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email:" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            
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
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
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
		$('#cpf_adotante').mask('000.000.000-00');//Máscara para o cpf
		$('#telefone_adotante').mask('0000-00009');//Máscara para o telefone
		$('#cep').mask('00000-000'); // Máscara para o cep
		$('#numero_casa').mask('099')// Máscara para o número da casa
	})
</script>
@endsection
