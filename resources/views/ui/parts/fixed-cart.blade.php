<div class="fixed-cart">
  <h3 class="text-center">Carrito de compra</h3>
  <ul class="list-group list-group-flush" id="cart-products">
    <?php $total = 0 ?>
    @if(session('cart'))
      @foreach(session('cart') as $id => $details)
        <?php $total += $details['price'] * $details['quantity'] ?>
        <li class="list-group-item" data-keygen="{{$details['keygen']}}" data-id="{{$id}}">
          <div class="row">
            <div class="col-xl-3">
              <?php $str = ['/',' ']; $especial = ['%',')','(','.'];
              $slug = str_replace($str, '-', $details['name'].'-'.$details['unidad']);
              $slug = str_replace($especial, '', $slug); ?>
              <a href="{{url('/producto/'.$slug.'/'.$id)}}">
                <img src="{{asset('/uploads/'.$details['photo']) }}" class="img-fluid product-thumbnail"/>
              </a>
            </div>
            <div class="col-xl-9">
            <div class="row">
              <div class="col-xl-9">
                <div class="form-group">
                  <a href="{{url('/producto/'.$slug.'/'.$id)}}">
                    <p class="title-product">{{ $details['name'].' ,'.$details['unidad'] }}</p>
                  </a>
                </div>
              </div>
              <div class="col-xl-3 text-xl-right sump">${{ $details['price'] * $details['quantity'] }}</div>
            </div>
          </div>
          </div>
          <!-- actions -->
          <div class="row">
            <div class="col">
              <div class="form-group d-flex">
                <label class="my-1 mr-2" for="quantity">Cantidad</label>
                <select class="custom-select quantity border-0" name="quantity" data-id="{{ $id }}">
                  @for ($i=1; $i <= 40; $i++)
                    @if ($i==$details['quantity'])
                      <option value="{{$i}}" selected>{{$i}}</option>
                    @else
                      <option value="{{$i}}">{{$i}}</option>
                    @endif
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-lg-4">
              <button class="btn btn-link text-dark remove-from-cart" data-id="{{ $id }}"><u>Eliminar</u></button>
            </div>
          </div>
        </li>
      @endforeach
    @else
      <p class="no-items mx-2">No hay nada en el carrito de compras.</p>
    @endif
  </ul>
  <div class="col text-dark bg-light" id="money-summary">
    <div class="row my-2 px-1">
      <div class="col"><p>Subtotal:</p></div>
      <div class="col sub text-right">${{ $total }}</div>
    </div>
    <div class="row my-2 px-1">
      <?php $costo_envio=0; if($total<500 && $total>0){$costo_envio=100.00;} ?>
      <div class="col-lg-8"><p>*Gastos de envío:</p></div>
      <div class="col envio text-right">${{$costo_envio}}</div>
    </div>
    <div class="row my-2 px-1 align-items-center">
      <div class="col">Total:</div>
      <div class="col total text-right"><b>${{ $total + $costo_envio }}</b></div>
    </div>
    <div class="row my-1 mx-2">
      <?php $disabled='disabled'; if($total>0){$disabled=''; } ?>
      <a href="{{ url('/tienda') }}" class="btn btn-light btn-block btn-lg"><i class="fa fa-angle-left"></i> Continuar comprando</a>
      @if (Auth::check())
        @if (Auth::user()->hasVerifiedEmail())
          <a href="{{url('/carrito')}}" class="btn btn-warning btn-block btn-lg" {{$disabled}}>Revisar Pedido</a>
        @else
          <a href="{{url('/email/verify')}}" class="btn btn-success btn-block btn-lg" {{$disabled}}>Revisar Pedido</a>
        @endif
      @else
        <a href="{{url('/login')}}" class="btn btn-warning btn-block btn-lg" {{$disabled}}>Revisar Pedido</a>
      @endif
    </div>
  </div>
</div>
