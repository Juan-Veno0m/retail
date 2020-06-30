<?php setlocale(LC_TIME, "spanish");
$fecha = str_replace("/", "-", $orden->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha));?>
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
            <span>Subtotal</span>
            <span>${{$pago->Total-$pago->CostoEnvio}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
            <span>Envio</span>
            <span>${{$pago->CostoEnvio}}</span>
          </li>
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
        @foreach ($items as $key => $v) <?php $total=0; $label='Unidad'; if($v->quantity>1){$label='Unidades';} ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{$v->ProductosNombre}} x {{$v->quantity.' '.$label}}</span>
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
