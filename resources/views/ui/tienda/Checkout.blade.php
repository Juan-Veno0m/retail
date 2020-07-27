@extends('master-ui')
@section('title', 'Checkout')
@section('description','Tienda en linea Yolkan')
@section('content')
  <style>
    #msform fieldset:not(:first-of-type) {
      display: none
    }
    #msform fieldset .form-card {
      text-align: left;
      color: #9E9E9E
    }
    #msform input, #msform textarea, #msform select{
      padding: 0px 8px 4px 8px;
      border: none;
      border-bottom: 1px solid #ccc;
      border-radius: 0px;
      margin-bottom: 25px;
      margin-top: 2px;
      width: 100%;
      box-sizing: border-box;
      color: #2C3E50;
      font-size: 16px;
      letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
      -moz-box-shadow: none !important;
      -webkit-box-shadow: none !important;
      box-shadow: none !important;
      border: none;
      font-weight: bold;
      border-bottom: 2px solid #5fbd74;
      outline-width: 0
    }

    #msform .action-button {
      width: 100px;
      background: skyblue;
      font-weight: bold;
      color: white;
      border: 0 none;
      border-radius: 0px;
      cursor: pointer;
      padding: 10px 5px;
      margin: 10px 5px
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
      box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
    }

    #msform .action-button-previous {
      width: 100px;
      background: #616161;
      font-weight: bold;
      color: white;
      border: 0 none;
      border-radius: 0px;
      cursor: pointer;
      padding: 10px 5px;
      margin: 10px 5px
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
      box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
    }
    #msform label{margin:0;}
    select.list-dt {
      border: none;
      outline: 0;
      border-bottom: 1px solid #ccc;
      padding: 2px 5px 3px 5px;
      margin: 2px
    }

    select.list-dt:focus {
      border-bottom: 2px solid skyblue
    }
    .fs-title {
      font-size: 25px;
      color: #2C3E50;
      margin-bottom: 10px;
      font-weight: bold;
      text-align: left
    }

    #progressbar {
      margin-bottom: 30px;
      overflow: hidden;
      color: lightgrey
    }

    #progressbar .active {
      color: #000000
    }

    #progressbar li {
      list-style-type: none;
      font-size: 12px;
      width: 25%;
      float: left;
      position: relative;
      color:#918c8c;
    }

    #progressbar #account:before {
      content: "\f48b";
    }

    #progressbar #personal:before {
      content: "\f06e";
    }

    #progressbar #payment:before {
      content: "\f155";
    }

    #progressbar #confirm:before {
      content: "\f00c";
    }

    #progressbar li:before {
      width: 50px;
      height: 50px;
      line-height: 45px;
      display: block;
      font-size: 18px;
      color: #ffffff;
      background: #918c8c;
      border-radius: 50%;
      margin: 0 auto 10px auto;
      padding: 2px
    }

    #progressbar li:after {
      content: '';
      width: 100%;
      height: 2px;
      background: lightgray;
      position: absolute;
      left: 0;
      top: 25px;
      z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
      background: #1464a5;
    }

    .radio-group {
      position: relative;
      margin-bottom: 25px
    }

    .radio {
      display: inline-block;
      width: 204;
      height: 104;
      border-radius: 0;
      background: lightblue;
      box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
      box-sizing: border-box;
      cursor: pointer;
      margin: 8px 2px
    }

    .radio:hover {
      box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
    }

    .radio.selected {
      box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
    }
    #progressbar span {
      font-family: "Poppins", Arial, sans-serif;
      line-height: 18px;
      font-weight: 400;
    }
  </style>
  <?php $estadosmx = [
			'1' => 'Aguascalientes',
			'2' => 'Baja California',
			'3' => 'Baja California Sur',
			'4' => 'Campeche',
			'5' => 'Chiapas',
			'6' => 'Chihuahua',
			'7' => 'Coahuila de Zaragoza',
			'8' => 'Colima',
			'9' => 'Ciudad de México',
			'10' => 'Durango',
			'11' => 'Guanajuato',
			'12' => 'Guerrero',
			'13' => 'Hidalgo',
			'14' => 'Jalisco',
			'15' => 'Mexico',
			'16' => 'Michoacan de Ocampo',
			'17' => 'Morelos',
			'18' => 'Nayarit',
			'19' => 'Nuevo Leon',
			'20' => 'Oaxaca',
			'21' => 'Puebla',
			'22' => 'Queretaro de Arteaga',
			'23' => 'Quintana Roo',
			'24' => 'San Luis Potosi',
			'25' => 'Sinaloa',
			'26' => 'Sonora',
			'27' => 'Tabasco',
			'28' => 'Tamaulipas',
			'29' => 'Tlaxcala',
			'30' => 'Veracruz-Llave',
			'31' => 'Yucatan',
			'32' => 'Zacatecas',
		]; ?>
  <div class="breadcrumb">@include('ui.parts.breadcrumbs')</div>
  <div class="container-fluid my-3">
    <div class="row justify-content-center mt-0">
      <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 border-0">
                <div class="row">
                    <div class="col-md-12 mx-0">
                      @if(session('cart'))
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar" class="pl-0">
                                <li class="active fas" id="account">
                                  <span>Envío</span></li>
                                <li id="personal" class="fas">
                                  <span>Revisar</span></li>
                                <li id="payment" class="fas">
                                  <span>Pago</span></li>
                                <li id="confirm" class="fas">
                                  <span>Confirmación</span></li>
                            </ul>
                            <!-- fieldsets -->
                            @include('ui.parts.checkout-shipping')
                            @include('ui.parts.checkout-review')
                            <fieldset>
                                <div class="card-body px-0">
                                    <h2 class="fs-title">Método de pago</h2>
                                    <div class="custom-control custom-radio text-left">
                                      <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="customRadio1">Transferencia / Deposito</label>
                                      <!-- Transfer -->
                                      @include('ui.parts.transferpayment')
                                    </div>
                                    <div class="custom-control custom-radio text-left">
                                      <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" disabled>
                                      <label class="custom-control-label" for="customRadio2">PayPal</label>
                                      <div class="alert alert-secondary" role="alert">
                                        Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                      </div>
                                    </div>
                                </div>
                                <button type="button" name="previous" class="previous btn btn-default btn-lg" value="Previous"> Atrás</button>
                                <button type="button" name="next" class="next btn btn-primary btn-lg submit"> Enviar Pedido </button>
                            </fieldset>
                            <fieldset class="parent-finish">
                                <div class="card-body">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="message">You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                      @else
                        <h2 class="fs-title">No tienes productos en el carrito de compras</h2>
                        <a href="{{url('/')}}" type="button" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> Agregar productos</a>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    /* global variables */
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity; let arraydata = {}; let envio=0; let sub =0; let total=0; let cont=1; let flag=false;let dev = $('.shipping');
    let action; let EnvioUID=0; let finish = $('.parent-finish');
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
    // store ajax
    function store(){
      return $.ajax({
        url: path+'/checkout/store',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: {envio: envio, total:total,EnvioUID:EnvioUID}
      });
    }
    // next function
    function next(btn){
      // show next
      current_fs = btn.parent();
      next_fs = btn.parent().next();
      //Add Class Active
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
        step: function(now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({'opacity': opacity});
        },
        duration: 600
      });
      // step
      cont++;
    }
    // next action
    $('#msform').on('click', '.next', function(event) {
      let btn = $(this);
      let btnparent = btn.parents('.parent');
      btnparent.find('.card-body').addClass('was-validated');
      // check validated
      let error=0;
      btnparent.find('.card-body .validated').map(function () {
        if ($(this).val()=="" && $(this).prop('required')) {error++;}
        else{ arraydata[$(this).attr("name")] = $(this).val();}
      }).get();
      //
      if (arraydata!=null) {
        sub = $('.review').find('.sub').data('sub'); // get subtotal
        if (arraydata['delegacion'].toLowerCase() === 'puebla') {
          if (sub<500) { envio = 100;}
          total = parseFloat(sub) + parseFloat(envio);
        }else{envio=null; total = parseFloat(sub);}
        // print values
        $('.review').find('.envio').html('$'+envio); $('.review').find('.total').html('$'+total);
      }
      if (error>0) {
        console.log(error);
      }
      else{
        // if is Form Ready
        if (cont >= 3 && btn.hasClass('submit')) {
          // ready for send ajax
          if (flag == false) {
            // true
            flag=true;
            console.log('envio:'+envio+' total:'+total)
            console.log('ready ajax');
            btn.html('Procesando <i class="fas fa-spinner fa-spin"></i>');
            // if shipping info not exits create
            if (action=='create') {
              // function Shipping
              $.when(shipping()).done(function(a1){
                // if its ok then store
                if (a1.respuesta=='ok') { EnvioUID = a1.EnvioID ;
                  // call
                  $.when(store()).done(function(a2){
                    next(btn);
                    finish.find('.fs-title').html(a2.tipo);
                    finish.find('.message').html(a2.mensaje+' <a href="'+path+'/Cuenta/MisPedidos/'+a2.OrdenID+'">'+a2.OrdenID+'</a>');
                  });
                }
              });
            }else{
              //store
              $.when(store()).done(function(a2){
                next(btn);
                finish.find('.fs-title').html(a2.tipo);
                finish.find('.message').html(a2.mensaje+' <a href="'+path+'/Cuenta/MisPedidos/'+a2.OrdenID+'">'+a2.OrdenID+'</a>');
              });
            }
          }
        }
        else{
          // next function
          next(btn);
        }
      }

    });
    //
    $('#msform').on('click', '.previous', function(event) {
      // if is not sent
      if (flag==false) {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
          step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            current_fs.css({
              'display': 'none',
              'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
          },
          duration: 600
        });
      }
    });
    // get informacion de envio if exits
    $.get(path+"/shipping/", function(data) {
      // if is not null
      if (data.envio==null) { action='create'; $('#shipping-edit').remove();
      }else{ action='update';
        // fill
        $.each(data, function(index, el) {
          dev.find("input[name*='fullname']").val(el.NombreCompleto);
          dev.find("input[name*='postalcode']").val(el.Codigopostal);
          dev.find("input[name*='telefono']").val(el.Telefono);
          dev.find("select[name*='estado']").val(el.EstadoID);
          dev.find("input[name*='delegacion']").val(el.Municipio);
          dev.find("input[name*='colonia']").val(el.Colonia);
          dev.find("input[name*='Calle']").val(el.Calle);
          dev.find("input[name*='exterior']").val(el.Exterior);
          dev.find("input[name*='interior']").val(el.Interior);
          dev.find("input[name*='Calle1']").val(el.Calle1);
          dev.find("input[name*='Calle2']").val(el.Calle2);
          dev.find("input[name*='adicional']").val(el.Adicional);
          EnvioUID = el.EnvioID ;
        });
        //
        dev.find('.validated').attr("disabled", true);
      }
    });
    // click edit shipping info
    $('#radio-shipping').click(function(event) {
      /* Act on the event */
      let check = $(this);
      let checkparent = check.parents('.parent');
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
      let inpt = $(this);
      let inputval = inpt.parents('.parent').find("input[name='telefono']");
      if (inpt[0].value.length==3 || inpt[0].value.length == 7) { inputval.val(inputval.val()+'-');}
    });
    // only numbers
    $("input[name='telefono']").keypress(function(event){
       if(event.which != 8 && isNaN(String.fromCharCode(event.which))|| $(this)[0].value.length>=12){
           event.preventDefault(); //stop character from entering input
       }
    });
  });
</script>
@endsection
