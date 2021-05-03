<section class="ftco-section py-5">
  <div class="container">
    <div class="row justify-content-center pb-3">
      <div class="col-lg-12 col-8 heading-section text-center ftco-animate fadeInUp ftco-animated">
        <h2 class="text-center">
          <div class="insight-title--subtitle">Productos Orgánicos y Artesanales</div>
        </h2>
      </div>
    </div>
    <div class="row justify-content-center mb-5 icon-separetor">
      <div class="col-xl-2"><hr></div>
      <div class="col-xl-1 text-center">
        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="bahai" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-bahai fa-w-16 fa-spin fa-lg"><path fill="currentColor" d="M496.25 202.52l-110-15.44 41.82-104.34c5.26-13.11-4.98-25.55-16.89-25.55-3.2 0-6.52.9-9.69 2.92L307.45 120l-34.1-107.18C270.64 4.27 263.32 0 256 0c-7.32 0-14.64 4.27-17.35 12.82l-34.09 107.19-94.04-59.89c-3.18-2.02-6.5-2.92-9.69-2.92-11.91 0-22.15 12.43-16.89 25.55l41.82 104.34-110 15.44c-17.53 2.46-21.67 26.27-6.03 34.67l98.16 52.66-74.49 83.53c-10.92 12.25-1.72 30.93 13.28 30.93 1.32 0 2.67-.14 4.07-.45l108.57-23.65-4.11 112.55c-.43 11.65 8.87 19.22 18.41 19.22 5.16 0 10.39-2.21 14.2-7.18l68.18-88.9 68.18 88.9c3.81 4.97 9.04 7.18 14.2 7.18 9.55 0 18.84-7.57 18.41-19.22l-4.11-112.55 108.57 23.65c1.39.3 2.75.45 4.07.45 15.01 0 24.2-18.69 13.28-30.93l-74.48-83.54 98.16-52.66c15.65-8.4 11.51-32.21-6.03-34.67zM369.02 322.05l13.99 15.69-20.39-4.44-59.48-12.96 2.25 61.67.77 21.14-12.81-16.7L256 337.74l-37.35 48.71-12.81 16.7.77-21.14 2.25-61.67-59.48 12.96-20.39 4.44 13.99-15.69 40.81-45.77-53.78-28.85-18.44-9.89 20.66-2.9 60.27-8.46-22.91-57.17-7.86-19.6 17.67 11.25 51.52 32.81 18.68-58.73 6.4-20.14 6.4 20.14 18.68 58.73 51.52-32.81 17.67-11.25-7.86 19.6-22.91 57.17 60.27 8.46 20.66 2.9-18.44 9.89-53.78 28.85 40.81 45.77z" class=""></path></svg>
      </div>
      <div class="col-xl-2"><hr></div>
  </div>
  <div class="container-fluid mt-4 grid">
    <div class="row">
      <!-- each product -->
      @foreach ($productos as $key => $p)
        <?php $imagen = asset('uploads/'.$p->img); if (is_null($p->img)) { $imagen = asset('img/default-img.png'); $small =asset('img/default-img.png');}
        $str = ['/',' ']; $especial = ['%',')','(','.'];
        $slug = str_replace($str, '-', $p->ProductosNombre.'-'.$p->Cantidad.'-'.$p->Unidad);
        $slug = str_replace($especial, '', $slug);
        if(strpos($p->img, 'large') !== false || strpos($p->img, 'original') !== false){
          $separate = explode('/', $p->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
          $imagen = $base.'/medium'.'/'.$filename.' 2x, '.
                    $base.'/large'.'/'.$filename.' 1x';
          $small = $base.'/medium'.'/'.$filename;
        }
        ?>
        <div class="col-lg-3 col-6">
          <div class="product">
            <a href="{{url('/producto/'.$slug.'/'.($p->ProductosID+3301))}}" class="img-prod" title="{{$p->ProductosNombre}}">
              <img class="img-fluid lazyload" alt="{{$p->ProductosNombre}}"
              data-sizes="auto"
              data-srcset="{{$imagen}}"
              data-src="{{$small}}" width="239" height="318">
            </a>
            <div class="text pt-3 px-3 text-center">
              <h3>{{$p->ProductosNombre}}</h3>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row mt-4 justify-content-center">
      <p><a href="{{url('/tienda')}}" class="btn btn-warning btn-lg" title="tienda"><b>Ver tienda</b></a></p>
    </div>
  </div>
</section>
