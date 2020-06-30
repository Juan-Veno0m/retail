@extends('master-ui')
@section('title', 'Detalles del pedido No. '.$NOrden)
@section('description','Tienda en linea Yolkan')
@section('content')
  <style>
    .orden-item-title{font-size: 24px;color:#444;}
    .media-icon {
      background: #444;
      height: 34px;
      width: 34px;
      text-align: center;
      display: inline;
      border-radius: 20px;
      color: #fff;
      margin-right: 10px;
    }
    .media-icon > i {
      vertical-align: sub;
    }
  </style>
  <div class="container pt-4">
    @include('ui.parts.items-pedido')
  </div>
@endsection
@section('scripts')
@endsection
