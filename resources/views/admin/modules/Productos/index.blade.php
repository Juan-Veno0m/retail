@extends('master-admin')
@section('title', 'Productos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-producto" data-toggle="modal" data-target="#form-producto">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <form role="search" method="GET" action="{{url('productos/index')}}" class="search d-flex align-items-center">
            <div class="input-group mb-3 icon-search">
              <span><i class="fas fa-search"></i></span>
              <input type="search" name="q" value="{{$q}}" class="form-control" placeholder="Ingrese su busqueda y presione Enter">
            </div>
          </form>
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla productos -->
            @include('admin.modules.Productos.tblproductos')
          </div>
          {{ $productos->links() }}
        </div>
      </div>
    </div>
    <!-- Modal -->
    @include('admin.modules.Productos.modal-create')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<script>
  let flag_agregar_producto = false; let modalform = $('#form-producto'); let trpadre; let tblproductos = $('#tabla-productos');
  let path = $('.root').data('path'); let modaltitle = $('#form-producto .modal-title');
  // Event Listener Form
  document.getElementById("guardar-producto").addEventListener('click', (e) => {
    // Button
    if (flag_agregar_producto == false) {
      // flag
      flag_agregar_producto = true;
      // validated
      let error=0; let action = modalform.data('action'); let arraydata = {};
      $('#form-producto .validated, #form-producto .selectpicker').map(function () {
        if ($(this).val()=="" || $(this).val()==0) {error++;}
        else{ arraydata[$(this).attr("name")] = $(this).val();}
      }).get();
      if (error>0) {Swal.fire('Por favor, llene los campos requeridos'); flag_agregar_producto=false;}
      else {
        //
        flag_agregar_producto=true;
        if (action=='update') {arraydata['id'] = modalform.data('id');}
        // ajax
        $.ajax({
          url: path+'/productos/'+action,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {data:arraydata}
        })
        .done(function(data) {
          // complete
          if (data.tipo=='success' && action=='update') {
            // update data from row affected
            trpadre.find('[name ="producto"]').html(arraydata['producto']);
            trpadre.find('[name ="categoria"]').html(arraydata['categoria']);
            trpadre.find('[name ="precio"]').html(arraydata['precio']);
          }else if (data.tipo=='success' && action=='create') {
            // get last index
            let number = $('#tabla-productos tr:last').data('index');
            $('#tabla-productos tbody').append('<tr data-id="'+data.id+'">'+
              '<th scope="row">'+(number+1)+'</th>'+
              '<td name="producto">'+arraydata['producto']+'</td>'+
              '<td name="categoria">'+modalform.find('[name ="categoria"] option:selected').text()+'</td>'+
              '<td name="precio">'+arraydata['precio']+'</td>'+
              '<td name="stock">10</td>'+
              '<td>'+
                '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">'+
                  '<button type="button" name="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-edit"></i></button>'+
                  '<button type="button" name="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-trash"></i></button>'+
                  '<button type="button" name="imagenes" class="btn btn-sm btn-light"><i class="far fa-images"></i></button>'+
                '</div>'+
              '</td>'+
            '</tr>');
          }
          // Close model and show alert message
          modalform.modal('toggle');
          Swal.fire({
            title:data.mensaje,
            icon: data.tipo,
            timer: 1500,
            onDestroy: () => { }
          });
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

      }
    }else{
      /*Agregando producto, por favor espere... */
      Swal.fire({
        title:"Agregando producto, por favor espere...",
        icon: "warning",
        timer: 1500,
        onDestroy: () => { }
      });
    }
  });
  // Jquery click Agregar
  $("a[name='agregar-producto']").click(function(event) { modalform.data('action','create');
    modaltitle.html('Agregar Producto')});
  // Jquery click edit
  tblproductos.on('click', 'button[name="editar"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    trpadre = btn.parents('tr');
    modalform.modal('show');
    modaltitle.html('Editar Producto');
    modalform.data('action','update'); modalform.data('id',trpadre.data('id'));
    // ajax
    $.ajax({
      url: path+'/productos/read',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id: trpadre.data('id')}
    })
    .done(function(data) {
      // Set data to input
      modalform.find('[name ="producto"]').val(data.productos.ProductosNombre);
      modalform.find('[name ="proveedor"]').val(data.productos.ProveedorID);
      modalform.find('[name ="categoria"]').val(data.productos.CategoriaID);
      modalform.find('[name ="unidad"]').val(data.productos.Unidad);
      modalform.find('[name ="cantidad"]').val(data.productos.Cantidad);
      modalform.find('[name ="precio"]').val(data.productos.PrecioUnitario);
      $('.selectpicker').selectpicker('refresh')
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  });
  // Jquery click delete
  tblproductos.on('click', 'button[name="eliminar"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trpadre = btn.parents('tr');
    //
    Swal.fire({
      title:"Under development ... <php>",
      icon: "info",
      timer: 1500,
      onDestroy: () => { }
    });
  });
  // Jquery click gallery
  tblproductos.on('click', 'button[name="imagenes"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trpadre = btn.parents('tr');
    //
    Swal.fire({
      title:"Under development ... <php>",
      icon: "info",
      timer: 1500,
      onDestroy: () => { }
    });
  });
</script>
@endsection
