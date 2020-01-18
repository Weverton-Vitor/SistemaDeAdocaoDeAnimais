@extends('Site.layoutSite')

@section('conteudo')
<style>
    body{
        background-color:  #c09174;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 100px">
            <div class="card box-login-register">
                <div class="card-header text-center box-header-login-register">{{ __('Confirmar senha') }}</div>

                <div class="card-body">
                    <p>Confirme sua senha antes de continuar.</p><br>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary btn-login-register">
                                    {{ __('Confirmar senha') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
