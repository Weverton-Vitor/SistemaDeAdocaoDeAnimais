<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width-device-width, initial-scale=1.0"/>
        <title> {{$cvTitlePage ?? "Titulo da página"}}</title>
        <link rel="stylesheet" href="{{ url('/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}">      
        <link rel="stylesheet" href="{{url('/css/styleLayoutPainelEAnimais.css')}}">
        <link rel="stylesheet" href="{{url('/css/stylePedidosAdocao.css')}}">
        <script src="{{ url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ url('/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('/bootstrap-4.4.1-dist/js/jQuery-Mask-Plugin/dist/jquery.mask.min.js') }}"></script>
    </head>
<body> 
    <div class="container container-layout borda-container">  
        <div class="row text-center">
            <div class="col-12">                
                 <h1 class="text"> {{$cvHeaderPage ?? "Nome da página"}} </h1>
            </div>            
        </div>  
        @include('includes.MensagemSucessoOuFalha')
        @include('includes.ErrosFormRequest')
        <div class="row">
            <div class="col-12">                    
                <nav class="navbar navbar-expand-sm menu bg-light">
                    <ul class="nav bg-light">
                        @if(isset($activeDashboard))
                        <li class="nav-item item itemAtivo">
                        @else
                        <li class="nav-item item ">
                        @endif
                            <a class="nav-link text" href="{{route('Painel.index')}}">Página Inicial</a>                            
                        </li>
                        @if(isset($activeAnimal))
                        <li class="nav-item item itemAtivo">
                        @else
                        <li class="nav-item item ">
                        @endif
                            <a class="nav-link text" href="{{route('Animais.index')}}">Animais</a>
                        </li>
                        @if(isset($activeIndexNovoPedido))
                        <li class="nav-item item itemAtivo">
                        @else
                        <li class="nav-item item ">
                        @endif
                            <a class="nav-link text" href="{{route('PedidosAdocao.index', ['novosPedidos' => 'true'])}}">
                                Novos pedidos de adoção
                                <span style="background-color: red; color: white; font-size: 14px ;padding: 5px; border-radius:100%">
                                    {{session('nNovosPedidos')}}
                                </span>
                            </a>
                        </li>
                        @if(isset($activeIndexTodosPedidos))
                        <li class="nav-item item itemAtivo">
                        @else
                        <li class="nav-item item ">
                        @endif
                            <a class="nav-link text" href="{{route('PedidosAdocao.index')}}">Todos os pedidos de adoção</a>
                        </li>
                        <li class="nav-item item ">                        
                            <a class="nav-link text" href="{{route('Site.index')}}"> Voltar para o site</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        @yield('conteudo')
    </div>   
</body>