@if (count($pedidos))
  <?php setlocale(LC_TIME, "spanish"); ?>
  <ul class="list-group list-group-flush">
    @foreach ($pedidos as $key => $v)
      <?php $fecha = str_replace("/", "-", $v->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha));?>
      <li class="list-group-item my-3">
        <div class="row">
          <div class="col-xl-2"><span><i class="fas fa-thumbtack"></i> Pedido #{{$v->OrdenID+9249582}}</span></div>
          <div class="col-xl-4">
            <i class="far fa-calendar-alt"></i>
            <span> {{iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',strtotime($newDate) ))}}</span>
          </div>
          <div class="col-xl-2"><span><i class="fas fa-dollar-sign"></i> {{number_format($v->Total,2)}}</span></div>
          <div class="col-xl-2"><span class="btn btn-sm btn-block {{$v->attribute}}">{{$v->status}}</span></div>
          <div class="col-xl-2">
            <a href="{{url('/Cuenta/MisPedidos/'.($v->OrdenID+9249582))}}" title="ver detalles" class="btn btn-link btn-block btn-sm">Ver detalle <i class="fas fa-info-circle"></i></a>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
  {{$pedidos->links()}}
@else
  <div class="card">
    <div class="card-header bg-white">Aún no haz realizado pedidos</div>
  </div>
@endif
