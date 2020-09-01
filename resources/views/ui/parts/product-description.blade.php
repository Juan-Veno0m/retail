<div class="row summary">
  <div class="col-xl-12"><h1 class="product-tittle">{{$producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad}}</h1></div>
  <div class="product-seperator-line"></div>
  <div class="col-xl-12">
    <span class="product-price">{{ '$'.number_format($producto->PrecioUnitario*2,2)}}</span>
  </div>
  <div class="product-seperator-line"></div>
  <div class="col-xl-12 mt-2 btn-action">
      <?php $cantidad=0;
      if (isset(session('cart')[$ProductosID])) {
        $cantidad = session('cart')[$ProductosID]['quantity'];
        $keygen = session('cart')[$ProductosID]['keygen'];
      }
      ?>
      @if ($cantidad>=1)
        <label for="cantidad">Cantidad</label>
        <div class="quantity d-block" data-id="{{$ProductosID}}" data-keygen="{{$keygen}}">
          <span class="input-number-decrement">–</span><input class="input-number" type="text" value="{{$cantidad}}" min="1" max="10"><span class="input-number-increment">+</span>
        </div>
      @else
        <button type="button" class="btn btn-dark btn-cart" data-id="{{$id}}">Agregar al Carrito</button>
      @endif
  </div>
  <div class="col-xl-12 mt-4">
    <div class="d-block">
      <span><b>Porción:&nbsp;</b>{{$producto->Cantidad.' '.$producto->Unidad}}</span>
    </div>
    <div class="d-block">
      <span><b>SKU:&nbsp;</b>{{$ProductosID}}</span>
    </div>
    <div class="d-block">
      <span><b>Categoria:&nbsp;</b>{{$producto->CategoriaNombre}}</span>
    </div>
  </div>
</div>
