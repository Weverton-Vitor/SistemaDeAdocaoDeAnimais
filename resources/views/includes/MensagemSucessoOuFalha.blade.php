@if(session('success'))
<div id="aviso" class="container collapse show" style="margin: 10px 0px 0px 0px">
    <div class="row alert alert-success">
        <div class="col-sm-11">                       
            {{session('success')}}                  
        </div> 
        <div class="col-1">                  
            <a class="btn-fechar-aviso" data-toggle="collapse" data-target="#aviso" href="#">
				<span>X</span>
			</a>
        </div>
    </div>
</div>
{{request()->session()->forget('success')}}
@elseif(session('error'))   
<div id="aviso" class="container collapse show" style="margin: 10px 0px 0px 0px">
    <div class="row alert alert-danger">
        <div class="col-sm-11">
            {{session('error')}}                          
        </div>                      
        <div class="col-1">                  
            <a class="btn-fechar-aviso" data-toggle="collapse" data-target="#aviso" href="#">
				<span>X</span>
			</a>
        </div> 
    </div>
</div>
{{request()->session()->forget('error')}}
@endif