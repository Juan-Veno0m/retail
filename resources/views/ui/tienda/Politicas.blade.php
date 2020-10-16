@extends('master-ui')
@section('title', 'Politicas de Compra')
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
      <div class="col-lg-6"><img src="{{asset('img/gallery/policy-for-you.svg')}}" class="img-fluid" alt="Política de Privacidad"></div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1>Políticas de Compra</h1>
        <p>Para realizar las compras en nuestra página solo deberás seguir estos sencillos pasos:</p>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Ingresar a nuestra página con el usuario y contraseña ya asignadas. </li>
          <li class="list-group-item">Elegir el o los productos de tu preferencia y agregarlos a tu carrito.</li>
          <li class="list-group-item">Una vez seleccionados todos los productos de tu interés, deberás seleccionar
            nuevamente el carrito ahí aparecerán todos los productos seleccionados.</li>
          <li class="list-group-item">Ahí finalizaras tu compra y seleccionaras tu forma de pago.</li>
        </ul>
        <h2>Horarios de envío</h2>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Si tu compra se realizó entre las 9:00 a.m. y 2:00 p.m. será entregado el mismo día en un horario aproximado de las 4:00 y las 7:00 p.m.</li>
          <li class="list-group-item">Si la compra se realiza después de las 2:00 p.m. será entregado al día siguiente hábil en un horario aproximado de 9:00 a.m. a 2:00 p.m. y de 4:00 a 7:00 p.m.</li>
          <li class="list-group-item">En caso de que te encuentres fuera de la Ciudad de Puebla tu compra puede tardar en llegarte de 3 a 4 días hábiles; más si contrataras el servicio exprés la entrega puede ser en 1 a 3 días hábiles, cabe mencionar que el servicio de paquetería es externo por lo que es importante mencionarte que estamos sujetos a sus tiempos de entrega y de la saturación de líneas de entrega que tengan, por lo que YOLKAN se deslinda de los retrasos que hubiera y  de los tiempos que no se respetaran de los ya mencionados.</li>
        </ul>
        <hr>
        <h2>Envío de pedido</h2>
        <p>Todo envió lleva un proceso de preparación para su salida hasta de 24 horas; y en compras realizadas
          con alguna oferta o promoción puede tardar hasta 72 horas hábiles.</p>
        <p>El costo por envió es adicional y puede variar de acuerdo a las distancias de entrega ya sea que se
          encuentre dentro de Puebla o fuera.</p>
        <h2>Responsabilidad</h2>
        <p>Sera responsabilidad de YOLKAN de que el o los productos adquiridos lleguen en las condiciones y
          presentación adecuadas para tu entera satisfacción, de no ser así daremos seguimiento a tus observaciones,
          así mismo de no estar satisfecha con la entrega en cuestión de tiempos por parte de la mensajería contratada
          trabajaremos en conjunto para que tu experiencia de compra sea la mejor.</p>
        <p>Sobre nuestros productos te compartimos que YOLKAN no es el productor de ellos y como sabes los productos
          que te ofrecemos son Orgánicos y Artesanales por lo que intentamos hacer la mejor selección de cada uno de
          ellos verificando su alta calidad ofrecida; para asegura la calidad de los productos que adquieres
          YOLKAN se hace responsable del producto que pudieras recibir defectuoso, siempre y cuando nos notifiques
          dentro de los 3 días hábiles posteriores a la entrega de tus productos, siempre y cuando estos no se hayan abierto;
          YOLKAN no se hará responsable si algún producto llegara a provocar alguna reacción alérgica en ti ya que
          para el uso de los mismo debes de consultar su composición y reacción antes de usarlos.</p>
        <h2>¡Cuídate, ayuda y gana!</h2>
        <p>Como beneficio, al adquirir nuestros productos formaras parte de una red de consumidores
          responsables, al ayudar al cuidado del planeta, desacelerando la cantidad de contaminación que se produce al crear nuevos productos.</p>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
