@extends('Painel.layoutPainel')  
@section('conteudo')                  
    <!--Formulario para excluir vários-->
    <form action="{{route($cvRoute.'.destroyMany')}}" method="get">
    <!--Linha do grid principal-->
    <div class="row">
        <div class="col-12">
            <table class="table table-striped bg-light tabela-index">
                <thead>
                    <th style="width: 20px"></th>
                    <th> Nome </th>
                    <th> Peso </th>
                    <th> Altura </th>                        
                    <th style="width: 150px;"> Tipo de Animal </th>                    
                    <th style="width: 170px;"> Status de Adoçao</th>
                    <th style="width: 15px"> Ver </th>                        
                    <th style="width: 20px"> Editar </th>                        
                    <th style="width: 20px"> Excluir </th>                        
                </thead>
                <tbody>                               
                    @foreach($cvObjects as $animal)
                    <tr>                                        
                        <td> <input type="checkbox" name="id[]" value="{{$animal->id}}"></td>
                        <td> {{$animal->nome}} </td>
                        <td> {{$animal->peso . " Kg"}} </td>
                        <td> {{$animal->altura . " cm"}} </td>
                        <td> {{$animal->tipo->nome}} </td>                        
                        <td> {{$animal->situacao_adocao == "S" ? "Adotado": "Não adotado"}} </td>
                        <td><center>
                                <a href="{{route($cvRoute.'.show', $animal->id)}}">                                                
                                    <img src="{{url('icones/eye.svg')}}" title="Ver detalhes" class="iconeAcao">
                                </a>
                        </center></td>
                        <td><center>
                        <a href="{{route($cvRoute.'.edit', $animal->id)}}">
                            <img src="{{url('icones/edit-pencil.svg')}}" title="Editar"  class="iconeAcao">
                        </a>
                        </center></td>
                        <td><center>
                            <a href="{{route($cvRoute.'.destroyOne', $animal->id)}}">
                                <img src="{{url('icones/recycle-bin.svg')}}" title="Excluir" class="iconeAcao">
                            </a>
                        </center></td>
                    </tr>
                    @endforeach                                
                </tbody>
            </table>
        </div>
    </div> 
    @if(isset($voltar))
    <div class="row">
        <div class="col-1" style="margin-right: 0px">
            <button class="btn btn-danger">
                Excluir
            </button>
        </div>
        <div class="col-1">
            <a href="{{route($cvRoute.'.index')}}" class="btn btn-secondary"> Voltar </a>
        </div>
        <div class="col-sm-10">
        @if(isset($searchCriteria))                    
            {{$cvObjects->appends(['searchCriteria' => $searchCriteria])->links()}}                        
        @else
            {{$cvObjects->links()}}
        @endif
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-1">
            <button class="btn btn-danger">
                Excluir
            </button>
        </div>
        <div class="col-sm-11">
        @if(isset($searchCriteria))                    
            {{$cvObjects->appends(['searchCriteria' => $searchCriteria])->links()}}                        
        @else
            {{$cvObjects->links()}}
        @endif
        </div>
    </div>
    @endif
</form>    
</div>    
@endsection