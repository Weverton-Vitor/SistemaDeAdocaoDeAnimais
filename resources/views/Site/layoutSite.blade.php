<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <script src="{{ url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ url('/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ url('/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}">    
        <link rel="stylesheet" href="{{url('css/styleSite.css')}}">        
        <title>{{$cvTitlePage}}</title>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.adoteUmAnimal')}}"> Adotar um animal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.contato')}}"> Contatos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Site.sobre')}}"> Sobre</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Registrar-se</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-4" style="margin: auto;">
                    <div class="float-right">
                        <p>Nome do usuário</p>
                    </div>
                </div>
            </div>            
        </div>
        @yield('conteudo')
    </body>
</html>