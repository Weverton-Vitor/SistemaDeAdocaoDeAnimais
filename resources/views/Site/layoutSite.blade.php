<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <script src="{{ url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ url('/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('/bootstrap-4.4.1-dist/js/jQuery-Mask-Plugin/dist/jquery.mask.min.js') }}"></script>
        <link rel="stylesheet" href="{{ url('/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}">    
        <link rel="stylesheet" href="{{url('css/styleSite.css')}}">        
        <title>{{$cvTitlePage ?? ''}}</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row linha-menu">
                <div class="col-1" style="margin-top: 5px; margin-bottom: 5px">
                    <img src="{{url('/img/logo.png')}}" width="70px">
                </div>
                <div class="col-7" style="margin: auto;">
                    <nav class="navbar navbar-expand-lg">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.index')}}"> Home</a>
                            </li>    
                            @if(Auth::check())               
                            @if(!is_null(Auth::user()->dados_adotante_id))        
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.adoteUmAnimal')}}"> Adotar um animal</a>
                            </li>  
                            @endif                            
                            @endif
                            @if(Auth::check())
                            @if(is_null(Auth::user()->dados_adotante_id))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Painel.index')}}"> Acessar painel de controle</a>
                            </li>                            
                            @endif
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.contato')}}"> Contatos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.sobre')}}"> Sobre</a>
                            </li>
                            @if(!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}"> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"> Registrar-se</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-4" style="margin: auto;">                
                    <div class="float-right">
                        @if(Auth::check())
                        <p class="badge badge-secondary" style="font-size: 15px; background-color: #3c1800; padding: 15px; margin-top: 10px">Usuário: {{Auth::user()->name}}</p>
                        @endif
                    </div>
                </div>
            </div>            
        </div>       
        @yield('conteudo')
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
    </body>
</html>