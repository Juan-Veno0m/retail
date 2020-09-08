@extends('master-admin')
@section('title', 'Pedidos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .btn-xs {
      padding: .2em .6em .3em;
      font-size: 14px;
      line-height: 1;
      border-radius: .25em;
    }
    .table-sm th, .table-sm td {font-size: 14px;}
    .table-xs th, .table-xs td {
      padding: 0px 5px;
      font-size: 14px;
      line-height: 1.42857143;
      font-family: 'Arial';
    }
    #generales > tbody > tr > th {background: #eee !important;}
    #generales th, .table-bordered td {border-color: #BDBDBD !important;}
    #generales td {
      text-align: right;
      color: #313131;
      font-family: inherit;
    }
    .btn-default {
      color: #4f4f4f;
      background: #e9ecef;
      border: solid 1px #ced4da;
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
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-producto" data-toggle="modal" data-target="#form-producto">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla pedidos -->
            <table class="table" id="tabla-ordenes">
              <thead>
                <tr>
                  <th scope="col">No. Pedido</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Metodo de Pago</th>
                  <th scope="col">Total</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pedidos as $key =>$p)
                  <tr data-id="{{$p->key}}" data-pedido="{{$p->OrdenID+9249582}}" data-empresario="{{$p->Nombre.' '.$p->ApellidoPaterno .' '.$p->ApellidoMaterno}}">
                    <td name="NoPedido">{{$p->OrdenID+9249582}}</td>
                    <td name="cliente">{{$p->Nombre}}</td>
                    <td name="status"><a class="btn btn-xs {{$p->attribute}}">{{$p->status}}</a></td>
                    <td name="mpago">{{$p->MetodoPago}}</td>
                    <td name="total">${{$p->Total}}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye fa-fw"></i> Opciones</button>
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                          <a class="dropdown-item btn-sm" name="editar" href="{{url('ordenes/pedidos/'.($p->OrdenID+9249582))}}"><i class="fas fa-info fa-fw"></i> Detalles</a>
                          <a class="dropdown-item btn-sm" name="pagos" href="#"><i class="fas fa-dollar-sign fa-fw"></i> Pagos</a>
                          <a class="dropdown-item btn-sm" target="_blank" name="ticket" href="{{url('ordenes/pedidos/ticket/'.($p->OrdenID+9249582))}}"><i class="fas fa-ticket-alt fa-fw"></i> Ticket</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex">
              <div class="col-xl-10">{{ $pedidos->links() }}</div>
              <div class="col-xl-2">
                <nav>
                  <span class="navbar-text">Registros: {{$pedidos->total()}}</span>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<script src="{{asset('/js/accounting.min.js')}}" defer></script>
<div aria-hidden="true" class="custom-alert"></div>
<script>
  let path = $('.root').data('path');
  $('#tabla-ordenes').on('click', 'a[name="pagos"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trPadre = btn.parents('tr');
    /* Act on the event */
    HistorialPagos(trPadre);
  });
  /* Sweetalert */
  function HistorialPagos(trPadre)
  {
    let flag=false; let action; let OrdenID; let Historial; let saldo = 0;
    let total = 0; let precio=0; let flagAplicar=false; let tblpagos = $('#pagosclientes');
    Swal.fire({
      title: 'Historial de Pagos pedido No. '+trPadre.data('pedido'),
      width: 1400,
      html:
        '<div class="container-fluid">'+
          '<div class="row">'+
            '<div class="col"><h5 class="text-center">Empresario: '+trPadre.data('empresario')+'</h5></div>'+
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
              '<table class="table table-sm" id="pagosclientes">'+
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
          url: '/ordenes/pedidos/historialpagos',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {Orden: trPadre.data('id')}
        })
        .done(function(data) {
          precio = Number(data.generales.Total).toFixed(2);
          let Tbody=''; OrdenID = data.Orden;
          //print table
          $.each(data.pagosclientes, function(index, el) {
            total+= el.montoPC; // SUM
            Tbody+='<tr>'+
              '<td>'+(index+1)+'</td>'+ // Key
              '<td>'+el.fechaPago+'</td>'+ // Fecha
              '<td>'+el.montoPC+'</td>'+ // Monto
              '<td>'+el.formaPagoP+'</td>'+ // Forma de Pago
              '<td>'+el.folioPagoP+'</td>'+ // Folio de pago
              '<td><button class="btn btn-sm btn-default" value="'+el.imagenPay+'" data-fecha="'+el.fechaPago+'" name="baucher">Baucher</button></td>'+ // Baucher
              '<td><small>'+el.comentarioPago+'</small></td>'+
              '<td><button class="btn btn-sm btn-default">Modificar</button></td>'+
            '</tr>';
          });
          $('#pagosclientes tbody').empty(); $('#pagosclientes tbody').append(Tbody);
          if (total>0) {action='update';}
          // print generales
          saldo = parseFloat(precio-total).toFixed(2);
          $('#generales').find('td[name ="precio"]').html('$'+precio);
          $('#generales').find('td[name ="pagado"]').html('$'+total);
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
            $('#pagosclientes tbody').append(element);
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
  // save pago ajax function
  function aplicarpago(formData,trPadre){
    $.ajax({
      url: path+'/ordenes/pedidos/actionpagos',
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
</script>
@endsection
