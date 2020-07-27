<div class="container" id="gallery-tab">
    <div class="row">
        <div class="col-12">
            <div id="main-picture" class="picture">
                <?php $imagen = asset('uploads/'.$producto->img); if (is_null($producto->img)) { $imagen = asset('img/default-img.png');}
                if(strpos($producto->img, 'original') !== false){
                  $separate = explode('/', $producto->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
                }?>
                <img src="{{$imagen}}" alt="{{$producto->ProductosNombre}}" class="img-fluid rounded">
            </div>
        </div>
    </div>
    <div class="row pt-3 pb-4 gutters-custom">
      @foreach ($imagenes as $key => $v)
        <?php $alt=$v->caption; if (empty($v->caption)) { $alt=$producto->ProductosNombre;} ?>
        <div class="col">
            <a href="#" class="child-picture">
                <img class="img-fluid thumbnail" src="{{asset('/uploads/'.$v->img)}}" alt="{{$alt}}">
            </a>
        </div>
      @endforeach
    </div>
</div>
