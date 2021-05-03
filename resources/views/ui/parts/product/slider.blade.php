<div class="container" id="gallery-tab">
    <div class="row align-items-center">
      <div class="col">
          <div id="main-picture" class="picture">
            <?php $imagen = asset('uploads/'.$producto->img); if (is_null($producto->img)) { $imagen = asset('img/default-img.png'); $small =asset('img/default-img.png');}
            if(strpos($producto->img, 'large') !== false || strpos($producto->img, 'original') !== false){
              $separate = explode('/', $producto->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
              $small = $base.'/large'.'/'.$filename;
            }?>
            <img class="img-fluid rounded lazyload" alt="{{$producto->ProductosNombre}}" data-src="{{$small}}">
          </div>
      </div>
    </div>
</div>
