@extends('master-ui')
@section('title', 'Inicio')
@section('description','Tienda en linea Yolkan')
@section('opg')
  <meta property="og:title" content="Tienda organica Yolkan" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{url('/')}}" />
  <meta property="og:image" content="{{url('/img/label-yolkan.webp')}}" />
@endsection
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
      .cover-grid {
        width: 100%;
        height: 350px !important;
      }
    </style>
    <!-- Section Carousel -->
    @include('ui.parts.main-carousel')
    <!-- Grid -->
    @include('ui.parts.grid')
    <!-- Section Services -->
    @include('ui.parts.services-shop')
    <!-- Section Features Products -->
    @include('ui.parts.featured-products')
@endsection
@section('scripts')
@endsection
