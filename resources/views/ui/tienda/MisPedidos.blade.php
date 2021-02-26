@extends('master-ui')
@section('title', 'Mis Pedidos')
@section('description','Tienda en linea Yolkan')
@section('content')
  <div class="container-fluid py-5">
    <div class="row text-center mt-2">
      <h1 class="col custom-font">Mis Pedidos</h1>
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-lg-11">
          @include('ui.parts.tbl-pedidos')
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
