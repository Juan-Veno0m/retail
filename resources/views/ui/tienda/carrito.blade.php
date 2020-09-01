@extends('master-ui')
@section('title', 'Carrito de Compras de Productos Orgánicos')
@section('description','Tienda en linea Yolkan')
@section('content')
    <style>
      .product-thumbnail {
        object-fit: cover;
        height: 128px;
        border-radius: 8px;
      }
      .title-product {
        text-transform: capitalize;
        font-size: 1.2em;
        color: #000;
      }
      #money-summary p, .col {
        font-family: 'Source Sans Pro';
        font-weight: 500;
      }
    </style>
    <!-- Section items -->
    @include('ui.parts.cart-main')
@endsection
@section('scripts')
@endsection
