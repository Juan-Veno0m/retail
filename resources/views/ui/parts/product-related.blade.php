<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-left ftco-animate fadeInUp ftco-animated">
        <h2 class="mb-4">Productos Relacionados</h2>
      </div>
    </div>
    <div class="row">
      <!-- each product -->
      @foreach ($related as $key => $p)
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
        <div class="col-lg-3 col-md-4 col-6 ftco-animate fadeInUp ftco-animated">
          <div class="product">
            <a href="{{url('/producto/'.$slug.'/'.($p->ProductosID+3301))}}" class="img-prod">
              <img class="img-fluid cover lazyload" alt="{{$p->ProductosNombre}}"
              data-sizes="auto"
              data-srcset="{{$imagen}}"
              data-src="{{$small}}">
              <!-- <span class="status">30%</span> -->
              <div class="overlay"></div>
            </a>
            <div class="text pt-3 px-3 text-center">
              <h3><a href="#">{{$p->ProductosNombre}}</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span class="price-sale">{{ '$'.number_format($p->PrecioUnitario*2,2)}}</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
