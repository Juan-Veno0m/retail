@extends('master-admin')
@section('title', 'Pedidos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-producto" data-toggle="modal" data-target="#form-producto">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla pedidos -->
            <table class="table" id="tabla-productos">
              <thead>
                <tr>
                  <th scope="col">No. Pedido</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Metodo de Pago</th>
                  <th scope="col">Total</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pedidos as $key =>$p)
                  <tr data-id="{{$p->OrdenID}}">
                    <td name="NoPedido">{{$p->OrdenID+9249582}}</td>
                    <td name="cliente">{{$p->name}}</td>
                    <td name="status"><span class="{{$p->attribute}}">{{$p->status}}</span></td>
                    <td name="mpago">{{$p->MetodoPago}}</td>
                    <td name="total">${{$p->Total}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a type="button" href="{{url('ordenes/pedidos/'.($p->OrdenID+9249582))}}" name="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-info"></i> Detalles</a>
                        <button type="button" name="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-layer-group"></i> Estatus</button>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex">
              <div class="col-xl-10">{{ $pedidos->links() }}</div>
              <div class="col-xl-2">
                <nav>
                  <span class="navbar-text">Registros: {{$pedidos->total()}}</span>
                </nav>
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
