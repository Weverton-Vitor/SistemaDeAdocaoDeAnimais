<!DOCTYPE html>
<html lang="en">
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
                                <a class="nav-link" href="#"> Home</a>
                            </li>                           
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Adotar um animal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Contato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Sobre</a>
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
        <div class="container-fluid" style="padding: 0px; margin-bottom: auto">
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicadores -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>

                <!-- Imagens -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="img-home" src="{{url('/img/animais1.jpg')}}" alt="Los Angeles">                        
                        <div class="carousel-caption legenda-img">
                            <h3>Faça o bem</h3>                           
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="img-home" src="{{url('/img/animais3.jpg')}}" alt="New York">
                        <div class="carousel-caption legenda-img">
                            <h3>Adote um animal</h3>                           
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="img-home" src="{{url('/img/animais2.jpg')}}" alt="Chicago">
                        <div class="carousel-caption legenda-img">
                            <h3>Tenha um companheiro(a)</h3>  
                        </div>
                    </div>
                </div>

                <!-- Setas da esquerda e da direita -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        </div>
    </body>
</html>