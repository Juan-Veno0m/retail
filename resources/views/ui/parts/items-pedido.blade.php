<?php setlocale(LC_TIME, "spanish");
$fecha = str_replace("/", "-", $orden->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha));?>
<div class="container py-4">
  <div class="row">
    <h2 class="orden-item-title">Pedido #{{$NOrden}} - {{iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',strtotime($newDate) ))}}</h2>
  </div>
  <div class="row justify-content-between align-items-start">
    <div class="col-xl-6 px-0 mb-2">
      <div class="card bg-light px-lg-0 mb-2"> <!-- element column -->
        <div class="card-header">Resumen del pedido</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
              <span>Costo de los productos</span>
              <span>${{$pago->TotalProductos}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
              <span>Costo de envío</span>
              <span>${{$pago->CostoEnvio}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
              <span>Descuento <small>(20%)</small></span>
              <span class="text-danger">- ${{$pago->Descuento}}</span>
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
      <div class="card bg-transparent border-0 px-lg-0"> <!-- element column -->
        <div class="card-header border">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex bg-transparent">
              <span class="media-icon"><i class="fas fa-money-bill"></i></span>
              <span class="mt-1">Método de Pago: {{$pago->Tipo}}</span>
            </li>
          </ul>
        </div>
        @if ($pago->MetodoID==3) <!-- Deposito -->
          <div class="card-body px-1">
            @include('ui.parts.transferpayment')
          </div>
        @endif
      </div>
    </div>
    <div class="col-xl-5 px-lg-0" > <!-- colum right -->
      <div class="row mb-2"> <!-- element -->
        <div class="accordion col px-0" id="accordionExample">
          <div class="card border-0">
            <div class="card-header border bg-light" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-dark text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Detalles de la orden
                  <small class="text-muted">Clic aquí.</small> <span class="float-right">+</span>
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  @foreach ($items as $key => $v) <?php $total=0; $label='Unidad'; if($v->quantity>1){$label='Unidades';} ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span><a href="{{url('/producto/'.str_replace(' ', '-', $v->ProductosNombre).'/'.($v->ProductosID+3301))}}">{{$v->ProductosNombre}}</a> x {{$v->quantity.' '.$label}}</span>
                      <span class="badge badge-dark badge-pill">${{($v->quantity * $v->Precio_lista)}}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row"> <!-- element -->
        <div class="col px-0">
          <div class="card bg-light">
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex  bg-transparent">
                  <span class="media-icon"><i class="fas fa-map-marker-alt"></i></span>
                  <span class="mt-1">{{$orden_envio->Calle.', Nº exterior: '.$orden_envio->Exterior.', '.$orden_envio->Colonia.','.
                  $orden_envio->Municipio.' ('.$orden_envio->Codigopostal.')'.', '.$orden_envio->estado}}<br>
                  Recibe {{$orden_envio->NombreCompleto.' '.$orden_envio->Telefono}}
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
