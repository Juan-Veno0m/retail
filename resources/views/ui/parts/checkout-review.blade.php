<fieldset>
    <div class="card-body review">
        <h2 class="fs-title">Tú pedido</h2>
        <ul class="list-group list-group-flush" id="cart-products">
          <?php $total = 0; $descuento = 0.2; $label = '20%'; 
            if (isset($p)) {
              if ($p->Puntos >=300) { // 25 %
                $descuento = 0.25;$label = '25%';
              } if ($p->Puntos >= 600) { // 30 %
                $descuento = 0.30;$label = '30%';
              }
            }
          ?>
          @if(session('cart'))
            @foreach(session('cart') as $id => $details)
              <?php $total += $details['price'] * $details['quantity'] ?>
              <li class="list-group-item" data-keygen="{{$details['keygen']}}">
                <div class="row align-items-center">
                  <div class="col-xl-10">
                    <div class="row">
                      <div class="col-xl-3 text-left">SKU:{{ $id }}</div>
                      <div class="col-xl-7 text-left">{{ $details['name'] }} x {{$details['quantity']}}</div>
                      <div class="col-xl-2 text-right">${{ $details['price'] * $details['quantity'] }}</div>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          @endif
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col-xl-6 text-left">Costo de los productos:</div>
                  <div class="col-xl-6 sub text-right" data-sub="{{ $total }}">${{ $total }}</div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col-xl-4 text-left">Costo de envío:</div>
                  <div class="col-xl-8 envio text-right">Pendiente</div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col-xl-4 text-left">Descuentos <small class="porcentaje" data-desc="{{$descuento}}" data-label="{{$label}}">({{$label}})</small>:</div>
                  <div class="col-xl-8 money text-right text-danger">${{$total*$descuento}}</div>
                </div>
              </div>
            </div>
          </li>
          @if (!Auth::user()->cont>0)
            <li class="list-group-item cupon">
              <div class="row align-items-center">
                <div class="col-xl-10">
                  <div class="row">
                    <div class="col-xl-4 text-left">Cupón de descuento:</div>
                    <div class="col-xl-8 money text-right text-danger">- $1,500</div>
                  </div>
                </div>
              </div>
            </li>
          @endif
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col text-left">Total:</div>
                  <div class="col total text-right"><b>${{ number_format($total-($total*$descuento), 2, '.', '') }}</b></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
    </div>
    <button type="button" name="previous" class="previous btn btn-default btn-lg" value="Previous"> Atrás</button>
    <button type="button" name="next" class="next btn btn-primary btn-lg"> Siguiente </button>
</fieldset>
