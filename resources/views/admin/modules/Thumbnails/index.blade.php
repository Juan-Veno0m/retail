@extends('master-admin')
@section('title', 'Regenerar Miniaturas')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-header">
          Examina las imagenes de los productos y regenera las miniaturas <small>(Mobile, Medium, Large)</small>
        </div>
        <div class="card-body">
          <!-- Search Form - Filter -->
          <div class="col">
            <button type="button" name="check" class="btn btn-sm btn-info">Revisar</button>
            <button type="button" name="regenerate" class="btn btn-sm btn-primary">Regenerar</button>
          </div>
        </div>
        <div class="card-footer">
          <p class="number">{{$productos}} Archivos</p>
        </div>
      </div>
    </div>
    <!-- Modal -->
@endsection
@section('scripts')
<script>
  /* flags */
  let flag=false;
  let path = $('.root').data('path');
  /* Revisar */
  $('button[name="check"]').click(function(){
    //do ajax
    let btn = $(this);
    if (flag==false) {
      // do
      flag=true;
      btn.html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
      $.getJSON(path+'/thumbnails/read', function(data) {
        /*optional stuff to do after success */
        $('.number').html(data.productos+' Archivos'); flag=false; btn.html('Revisar');
      });
    }else{console.log('wait');}

  });
  /* Regenerar */
  $('button[name="regenerate"]').click(function(){
    //do ajax
    let btn = $(this);
    if (flag==false) {
      // do
      flag=true;
      btn.html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
      $.getJSON(path+'/thumbnails/regenerate', function(data) {
        /*optional stuff to do after success */
        if (data.tipo=='success') {
          flag=false; btn.html('Regenerar');
        }else{console.log('wrong');}
      });
    }else{console.log('wait');}

  });
</script>
@endsection
