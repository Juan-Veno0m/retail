@extends('master-admin')
@section('title', 'Productos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .dz-filename > span {
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 100%;
    }
    .selected-item > .img-thumbnail {
      background: #358439;
      box-shadow: 0px 0px 6px #358439;
    }
    .featured > .img-thumbnail {
      border: solid 2px #f7f000;
    }
    .cover {
      object-fit: cover;
      height: 140px !important;
      width: 100%;
    }
    .table-select > tbody > tr.active {
      border-left: solid 5px #036665;
      background: #c5f2c3;
    }
    .table-bordered-bottom th, .table-bordered-bottom td {
      border-bottom: 1px solid #dee2e6;
    }
    /* swal2 multiple select */
    .swal2-content .dropdown-toggle {
      border: 0;
      background: transparent;
      border-bottom: 1px solid #ced4da;
    }
    .swal2-content .dropdown-toggle.btn-light:active {
      border-bottom: 1px solid #4285f4;
      -webkit-box-shadow: 0 1px 0 0 #4285f4;
      box-shadow: 0 1px 0 0 #4285f4;
      background: transparent;
    }
    .swal2-content .dropdown-menu {
      min-width: 406px !important;
      max-height: 170px;
      margin: 0;
      overflow-y: auto;
      background-color: #fff;
      -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
      box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
      border-radius: 0em;
    }
    .swal2-content .bootstrap-select .dropdown-item:active {
      background: #eee;
      color: #000;
    }
    .swal2-content .dropdown-menu .selected {
      background-color: #eee;
    }
    .swal2-content .dropdown-menu .text {
      font-size: .9rem;
      color: #4285f4;
      margin-left: 24px;
    }
    .swal2-content .dropdown-menu .bs-ok-default.check-mark::after {
      width: 12px;
      height: 1.375rem;
      border-top: 2px solid transparent;
      border-right: 2px solid #4285f4;
      border-bottom: 2px solid #4285f4;
      border-left: 2px solid transparent;
      -webkit-transform: rotate(40deg);
      transform: rotate(40deg);
      -webkit-transform-origin: 100% 100%;
      transform-origin: 100% 100%;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
    }
    .swal2-content .dropdown-menu .selected span.check-mark {left: 4px;}
    .swal2-content .dropdown-menu .bs-searchbox .form-control {
      border: 0;
      border-radius: 0;
      border-bottom: 1px solid #ced4da;
    }
    .swal2-content .dropdown-menu .bs-searchbox .form-control:focus {
      border-bottom: 1px solid #4285f4;
      -webkit-box-shadow: 0 1px 0 0 #4285f4;
      box-shadow: 0 1px 0 0 #4285f4;
    }
    .table thead th{
      border-bottom: none;
      background: #2f6766;
      color: #fff;
      border-radius: 12px;
      border-right: solid 2px #fff;
    }
  </style>
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-light ml-2" name="agregar-producto" data-toggle="modal" data-target="#form-producto">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          @include('admin.modules.Productos.search')
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla productos -->
            @include('admin.modules.Productos.tblproductos')
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    @include('admin.modules.Productos.modal-create')
    @include('admin.modules.Productos.modal-images')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/dropzone.min.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/basic.min.css">
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css" rel="stylesheet">
<script>
  let flag_agregar_producto = false; let modalform = $('#form-producto'); let trpadre; let tblproductos = $('#tabla-productos');
  let path = $('.root').data('path'); let modaltitle = $('#form-producto .modal-title'); let modalimages = $('#form-images');
  let flag_cargar_imagenes = false;
  // Event Listener Form
  document.getElementById("guardar-producto").addEventListener('click', (e) => {
    // Button
    if (flag_agregar_producto == false) {
      // flag
      flag_agregar_producto = true;
      // validated
      modalform.addClass('was-validated');
      let error=0; let action = modalform.data('action'); let arraydata = {};
      $('#form-producto .validated, #form-producto .selectpicker').map(function () {
        if ($(this).val()=="") {error++;}
        else{ arraydata[$(this).attr("name")] = $(this).val();}
      }).get();
      if (error>0) {Swal.fire('Por favor, llene los campos requeridos'); flag_agregar_producto=false;}
      else {
        //
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
          flag_agregar_producto=false;
          if (data.tipo=='success' && action=='update') {
            // update data from row affected
            trpadre.find('[name ="producto"]').html(arraydata['producto']);
            trpadre.find('[name ="categoria"]').html(modalform.find('[name ="categoria"] option:selected').text());
            trpadre.find('[name ="precio"]').html(arraydata['precio']);
          }else if (data.tipo=='success' && action=='create') {
            // get last index
            let number = $('#tabla-productos tr:last').data('index');
            $('#tabla-productos tbody').append('<tr data-id="'+data.id+'">'+
              '<th scope="row">'+(parseInt(number)+1)+'</th>'+
              '<td name="producto">'+arraydata['producto']+'</td>'+
              '<td name="categoria">'+modalform.find('[name ="categoria"] option:selected').text()+'</td>'+
              '<td name="precio">'+arraydata['precio']+'</td>'+
              '<td name="stock">10</td>'+
              '<td>'+
                '<div class="btn-group" role="group" aria-label="Button group with nested dropdown">'+
                  '<button type="button" name="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-edit"></i></button>'+
                  '<button type="button" name="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-trash"></i></button>'+
                  '<button type="button" name="imagenes" class="btn btn-sm btn-light"><i class="far fa-images"></i></button>'+
                  '<button type="button" name="localidades" title="localidades" class="btn btn-sm btn-light"><i class="fas fa-city"></i></button>'+
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
    // Clean Form input
    cleaninput();
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
      modalform.find('[name ="descripcion"]').val(data.productos.Descripcion);
      modalform.find('[name ="unidad"]').val(data.productos.Unidad);
      modalform.find('[name ="cantidad"]').val(data.productos.Cantidad);
      modalform.find('[name ="precio"]').val(data.productos.PrecioUnitario);
      modalform.find('[name ="precioby"]').val(data.productos.PrecioBy);
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
      title: 'Esta seguro de eliminar?',
      text: "Esta acción no se podrá revertir!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'si, borrar!',
      cancelButtonText:'Cancelar'
    }).then((result) => {
      if (result.value) {
        /* send ajax */
        $.ajax({
          url: path+'/productos/delete',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {id: trpadre.data('id')}
        })
        .done(function(data) {
          if (data.tipo=='ok') {
            trpadre.remove();
            Swal.fire(
              'Borrado!',
              'El producto ha sido eliminado',
              'success'
            )
          }else if (data.tipo=='error') {
            Swal.fire(
              'Error!',
              'No se puede eliminar el producto',
              'error'
            )
          }
        });

      }
    });

  });
  // Jquery click gallery
  tblproductos.on('click', 'button[name="imagenes"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trpadre = btn.parents('tr');
    // cleanup
    Dropzone.forElement('#my-awesome-dropzone').removeAllFiles(true)
    modalimages.find('#container-imagenes').empty();
    modalimages.modal('show');
    modalimages.find('input[name="producto"]').val(trpadre.data('id'));
  });
  // Event Listener Load Images
  document.getElementById('nav-cargar-imagenes-tab').addEventListener('click',(e)=> {
    //
    if (flag_cargar_imagenes == false) {
      loadimagenes();
    }else{
      /*Cargando producto, por favor espere... */
      Swal.fire({
        title:"Cargando producto, por favor espere...",
        icon: "warning",
        timer: 1500,
        onDestroy: () => { }
      });
    }
  });
  // cls form
  function cleaninput(){$('#form-producto .validated, #form-producto .selectpicker').map(function () {$(this).val("");}); }
  // Fuction Load Imagenes
  function loadimagenes(){
    // flag
    flag_cargar_imagenes = true;
    modalimages.find('#container-imagenes').empty();
    // Ajax
    $.ajax({
      url: path+'/productos/images/read',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id: modalimages.find('input[name="producto"]').val()}
    })
    .done(function(data) {
      //
      if (data.tipo == "success") {
        // fill
        if (data.imagenes.length == 0) {
          // append
          modalimages.find('#container-imagenes').append('<div class="col my-2"><h6 class="text-center"><i class="far fa-frown"></i> Producto sin imagenes</h6></div>');
        }else{
          let html_images=''; let regenerate=1;
          $.each(data.imagenes,function(index, el) {let featured='';
            if (el.ImagenesPID == data.featured['Featured']) { featured='featured'}
            if (el.img.includes('original')) {regenerate=0;}
            html_images+='<div class="col-xl-4 my-2 col-img '+featured+'">'+
              '<img src="'+path+'/uploads/'+el.img+'" data-src="'+el.img+'" data-regenerate="'+regenerate+'" class="img-fluid img-thumbnail cover" data-id="'+el.ImagenesPID+'">'+
            '</div>';
          });
          // append
          modalimages.find('#container-imagenes').append(html_images)
        }
        // flag
        flag_cargar_imagenes = false;
      }
    });
  }
  // Select img
  modalimages.on('click', '.img-thumbnail', function(event) {
    event.preventDefault();
    let divPadre = $(this).parents('.col-img');
    /* Act on the event */
    if (!divPadre.hasClass('selected-item')) {
      divPadre.addClass('selected-item');
      /* enabled */
      modalimages.find('#opciones_imagen').removeClass('disabled');
    }else{divPadre.removeClass('selected-item');}
  });
  // Actualizar Imagenes
  modalimages.on('click', 'button[name="actualizar"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    loadimagenes();
  });
  // Select featured
  modalimages.on('click', 'button[name="principal"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    let productoid = modalimages.find('input[name="producto"]').val(); let count=0;
    modalimages.find('#container-imagenes .selected-item').each( function(){count++;});
    if (count==1) {
      // continuar
      let imagenid = modalimages.find('#container-imagenes .selected-item .img-thumbnail').data('id');
      // Send ajax
      $.ajax({
        url: path+'/productos/images/featured',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: {productoid: productoid,imagenid:imagenid}
      })
      .done(function(data) {
        //
        Swal.fire({
          title: data.mensaje,
          icon: data.tipo,
          timer: 1500,
          onDestroy: () => { loadimagenes();}
        });
      });

    }else{
      // Seleccione solo 1 elemento como principal
      Swal.fire({
        title:"Seleccione solo una imagen",
        icon: "warning",
        timer: 1500,
        onDestroy: () => { }
      });
    }
  });
  // delete imagen
  modalimages.on('click', 'button[name="eliminar"]', function(event) {
    // Select
    let count=0;
    modalimages.find('#container-imagenes .selected-item').each( function(){count++;});
    if (count>=1) {
      // continuar
      let ImagenesPID = modalimages.find('#container-imagenes .selected-item .img-thumbnail').map(function(index,el){
        return [[ $(this).data('id'), $(this).data('src')]];
      }).get();
      // * Confirmar
      Swal.fire({
        title: '¿Esta Seguro?',
        text: "No se podra revertir cambios!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!'
      }).then((result) => {
        if (result.value) {
          // Ajax
          $.ajax({
            url: path+'/productos/images/delete',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'json',
            data: {ImagenesPID:ImagenesPID}
          })
          .done(function(data) {
            //
            Swal.fire({
              title: data.mensaje,
              icon: data.tipo,
              timer: 1500,
              onDestroy: () => { loadimagenes();}
            });
          });

        }
      });
    }else{
      // Seleccione elementos
      Swal.fire({
        title:"Seleccione las imagenes que desea eliminar",
        icon: "warning",
        timer: 1500,
        onDestroy: () => { }
      });
    }
  });
  // active tr table products
  tblproductos.on('click', 'tr', function(event) {
    let tr = $(this);
    // find the one
    tr.parents('tbody').find('.active').removeClass('active');
    if (!tr.hasClass('active')) {
      tr.addClass('active');
    }else{tr.removeClass('active');}
  });
  // stock dialog
  tblproductos.on('click', 'button[name="stock"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    let btn = $(this);
    let btnParent = btn.parents('tr');
    Swal.fire({
      title: 'Cambio de Stock',
      icon: 'warning',
      width: 600,
      html:
      '<div class="container-fluid mt-4 needs-validation" id="form">'+
        '<div class="row form-group">'+
          '<label for="stock" class="col-sm-5 col-form-label text-left">Stock</label>'+
          '<div class="col-sm-7">'+
            '<input type="text" class="form-control array" name="stock" id="stock" required>'+
          '</div>'+
        '</div>'+
        '<div class="row form-group">'+
          '<label for="comentarios" class="col-sm-5 col-form-label text-left">Comentarios</label>'+
          '<div class="col-sm-7">'+
            '<textarea rows="2" class="form-control array" name="comentarios" id="comentarios" required></textarea>'+
          '</div>'+
        '</div>'+
        '<div class="row form-group float-right">'+
          '<button name="guardar" class="btn btn-dark">Guardar</button>'+
        '</div>'+
      '</div>',
      showConfirmButton: false,
      showCancelButton: false,
      showCloseButton: true,
      onRender:() => {
        let flag=false;
        /* click */
        $('.swal2-container').on('click', 'button[name="guardar"]', function(event) {
          event.preventDefault();
          /* Act on the event */
          let save = $(this); let error=0; let datos={};
          let saveparent = save.parents('#form');
          saveparent.addClass('was-validated');
          saveparent.find('.array').each(function(index, el) {
            if ($(this).val()=="" && $(this).prop('required')) {error++;}
            else{
              datos[$(this).attr("name")] = $(this).val();
            }
          });
          if (error==0 && flag==false) {
            flag=true;
            datos['oldstock'] = btn.val(); datos['key'] = btnParent.data('id');
            /*ajax */
            $.ajax({
              url: path+'/productos/stock',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              dataType: 'json',
              data: datos
            })
            .done(function(data) {
              if (data.tipo==200) {
                Swal.fire('Cambios aplicados!', '', 'success')
                btn.html('<i class="fas fa-layer-group"></i> '+data.stock);
                btn.val(data.stock);
              }
            });
          }
        });
      }
    })
  });
  // localidades disponibles
  tblproductos.on('click', 'button[name="localidades"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    let btn = $(this); let initial;
    let btnParent = btn.parents('tr');
    Swal.fire({
      title: 'Localidades disponibles',
      width: 600,
      html:
      '<div class="container-fluid mt-4 needs-validation" id="form">'+
        '<div class="row form-group">'+
          '<label for="localidad" class="col-sm-12 col-form-label text-center" style="font-size: .8rem;color: #757575;">Localidades</label>'+
          '<select class="selectpicker col-sm-12" width="fit" id="localidad" multiple data-live-search="true" title="Selecione localidades">'+
          '</select>'+
        '</div>'+
        '<div class="row form-group justify-content-center pt-4">'+
          '<button name="guardar" class="btn btn-sm btn-dark">Guardar</button>'+
        '</div>'+
      '</div>',
      onBeforeOpen: () => {
        Swal.showLoading()
        // get localidades
        $.ajax({
          url: path+'/productos/localidades',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {id: btnParent.data('id')}
        }).done(function(data) {
          let select = $('#localidad'); let items="";
          select.empty();
          $.each( data.local, function( i, item ) {
              items+='<option value="'+item.id+'">'+item.nombre+'</option>';
          });
          select.append(items);select.selectpicker();
          // render select
          initial = data.plocal.map(function(a) {return a.LocalidadID;}); // get only values from objt
          select.selectpicker('val',initial);
          Swal.hideLoading()
        });

      },
      showConfirmButton: false,
      showCancelButton: false,
      showCloseButton: true,
      onRender:() => {
        let flag=false;
        /* click */
        $('.swal2-container').on('click', 'button[name="guardar"]', function(event) {
          event.preventDefault();
          /* Act on the event */
          let localidad = $('#localidad').val();
          if (localidad.length>0) {
            let res =  localidad.map(function (x) {return parseInt(x, 10);});
            //* arrays */
            let eliminar = initial.filter(x => res.indexOf(x) === -1);
            let agregar = res.filter(x => initial.indexOf(x) === -1);
            /* ajax */
            $.ajax({
              url: path+'/productos/localidadesTx',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              dataType: 'json',
              data: {id:btnParent.data('id'),eliminar:eliminar, agregar:agregar }
            })
            .done(function(data) {
              if (data.tipo==200) {
                Swal.fire('Cambios aplicados!', '', 'success');
              }
            });
          }else{$('#localidad').selectpicker('toggle');}

        });
      }
    })
  });
  // Descontinuar / Habilitar producto
  tblproductos.on('click', 'button[name="descontinuado"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    let btn = $(this);
    let btnParent = btn.parents('tr');
    let icon; bit = 0;
    if (btn.val()==0) {icon='<i class="fas fa-toggle-off"></i>';bit=1;}else{icon='<i class="fas fa-toggle-on"></i>';}
    /* confirm action */
    Swal.fire({
      title: '¿Esta seguro de continuar?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `Continuar`,
    }).then((result) => {
      if (result.isConfirmed) {
        /*ajax */
        $.ajax({
          url: path+'/productos/descontinuado',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {id: btnParent.data('id'),bit:bit}
        })
        .done(function(data) {
          if (data.tipo==200) {
            Swal.fire('Cambios aplicados', '', 'success')
            btn.html(icon);
            btn.val(bit);
          }else{console.log(data.tipo)}
        });
      }
    })

  });
</script>
@endsection
