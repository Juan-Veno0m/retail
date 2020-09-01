@extends('master-ui')
@section('title', $CategoriaNombre)
@section('description','Tienda en linea Yolkan')
@section('content')
    <link href="{{asset('/css/ui/tienda/main.css')}}" rel="stylesheet">
    <link href="{{asset('/css/ui/tienda/fixed-cart.css')}}" rel="stylesheet">
    <!-- Section Content -->
    @include('ui.parts.fixed-cart')
    <section class="col-lg-9">
      <div class="container">
        <div class="row justify-content-center pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate fadeInUp ftco-animated">
            <h1 class="text-center">
              <div class="insight-title--title">{{$CategoriaNombre}}</div>
              <div class="insight-title--subtitle">Tienda orgánica</div>
            </h1>
          </div>
        </div>
        <div class="row justify-content-center mb-5 icon-separetor">
          <div class="col-xl-2"><hr></div>
          <div class="col-xl-1 text-center">
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bahai" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-bahai fa-w-16 fa-spin fa-lg"><path fill="currentColor" d="M496.25 202.52l-110-15.44 41.82-104.34c5.26-13.11-4.98-25.55-16.89-25.55-3.2 0-6.52.9-9.69 2.92L307.45 120l-34.1-107.18C270.64 4.27 263.32 0 256 0c-7.32 0-14.64 4.27-17.35 12.82l-34.09 107.19-94.04-59.89c-3.18-2.02-6.5-2.92-9.69-2.92-11.91 0-22.15 12.43-16.89 25.55l41.82 104.34-110 15.44c-17.53 2.46-21.67 26.27-6.03 34.67l98.16 52.66-74.49 83.53c-10.92 12.25-1.72 30.93 13.28 30.93 1.32 0 2.67-.14 4.07-.45l108.57-23.65-4.11 112.55c-.43 11.65 8.87 19.22 18.41 19.22 5.16 0 10.39-2.21 14.2-7.18l68.18-88.9 68.18 88.9c3.81 4.97 9.04 7.18 14.2 7.18 9.55 0 18.84-7.57 18.41-19.22l-4.11-112.55 108.57 23.65c1.39.3 2.75.45 4.07.45 15.01 0 24.2-18.69 13.28-30.93l-74.48-83.54 98.16-52.66c15.65-8.4 11.51-32.21-6.03-34.67zM369.02 322.05l13.99 15.69-20.39-4.44-59.48-12.96 2.25 61.67.77 21.14-12.81-16.7L256 337.74l-37.35 48.71-12.81 16.7.77-21.14 2.25-61.67-59.48 12.96-20.39 4.44 13.99-15.69 40.81-45.77-53.78-28.85-18.44-9.89 20.66-2.9 60.27-8.46-22.91-57.17-7.86-19.6 17.67 11.25 51.52 32.81 18.68-58.73 6.4-20.14 6.4 20.14 18.68 58.73 51.52-32.81 17.67-11.25-7.86 19.6-22.91 57.17 60.27 8.46 20.66 2.9-18.44 9.89-53.78 28.85 40.81 45.77z" class=""></path></svg>
          </div>
          <div class="col-xl-2"><hr></div>
        </div>
      </div>
      <div class="container mt-4">
        <form role="search" method="GET" class="search row align-items-center mb-3 mr-1">
          <div class="col-xl-12">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="q" name="q" value="{{$q}}" placeholder="Ingrese el producto a buscar" aria-label="Ingrese el producto a buscar" aria-describedby="q">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
          @if (count($productos))
            @foreach ($productos as $key => $p)
              <?php $imagen = asset('uploads/'.$p->img); if (is_null($p->img)) { $imagen = asset('img/default-img.png'); $small =asset('img/default-img.png');}
              $str = ['/',' ']; $especial = ['%',')','(','.'];
              $slug = str_replace($str, '-', $p->ProductosNombre.'-'.$p->Cantidad.'-'.$p->Unidad);
              $slug = str_replace($especial, '', $slug);
              if(strpos($p->img, 'large') !== false || strpos($p->img, 'original') !== false){
                $separate = explode('/', $p->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
                $imagen = $base.'/mobile'.'/'.$filename.' 2x, '.
                          $base.'/medium'.'/'.$filename.' 1x';
                $small = $base.'/medium'.'/'.$filename;
              }?>
              <div class="col-lg-3 col-md-4 ftco-animate fadeInUp ftco-animated">
                <div class="product">
                  <a href="{{url('/producto/'.$slug.'/'.($p->ProductosID+3301))}}" class="img-prod">
                    <img class="img-fluid cover lazyload" alt="{{$p->ProductosNombre}}"
                    data-sizes="auto"
                    data-srcset="{{$imagen}}"
                    data-src="{{$small}}">
                    <div class="overlay"></div>
                  </a>
                  <div class="text pt-3 px-3 text-center">
                    <h3><a href="#">{{$p->ProductosNombre.' '.$p->Cantidad.' '.$p->Unidad}}</a></h3>
                    <p>{{$p->CategoriaNombre}}</p>
                    <div class="d-flex">
                      <div class="pricing">
                        <p class="price"><span class="price-sale">{{ '$'.number_format($p->PrecioUnitario*2,2)}}</span></p>
                      </div>
                    </div>
                    <div class="row py-2  px-2 block-add">
                      <a class="btn btn-link btn-block text-center text-dark" id="add-cart" data-id="{{$p->ID}}"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="alert alert-warning text-center col" role="alert">
              Lo sentimos, no encontramos este producto.
            </div>
          @endif
        </div>
        <div class="row justify-content-center mt-5">{{$productos->links()}}</div>
      </div>
    </section>
@endsection
@section('scripts')
@endsection
