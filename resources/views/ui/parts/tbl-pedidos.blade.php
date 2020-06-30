<?php setlocale(LC_TIME, "spanish"); ?>
@foreach ($pedidos as $key => $v)
  <?php $fecha = str_replace("/", "-", $v->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha));?>
  <div class="card">
    <div class="card-header bg-white">Estatus: {{$v->status}}</div>
    <div class="row align-items-start">
      <div class="col-xl-5">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>No. Pedido: {{$v->OrdenID+9249582}}</span>
            <span class="badge badge-success badge-pill">{{iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',strtotime($newDate) ))}}</span>
          </li>
          <li class="list-group-item">Costo de envio: ${{$v->CostoEnvio}}</li>
          <li class="list-group-item">Método de Pago: {{$v->MetodoPago}}</li>
          <li class="list-group-item">Total: ${{$v->Total}}</li>
        </ul>
      </div>
      <div class="col-xl-5">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Recibe: {{$v->NombreCompleto}}</li>
          <li class="list-group-item">Delegación /Municipio: {{$v->Municipio}}</li>
          <li class="list-group-item">Colonia: {{$v->Colonia}} <span class="badge badge-secondary">CP {{$v->Codigopostal}}</span></li>
          <li class="list-group-item">Calle: {{$v->Calle}} No. {{$v->Exterior}}</li>
        </ul>
      </div>
      <div class="col-xl-2 px-4 py-3">
        <a href="{{url('/MisPedidos/'.($v->OrdenID+9249582))}}" class="btn btn-dark btn-block">ver detalles</a>
      </div>
    </div>
  </div>
@endforeach
