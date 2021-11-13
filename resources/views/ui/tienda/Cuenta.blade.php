@extends('master-ui')
@section('title', 'Mi Cuenta')
@section('description','Tienda en linea Yolkan')
@section('content')
  <style>
    .font-sm {
      font-size: 17px;
      font-weight: 400;
      color: #111;
      line-height: 1.3;
    }
    .box > .icon {
      font-size: 28px;
      width: 86.75px;
      text-align: center;
      display: table-cell;
    }
    .box > .icon > i {vertical-align: bottom;}
    .box {
      border: 1px #ddd solid;
      border-radius: 4px;
      height: 84px;
      display: table;
      margin: 5px;
    }
    @media only screen and (max-width: 600px) {
      .box{width: 100%;}
    }
    .box > .body {
      display: table-cell;
      padding: 4px;
    }
    .box > .body > p {
      color: #555 !important;
      font-size: 13px;
      line-height: 19px;
    }
    .box:hover, .box:active, .box:focus {
      color: #000;
      background: #bfbfbf;
    }
    .sub-heading {
      line-height: 4.2rem;
      margin: 0;
      font-size: 17px;
    }
  </style>
  <div class="container pt-4">
    <div class="row mx-4 text-left">
      <h1 class="custom-font">Mi Cuenta</h1>
      <p class="sub-heading ml-lg-3">Hola <b>{{Auth::user()->name}}</b>@if(Auth::user()->isAsociado()), Empresario #{{$asociado->NoEmpresario}}@endif</p>
    </div>
    @include('ui.parts.account-grid')
  </div>
@endsection
@section('scripts')
@endsection
