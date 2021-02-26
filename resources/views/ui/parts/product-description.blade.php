<div class="row summary mt-1 mt-lg-0">
  <div class="col-xl-12 pl-0 pl-lg-3"><h1 class="product-tittle">{{$producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad}}</h1></div>
  <div class="col-xl-12 pl-0 pl-lg-3"><h2 class="product-subtitle">Productor:&nbsp;{{$producto->EmpresaNombre}}</h2></div>
  <!-- Carousel -->
  <div class="col-xl-12 pl-0">
    <div id="carouselmobile" class="carousel slide carousel-fade d-block d-sm-none" data-ride="carousel">
      <div class="carousel-inner">
        <!-- items -->
        <?php $indicators=''; ?>
        @foreach ($imagenes as $key => $v)
          <?php $alt=$v->caption; if (empty($v->caption)) { $alt=$producto->ProductosNombre;}
          if(strpos($v->img, 'large') !== false || strpos($v->img, 'original') !== false){
            $separate = explode('/', $v->img); $base= '/uploads'.'/'.$separate[0];  $filename = $separate[2];
            $small = $base.'/mobile'.'/'.$filename;
          }?>
          <div class="carousel-item <?php if($loop->index==0) echo "active";?>" data-interval="3000">
            <img src="{{asset($base.'/medium'.'/'.$filename)}}" class="d-block w-100" alt="{{$alt}}">
          </div>
          <?php $indicators .='<li data-target="#carouselmobile" data-slide-to="'.$loop->index.'"></li>'; ?>
        @endforeach
      </div>
      <ol class="carousel-indicators">
        <?php echo $indicators ?>
      </ol>
    </div>
  </div>
  <!-- end -->
  <div class="product-seperator-line pt-1"></div>
  <div class="col-xl-12">
    <span class="label">Precio: </span><span class="product-price">{{ '$'.number_format($producto->PrecioUnitario*2,2)}}</span>
  </div>
  <div class="product-seperator-line pt-1 mt-2"></div>
  <div class="col-xl-12 mt-2 btn-action">
      <?php $cantidad=0;
      if (isset(session('cart')[$ProductosID])) {
        $cantidad = session('cart')[$ProductosID]['quantity'];
        $keygen = session('cart')[$ProductosID]['keygen'];
      }
      ?>
      @if($producto->UnidadesEnStock>0)
        @if ($cantidad>=1)
          <label for="cantidad">Cantidad</label>
          <div class="quantity d-block" data-id="{{$ProductosID}}" data-keygen="{{$keygen}}">
            <span class="input-number-decrement">–</span><input class="input-number" type="text" value="{{$cantidad}}" min="1" max="{{$producto->UnidadesEnStock}}"><span class="input-number-increment">+</span>
          </div>
        @else
          <button type="button" class="btn btn-warning btn-cart" data-id="{{$id}}">Agregar al Carrito</button>
        @endif
      @else
        @if ($producto->Descontinuado==true)
          <button type="button" class="btn btn-secondary">Producto descontinuado</button>
        @else
          <button type="button" class="btn btn-secondary">Producto agotado</button>
        @endif
      @endif
  </div>
  <div class="col-xl-12 mt-4">
    <div class="d-block">
      <span><label>Porción:&nbsp;</label>{{$producto->Cantidad.' '.$producto->Unidad}}</span>
    </div>
    <div class="d-block">
      <span><label>SKU:&nbsp;</label>{{$ProductosID}}</span>
    </div>
    <div class="d-block">
      <span><label>Categoria:&nbsp;</label>{{$producto->CategoriaNombre}}</span>
    </div>
  </div>
</div>
