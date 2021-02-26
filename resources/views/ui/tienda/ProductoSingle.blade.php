@extends('master-ui')
@if (isset($error))
  @section('title', 'Producto no encontrado')
  @section('description','La página solicitada no está disponible en este momento.
  Es posible que la página que estas buscando no exista o que la dirección de URL no se haya escrito correctamente.') <!-- Meta Description -->
  @section('opg')
    <!-- Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@Yolkan6" />
    <meta name="twitter:creator" content="@Yolkan6" />
    <!--  Open Graph -->
    <meta property="og:title" content="Producto no encontrado" />
    <meta property="og:description" content="La página solicitada no está disponible en este momento.
    Es posible que la página que estas buscando no exista o que la dirección de URL no se haya escrito correctamente."/>
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{URL::current()}}" />
    <meta property="og:image" content="https://super.walmart.com.mx/static/media/not-found.6c88f2df.svg" />
    <meta property="og:site_name" content="Yolkan" />
  @endsection
  @section('content')
    <link href="{{asset('/css/ui/tienda/productsingle.css?x=4')}}" rel="stylesheet">
    <link href="{{asset('/css/ui/tienda/fixed-cart.css')}}" rel="stylesheet">
    @include('ui.parts.fixed-cart')
    <div class="col-lg-9">
      <div class="row justify-content-md-center pb-4">
          <div class="col-lg-4 text-center">
            <img src="{{asset('img/product-not-found.jpg')}}">
            <h1 style="font-size: 20px;color: #282828;">El producto que estabas buscando no existe</h1>
            <p class="mt-3">La página solicitada no está disponible en este momento.
              Es posible que la página que estas buscando no exista o que la dirección de URL no se haya escrito correctamente.</p>
            <a type="button" class="btn btn-warning btn-block btn-lg" href="{{url('/tienda')}}">Seguir comprando</a>
          </div>
      </div>
    </div>
  @endsection
@else
  @section('title', $producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad)
  @section('description',$producto->Descripcion) <!-- Meta Description -->
  @section('opg')
    <!-- Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@Yolkan6" />
    <meta name="twitter:creator" content="@Yolkan6" />
    <!--  Open Graph -->
    <meta property="og:title" content="{{$producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad}}" />
    <meta property="og:description" content="{{$producto->Descripcion}}"/>
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{URL::current()}}" />
    <meta property="og:image" content="{{asset('uploads/'.$producto->img)}}" />
    <meta property="og:site_name" content="Yolkan" />
    <meta property="product:price:amount" content="{{number_format($producto->PrecioUnitario*2,2)}}"/>
    <meta property="product:price:currency" content="MXN"/>
  @endsection
  @section('content')
    <link href="{{asset('/css/ui/tienda/productsingle.css?x=4')}}" rel="stylesheet">
    <link href="{{asset('/css/ui/tienda/fixed-cart.css')}}" rel="stylesheet">
    <style>
      img.lazyload {
        background: white;
        opacity: 0;
      }img.lazyloaded {
        background: none;
        transition: fadeIn;
        opacity: 1;
      }
    </style>
    @include('ui.parts.fixed-cart')
    <div class="col-lg-9">
      @include('ui.parts.sticky-breadcrumb')
      <div class="row">
        <!-- Col Slider -->
        <div class="col-xl-6 my-lg-4 px-0 d-none d-sm-block">@include('ui.parts.product-slider')</div>
        <!-- Col Description -->
        <div class="col-xl-6 my-lg-4 px-1">@include('ui.parts.product-description')</div>
      </div>
    </div>
    <div class="col-lg-9 my-2">
      <!-- description -->
      <div class="row">
        <div class="accordion description col" id="accordionExample">
          <div class="card">
            <div class="card-header bg-white" id="headingOne">
              <h2 class="mb-0">
                <a class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Descripción <div class="float-right"><i class="fas fa-plus"></i></div>
                </a>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <p>{{$producto->Descripcion}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9 my-4">
      <div class="row">
        <div class="col">@include('ui.parts.product-related')</div>
      </div>
    </div>
  @endsection
  @section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      // on click input number
      $('.summary').on('click', '.quantity > span', function(event) {
        event.preventDefault();
        /* Act on the event */
        let inp = $('.input-number'); let span = $(this); let number = parseInt(inp.val());
        if (span.hasClass('input-number-decrement')&& number>=2) {
          inp.val(number-1);span.data('lock',false);
        }else if (span.hasClass('input-number-increment') && number < inp.attr('max')) {
          inp.val(number+1);span.data('lock',false);
        }else{ span.data('lock',true);}
      });
      // Change img src
      $('#gallery-tab').on('click', '.child-picture > img ', function(event) {
        event.preventDefault();
        /* Act on the event */
        let img = $(this);
        let src = img.data('clic');
        $('#gallery-tab').find('#main-picture > img').attr('src',src);
      });
    });
  </script>
  @endsection
@endif
