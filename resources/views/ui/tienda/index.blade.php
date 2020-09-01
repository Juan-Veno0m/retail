@extends('master-ui')
@section('title', 'Productos naturales')
@section('description','Tienda en línea Yolkan, de productos orgánicos y artesanales, 100 % naturales de pequeños productores locales.')
@section('opg')
  <meta property="og:title" content="Tienda en línea yolkan de productos orgánicos y artesanales." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{url('/')}}" />
  <meta property="og:image" content="{{url('/img/label-yolkan.webp')}}" />
@endsection
@section('content')
    <link href="{{asset('/css/ui/index/main.css?x=1')}}" rel="stylesheet">
    <!-- Section Carousel -->
    @include('ui.parts.main-carousel')
    <!-- Grid -->
    @include('ui.parts.grid')
    <!-- Section Services -->
    @include('ui.parts.services-shop')
    <!-- Section categories -->
    @include('ui.parts.catalogo')
@endsection
@section('scripts')
@endsection
