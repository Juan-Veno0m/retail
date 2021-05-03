@extends('master-admin')
@section('title', 'Pedidos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .orden-item-title{font-size: 24px;color:#444;}
    .media-icon {
      background: #444;
      height: 34px;
      width: 34px;
      text-align: center;
      display: inline-table;
      border-radius: 20px;
      color: #fff;
      margin-right: 10px;
      font-size: 16px;
    }
    .media-icon > i {
      vertical-align: sub;
    }
  </style>
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <?php setlocale(LC_TIME, "spanish");
          $fecha = str_replace("/", "-", $orden->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha)); $total=0;?>
          <div class="container py-4">
            <div class="row">
              <h2 class="orden-item-title">Pedido #{{$NOrden}} - {{iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',strtotime($newDate) ))}}</h2>
            </div>
            <div class="row justify-content-between">
              <div class="card bg-light col-xl-6 px-0">
                <div class="card-header">Resumen del pedido</div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Total productos</span>
                      <span>${{$pago->TotalProductos}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Descuento <small>({{$pago->Porcentaje}}%)</small></span>
                      <span class="text-danger">- ${{$pago->Descuento}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Subtotal <small></small></span>
                      <span class="text-dark"> ${{$pago->TotalProductos-$pago->Descuento}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Envio</span>
                      @if ($orden->TipoEnvio == 1 )<span>${{$pago->CostoEnvio}}</span>
                      @else <span>$0.00</span>@endif
                    </li>
                    @if ($orden->CuponID)
                      <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        <span>Cupón de descuento</span>
                        <span class="text-danger">- $1,500</span>
                      </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Total</span>
                      <span>${{$pago->Total}}</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card border-right-0 border-left-0 border-top-0 col-xl-5 px-0">
                <div class="card-header bg-transparent">Orden</div>
                <ul class="list-group list-group-flush">
                  @foreach ($items as $key => $v) <?php $total +=$v->quantity * $v->Precio_lista; $label='Unidad'; if($v->quantity>1){$label='Unidades';} ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><a href="{{url('/producto/'.str_replace(' ', '-', $v->ProductosNombre).'/'.($v->ProductosID+3301))}}">{{$v->ProductosNombre}}</a> x {{$v->quantity.' '.$label}}</span>
                      <span class="badge badge-dark badge-pill">${{($v->quantity * $v->Precio_lista)}}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="row mt-4">
              <div class="card bg-light col-xl-6 px-0">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent">
                      <span class="media-icon"><i class="fas fa-money-bill"></i></span>
                      <span class="mt-1">Método de Pago {{$pago->Tipo}}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="card bg-light col-xl-6 px-0">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @if ($orden->TipoEnvio == 1 )
                      <li class="list-group-item d-flex  bg-transparent">
                        <span class="media-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="mt-1">{{$TipoEnvio->Calle.', Nº exterior: '.$TipoEnvio->Exterior.', '.$TipoEnvio->Colonia.','.
                        $TipoEnvio->Municipio.' ('.$TipoEnvio->Codigopostal.')'.', '.$TipoEnvio->estado}}<br>
                        Recibe {{$TipoEnvio->NombreCompleto.' '.$TipoEnvio->Telefono}}
                        </span>
                      </li>
                    @else
                      <li class="list-group-item d-flex  bg-transparent">
                        <span class="media-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="mt-1">Pickup</span>
                      </li>
                      <li class="list-group-item d-flex  bg-transparent">
                        <label class="form-check-label" for="pickup">
                          <span class="d-block" name="Fullname">Yolkan Puebla</span>
                          <span class="d-block" name="address">Privada 37 Sur No.2115, Belisario Dominguez</span>
                          <span class="d-block" name="city">CP: 72180 ,Puebla, Puebla.</span>
                        </label>
                      </li>
                      <li class="list-group-item d-flex  bg-transparent"><span class="mt-1">Fecha: {{date("d/m/Y", strtotime($TipoEnvio->Fecha))}},
                        Hora: {{$TipoEnvio->Hora}} Hrs</span></li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/dropzone.min.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/basic.min.css">
@endsection
