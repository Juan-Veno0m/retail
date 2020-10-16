@extends('master-ui')
@section('title', 'Contrato Yolkan')
@section('description','Políticas de compra a considerar en nuestra plataforma Yolkan. Entre ellas, los pasos
para realizar un pedido, y proceso de envío.') <!-- Meta Description -->
@section('opg')
  <!-- Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@Yolkan6" />
  <meta name="twitter:creator" content="@Yolkan6" />
  <!--  Open Graph -->
  <meta property="og:title" content="Contrato Yolkan" />
  <meta property="og:description" content="Políticas de compra a considerar en nuestra plataforma Yolkan. Entre ellas, los pasos
  para realizar un pedido, y proceso de envío."/>
  <meta property="og:type" content="og:website" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:image" content="{{asset('/img/gallery/contract-outline.png')}}" />
  <meta property="og:site_name" content="Yolkan" />
  <meta name="author" content="Veno0M" />
  <meta name="robots" content="index, follow" />
  <style>
    p {
      font-size: 16px;
      line-height: 1.8em;
    }
  </style>
@endsection
@section('content')
  <!-- Section Content Header -->
  <div class="container-fluid py-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <p class="text-center"><img src="{{asset('img/gallery/contract-outline.png')}}" width="250" class="img-fluid" alt="Política de Privacidad"></p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="text-center mb-4">Contrato Yolkan</h1>
        <div style="height:420px" class="mb-5">
          <object data="{{asset('/upfiles/contrato.pdf')}}" type="application/pdf" width="100%" height="100%">
            <p>Alternative text - include a link <a href="myfile.pdf">to the PDF!</a></p>
          </object>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
