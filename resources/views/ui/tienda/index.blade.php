@extends('master-ui')
@section('title', 'Inicio')
@section('description','Tienda en linea Yolkan')
@section('content')
    <style>
      .insight-title--title {
        font-family: 'Great Vibes', cursive;
        line-height: 1.5;
        font-weight: 400;
        font-size: 46px;
        color: #5fbd74;
      }
      .insight-title--subtitle {
        text-transform: uppercase;
        font-size: 40px;
        letter-spacing: .1em;
        color: #392a25;
        font-weight: 900;
        line-height: 1.6;
        margin-top: -10px;
      }
      .insight-special-title--title{
        font-family: 'Great Vibes', cursive;
        line-height: 1.5;
        font-weight: 400;
        font-size: 34px;
        color: #5fbd74;
      }
      .style-default-left {
        margin-left: -120px;
      }
      .ftco-services {
        background: #5fbd74;
        border-radius: 6px;
      }
      .ftco-services .media {
        border-right: solid 1px #7fca8f;
        margin: 8px 0px;
      }
    </style>
    <!-- Section Carousel -->
    @include('ui.parts.main-carousel')
    <!-- Welcome -->
    @include('ui.parts.welcome-shop')
    <!-- Section Services -->
    @include('ui.parts.services-shop')
    <!-- Section Features Products -->
    @include('ui.parts.featured-products')
    <!-- Section Subcribe Newsletter -->
    @include('ui.parts.subcribe-newsletter')
@endsection
@section('scripts')
@endsection
