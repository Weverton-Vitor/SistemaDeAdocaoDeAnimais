@extends('Painel.layoutPainel')
@section('conteudo')
<div class="container bg-white borda-container container-selecionar-animais">
    @foreach($animais as $animal)
    <div class="card card-animal">
        <div class="card-header">
            <h4 class="card-title">{{$animal->nome}}</h4>
        </div>
        <div class="card-body" style="padding: 0px">
            @if(is_null($animal->imagem))
            <!-- Animal sem imagem-->
            <img class="card-img-top" src="{{url('/img/imagemGenerica.png')}}" style="width: 100%">
            @else
            <!-- Animal com imagem-->
            <img class="card-img-top" src="/storage/uploadImg/{{$animal->imagem}}">
            @endif
            <div style="padding: 10px">
                <p class="text">Peso: {{$animal->peso . " Kg"}}</p>
                <p class="text">Altura: {{$animal->altura . " cm"}}</p>
                <p class="text">Raça: {{$animal->raca}}</p>
                <p class="text">Situação Médica: {{$animal->situacao_medica}}</p>
            </div>
        </div>
        <div class="card-footer" style="padding: 0px">
            <form class="form" action="{{route($cvRoute.'.store')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="animal_id" value="{{$animal->id}}">
                <button class="btn btn-primary btn-selecionar">
                    Selecionar
                </button>            
            </form>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12">
            {{$animais->links()}}
        </div>
    </div>
</div>
@endsection