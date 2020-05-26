@extends('master-ui')
@section('title', 'Inicio')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
    <!-- Section Carousel -->
    @include('ui.parts.main-carousel')
    <!-- Section Services -->
    @include('ui.parts.services-shop')
    <!-- Section Features Products -->
    @include('ui.parts.featured-products')
    <!-- Section Subcribe Newsletter -->
    @include('ui.parts.subcribe-newsletter')
@endsection
@section('scripts')
    <script src="{{mix('/js/all.js')}}"></script>
@endsection
