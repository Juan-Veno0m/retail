<div class="container pt-4">
  <div class="row align-items-first">
    <div class="col-xl-8">
      <div class="alert alert-warning" role="alert">
        Costos de envío calculados para entrega local en Puebla Capital. Para envíos a otra zona el costo puede variar.
      </div>
      <h2>Bolsa de compra</h2>
      <ul class="list-group list-group-flush" id="cart-products">
        <?php $total = 0 ?>
        @if(session('cart'))
          @foreach(session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity'] ?>
            <li class="list-group-item" data-keygen="{{$details['keygen']}}">
              <div class="row">
                <div class="col-xl-3">
                  <a href="{{url('/producto/'.str_replace(' ', '-', $details['name']).'/'.($id))}}">
                    <img src="{{asset('/uploads/'.$details['photo']) }}" class="img-fluid product-thumbnail"/>
                  </a>
                </div>
                <div class="col-xl-9">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="form-group">
                        <a href="{{url('/producto/'.str_replace(' ', '-', $details['name']).'/'.($id))}}">
                          <p class="title-product">{{ $details['name'] }}</p>
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-3 text-xl-right sump">${{ $details['price'] * $details['quantity'] }}</div>
                  </div>
                  <div class="row">
                    <div class="col-xl-3">
                      <div class="form-group d-flex">
                        <label class="my-1 mr-2" for="quantity">Cantidad</label>
                        <select class="custom-select quantity border-0" name="quantity" data-id="{{ $id }}">
                          @for ($i=1; $i <= 10; $i++)
                            @if ($i==$details['quantity'])
                              <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                              <option value="{{$i}}">{{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-link text-dark remove-from-cart" data-id="{{ $id }}"><u>Eliminar</u></button>
                </div>
              </div>
            </li>
          @endforeach
        @else
          <p>No hay nada en el carrito de compras.</p>
        @endif
      </ul>
    </div>
    <div class="col-xl-4 text-dark" id="money-summary">
      <h2>Resumen</h2>
      <div class="row my-2 px-1">
        <div class="col"><p>Subtotal:</p></div>
        <div class="col sub text-right">${{ $total }}</div>
      </div>
      <div class="row my-2 px-1">
        <?php $costo_envio=0; if($total<500 && $total>0){$costo_envio=100.00;} ?>
        <div class="col"><p>*Gastos de envío:</p></div>
        <div class="col envio text-right">${{$costo_envio}}</div>
      </div>
      <hr>
      <div class="row my-2 px-1 align-items-center">
        <div class="col">Total:</div>
        <div class="col total text-right"><b>${{ $total + $costo_envio }}</b></div>
      </div>
      <hr>
      <div class="row my-1 mx-2">
        <?php $disabled='disabled'; if($total>0){$disabled=''; } ?>
        <a href="{{ url('/') }}" class="btn btn-light btn-block btn-lg"><i class="fa fa-angle-left"></i> Continuar comprando</a>
        @if (Auth::check())
          @if (Auth::user()->hasVerifiedEmail())
            <a href="{{url('/checkout')}}" class="btn btn-success btn-block btn-lg" {{$disabled}}>Realizar Pedido</a>
          @else
            <a href="{{url('/email/verify')}}" class="btn btn-success btn-block btn-lg" {{$disabled}}>Realizar Pedido</a>
          @endif
        @else
          <button type="button" class="btn btn-success btn-block btn-lg" {{$disabled}}  data-toggle="modal" data-target="#login-form">Realizar Pedido</button>
        @endif
      </div>
    </div>
  </div>
</div>
