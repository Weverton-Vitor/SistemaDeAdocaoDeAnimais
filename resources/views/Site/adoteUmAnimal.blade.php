@extends('Site.layoutSite')
@section('conteudo')
<style>
    body{
        background-color:  #c09174;
    }
</style>
<div class="container container-selecionar-animais">    

    @foreach($animais as $animal)
    <div class="card card-animal">
        <div class="card-header">
            <h4 class="card-title">{{$animal->nome}}</h4>
        </div>

        <div class="card-body" style="padding: 0px">
            @if(is_null($animal->imagem))
            <!-- Animal sem imagem-->
            <img class="card-img-top img-animal" src="{{url('/img/imagemGenerica.png')}}">
            @else
            <!-- Animal com imagem-->
            <img class="card-img-top img-animal" src="/storage/uploadImg/{{$animal->imagem}}">
            @endif
            <div style="padding: 10px">
                <p class="text">Peso: {{$animal->peso . " Kg"}}</p>
                <p class="text">Altura: {{$animal->altura . " cm"}}</p>
                <p class="text">Raça: {{$animal->raca}}</p>
                <p class="text">Situação Médica: {{$animal->situacao_medica}}</p>
            </div>
        </div>

        <div class="card-footer" style="padding: 0px">                            
                <button id="{{$animal->id}}" class="btn btn-secondary btn-selecionar" data-toggle="modal" data-target="#myModal" onclick="getId(this)">
                    Selecionar
                </button>                        
        </div>
    </div>
    @endforeach  

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header text-center" style="background-color: #734b3d">
                    <h4 class="modal-title">Aviso!</h4>                
                </div>
                
                <div class="modal-body" style="background-color: #c09174">
                    <p>
                        Essa ação não não confirma adoção, é apenas uma reserva para o animal.<br>
                        Há um prazo de 3 dias para ir ao local fisico da ONG e efetivar<br>
                        a adoção, passados 3 dias o animal ficará disponivel para novas adoções
                    </p>
                    <form id="form" class="form" action="{{route('PedidosAdocao.store')}}" method="post">
                        {!! csrf_field() !!}
                        <input id="animal_id" type="hidden" name="animal_id" value="">
                    </form>
                </div>

                <div class="modal-footer" style="background-color: #c09174">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="background-color: #3c1800" onclick="submitForm()">Continuar</button>
                </div>

            </div>
        </div>
    </div>  

</div>

<div class="container container-selecionar-animais">  
    <div class="row">
        <div class="col-12">
            {{$animais->links()}}
        </div>
    </div>
</div>
<script>
    function getId(object){
        var animalId = object.id;
        document.getElementById('animal_id').value = animalId;
    }

    function submitForm(){
        document.getElementById('form').submit();
    }
</script>
@endsection