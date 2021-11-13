// declare and initiate vars
  $('#proveedor').val("");
  var flag = false,
  path = $('.root').data('path'),
  items = {},
  item = $('#item'),
  tbl = $('#table-items tbody'),
  c = 0,
  founditem,
  labeldesc = $('.ajax-desc'),
  costo = [],
  multi = [],
  temp = [],
  type= [],
  htmlcosto,
  cantidad = [],
  id=[],
  sub = [],
  total=0,
  subt = 0,
  maxProduct=0,
  cupon = 0,
  option,
  productname,
  sku,
  subtotal=0,
  descuento=0,
  multiplica=0,
  label,
  labelcupon = $('.cupon'),
  action = 'create',
  product = $('#producto'),
  typeOfsale = $('#typeOfsale'),
  empresario = $('#empresario'),
  label_name = $('.label-name'),
  NoEmpresario,
  arraydata = {},
  pagoPay = $('#pagoPay'),
  cambioPay = $('#cambioPay'),
  totalPay = $('#totalPay'),
  tfoot = $('#table-items tfoot');
  var todayDate = new Date().toISOString().slice(0, 10);
// config headers
$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
// on select product ///
product.on('change', function(e){
  c++;
  founditem=0;
  option = $(this).find("option:selected");
  productname = option.data('name');
  maxProduct = option.data('max');
  sku = option.data('sku');
  type[c] = option.data('by');
  // there's the item in the table?
  $('#table-items > tbody  > tr').each(function(index, el) {
    if ($(this).data('key') == option.val()) {
      founditem = $(this).data('row'); return false;
    }
  });
  // duplicate yes?
  if(founditem !== 0){
    // find it
    if (type[c]!==1) {
      multi[founditem]['cantidad']++;
      multi[founditem]['sub'] = multi[founditem]['costo'] * multi[founditem]['cantidad'];
      let findtd = $('#table-items > tbody').find("[data-row='"+founditem+"']");
      findtd.find('.cantidadtd').html(multi[founditem]['cantidad']);
      findtd.find('.subtd').html(accounting.formatMoney(multi[founditem]['sub']));
      product.val('default');
      sumar();
    }
  }else{
    multi[c] = [];
    multi[c]['id'] = option.val();
    multi[c]['costo']= option.data('value');
    multi[c]['cantidad'] = 1 ;
    multi[c]['sub'] = multi[c]['costo'] * multi[c]['cantidad'];
    if (type[c]==1) {htmlcosto='<td>$'+multi[c]['costo']+'/Kg</td>';multi[c]['cantidad']='1000';}
    else{htmlcosto='<td>$'+multi[c]['costo']+'</td>';}
    tbl.append('<tr data-row="'+c+'" data-key="'+option.val()+'"><th scope="row">'+sku+'</th>'+
      '<td>'+productname+'</td>'+
       htmlcosto+
      '<td class="cantidadtd">'+multi[c]['cantidad']+'</td>'+
      '<td class="subtd">'+accounting.formatMoney(multi[c]['sub'])+'</td>'+
    '</tr>');
    /// set default
    product.val('default');
    sumar();
  }
});
// clear
function clear(){
  typeOfsale.val('public');
  empresario.val('');
  label_name.empty();
  tbl.empty();
  labeldesc.empty();
  multi = [];
  flag=false;
}
clear();
/// test
document.addEventListener('textInput', function (e){
    if(e.data.length >= 6){
        console.log('IR scan textInput', e.data);
        e.preventDefault();
    }
});
tbl.on('click', 'tr', function(event) {
  event.preventDefault();
  let tr = $(this);
  let trPadre = $(this).parents('tbody');
  /* Act on the event */
  if (!tr.hasClass('active')) {
    trPadre.find('.active').removeClass('active');
    tr.addClass('active');
  }
});
// prev
$('#up').click(function(event) {
  /* Act on the event */
  let tr = tbl.find('.active');
  let prev = tr.prev('tr');
  tr.removeClass('active'); prev.addClass('active');
});
// next
$('#down').click(function(event) {
  /* Act on the event */
  let tr = tbl.find('.active');
  let prev = tr.next('tr');
  tr.removeClass('active'); prev.addClass('active');
});
// Modificar cantidad
$('#quantity').click(function(event) {
  /* Act on the event */
  if (tbl.find('.active').length > 0) {
    let current = tbl.find('.active').data('row');
    if (type[current]==1) {
      Swal.fire({
        title: 'Ingrese la Cantidad',
        input: 'text',
        inputLabel: 'Ingrese el peso en gramos',
        inputAttributes: {
          min: 1,
          max: 12000,
          step: 1
        },
        inputValue: multi[current]['cantidad'],
        showCancelButton: true,
        inputValidator: (value) => {
          if (!value) {
            return 'Ingrese la cantidad'
          }else{
            multi[current]['cantidad']=value;
            multi[current]['sub']= multi[current]['costo'] * (multi[current]['cantidad']/1000);
            tbl.find('.active').find('.cantidadtd').html(multi[current]['cantidad']+' g');
            tbl.find('.active').find('.subtd').html(accounting.formatMoney(multi[current]['sub']));
            sumar();
          }
        }
      })
    }else{
      Swal.fire({
        title: 'Ingrese la Cantidad',
        input: 'number',
        inputAttributes: {
          min: 1,
          max: 120,
          step: 1
        },
        inputValue: multi[current]['cantidad'],
        showCancelButton: true,
        inputValidator: (value) => {
          if (!value) {
            return 'Ingrese la cantidad'
          }else{
            multi[current]['cantidad']=value;
            multi[current]['sub']= multi[current]['costo'] * multi[current]['cantidad'];
            tbl.find('.active').find('.cantidadtd').html(multi[current]['cantidad']);
            tbl.find('.active').find('.subtd').html(accounting.formatMoney(multi[current]['sub']));
            sumar();
          }
        }
      })
    }

  }else{Swal.fire('Seleccione un producto')}

});
// Delete
$('#delete').click(function(event) {
  /* Act on the event */
  if (tbl.find('.active').length > 0) {
    let current = tbl.find('.active').data('row');
    delete multi[current];
    multi.filter(function(val){return val});
    tbl.find('.active').remove(); sumar();
  }else{Swal.fire('Seleccione un producto');}
});
// sumar
function sumar(total){
  total=0;subt=0;
  for (var i = 1; i <= c; i++) {
    if (multi.hasOwnProperty(i)) {total+= multi[i]['sub'];subt+= multi[i]['sub'];}
  }
  // verificar si aplica descuento en caso de que la compra sea de un empresario
  if (multiplica>0) {
    descuento=total*multiplica;
    total = total - descuento;
    if (cupon>total) {total=0;}else{total=total-cupon;} ;
    labeldesc.html('Descuento: '+accounting.formatMoney(descuento)); labeldesc.removeClass('d-none');}
  $('.totalSale').html(accounting.formatMoney(total));
  return total;
}
// On Type of Sale change
typeOfsale.change(function(event) {
  /* Act on the event */
  if ($(this).val() == 'private') {empresario.prop( "disabled", false );}
  else{
    labeldesc.val(''); empresario.val('');label_name.empty();
    empresario.prop( "disabled", true ); multiplica=0;cupon=0;labeldesc.addClass('d-none');}
});
// Autocomplete Empresario
empresario.keyup(function(event) {
  /* Act on the event */
  if ($(this).val().length>=3) {
    empresario.autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: path+"/ventas/search",
          dataType: "json",
          type:'POST',
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        //empresario.val(ui.item.id);
        label_name.html(ui.item.label);
        NoEmpresario = ui.item.value;
        getPuntos(ui.item.value,todayDate);
      }
    } );
  }
});
//* get puntos
function getPuntos(empresario,fecha){
  $.ajax({
    url: path+'/ventas/puntos',
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
    }$('.descuento').html(label+'%');
    if (!data.user.cont>0) {
      cupon = 1500;
      labelcupon.empty();
      labelcupon.append('Cupon: $1,500.00');
      sumar();
    }else{cupon=0;labelcupon.empty();sumar();}
  });
}
// # Pagar (Open dialog)
$('#pay').click(function(event) {
  /* Act on the event */
  if (sumar()>0) {
    if (typeOfsale.val() == 'private' && empresario.val() == "") {
      Swal.fire({
        icon: 'warning',
        html:'<h2>Seleccione empresario</h2>'
      })
      return false;
    }
    Swal.fire({
      title:'Yolkan Pagos',
      html:
        '<div class="row mt-4"><div class="col-lg-11 text-left"><h3>Confirmar y Pagar</h3></div>'+
        '<div class="col-lg-1 icon-circle"><i class="fas fa-dollar-sign"></i></div></div>'+
        '<div class="row mt-3">'+
          '<div class="col-lg-3"><label for="typePay" class="swal2-input-label">Tipo de Pago:</label></div>'+
          '<div class="col-lg-9"><select disabled class="custom-select" id="typePay">'+
              '<option value="efectivo">Efectivo</option>'+
            '</select></div>'+
        '</div>'+
        '<div class="row">'+
          '<div class="col-lg-3"><label for="totalPay" class="swal2-input-label">Total:</label></div>'+
          '<div class="col-lg-9"><input class="custom-input" id="totalPay" disabled value="'+accounting.formatMoney(sumar())+'"></div>'+
        '</div>'+
        '<div class="row">'+
          '<div class="col-lg-3"><label for="pagoPay" class="swal2-input-label">Pago:</label></div>'+
          '<div class="col-lg-9"><input class="custom-input" id="pagoPay" value="'+accounting.formatMoney(sumar())+'"></div>'+
        '</div>'+
        '<div class="row">'+
          '<div class="col-lg-3"><label for="cambioPay" class="swal2-input-label">Cabio:</label></div>'+
          '<div class="col-lg-9"><input class="custom-input" disabled id="cambioPay" value="'+accounting.formatMoney(0)+'"></div>'+
        '</div>'+
        '<div class="row">'+
          '<div class="col-lg-3"><label for="fechaSet" class="swal2-input-label">Asignar Fecha:</label></div>'+
          '<div class="col-lg-9"><input class="custom-input" id="fechaSet" type="date"></div>'+
        '</div>'+
        '<div class="row mt-4">'+
          '<div class="col-lg-3"><button type="button" class="btn btn-light" id="cancelPay"> <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="12px"><path fill="currentColor" d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z" class=""></path></svg> Cerrar</button></div>'+
          '<div class="col-lg-9"><button type="button" class="btn btn-block btn-primary" id="ConfirmPay">'+
            '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22px"><path fill="currentColor" d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>'+
            '&nbsp;Pagar</button></div>'+
        '</div>'+
        '<div class="row mt-4"><div class="col" id="custom-alert"></div></div>',
      showCloseButton: false,
      showCancelButton: false,
      showConfirmButton:false,
      focusConfirm: false,
      allowOutsideClick: false
    })
  }else{
    Swal.fire({
      icon: 'warning',
      html:'<h2>Ingrese productos</h2>'
    })
  }

});
// Events
$(document).on('focus', '#pagoPay', function(event) {
  event.preventDefault();
  /* Act on the event */
  $(this).val(accounting.unformat($(this).val()));
});
// focus out format money
$(document).on('focusout', '#pagoPay', function(event) {
  $(this).val(accounting.formatMoney($(this).val()));
});
// keyup
$(document).on('keyup', '#pagoPay', function(event) {
  let valor = $(this);
  let cambio = $(document).find('#cambioPay');
  if (valor.val()>=sumar()) {
    cambio.val(accounting.formatMoney(valor.val()-sumar()));
  }
});
//
$(document).on('click', '#ConfirmPay', function(event) {
  if (!$(this).is(':disabled')) {
    let pago = $(document).find('#pagoPay');
    let alert = $(document).find('#custom-alert')
    if (sumar() > accounting.unformat(pago.val())) {
      // alert
      alert.empty(); alert.append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
        'El Pago no puede ser menor al total'+
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
          '</button>'+
        '</div>');
      // correct
      pago.val(accounting.formatMoney(sumar()));
    }else{
      // confirm dialog
      alert.empty(); alert.append('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
        '¿Esta seguro? <button class="btn btn-link" id="btn-confirm">&gt; Si, continuar</button>'+
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
          '<span aria-hidden="true">×</span>'+
        '</button>'+
      '</div>');
    }
  }
});
// close payment
$(document).on('click', '#cancelPay', function(event) {
  event.preventDefault();
  /* Act on the event */
  if (!$(this).is(':disabled')) {
    swal.close()
  }
});
// pay and confirm
$(document).on('click', '#btn-confirm', function(event) {
  // ready for send ajax
  if (flag == false) {
    //
    let alert = $(document).find('#custom-alert')
    $(document).find('#cancelPay').prop('disabled', true);
    $(document).find('#ConfirmPay').prop('disabled', true);
    flag=true;
    //
    let dataform = {'Total': accounting.unformat($(document).find('#totalPay').val()),
    'Pago': accounting.unformat($(document).find('#pagoPay').val()),
    'Cambio': accounting.unformat($(document).find('#cambioPay').val()),
    'typeOfsale':typeOfsale.val(), 'Empresario':NoEmpresario,'Percent':label,'descuento':descuento,
    'typePay': $(document).find('#typePay').val(),'cupon':cupon,'subt':subt, 'fechaSet': $(document).find('#fechaSet').val()};
    alert.empty(); alert.append('<div class="alert alert-primary fade show" role="alert">'+
      'Procesando venta ... '+
      '<svg width="18px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-circle-notch fa-w-16 fa-spin fa-lg"><g class="fa-group"><path fill="currentColor" d="M504 257.28v.23C503.42 394 392.44 504.24 256 504v-64a184.09 184.09 0 0 0 177.16-134.42c27.44-97.84-29.63-199.41-127.47-226.85A24 24 0 0 1 288 55.66V39a24 24 0 0 1 30-23.22c107.4 27.65 186.61 125.38 186 241.5z" class="fa-secondary"></path><path fill="currentColor" d="M256 439.93v64C119.56 504.24 8.58 394 8 257.51v-.23C7.39 141.16 86.6 43.43 194 15.78A24 24 0 0 1 224 39v16.66a24 24 0 0 1-17.69 23.07c-97.84 27.44-154.91 129-127.47 226.85A184.07 184.07 0 0 0 256 439.93z" class="fa-primary"></path></g></svg>'+
      '</div>');
    // send ajax
    let temp = [];
    for (var i = 1; i <= c; i++) {
      if (multi.hasOwnProperty(i)) {
        temp.push({'id':multi[i]['id'],'costo':multi[i]['costo'],'cantidad': multi[i]['cantidad'],'sub': multi[i]['sub']});
      }
    }
    //
    $.ajax({
      url: path+'/ventas/generar',
      type: 'POST',
      dataType: 'json',
      data: {items:temp,dataform:dataform},
    }).done(function(data) {
      if (data.tipo=='Completado') {
        // ok
        alert.empty(); alert.append('<div class="alert alert-primary fade show" role="alert">'+
          'Venta exitosa '+
          '<svg width="18px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-3x"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" class=""></path></svg>'+
          '</div>');
          // then check
          if (data.venta == "public") {
            // open ticket
            let url = path+'/ventas/ticket/'+data.VentasID;
            window.open(url, '_blank').focus();
          }else{
            // set
            alert.empty(); alert.append('<div class="alert alert-primary fade show" role="alert">'+
              'Se registro la venta en su cuenta '+
              '<svg width="18px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-3x"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" class=""></path></svg>'+
              '</div>');
              let url = path+'/ordenes/pedidos/ticket/'+data.OrdenID;
              window.open(url, '_blank').focus();

          }
          // clear
          clear();sumar();swal.close()
      }
      else if (data.tipo==500) {}
    });
  }
});
