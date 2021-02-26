@extends('master-admin')
@section('title', 'Compras')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .custom-select, input {
      padding: 8px;
      height: 36px !important;
      font-size: 12px !important;
      color: #3c3b3b !important;
    }
    .input-group-text {font-size: 14px;}
    .bootstrap-select .text {font-size: 12px !important;}
  </style>
  <!-- Section  -->
  <div class="container-fluid">
    <div class="card card-custom gutter-b">
      <div class="card-body">
        <form class="needs-validation" novalidate>
          <div class="form-row">
            <div class="col-md-9 mb-3">
              <label for="proveedor">Proveedor</label>
              <select class="selectpicker form-control array" name="proveedor" id="proveedor" data-live-search="true" required>
                <option selected disabled value="">Seleccione proveedor</option>
                @foreach ($proveedores as $key => $value)
                  <option value="{{$value->ProveedorID }}">{{$value->EmpresaNombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom02">Fecha</label>
              <input type="date" name="fecha" class="form-control array" required>
            </div>
          </div>
          <!-- Pago -->
          <hr>
          <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="Total">Total</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">$</div>
                </div>
                <input type="text" class="form-control array" id="Total" name="Total" required>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="MetodoPago">Método de pago</label>
              <select class="custom-select array" id="MetodoPago" name="MetodoPago" disabled>
                <option selected disabled value="">Seleccione método de pago</option>
                <option value="1">Efectivo</option>
                <option value="2">PayPal</option>
                <option value="3">Deposito / Transferencia</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="Folio">Folio</label>
              <input type="text" class="form-control array" id="Folio" name="Folio" disabled>
            </div>
          </div>
          <!-- Envío -->
          <div class="form-row">
            <div class="col-md-3 mb-3">
              <label for="TipoEnvio">Tipo de envío</label>
              <select class="custom-select array" id="TipoEnvio" name="TipoEnvio" required>
                <option selected disabled value="">Seleccione tipo envio</option>
                <option value="1">No Aplica</option>
                <option value="2">Local</option>
                <option value="3">Paquetería</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="Paqueteria">Paquetería</label>
              <select class="custom-select array" name="Paqueteria" id="Paqueteria" disabled>
                <option selected disabled value="">Seleccione paquetería</option>
                @foreach ($paqueteria as $key => $p)
                  <option value="{{$p->PaqueteriaID}}">{{$p->Empresa}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="Rastreo">Código de rastreo</label>
              <input type="text" class="form-control array" name="Rastreo" id="Rastreo" disabled>
            </div>
            <div class="col-md-2 mb-3">
              <label for="Costo">Costo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">$</div>
                </div>
                <input type="text" class="form-control array" name="Costo" id="Costo" disabled>
              </div>
            </div>
          </div>
          <!-- add item -->
          <hr>
          <div class="form-row" id="item">
            <div class="col-md-6 mb-3">
              <label for="producto">Producto:</label>
              <select class="selectpicker form-control" id="producto" data-live-search="true"></select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="costo">Costo unitario:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">$</div>
                </div>
                <input type="text" class="form-control" id="costo">
              </div>
            </div>
            <div class="col-md-1 mb-3">
              <label for="cantidad">Cantidad:</label>
              <input type="text" class="form-control" id="cantidad">
            </div>
            <div class="col-md-2 mt-4">
              <button class="btn btn-light" type="button" name="agregar"><i class="fas fa-plus"></i> Agregar</button>
            </div>
          </div>
          <!-- table items -->
          <div class="form-row">
            <table class="table" id="table-items">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Costo unitario</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
                <tr>
                  <th colspan="3"></th>
                  <th>Subtotal</th>
                  <th class="total"></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- button -->
          <hr>
          <button class="btn btn-primary" type="button" id="guardar">Guardar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css" rel="stylesheet">
<script src="{{asset('/js/accounting.min.js')}}" defer></script>
<script>
  let form = $('.needs-validation'); let flag = false; let path = $('.root').data('path'); let items = {};
  let item = $('#item'); let tbl = $('#table-items tbody'); let c = 0; let product = $('#producto');
  $('#proveedor').val(""); let costo = $('#costo'); let cantidad = $('#cantidad'); let total=0;
  document.getElementById("guardar").addEventListener('click', (e) => {
    /* Act on the event */
    form.addClass('was-validated');
    let error=0; let arraydata= {};
    // array
    form.find('.array').map(function () {
      if ($(this).val()=="" && $(this).prop('required')) {error++;}
      else{ arraydata[$(this).attr("name")] = $(this).val();}
    }).get();
    if (error>0) {Swal.fire('Por favor, llene los campos requeridos'); }
    else {
      // ready for send ajax
      if (flag == false) {
        // true
        flag=true;
        // send ajax
        $.ajax({
          url: path+'/inventarios/create',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {arraydata:arraydata,items:items,keys: Object.keys(items).length}
        }).done(function(data) {
          if (data.tipo==200) {Swal.fire('Compra cargada correctamente!');
            setTimeout(function(){
              window.location=path+'/inventarios';}, 1500)
          }
          else if (data.tipo==500) {}
        });
      }
    }
  });
  // add item
  item.on('click', 'button[name="agregar"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    if (product.val()!="" && cantidad.val()!="" && costo.val()!="") {
      total=parseFloat(costo.val()*cantidad.val()) + parseFloat(total);
      $('.total').text(accounting.formatMoney(total)); c=parseInt(c)+1;
      tbl.append('<tr><th scope="row">'+c+'</th>'+
        '<td>'+$('#producto option:selected').text()+'</td>'+
        '<td>'+accounting.formatMoney(costo.val())+'</td>'+
        '<td>'+cantidad.val()+'</td>'+
        '<td>'+accounting.formatMoney(parseFloat(costo.val()*cantidad.val()).toFixed(2))+'</td>'+
      '</tr>');
      // items
      items[c] = {
        'id' : product.val(),
        'costo' : costo.val(),
        'cantidad' : cantidad.val(),
        'stock': parseInt($('#producto option:selected').data('stock')) + parseInt(cantidad.val()),
        'recibido': parseInt($('#producto option:selected').data('recibido')) + parseInt(cantidad.val())
      };
    }else{
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ingrese los datos requeridos del producto.'
      })
    }

  });
  /* Tipo de envío change */
  $('#TipoEnvio').change(function(event) {
    /* Act on the event */
    let sel = $(this);
    let paq = $('#Paqueteria'); let ras = $('#Rastreo');  let cost = $('#Costo');
    if (sel.val()!=1) {
      paq.attr('disabled', false);
      ras.attr('disabled', false);
      cost.attr('disabled', false);
    }else{paq.attr('disabled', true);
    ras.attr('disabled', true);
    cost.attr('disabled', true);}
  });
  /* on select proveedor */
  $('#proveedor').change(function(event) {
    /* Act on the event */
    $.ajax({
      url: path+'/inventarios/productos',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id: $(this).val()}
    })
    .done(function(data) {
      /* */
      product.empty();
      if (data.productos.length >= 1) {
        let options = '<option selected disabled value="">Seleccione producto</option>';
        for (var i = 0; i < data.productos.length; i++) {
          options+= '<option value="'+data.productos[i].ProductosID+'" data-stock="'+data.productos[i].UnidadesEnStock+'" data-recibido="'+data.productos[i].UnidadesRecibidas+'">'+data.productos[i].ProductosNombre.substring(0, 38)+'('
          +data.productos[i].Cantidad+' '+data.productos[i].Unidad+')</option>';
        }
        product.append(options);
        product.selectpicker('refresh');
      }
    });

  });
</script>
@endsection
