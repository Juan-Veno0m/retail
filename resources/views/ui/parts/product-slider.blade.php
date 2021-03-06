<div class="container" id="gallery-tab">
    <div class="row align-items-center">
      <div class="col-lg-2 no-gutters">
        @foreach ($imagenes as $key => $v)
          <?php $alt=$v->caption; if (empty($v->caption)) { $alt=$producto->ProductosNombre;}
          if(strpos($v->img, 'large') !== false || strpos($v->img, 'original') !== false){
            $separate = explode('/', $v->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
            $small = $base.'/mobile'.'/'.$filename;
          }?>
          <div class="d-flex mb-1">
              <a href="#" class="child-picture">
                  <img class="img-fluid thumbnail lazyload" data-src="{{asset($small)}}" data-clic="{{asset($base.'/medium'.'/'.$filename)}}" alt="{{$alt}}">
              </a>
          </div>
        @endforeach
      </div>
      <div class="col-10">
          <div id="main-picture" class="picture">
            <?php $imagen = asset('uploads/'.$producto->img); if (is_null($producto->img)) { $imagen = asset('img/default-img.png'); $small =asset('img/default-img.png');}
            if(strpos($producto->img, 'large') !== false || strpos($producto->img, 'original') !== false){
              $separate = explode('/', $producto->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
              $small = $base.'/medium'.'/'.$filename;
            }?>
            <img class="img-fluid rounded lazyload" alt="{{$producto->ProductosNombre}}" data-src="{{$small}}">
          </div>
      </div>
    </div>
</div>
