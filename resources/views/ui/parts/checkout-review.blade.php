<fieldset>
    <div class="card-body review">
        <h2 class="fs-title">Tú pedido</h2>
        <ul class="list-group list-group-flush" id="cart-products">
          <?php $total = 0 ?>
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
                  <div class="col-xl-6 text-left">Subtotal:</div>
                  <div class="col-xl-6 sub text-right" data-sub="{{ $total }}">${{ $total }}</div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col-xl-4 text-left">Gastos de envío:</div>
                  <div class="col-xl-8 envio text-right">Pendiente</div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-xl-10">
                <div class="row">
                  <div class="col text-left">Total:</div>
                  <div class="col total text-right"><b>${{ $total }}</b></div>
                </div>
              </div>
            </div>
          </li>
        </ul>
    </div>
    <button type="button" name="previous" class="previous btn btn-default btn-lg" value="Previous"> Atrás</button>
    <button type="button" name="next" class="next btn btn-primary btn-lg"> Siguiente </button>
</fieldset>
