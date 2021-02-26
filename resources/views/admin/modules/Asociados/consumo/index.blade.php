@extends('master-admin')
@section('title', 'Consumo')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .loading {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      text-align: center;
      background: #ffffff36;
      bottom: 0;
    }
    .loading .title {
      font-size: 30px;
      color: #343a40;
      font-weight: 700;
    }.message {font-size: 15px;}
    .table-select > tbody > tr.active {
      border-left: solid 5px #036665;
      background: #c5f2c3;
    }
    .table-bordered-bottom th, .table-bordered-bottom td {
      border-bottom: 1px solid #dee2e6;
    }
    .table thead th{
      border-bottom: none;
      background: #2f6766;
      color: #fff;
      border-radius: 12px;
      border-right: solid 2px #fff;
    }
  </style>
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          @include('admin.modules.Asociados.consumo.search')
          <!-- tbl asociados -->
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla pedidos -->
            <table class="table table-select table-bordered-bottom" id="tabla-proveedores">
              <thead>
                <tr>
                  <th scope="col">No. Empresario</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Consumo</th>
                  <th scope="col">Red</th>
                  <th scope="col">Regalias</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($balance as $key =>$p)
                  <?php $total=0; ?>
                  @foreach ($red as $key => $n)
                    @if ($n->Parent == $p->id)<?php $total=number_format($total+$n->Puntos,2); ?>@endif
                  @endforeach
                  <tr class="root">
                    <td name="NoEmpresario">{{$p->NoEmpresario}}</td>
                    <td name="Nombre">{{$p->ApellidoPaterno.' '.$p->ApellidoMaterno.' '.$p->Nombre}}</td>
                    <td name="Consumo">${{number_format($p->Puntos*10,2)}}</td>
                    <?php $totalred = ($p->Puntos*10)+($total*10); ?>
                    <td name="Red">${{number_format($totalred,2)}}</td>
                    <td name="regalias">${{number_format($totalred*0.05,2)}}</td>
                    <td>
                      <a type="button" name="editar" class="btn btn-sm btn-light mr-3" data-id="{{$p->id}}" data-key="{{$p->NoEmpresario}}" data-name="{{$p->Nombre}}"><i class="fas fa-eye"></i> Detalles</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex">
              <div class="col-xl-10">{{ $balance->links() }}</div>
              <div class="col-xl-2">
                <nav>
                  <span class="navbar-text">Registros: {{$balance->total()}}</span>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
@endsection
