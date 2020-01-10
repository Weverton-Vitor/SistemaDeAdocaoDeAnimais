@if(isset($errors) && count($errors) > 0) <!--errors é um varialvel passada pelo controller -->
<div class="container" style="margin-top: 30px">
  <div class="row" style=" padding: 10px 25px 0px 20px">
    <div class="col-sm-12">
      <div class=" alert alert-danger">      
          @foreach(($errors->all()) as $error)
          {{$error}}<br>
          @endforeach      
      </div>                                 
    </div>
  </div>  
</div>  
@endif