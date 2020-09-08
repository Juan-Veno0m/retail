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
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-producto" data-toggle="modal" data-target="#form-producto">Agregar</a>
  @endsection
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
                      <span>Subtotal</span>
                      <span>${{$pago->TotalProductos}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      <span>Envio</span>
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
    <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/dropzone.min.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.7.1/dist/basic.min.css">
@endsection
