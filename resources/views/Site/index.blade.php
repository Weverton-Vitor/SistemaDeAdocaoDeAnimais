@extends('Site.layoutSite')
@section('conteudo')
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
@endsection