@extends('master-admin')
@section('title', 'Gestión de Inventarios')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    #generales > tbody > tr > th {background: #eee !important;}
    #generales th, .table-bordered td {border-color: #BDBDBD !important;}
    #generales td {
      text-align: right;
      color: #313131;
      font-family: inherit;
    }
    .table [name="status"] .btn {
      width: 118px;
      font-size: 12px;
      font-weight: 800;
      padding: 2px;
    }
    .btn-default {
      color: #4f4f4f;
      background: #e9ecef;
      border: solid 1px #ced4da;
    }
    .table-select > tbody > tr.active {
      border-left: solid 5px #036665;
      background: #c5f2c3;
    }
    .table-bordered-bottom th, .table-bordered-bottom td {
      border-bottom: 1px solid #dee2e6;
    }
    .table-xs th, .table-xs td {
      padding: 0px 5px;
      font-size: 14px;
      line-height: 1.42857143;
      font-family: 'Arial';
    }
    #change .btn-outline-dark.active::before {
      content: "\f058";
      font-family: "Font Awesome 5 Free";
    }
    form .form-control {
      width: 80%;
      text-align: center;
      height: 34px;
      font-size: 12px;
      border: 1px solid #E5EAEE;
      border-radius: 0.85rem !important;
    }
    .table thead th{
      border-bottom: none;
      background: #2f6766;
      color: #fff;
      border-radius: 12px;
      border-right: solid 2px #fff;
    }
    .custom-file-ok::after {
      background: #06bd67 !important;
      color: #fff !important;
      content: '\f058' !important;
      font-family: "Font Awesome 5 Free";
    }
    .custom-alert {
      display: none;
      background-color: rgba(0, 0, 0, 0.8);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      outline: none;
      z-index: 1090;
    }
    .custom-alert > .title {
      background-color: #fff;
      position: absolute;
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
      top: 0;
      left: 0;
      width: 100%;
      height: 30px;
      max-height: 30px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.5);
      /*! background-color: rgba(255, 255, 255, 0.1); */
      color: #fff;
      padding: 5px 45px 5px 5px;
      border-bottom: 3px solid #0288D1;
    }
    .custom-alert img {
      border: 1px solid transparent;
      background-color: rgba(28, 41, 49, 0.20);
      width: auto;
      max-width: 90%;
      height: auto;
      max-height: 90%;
      margin: 2.5% auto;
      display: block;
      transition: all 1s;
    }
    .custom-alert .title a {
      position: absolute;
      background-color: transparent;
      display: inline-block;
      border: none;
      color: #fff;
      right: 30px;
      outline: none;
    }
    .custom-alert .title button {
      font-size: 25px;
      position: absolute;
      background-color: transparent;
      display: inline-block;
      border: none;
      color: #fff;
      right: 0;
      top: -6px;
      outline: none;
    }
  </style>
  <div class="container-fluid">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Productos</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Compras (Incomming)</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Ventas (Outgoing)</a>
      </li>
    </ul>
    <div class="tab-content shadow py-4 px-3 rounded" id="pills-tabContent">
      <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!-- Search Form - Filter -->
        @include('admin.modules.Inventarios.search')
        <div class="table-responsive" style="min-height:350px;">
          <!-- tabla productos -->
          @include('admin.modules.Inventarios.tblproductos')
        </div>
      </div>
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!-- Search Form - Filter -->
        @include('admin.modules.Inventarios.search')
        <div class="table-responsive" style="min-height:350px;">
          <!-- tabla productos -->
          @include('admin.modules.Inventarios.tblcompras')
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
<script src="{{asset('/js/accounting.min.js')}}" defer></script>
<div aria-hidden="true" class="custom-alert"></div>
<script>
  let tblselect = $('.table-select'); let tblcompras = $('#tabla-compras');
  let path = $('.root').data('path');
  // active tr table products
  tblselect.on('click', 'tr', function(event) {
    let tr = $(this);
    // find the one
    tr.parents('tbody').find('.active').removeClass('active');
    if (!tr.hasClass('active')) {
      tr.addClass('active');
    }else{tr.removeClass('active');}
  });
  /* tbl compras pagos */
  tblcompras.on('click', 'a[name="pago"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trPadre = btn.parents('tr');
    /* Act on the event */
    HistorialPagos(trPadre);
  });
  /* envio action button */
  tblcompras.on('click', 'a[name="envio"]', function(event) {
    let btn = $(this); let trPadre = btn.parents('tr'); let ComprasEnvioID=0;
    Swal.fire({
      title: 'Envío orden No.'+trPadre.data('orden'),
      width: 1400,
      html:
        '<div class="container-fluid">'+
          '<div class="form-row mt-3">'+
            '<div class="form-group col-lg-3">'+
              '<label for="tipoenvio">Tipo de envío</label>'+
              '<div class="input-group input-group-sm">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text"><i class="fas fa-shipping-fast"></i></span>'+
                '</div>'+
                '<select class="custom-select array" id="tipoenvio" name="tipoenvio">'+
                  '<option selected="" disabled="" value="">Seleccione tipo de envio</option>'+
                  '<option value="1">No Aplica</option>'+
                  '<option value="2">Local</option>'+
                  '<option value="3">Paquetería</option>'+
                '</select>'+
              '</div>'+
            '</div>'+
            '<div class="form-group col-lg-1">'+
              '<label for="costoenvio">Costo</label>'+
              '<div class="input-group input-group-sm">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                '</div>'+
                '<input type="text" class="form-control array" id="costoenvio" name="costoenvio">'+
              '</div>'+
            '</div>'+
            '<div class="form-group col-lg-2">'+
              '<label for="fecharecibido">Fecha de recibido</label>'+
              '<div class="input-group input-group-sm">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>'+
                '</div>'+
                '<input type="date" class="form-control array" id="fecharecibido" name="fecharecibido">'+
              '</div>'+
            '</div>'+
            '<div class="form-group col-lg-3">'+
              '<label for="Paqueteria">Paquetería</label>'+
              '<div class="input-group input-group-sm">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text"><i class="fas fa-shipping-fast"></i></span>'+
                '</div>'+
                '<select class="custom-select array" name="Paqueteria" id="Paqueteria" disabled="">'+
                  '<option selected="" disabled="" value="">Seleccione paquetería</option>'+
                  '<option value="1">Proveedor</option>'+
                  '<option value="2">DHL</option>'+
                  '<option value="3">Fed Ex</option>'+
                  '<option value="4">Estafeta</option>'+
                  '<option value="5">Redpack</option>'+
                  '<option value="6">UPS</option>'+
                '</select>'+
              '</div>'+
            '</div>'+
            '<div class="form-group col-lg-2">'+
              '<label for="codigorastreo">Código de rastreo</label>'+
              '<div class="input-group input-group-sm">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text"><i class="fas fa-thumbtack"></i></span>'+
                '</div>'+
                '<input type="text" class="form-control array" id="codigorastreo" name="codigorastreo">'+
              '</div>'+
            '</div>'+
            '<div class="form-group col-lg-1">'+
              '<label for="guardar">Guardar</label>'+
              '<button class="btn btn-primary btn-sm" id="guardar"><i class="fas fa-sync-alt"></i></button>'+
            '</div>'+
          '</div>'+
          '<div class="row message"></div>'+
        '</div>',
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton: false,
      allowOutsideClick: false,
      didRender :() => {
        // ->
        let swalcontent = $('.swal2-container');
        function actionenvios(action,data){
          Swal.showLoading()
          // ajax
          $.ajax({
            url: path+'/inventarios/compras/actionenvios',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'json',
            data: {key: trPadre.data('key'),action:action,data:data,ComprasEnvioID:ComprasEnvioID}
          })
          .done(function(data) {
            Swal.hideLoading()
            switch (data.tipo) {
              case 200:
                swalcontent.find('#tipoenvio').val(data.envio.TipoEnvio);
                swalcontent.find('#costoenvio').val(data.envio.Costo);
                swalcontent.find('#fecharecibido').val(data.envio.FechaRecibido);
                //
                if (data.paqueteria !== undefined || data.paqueteria !== null) {
                  swalcontent.find('#Paqueteria').val(data.paqueteria.PaqueteriaID);
                  swalcontent.find('#codigorastreo').val(data.paqueteria.rastreo);
                  ComprasEnvioID=data.paqueteria.ComprasEnvioID;
                }
                break;

              case 201:
                actionenvios('read',null);
                swalcontent.find('.message').empty();
                swalcontent.find('.message').append('<div class="alert alert-success alert-dismissible fade show col" role="alert">'+
                  '<strong>Cambios aplicados!</strong> La información se guardo correctamente.'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                  '</button>'+
                '</div>');
                break;

              case 202:
                actionenvios('read',null);
                swalcontent.find('.message').empty();
                swalcontent.find('.message').append('<div class="alert alert-success alert-dismissible fade show col" role="alert">'+
                  '<strong>Cambios aplicados!</strong> La información se guardo correctamente.'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                  '</button>'+
                '</div>');
                break;
            }
          });
        }
        actionenvios('read',null);
        // tipo de envio change
        swalcontent.find('#tipoenvio').change(function(event) {
          if ($(this).val()==3) {swalcontent.find('#Paqueteria').attr('disabled', false);}
          else{swalcontent.find('#Paqueteria').attr('disabled', true);}
        });
        // guardar
        swalcontent.find('#guardar').click(function(event) {
          let data = {};
          swalcontent.find('.array').map(function () {
            data[$(this).attr("name")] = $(this).val();
          }).get();
          /* Act on the event */
          actionenvios('update',data);
        });
      }
    })
  });
  /* productos details */
  tblcompras.on('click', 'a[name="detalles"]', function(event) {
    let btn = $(this); let trPadre = btn.parents('tr');
    Swal.fire({
      title: 'Detalles orden No.'+trPadre.data('orden'),
      width: 1400,
      html:
        '<div class="container-fluid">'+
          '<div class="row mt-3">'+
            '<div class="table-responsive">'+
              '<table class="table table-sm" id="detalles">'+
                '<thead>'+
                  '<tr>'+
                    '<th scope="col">#</th>'+
                    '<th scope="col">Producto</th>'+
                    '<th scope="col">Costo Unitario</th>'+
                    '<th scope="col">Cantidad</th>'+
                    '<th scope="col">Total</th>'+
                    '<th scope="col">Operación</th>'+
                  '</tr>'+
                '</thead>'+
                '<tbody>'+
                '</tbody>'+
              '</table>'+
            '</div>'+
          '</div>'+
        '</div>',
      willOpen : () => {
        Swal.showLoading()
        // ajax
        $.ajax({
          url: path+'/inventarios/compras/details',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {Orden: trPadre.data('key')}
        })
        .done(function(data) {
          let Tbody=''; OrdenID = trPadre.data('key'); let total=0;
          //print table
          $.each(data.items, function(index, el) {
            total+= parseFloat(el.CostoUnitario); // SUM
            Tbody+='<tr>'+
              '<td>'+(index+1)+'</td>'+ // Key
              '<td>'+el.ProductosNombre+'</td>'+ // Nombre producto
              '<td>$'+el.CostoUnitario+'</td>'+ // Costo U
              '<td>'+el.Cantidad+'</td>'+ // Cantidad
              '<td>$'+parseFloat(el.CostoUnitario*el.Cantidad).toFixed(2)+'</td>'+ // Total
              '<td><button class="btn btn-sm btn-default">Modificar</button></td>'+
            '</tr>';
          });
          $('#detalles tbody').empty(); $('#detalles tbody').append(Tbody);
          Swal.hideLoading()
        });

      },
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton: false,
      allowOutsideClick: false,
      didRender :() => {
        // ->

      }
    })
  });
  /* change status */
  tblcompras.on('click', 'button[name="status"]', function(event) {
    event.preventDefault();
    let btn = $(this); let flag=false;let trPadre = btn.parents('tr');
    if (btn.data('val')!== 5 && btn.data('val')!== 6) {
      /* Act on the event */
      Swal.fire({
        title:'Cambiar estatus del pedido',
        html:
        '<div class="container px-0 needs-validation" id="form">'+
          '<div class="col-12 mt-1">'+
            '<h4>No.'+trPadre.data('orden')+' / Estatus actual: '+btn.text()+'</h4>'+
          '</div>'+
          '<div class="col-12 mt-1">'+
            '<p>Selecciona el nuevo estatus e indica en los comentarios los detalles del movimiento.</p>'+
            '<label for="change" class="col-12 col-form-label"><b>Nuevo estatus:</b></label>'+
          '</div>'+
          '<div class="btn-group btn-group-toggle" data-toggle="buttons" id="change">'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Pagada" value="2"> Pagada'+
            '</label>'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Completada" value="3"> Completada'+
            '</label>'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Cancelada" value="4"> Cancelada'+
            '</label>'+
          '</div>'+
          '<div class="form-row">'+
            '<div class="col-12">'+
              '<label for="motivo" class="col-12 col-form-label"><b>Motivo:</b></label>'+
              '<textarea id="motivo" class="form-control" rows="3" placeholder="Describa brevemente el motivo del cambio" required></textarea>'+
            '</div>'+
          '</div>'+
          '<div class="form-row mt-3 justify-content-between">'+
            '<div class="col-8">'+
              '<div class="input-group mb-3">'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text">Fecha y Hora</span>'+
                '</div>'+
                '<input type="datetime-local" name="fecha_cambio" class="form-control" required>'+
              '</div>'+
            '</div>'+
            '<div class="col-2"><button name="aplicar" class="btn btn-primary">Aplicar</button></div>'+
          '</div>'+
        '</div>',
        onBeforeOpen: () => {
            //Swal.showLoading()
            $('.swal2-container').find('#change input[name="'+btn.text()+'"]').prop("disabled", true);
            //
            if (btn.data('val')== 1) {
              $('.swal2-container').find('#change input[name="Entregado"]').prop("disabled", true);
            }
        },
        width: 700,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false,
        onRender:() => {
          /* */
          let swalcontent = $('.swal2-container');
          swalcontent.find('button[name="aplicar"]').click(function(event) {
            /* Act on the event */
            let newstat = swalcontent.find('#change label.active input').val();
            let comment = swalcontent.find('#motivo').val();
            let fecha_hora = swalcontent.find('input[name="fecha_cambio"]').val();
            if (!swalcontent.find('#form').hasClass('was-validated')) {
              swalcontent.find('#form').addClass('was-validated');
            }
            if (newstat!== null && comment !== "" && fecha_hora !== "" && flag == false) {
              flag=true;
              /* ajax */
              $.ajax({
                url: path+'/inventarios/compras/comentarios',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                dataType: 'json',
                data: {id:btn.data('orden'), newstat: newstat, oldstat: btn.val(),comment: comment,fecha_hora:fecha_hora, key:trPadre.data('key')}
              })
              .done(function(data) {
                switch (data.tipo) {
                  case 200:
                    /* btn changes */
                    btn.data('val',data.status.id);
                    btn.addClass(data.status.attribute).removeClass(btn.data('class'));
                    btn.text(data.status.status);
                    Swal.fire(
                      'Cambios aplicados!',
                      'La información se aplico correctamente.',
                      'success'
                    );
                    break;
                  //
                  case 500:
                    console.log('error');
                    break;
                  // saldo pendiente
                  case 501:
                    Swal.fire({
                      title: 'Error al aplicar cambios',
                      text: data.mensaje,
                      icon: 'error',
                      showCancelButton: false,
                      confirmButtonColor: '#2f6766'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        // run pagos
                        HistorialPagos(trPadre);
                      }
                    })
                    break;
                }
              });
            }
          });
        }
      })
    }
  });
  // save pago ajax function
  function aplicarpago(formData,trPadre){
    $.ajax({
      url: path+'/inventarios/compras/actionpagos',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data:formData,
      contentType: false,
      processData: false,
    })
    .done(function(data) {
      if (data.tipo==200) {
        if (data.mensaje=='saldo') {
          trPadre.find('td[name="status"] a').addClass(data.estatus).removeClass('btn-info');
          trPadre.find('td[name="status"] a').text('Confirmado');
        }
        Swal.close()
        setTimeout(function() {
              HistorialPagos(trPadre);
        }, 400);
      }
    });
  }
  /* Sweetalert */
  function HistorialPagos(trPadre){
    let flag=false; let action; let OrdenID; let Historial; let saldo = 0;
    let total = 0; let precio=0; let flagAplicar=false; let tblpagos = $('#pagosclientes');
    Swal.fire({
      title: 'Historial de Pagos orden No. '+trPadre.data('orden'),
      width: 1400,
      html:
        '<div class="container-fluid">'+
          '<div class="row">'+
            '<div class="col"><h5 class="text-center">Proveedor: '+trPadre.data('prov')+'</h5></div>'+
          '</div>'+
          '<div class="row mt-2">'+
            '<div class="col-4">'+
              '<table class="table table-bordered table-xs" id="generales">'+
                '<tbody>'+
                  '<tr>'+
                    '<th>Precio</th>'+
                    '<td name="precio"></td>'+
                  '</tr>'+
                  '<tr>'+
                    '<th>Total Pagado</th>'+
                    '<td name="pagado"></td>'+
                  '</tr>'+
                  '<tr>'+
                    '<th>Saldo</th>'+
                    '<td name="saldo"></td>'+
                  '</tr>'+
                '</tbody>'+
              '</table>'+
            '</div>'+
            '<div class="col-8 align-self-center text-right" id="agregar-pagos">'+
              '<button class="btn btn-sm btn-dark" name="agregar"><i class="fas fa-plus"></i> Agregar</button>'+
            '</div>'+
          '</div>'+
          '<div class="row mt-3">'+
            '<div class="table-responsive">'+
              '<table class="table table-sm" id="pagosproveedor">'+
                '<thead>'+
                  '<tr>'+
                    '<th scope="col">#</th>'+
                    '<th scope="col">Fecha</th>'+
                    '<th scope="col">Monto</th>'+
                    '<th scope="col">Forma de Pago</th>'+
                    '<th scope="col">Folio de Pago</th>'+
                    '<th scope="col">Imagen</th>'+
                    '<th scope="col">Comentario</th>'+
                    '<th scope="col">Operación</th>'+
                  '</tr>'+
                '</thead>'+
                '<tbody>'+
                '</tbody>'+
              '</table>'+
            '</div>'+
          '</div>'+
        '</div>',
      onBeforeOpen: () => {
        Swal.showLoading()
        // ajax
        $.ajax({
          url: '/inventarios/compras/historialpagos',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {Orden: trPadre.data('key')}
        })
        .done(function(data) {
          precio = Number(trPadre.data('total')).toFixed(2);
          let Tbody=''; OrdenID = trPadre.data('key');
          //print table
          $.each(data.pagos, function(index, el) {
            total+= parseFloat(el.Monto); // SUM
            Tbody+='<tr>'+
              '<td>'+(index+1)+'</td>'+ // Key
              '<td>'+el.FechaPago+'</td>'+ // Fecha
              '<td>'+el.Monto+'</td>'+ // Monto
              '<td>'+el.formaPagoP+'</td>'+ // Forma de Pago
              '<td>'+el.Folio+'</td>'+ // Folio de pago
              '<td><button class="btn btn-sm btn-default" value="'+el.imagenPay+'" data-fecha="'+el.FechaPago+'" name="baucher">Baucher</button></td>'+ // Baucher
              '<td><small>'+el.comentarioPago+'</small></td>'+
              '<td><button class="btn btn-sm btn-default">Modificar</button></td>'+
            '</tr>';
          });
          $('#pagosproveedor tbody').empty(); $('#pagosproveedor tbody').append(Tbody);
          if (total>0) {action='update';}
          // print generales
          saldo = parseFloat(precio-total).toFixed(2);
          $('#generales').find('td[name ="precio"]').html('$'+precio);
          $('#generales').find('td[name ="pagado"]').html('$'+total.toFixed(2));
          $('#generales').find('td[name ="saldo"]').html('$'+parseFloat(saldo).toFixed(2));
          Swal.hideLoading()
          if (precio == total) { $('#agregar-pagos').addClass('d-none');}
        });

      },
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton: false,
      allowOutsideClick: false,
      onRender:() => {
        // ->
        $('#agregar-pagos').click(function(event) {
          /* Act on the event */
          if (flag==false) {
            flag=true; action='create';
            // ok
            let formap = '<select class="custom-select array" name="formaPagoP">'+
              '<option selected>Elegir...</option>'+
              '<option value="Efectivo">Efectivo</option>'+
              '<option value="Mercado Pago">Mercado Pago</option>'+
              '<option value="Deposito Bancomer 1512">Deposito Bancomer 1512</option>'+
            '</select>';
            let element = '<tr class="needs-validation" novalidate>'+
              '<td>1</td>'+ // Key
              '<td><input type="date" class="form-control array" name="fecha" required></td>'+ // Fecha
              '<td><input type="text" class="form-control array" name="monto" placeholder="Monto" required value="'+parseFloat(saldo).toFixed(2)+'"></td>'+ // Monto
              '<td>'+formap+'</td>'+ // Forma de Pago
              '<td><input type="text" class="form-control array" name="folio" placeholder="Folio" required></td>'+ // Folio de pago
              '<td>'+
                '<div class="custom-file">'+
                  '<input type="file" class="custom-file-input array" id="imagen" name="imagen" required>'+
                  '<label class="custom-file-label" for="imagen"></label>'+
                '</div>'+
              '</td>'+
              '<td><input type="text" class="form-control array" name="comentarios" placeholder="Comentarios"></td>'+
              '<td><button class="btn btn-sm btn-default" name="aplicar" title="Guardar">Aplicar</button></td>'+
            '</tr>';
            $('#pagosproveedor tbody').append(element);
          }
        });
        // change name input file
        $('body').on('change','#imagen',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').addClass('custom-file-ok');
        });
        // focus format money
        $('.swal2-container').on('focusout', 'input[name="monto"]', function(event) {
          event.preventDefault();
          /* Act on the event */
          let inp = $(this);
          if (inp.val()<= (precio-total)) {
            inp.val(accounting.formatMoney(inp.val()));
          }else{inp.val('');}
        });
        // unformat
        $('.swal2-container').on('focusin', 'input[name="monto"]', function(event) {
          let inp = $(this);
          if (!inp.val()=='') {
            inp.val(accounting.unformat(inp.val()));
          }
        });
        // aplicar button
        $('body').on('click', 'button[name="aplicar"]', function(event) {
          event.preventDefault();
          /* Act on the event */
          let Trform = $(this).parents('tr');
          Trform.addClass('was-validated');
          let error=0; let formData = new FormData(); let datos={};
          Trform.find('.array').each(function(index, el) {
            if ($(this).val()=="" && $(this).prop('required')) {error++;}
            else{
              if ($(this).attr("name") == 'monto') {datos[$(this).attr("name")] = accounting.unformat($(this).val());}
              else{datos[$(this).attr("name")] = $(this).val();}
            }
          });
          if (error==0 && flagAplicar==false) {
            let files = Trform.find('input[name="imagen"]')[0].files;
    				let file = files["0"];
            flagAplicar=true; datos['action'] = action;
            datos['OrdenID'] = OrdenID; formData.append("file", file);
            // liquidado ?
            datos['saldo']= parseFloat(saldo-datos['monto']).toFixed(2);
            datos['total'] = trPadre.data('total');
            formData.append("datos",JSON.stringify(datos));
            // send ajax
            aplicarpago(formData,trPadre);
          }
        });
        // ver baucher de pago
        $('body').on('click', 'button[name="baucher"]', function(event) {
          event.preventDefault();
          let btn = $(this);
          let alert = $('.custom-alert'); let content;
          /* Act on the event */
          alert.empty();
          content = '<div class="title">'+
              '<span>Pago '+btn.data('fecha')+'</span>'+
              '<button name="close">×</button>'+
            '</div>'+
            '<img src="'+path+'/upfiles'+$(this).val()+'" alt="" style="margin-top: 34.5px;" class="img-fluid">';
          alert.append(content); alert.fadeIn();
        });
        // close custom alert
        $('body').on('click', 'button[name="close"]', function(event) {$(this).parents('.custom-alert').fadeOut();});
      }
    })
  }
</script>
@endsection
