@extends('master-ui')
@section('title', 'Contacto')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
    <!-- Section Content Header -->
    @include('ui.parts.hero-wrap')
    <!-- Section Form contact -->
    @include('ui.parts.form-full')
    <!-- Section Subcribe Newsletter -->
    @include('ui.parts.subcribe-newsletter')
@endsection
@section('scripts')
    <script src="{{mix('/js/all.js')}}"></script>
@endsection
