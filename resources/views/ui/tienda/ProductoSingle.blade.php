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
  <!-- HTML Meta Tags -->
  <?php $title = $producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad;
    $SKU = substr($producto->ProductosNombre, 0, 3).'-'.substr($producto->Cantidad.$producto->Unidad, 0, 3).'-'.substr($producto->EmpresaNombre, 0, 3);
  ?>
  @section('title', $title)
  <!-- Datos estructurados -->
  <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "brand": {
        "@type": "Brand",
        "name": "{{$producto->EmpresaNombre}}"
      },
      "name": "{{$title}}",
      "image": "{{asset('uploads/'.$producto->img)}}",
      "description": "{{$producto->Descripcion}}",
      "sku": "{{strtoupper($SKU)}}",
      "mpn": "{{$ProductosID}}",
      "offers": {
        "@type": "Offer",
        "url": "{{URL::current()}}",
        "priceCurrency": "mxn",
        "priceValidUntil": "2021-11-20",
        "price": "{{number_format($producto->PrecioUnitario*2,2)}}",
        "itemCondition": "New",
        "availability": "https://schema.org/InStock"
      }
    }
  </script>
  @section('description',$producto->Descripcion) <!-- Meta Description -->
  @section('opg')
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{$title}}">
    <meta itemprop="description" content="{{$producto->Descripcion}}">
    <meta itemprop="image" content="{{asset('uploads/'.$producto->img)}}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{URL::current()}}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:title" content="{{$title}}">
    <meta property="og:description" content="{{$producto->Descripcion}}">
    <meta property="og:image" content="{{asset('uploads/'.$producto->img)}}">
    <meta property="og:site_name" content="Yolkan" />
    <meta property="product:price:amount" content="{{number_format($producto->PrecioUnitario*2,2)}}"/>
    <meta property="product:price:currency" content="MXN"/>
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$title}}">
    <meta name="twitter:site" content="@Yolkan6" />
    <meta name="twitter:creator" content="@Yolkan6" />
    <meta name="twitter:description" content="{{$producto->Descripcion}}">
    <meta name="twitter:image" content="{{asset('uploads/'.$producto->img)}}">
  @endsection
  @section('content')
    <link href="{{asset('/css/ui/tienda/productsingle.css?x=4')}}" rel="stylesheet">
    <link href="{{asset('/css/ui/tienda/fixed-cart.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
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
    <div class="col-lg-9 my-2" id="product-content">
      <!-- breadcrumb -->
      @include('ui.parts.sticky-breadcrumb')
      <div class="row">
        <!-- Col Slider -->
        <div class="col-xl-6 my-lg-4 px-0 d-none d-sm-block">@include('ui.parts.product.slider')</div>
        <!-- Col Description -->
        <div class="col-xl-6 my-lg-4 px-1">@include('ui.parts.product.description')</div>
      </div>
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
      <!-- related product -->
      @include('ui.parts.product-related')
      <!-- Reseñas -->
      @include('ui.parts.product.reviews')
    </div>
  @endsection
  @section('scripts')
  <!-- modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" defer></script>
  <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      $(function () {
        $(".rateYo").rateYo({
          fullStar: true,
          starWidth: "17px",
          readOnly: true
        });
        //*
        $('.rateYo').map(function(index,el){
          $(this).rateYo("rating", $(this).data('rating'));
        });
      });
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
