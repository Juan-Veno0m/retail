@if (count($pedidos))
  <?php setlocale(LC_TIME, "spanish"); ?>
  @foreach ($pedidos as $key => $v)
    <?php $fecha = str_replace("/", "-", $v->Fecha_requerida);	$newDate = date("d-m-Y", strtotime($fecha));?>
    <div class="card py-1 px-2 mb-2">
      <div class="row">
        <div class="col-xl-6 d-inline">
          <span>No. Pedido: {{$v->OrdenID+9249582}}</span>
          <span class="badge badge-light badge-pill">{{iconv('ISO-8859-1', 'UTF-8', strftime('%A %d de %B de %Y',strtotime($newDate) ))}}</span>
        </div>
        <div class="col-xl-2"><span>$ {{$v->Total}}</span></div>
        <div class="col-xl-2"><span class="{{$v->attribute}}">{{$v->status}}</span></div>
        <div class="col-xl-2">
          <a href="{{url('/Cuenta/MisPedidos/'.($v->OrdenID+9249582))}}" title="ver detalles" class="btn btn-secondary btn-block btn-sm"><i class="fas fa-eye"></i></a>
        </div>
      </div>
    </div>
  @endforeach
  {{$pedidos->links()}}
@else
  <div class="card">
    <div class="card-header bg-white">Aún no haz realizado pedidos</div>
  </div>
@endif
