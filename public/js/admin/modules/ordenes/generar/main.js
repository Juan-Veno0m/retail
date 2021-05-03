// declare and initiate vars
  $('#proveedor').val("");
  var form = $('.needs-validation'),
  flag = false,
  path = $('.root').data('path'),
  items = {},
  item = $('#item'),
  tbl = $('#table-items tbody'),
  c = 0,
  product = $('#producto'),
  paq = $('#Paqueteria'),
  ras = $('#Rastreo'),
  cost = $('#costoenvio'),
  empresario,
  fecha,
  costo = $('#costo'),
  cantidad = $('#cantidad'),
  total=0,
  maxProduct=0,
  cupon = 0,
  option,
  productname,
  sku,
  subtotal=0,
  descuento,
  multiplica,
  label,
  action = 'create',
  TipoEnvio = $('#TipoEnvio'),
  arraydata = {},
  actionshipping = $('#actionshipping'),
  shipping_address = $('#shipping_address'),
  inputtel = $("input[name='telefono']"),
  tfoot = $('#table-items tfoot');
// config headers
$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
/* Tipo de envío change */
TipoEnvio.change(function(event) {
  /* Act on the event */
  var sel = $(this);
  if (sel.val() == 3) {
    paq.attr('disabled', false);
    ras.attr('disabled', false);
  }else{paq.attr('disabled', true);
  ras.attr('disabled', true);}
  // pickup show
  if (sel.val()== 2 ) {
    $('#PickupGrid').collapse('show'); $('#ShippingInfo').collapse('hide'); cost.val('');
    cost.attr('disabled', true); cost.prop('required',false);tfoot.find('.envio').empty();}
  else if(typeof empresario !== 'undefined'){
    address(empresario); cost.attr('disabled', false); cost.prop('required',true);
    $('#PickupGrid').collapse('hide'); $('#ShippingInfo').collapse('show');}
  else{Swal.fire('Seleccione empresario para continuar.');}
});
// on select product ///
product.on('change', function(e){
  option = $(this).find("option:selected");
  costo.val(option.data('value'));
  productname = option.data('name');
  maxProduct = option.data('max');
  sku = option.data('sku');
  cantidad.attr("placeholder", "Max: "+maxProduct);
});
// only numbers
cantidad.keypress(function(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
});
/// test
document.addEventListener('textInput', function (e){
    if(e.data.length >= 6){
        console.log('IR scan textInput', e.data);
        e.preventDefault();
    }
});
// on select user
$('input[name="fecha"]').on('change', function(event) {
  /* Act on the event */
  empresario = $('#empresario').val();
  fecha = $(this);
  if (empresario!== null) {
    /* send ajax */
    getPuntos(empresario,fecha.val())
    if (TipoEnvio.val()== 2 ) {
      cost.val('');cost.attr('disabled', true); cost.prop('required',false);}
    else{cost.attr('disabled', false); cost.prop('required',true);}
  }else{Swal.fire('Seleccione un empresario primero'); fecha.val(null);}
});
//change empreario
$('#empresario').on('change', function(e){
  empresario = $(this).val();
  fecha = $('input[name="fecha"]').val();
  if (fecha!== "") {getPuntos(empresario,fecha)}
  if (TipoEnvio.val()==1 || TipoEnvio.val() == 3) {address(empresario);}
});
//* get puntos
function getPuntos(empresario,fecha){
  $.ajax({
    url: path+'/ordenes/generar/puntos',
    type: 'POST',
    dataType: 'json',
    data: {empresario: empresario, fecha:fecha}
  })
  .done(function(data) {
     multiplica = 0.2; label = '20';
    if (data.p !== null) {
      if (data.p.Puntos >=300) { // 25 %
        multiplica = 0.25; label = '25';
      } else if (data.p.Puntos >= 600) { // 30 %
        multiplica = 0.30; label = '30';}
    }tfoot.find('.label').html(label+'%');
    if (!data.user.cont>0) {
      cupon = 1500;
      tfoot.find('.cupon').empty();
      tfoot.find('.cupon').append('<th colspan="3"></th>'+
          '<th>Cupon</th>'+
          '<th>- $1,500.00</th>');
    }
  });
}
// click add item product
$('button[name="agregar"]').click(function(event) {
  /* Act on the event */
  if (typeof empresario !== 'undefined'  && typeof fecha !== 'undefined') {
    if (product.val()!== null) {
      if (cantidad.val()!== "") {
        if (cantidad.val() < maxProduct) {
          // append table element
          subtotal=parseFloat(costo.val()*cantidad.val()) + parseFloat(subtotal);
          $('.subtotal').text(accounting.formatMoney(subtotal)); c=parseInt(c)+1;
          descuento = subtotal*multiplica;
          $('.desc').text(accounting.formatMoney(descuento));
          tbl.append('<tr><th scope="row">'+sku+'</th>'+
            '<td>'+productname+'</td>'+
            '<td>'+costo.val()+'</td>'+
            '<td>'+cantidad.val()+'</td>'+
            '<td>'+accounting.formatMoney(costo.val()*cantidad.val())+'</td>'+
          '</tr>');
          // items
          items[c] = {
            'id' : product.val(),
            'costo' : costo.val(),
            'cantidad' : cantidad.val()
          };
          // Total
          total = parseFloat(subtotal + parseFloat(cost.val())) - parseFloat(cupon + descuento);
          if (total<0) { total=0;}
          $('.total').text(accounting.formatMoney(total));
          // clean
          product.val('default');
          product.selectpicker("refresh");
          costo.val('');
          cantidad.val('');
          // --
        }else{Swal.fire('Cantidad máxima: '+maxProduct);}
      }else{Swal.fire('Ingrese cantidad del producto');}
    }else{Swal.fire('Seleccione un producto primero');}
  }else{Swal.fire('Seleccione empresario y fecha');}
});
// on select day for pickup
$('#calendar').on('click', '.item', function(event) {
  event.preventDefault();
  /* Act on the event */
  var td = $(this);
  var tbody = td.parents('tbody');
  tbody.find('.selected').removeClass('selected');
  if (!td.hasClass('className')){td.addClass('selected');}
});
// get empresario address
function address(empresario){
  // send ajax
  $.post( path+"/ordenes/generar/address", { empresario:empresario }, function( data ) {
    // if is not null
    var itemsHtml='';
    shipping_address.empty();
    if (! data.envio.length) {
      itemsHtml='<div class="alert alert-danger" role="alert">'+
          'Este empresario no tiene ninguna dirección de entrega cargada. Por favor agrege una para continuar.'+
        '</div>';
    }
    else{
      $.each(data.envio, function(index, el) {
        itemsHtml+='<div class="form-check">'+
          '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault'+index+'" data-type="1" data-city="'+el.Municipio+'" value="'+el.EnvioID+'"/>'+
          '<label class="form-check-label" for="flexRadioDefault'+index+'">'+
            '<span class="d-block" name="Fullname">'+el.NombreCompleto+'</span>'+
            '<span class="d-block" name="address">'+el.Calle+' '+el.Exterior+', '+el.Colonia+'</span>'+
            '<span class="d-block" name="city">CP: '+el.Codigopostal+' ,'+el.Municipio+', '+el.estado+'.'+'</span>'+
          '</label>'+
        '</div>';
      });
    }
    //
    shipping_address.append(itemsHtml);
  });

}
// function shipping ajax
function shipping(){
  return $.ajax({
    url: path+'/ordenes/generar/shipping_action',
    type: 'POST',
    dataType: 'json',
    data: {action: action, arraydata:arraydata,empresario:empresario}
  });
}
//action shipping
actionshipping.on('click', '.save', function(event) {
  event.preventDefault();
  /* Act on the event */
  var btn = $(this);
  var btnparent = btn.parents('.modal-content');
  btnparent.find('.shipping').addClass('was-validated');
  // check validated
  var error=0;
  btnparent.find('.shipping .validated').map(function () {
    if ($(this).val()=="" && $(this).prop('required')) {error++;}
    else{ arraydata[$(this).attr("name")] = $(this).val();}
  }).get();
  //
  if (arraydata!=null) {
   // function Shipping
    $.when(shipping()).done(function(a1){
      // if its ok then store
      if (a1.respuesta=='ok') { /* append html */
        // fill
        var itemsHtml='';
        itemsHtml+='<div class="form-check">'+
          '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault" data-type="1" data-city="'+a1.Municipio+'" value="'+a1.envio.EnvioID+'"/>'+
          '<label class="form-check-label" for="flexRadioDefault">'+
            '<span class="d-block" name="Fullname">'+a1.envio.NombreCompleto+'</span>'+
            '<span class="d-block" name="address">'+a1.envio.Calle+' '+a1.envio.Exterior+', '+a1.envio.Colonia+'</span>'+
            '<span class="d-block" name="city">CP: '+a1.envio.Codigopostal+' ,'+a1.envio.Municipio+', '+a1.envio.estado+'.'+'</span>'+
          '</label>'+
        '</div>';
        //
        shipping_address.append(itemsHtml);
        actionshipping.modal('hide');
      }
    });
  }
  if (error>0) {
    console.log(error);
  }
});
// format phone number
inputtel.on('keyup', function() {
  //
  var inpt = $(this);
  var inputval = inpt.parents('.parent').find("input[name='telefono']");
  if (inpt[0].value.length==3 || inpt[0].value.length == 7) { inputval.val(inputval.val()+'-');}
});
// only numbers
inputtel.keypress(function(event){
   if(event.which != 8 && isNaN(String.fromCharCode(event.which))|| $(this)[0].value.length>=12){
       event.preventDefault(); //stop character from entering input
   }
});
// store send ajax
$('#guardar').click(function(event) {
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
    if (Object.keys(items).length == 0) {
      Swal.fire('Por favor, agrege productos al pedido');
    }
    else{
      // complete elements
      arraydata['descuento'] = descuento;
      arraydata['subtotal'] = subtotal;
      arraydata['porcentaje'] = label;
      arraydata['total'] = total;
      arraydata['costoenvio'] = cost.val();
      var radio = $("#shipping input[type='radio']:checked");
      var tipoenvio = radio.data('type');
      arraydata['EnvioUID'] = radio.val();
      /* pickup info */
      if (tipoenvio == 2 ) {
        var selectday = $('#calendar tbody .selected');
        arraydata['fechaPick'] = selectday.data('date');
        arraydata['horaPick'] = selectday.parents('tr').data('hour');
      }
      console.log(arraydata);
      // confirm dialog
      Swal.fire({
        title: 'Esta seguro?',
        text: "Verifica que los datos sean correctos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar'
      }).then((result) => {
        if (result.isConfirmed) {
          // ready for send ajax
          if (flag == false) {
            // true
            flag=true;
            // send ajax
            $.ajax({
              url: path+'/ordenes/generar/store',
              type: 'POST',
              dataType: 'json',
              data: {arraydata:arraydata,items:items,keys: Object.keys(items).length}
            }).done(function(data) {
              if (data.tipo=='Completado') {Swal.fire('Compra cargada correctamente!');
                setTimeout(function(){
                  window.location=path+'/ordenes/pedidos/'+data.OrdenID;}, 1500)
              }
              else if (data.tipo==500) {}
            });
          }
        }
      })

    }
  }
});
// costo envio change
cost.change(function(event) {
  /* Act on the event */
  var btn = $(this);
  if (btn.val()) {
    tfoot.find('.envio').empty();
    tfoot.find('.envio').append('<th colspan="3"></th>'+
        '<th>Envio</th>'+
        '<th>'+accounting.formatMoney(btn.val())+'</th>');
  }
});
