@extends('master-ui')
@section('title', 'Cambios y devoluciones')
@section('description','Políticas de compra a considerar en nuestra plataforma Yolkan. Entre ellas, los pasos
para realizar un pedido, y proceso de envío.') <!-- Meta Description -->
@section('opg')
  <!-- Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@Yolkan6" />
  <meta name="twitter:creator" content="@Yolkan6" />
  <!--  Open Graph -->
  <meta property="og:title" content="Politicas de Compra" />
  <meta property="og:description" content="Políticas de compra a considerar en nuestra plataforma Yolkan. Entre ellas, los pasos
  para realizar un pedido, y proceso de envío."/>
  <meta property="og:type" content="og:website" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:image" content="{{asset('/img/gallery/policy-for-you.svg')}}" />
  <meta property="og:site_name" content="Yolkan" />
  <meta name="author" content="Veno0M" />
  <meta name="robots" content="index, follow" />
@endsection
@section('content')
  <!-- Section Content Header -->
  <div class="container-fluid py-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <p class="text-center"><img src="{{asset('img/gallery/return-purchase.png')}}" width="250" class="img-fluid" alt="Política de Privacidad"></p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1>Cambios y devoluciones</h1>
        <p>En caso de no estar satisfecho con la adquisición de alguno de nuestros productos, tendrás el derecho de realizar
          la devolución del mismo, para dicho trámite solo tendrás que hacernos llegar el producto a la dirección que te
           proporcionaremos, tomando en cuenta que el producto debe de estar cerrado y en perfectas condiciones, cabe
           mencionar que la devolución NO aplicara en productos de limpieza e higiene, es importante que si realizaste
           tu compra por medio de depósito vía OXXO o DEPOSITO BANCARIO será importante que nos proporciones tu cuenta
           de CLABE INTERBANCARIA de la cuenta a la que se hará el rembolso de dicha devolución.</p>
        <p>El pazo máximo para que se realice tu devolución será de 30 días.</p>
        <p>Los gastos de envió de una devolución correrán por parte del comprador (EMPRESARIO YOLKAN);
          YOLKAN solo absorberá los gastos de envió al recoger y entregar nuevo producto siempre y cuando haya sido una
           falla de marca desde inicio.</p>
        <p>Considera conservar para tu devolución Factura, Empaque Original, Etiquetas y muy importante el producto en
          buen estado, ya que, de estar roto, o dañado, o con señas de uso la Devolución NO procederá.</p>
        <p>En caso de solicitar el rembolso del producto, en cuanto YOLKAN tenga el producto en sus manos se podrán en
          contacto contigo para compartirte el proceso del mismo. </p>
        <p>Importante que conozcas es que NO habrá cambio o devolución en compras realizadas para países INTERNACIONALES,
          dichas políticas solo aplican para compras dentro de la REPUBLICA MEXICANA</p>
        <p>Si haz realizado todo tu proceso y aun no haz recibo el cambio del producto o el rembolso puedes ponerte en
          contacto con nosotros atreves de contacto@yolkan.net</p>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
