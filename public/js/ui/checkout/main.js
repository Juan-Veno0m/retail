$(document).ready(function(){
  // global variables
  var arraydata = {}; var envio=0; var sub =0; var total=0; var flag=false;var dev = $('.shipping');
  var descuento=0; var fixedTotal=0; var desc; var label; var tipoenvio; var fechaPick; var horaPick;
  var action; var EnvioUID=0;
  var path = $('#path').data('path'); var steps = 0; var loader = $('#loader'); var cartresume = $('#cart-resume');
  $("#shipping input[type='radio']").prop('checked', false);
  /* when load all close loader */
  setTimeout(function(){ $('#path').fadeIn(600);loader.fadeOut(200);}, 1500);
  // store ajax
  function store(){
    return $.ajax({
      url: path+'/checkout/store',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {envio: envio, total:total,descuento:descuento,EnvioUID:EnvioUID,fixedTotal:fixedTotal,label:label,
        tipoenvio:tipoenvio,fechaPick:fechaPick,horaPick:horaPick}
    });
  }
  // function shipping ajax
  function shipping(){
    return $.ajax({
      url: path+'/shipping/shipping_action',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {action: action, arraydata:arraydata}
    });
  }
  // next button
  $('#main-checkout').on('click', '.next', function(event) {
    event.preventDefault();
    var btn = $(this);
    var accordion = btn.parents('#accordion');
    var radio = $("#shipping input[type='radio']:checked");
    /* Act on the event */
    if(radio.val()){
      // verificar si el elemento seleccionado es Pickup
      if (radio.data('type') == 2 ) {
        if ($('#calendar tbody .selected').length>0) {
          steps++;
          if (steps<=2) {
            /* next */
            accordion.find('.collapse').removeClass('show');
            btn.closest('.list-group-item').next().find('.collapse').addClass('show');
          }if(steps==2){$('.submit').attr('disabled', false); console.log('ready');steps=0;}
        }else{alert('seleccione una opción del calendario para el pickup.');}
      }else{
        steps++;
        if (steps<=2) {
          /* next */
          accordion.find('.show').removeClass('show');
          btn.closest('.list-group-item').next().find('.collapse').addClass('show');
        }if(steps==2){$('.submit').attr('disabled', false); console.log('ready');steps=0;}
      }

    }else{alert('seleccione una opción');}

  });
  // get informacion de envio if exits
  $.get(path+"/shipping", function(data) {
    // if is not null
    $('.submit').attr('disabled', true);
    if (data.envio==null) {
      action='create'; $('#shipping-edit').remove();
      $('#shipping').removeClass('collapse'); $('#shipping').addClass('show');
      $('#actionshipping').addClass('show');$('#actionshipping').removeClass('collapse');
    }else{ action='create';
      // fill
      var itemsHtml='';
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
      //
      $('#shipping_address').append(itemsHtml);
      //dev.find('.validated').attr("disabled", true);
    }
  });
  // click edit shipping info
  $('#radio-shipping').click(function(event) {
    /* Act on the event */
    var check = $(this);
    var checkparent = check.parents('.parent');
    if (check.is(':checked')) {
      dev.find('.validated').attr("disabled", false);
      checkparent.find('.update').removeClass('d-none');
      checkparent.find('.next').addClass('d-none');
    }
    else{
      dev.find('.validated').attr("disabled", true);
      checkparent.find('.update').addClass('d-none');
      checkparent.find('.next').removeClass('d-none');
    }
  });
  // format phone number
  $("input[name='telefono']").on('keyup', function() {
    //
    var inpt = $(this);
    var inputval = inpt.parents('.parent').find("input[name='telefono']");
    if (inpt[0].value.length==3 || inpt[0].value.length == 7) { inputval.val(inputval.val()+'-');}
  });
  // only numbers
  $("input[name='telefono']").keypress(function(event){
     if(event.which != 8 && isNaN(String.fromCharCode(event.which))|| $(this)[0].value.length>=12){
         event.preventDefault(); //stop character from entering input
     }
  });
  // change shipping
  $('#change-shipping').click(function(event) {
    /* Act on the event */
    if (!$('#nav-home').hasClass('show')) {$('#nav-home').addClass('show');}
  });
  // send order */
  $('#main-checkout').on('click', '.submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    var btn = $(this);
    var btnparent = btn.parents('.modal-content');
    btnparent.find('.card-body').addClass('was-validated');
    // check validated
    if (flag == false) {
      // disable
      flag=true;
      var radio = $("#shipping input[type='radio']:checked");
      tipoenvio = radio.data('type');
      EnvioUID = radio.val();
      /* pickup info */
      if (tipoenvio == 2 ) {
        var selectday = $('#calendar tbody .selected');
        fechaPick = selectday.data('date');
        horaPick = selectday.parents('tr').data('hour');
      }
      $('#path').fadeOut(600); loader.fadeIn(200);
      loader.find('.title-loader').empty().append('Procesando pedido');
      /* send ajax store */
      $.when(store()).done(function(a2){
        /* when done */
        setTimeout(function(){
          loader.animate({
            backgroundColor: "#12c06a",
          }, 400 );
          loader.find('.title-loader').empty().append(a2.tipo);
          //finish.find('.message').html(a2.mensaje+' <a href="'+path+'/Cuenta/MisPedidos/'+a2.OrdenID+'">'+a2.OrdenID+'</a>');
          loader.find('.media-loader').attr('src', path+'/img/icon/success.gif');
          window.location.replace(path+'/Cuenta/MisPedidos/'+a2.OrdenID);
        }, 1500);

      });
      /* when failed */
      /*setTimeout(function(){
        loader.animate({
          backgroundColor: "#fb6b6b",
        }, 400 );
        loader.find('.title-loader').empty().append('Lo sentimos, ocurrió un problema.')
        $('.media-loader').addClass('warning');
        $('.media-loader').attr('src', path+'/img/icon/error.gif');
      }, 1500); */
    }
  });
  //action shipping
  $('#actionshipping').on('click', '.save', function(event) {
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
          $('#shipping_address').append(itemsHtml);
          $('#actionshipping').modal('hide');
        }
      });
    }
    if (error>0) {
      console.log(error);
    }
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
  // calcular costo de envio al seleccionar opción de envio
  $('#shipping').on('change', 'input[type="radio"]', function(event) {
    event.preventDefault();
    var input = $(this);
    /* Act on the event */
    if (input.data('type') == 1 ) {
      sub = cartresume.find('.sub').data('sub'); // get subtotal
      if (input.data('city') == 'Puebla') {
        if (sub<500) { envio = 100;}
      }else{envio=299; total = parseFloat(sub);descuento = parseFloat(sub*desc);}
    }else{envio = 0;}
    /* */
    sub = cartresume.find('.sub').data('sub'); // get subtotal
    desc = parseFloat(cartresume.find('.porcentaje').data('desc'));
    label = parseFloat(cartresume.find('.porcentaje').data('label'));
    total = parseFloat(sub);
    descuento = parseFloat(sub*desc);
    // print values
    cartresume.find('.envio').html('$'+envio); //
    fixedTotal= total-descuento + parseFloat(envio);
    // check if cupon exits
    if ($('.cupon').length) {if (fixedTotal<1500) {fixedTotal=0;}else{fixedTotal=parseFloat(fixedTotal-1500).toFixed(2);}}
     cartresume.find('.total').html('$'+(parseFloat(fixedTotal)).toFixed(2));
  });
});
