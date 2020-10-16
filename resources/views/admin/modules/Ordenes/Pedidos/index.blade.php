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
    .table .btn {
      width: 112px;
    }
    .table .dropdown-toggle {
      width: 24px;
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
    td>span:after {
      content: "Primer compra";
      font-size: 10px;
      position: absolute;
      color: #fff;
      background-color: #012626;
      height: 15px;
      border: 1px solid #404040;
      padding: 0px 4px;
      border-radius: 1px;
      left: 12px;
      bottom: -15px;
    }
    .first {
      position: relative;
      display: flex;
    }
    .table-select > tbody > tr.active {
      border-left: solid 5px #036665;
      background: #c5f2c3;
    }
    .table-bordered-bottom th, .table-bordered-bottom td {
      border-bottom: 1px solid #dee2e6;
      text-align: center;
    }
    .table thead th{
      border-bottom: none;
      background: #2f6766;
      color: #fff;
      border-radius: 12px;
      border-right: solid 2px #fff;
      text-align: center;
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
  </style>
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          @include('admin.modules.Ordenes.Pedidos.search')
          <!-- table content -->
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla pedidos -->
            <table class="table table-select table-bordered-bottom" id="tabla-ordenes">
              <thead>
                <tr>
                  <th scope="col">No. Pedido</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Cliente</th>
                  <th scope="col" style="width: 114px;">Estatus</th>
                  <th scope="col">Metodo de Pago</th>
                  <th scope="col">Total</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pedidos as $key =>$p)
                  <tr data-id="{{$p->key}}" data-key="{{$p->AsociadosID}}" data-pedido="{{$p->OrdenID+9249582}}"
                    data-empresario="{{$p->Nombre.' '.$p->ApellidoPaterno .' '.$p->ApellidoMaterno}}" data-u="{{$p->UsuarioID}}"
                    data-cupon="{{$p->descuento}}" data-total="{{$p->Total}}">
                    <td name="NoPedido">
                      {{$p->OrdenID+9249582}}
                      @if (isset($p->descuento))<span class="first"></span>@endif
                    </td>
                    <td name="fecha">{{date("d/m/Y", strtotime($p->Fecha_requerida))}}</td>
                    <td name="cliente">{{$p->Nombre}}</td>
                    <td name="status"><a name="status" class="btn btn-xs {{$p->attribute}}" data-class="{{$p->attribute}}" data-val="{{$p->Orden_estatus}}" data-orden="{{$p->OrdenID+9249582}}">{{$p->status}}</a></td>
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
  let path = $('.root').data('path'); let tblOrd= $('#tabla-ordenes');
  tblOrd.on('click', 'a[name="pagos"]', function(event) {
    event.preventDefault();
    let btn = $(this);
    let trPadre = btn.parents('tr');
    /* Act on the event */
    HistorialPagos(trPadre);
  });
  /* Sweetalert */
  function HistorialPagos(trPadre){
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
            // key, user, cupon, total
            datos['key'] = trPadre.data('key'); datos['u'] = trPadre.data('u'); datos['cupon'] = trPadre.data('cupon');
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
  // active tr table products
  tblOrd.on('click', 'tr', function(event) {
    let tr = $(this);
    // find the one
    tr.parents('tbody').find('.active').removeClass('active');
    if (!tr.hasClass('active')) {
      tr.addClass('active');
    }else{tr.removeClass('active');}
  });
  /* change status */
  tblOrd.on('click', 'a[name="status"]', function(event) {
    event.preventDefault();
    let btn = $(this); let flag=false;let trPadre = btn.parents('tr');
    if (btn.data('val')!== 5 && btn.data('val')!== 6) {
      /* Act on the event */
      Swal.fire({
        title:'Cambiar estatus del pedido',
        html:
        '<div class="container px-0 needs-validation" id="form">'+
          '<div class="col-12 mt-1">'+
            '<h4>No.'+btn.data('orden')+' / Estatus actual: '+btn.text()+'</h4>'+
          '</div>'+
          '<div class="col-12 mt-1">'+
            '<p>Selecciona el nuevo estatus e indica en los comentarios los detalles del movimiento.</p>'+
            '<label for="change" class="col-12 col-form-label"><b>Nuevo estatus:</b></label>'+
          '</div>'+
          '<div class="btn-group btn-group-toggle" data-toggle="buttons" id="change">'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Confirmado" value="2"> Confirmado'+
            '</label>'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Entregado" value="5"> Entregado'+
            '</label>'+
            '<label class="btn btn-outline-dark">'+
              '<input type="radio" name="Cancelado" value="6"> Cancelado'+
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
                url: path+'/ordenes/pedidos/status',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                dataType: 'json',
                data: {id:btn.data('orden'), newstat: newstat, oldstat: btn.data('val'),comment: comment,fecha_hora:fecha_hora, key:trPadre.data('key')}
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
</script>
@endsection
