<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Checkout - Yolkan tienda orgánica en línea</title>
        <meta name="description" content="Completa tu compra en linea.">
        <!--  Open Graph -->
        @yield('opg')
        <meta name="author" content="Veno0M" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{url()->current()}}" />
        <!-- Critical css -->
        <style>
          #loader{height: 100vh;width: 100vw;background: #30c591;position: fixed;right: 0;bottom: 0;}
          #loader > .content{height: 100%;width: 100%;position: relative;}
          #loader > .content > .media-loader{max-width: 100%; position: absolute;margin: auto;top: 0;bottom: 0;right: 0;left: 0;}
          #loader > .content > .title-loader {
            position: absolute;
            bottom: 18%;
            left: 0;
            right: 0;
            text-align: center;
            color: #fff;
          }
        </style>
        <!-- Fonts -->
        <style>
          /* cyrillic-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNa7lqDY.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
          }
          /* cyrillic */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qPK7lqDY.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
          }
          /* greek-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNK7lqDY.woff2) format('woff2');
          unicode-range: U+1F00-1FFF;
          }
          /* greek */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qO67lqDY.woff2) format('woff2');
          unicode-range: U+0370-03FF;
          }
          /* vietnamese */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qN67lqDY.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
          }
          /* latin-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNq7lqDY.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7l.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }/* sans pro */
          @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap');
          /* devanagari */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
          }
          /* latin-ext */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }
        </style>
        <!-- Checkout Style  -->
        <link rel="preload" href="{{asset('/css/ui/tienda/checkout.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('/css/ui/tienda/checkout.css')}}"></noscript>
        @include('ui.layouts.styles-main')
    </head>
    <body>
      <?php $estadosmx = [
          '1' => 'Aguascalientes',
          '2' => 'Baja California',
          '3' => 'Baja California Sur',
          '4' => 'Campeche',
          '5' => 'Chiapas',
          '6' => 'Chihuahua',
          '7' => 'Coahuila de Zaragoza',
          '8' => 'Colima',
          '9' => 'Ciudad de México',
          '10' => 'Durango',
          '11' => 'Guanajuato',
          '12' => 'Guerrero',
          '13' => 'Hidalgo',
          '14' => 'Jalisco',
          '15' => 'Mexico',
          '16' => 'Michoacan de Ocampo',
          '17' => 'Morelos',
          '18' => 'Nayarit',
          '19' => 'Nuevo Leon',
          '20' => 'Oaxaca',
          '21' => 'Puebla',
          '22' => 'Queretaro de Arteaga',
          '23' => 'Quintana Roo',
          '24' => 'San Luis Potosi',
          '25' => 'Sinaloa',
          '26' => 'Sonora',
          '27' => 'Tabasco',
          '28' => 'Tamaulipas',
          '29' => 'Tlaxcala',
          '30' => 'Veracruz-Llave',
          '31' => 'Yucatan',
          '32' => 'Zacatecas',]; ?>
      <!-- loader -->
      <div id="loader">
        <div class="content">
          <img class="media-loader img-fluid" src="{{asset('/img/checkout-loader.gif')}}">
          <h2 class="title-loader">Estamos preparando todo</h2>
        </div>
      </div>
      <!-- Section content -->
      <div class="container-fluid" style="display:none" id="path" data-path="{{url('/')}}">
        <div class="row" id="main-checkout">
            <div class="card border-0 col">
              <div class="card-header bg-success border-0 row">
                <div class="col-lg-8 col-6">
                  <a href="{{url('/')}}" name="home">
                    <img src="{{asset('/img/label-yolkan-light.webp')}}" alt="Logo Yolkan" height="48px">
                  </a>
                </div>
                 <div class="col-lg-4 col-6">
                   <h1 class="fs-title my-1 text-white">Checkout</h1>
                 </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-8 px-0">
                    <ul class="list-group list-group-flush" id="accordion">
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-lg-10 col-8">
                            <h2 class="subtitle">Método de entrega</h2>
                          </div>
                          <div class="col-lg-2 col-4">
                            <button class="btn btn-link" id="change-shipping" type="button" data-toggle="collapse" data-target="#shipping" aria-expanded="false" aria-controls="shipping">
                              Cambiar
                            </button>
                          </div>
                        </div>
                        <div class="show collapse mt-2 row" id="shipping">
                          <div class="container-fluid">
                            @include('ui.parts.checkout.shipping')
                            <div class="row justify-content-end">
                              <button class="btn next btn-success">Continuar</button>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-lg-10 col-8">
                            <h2 class="subtitle">Metodo de pago</h2>
                          </div>
                          <div class="col-lg-2 col-4">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#payment" aria-expanded="false" aria-controls="payment">
                              Cambiar
                            </button>
                          </div>
                        </div>
                        <div class="collapse mt-2" id="payment">
                          <div class="row">
                            <div class="col-12 custom-control custom-radio text-left">
                              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                              <label class="custom-control-label" for="customRadio1">Transferencia / Deposito</label>
                              @include('ui.parts.transferpayment')
                            </div>
                            <div class="col-12 custom-control custom-radio text-left">
                              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" disabled>
                              <label class="custom-control-label" for="customRadio2">PayPal</label>
                              <div class="alert alert-secondary" role="alert">
                                Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-end">
                            <button class="btn next btn-success">Continuar</button>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row"><h2 class="subtitle col">Tu pedido</h2></div>
                        <div id="collapseItems" class="collapse">
                          <div class="row card-body">
                            <ul class="list-group list-group-flush" id="cart-products">
                            @if(session('cart'))
                              @foreach(session('cart') as $id => $details)
                                <li class="list-group-item" data-keygen="{{$details['keygen']}}">
                                  <div class="row">
                                  <div class="col-lg-3 col-5 text-center">
                                    <?php $str = ['/',' ']; $especial = ['%',')','(','.'];
                                    $slug = str_replace($str, '-', $details['name'].'-'.$details['unidad']);
                                    $slug = str_replace($especial, '', $slug); ?>
                                    <img src="{{asset('/uploads/'.$details['photo']) }}" class="img-fluid product-thumbnail"/>
                                  </div>
                                  <div class="col-lg-9 col-7">
                                    <div class="row">
                                      <div class="col-xl-10">
                                        <div class="form-group">
                                          <h2 class="title-product" itemprop="name">
                                            {{ $details['name'].' ,'.$details['unidad'] }}
                                          </h2>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <label class="my-1" for="quantity">Cantidad: {{$details['quantity']}}</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xl-2 text-xl-right item__price">
                                        <span class="price-tag item__price-tag" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                          <meta itemprop="price" content="{{$details['price'] * $details['quantity']}}">
                                          <span class="price-tag-symbol" itemprop="priceCurrency">$</span>
                                          <span class="price-tag-fraction">{{ $details['price'] * $details['quantity'] }}</span>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </li>
                              @endforeach
                            @else
                              <p>No hay nada en el carrito de compras.</p>
                            @endif
                          </ul>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- place your order -->
                  <div class="col-lg-4 px-0">
                    <div class="card border-0 px-lg-4" id="cart-resume">
                        <h2 class="fs-title mx-2">Resumen del pedido</h2>
                        <ul class="list-group list-group-flush">
                          <?php $total = 0; $descuento = 0.2; $label = '20%'; $items=0;
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
                              <?php $total += $details['price'] * $details['quantity']; $items++; ?>
                            @endforeach
                          @endif
                          <li class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col">
                                <div class="row">
                                  <div class="col-8 text-left">Productos ({{$items}}):</div>
                                  <div class="col-4 sub text-right" data-sub="{{ $total }}">${{ $total }}</div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col">
                                <div class="row">
                                  <div class="col-8 text-left">Costo de envío:</div>
                                  <div class="col-4 envio text-right">Pendiente</div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col">
                                <div class="row">
                                  <div class="col-8 text-left">Descuentos <small class="porcentaje" data-desc="{{$descuento}}" data-label="{{$label}}">({{$label}})</small>:</div>
                                  <div class="col-4 money text-right text-danger">${{$total*$descuento}}</div>
                                </div>
                              </div>
                            </div>
                          </li>
                          @if (!Auth::user()->cont>0)
                            <li class="list-group-item cupon">
                              <div class="row align-items-center">
                                <div class="col">
                                  <div class="row">
                                    <div class="col-8 text-left">Cupón de descuento:</div>
                                    <div class="col-4 money text-right text-danger">- $1,500</div>
                                  </div>
                                </div>
                              </div>
                            </li>
                          @endif
                          <hr>
                        </ul>
                        <div class="row mx-2">
                          <div class="col">
                            <h3 class="row text-danger">
                              <div class="col-6 text-left">Total:</div>
                              <div class="col-6 total text-right">${{ number_format($total-($total*$descuento), 2, '.', '') }}</div>
                            </h3>
                          </div>
                        </div>
                        <div class="row mx-2"><button type="button" name="next" class="btn btn-warning btn-lg col submit"> Enviar Pedido </button></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <!-- End content -->
      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" async</script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" defer></script>
      <!-- Modal -->
      @include('ui.parts.checkout.modal-shipping')
      <script src="{{asset('js/ui/checkout/main.js')}}" defer></script>
      @yield('scripts')
    </body>
</html>
