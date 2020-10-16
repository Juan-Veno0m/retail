@extends('master-ui')
@section('title', 'Acerca de Yolkan')
@section('description','Nuestra fuerza se basa en los productos orgánicos,
transformando vidas de una manera más natural, con apoyo a los pequeños productores mexicanos.') <!-- Meta Description -->
@section('opg')
  <!-- Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@Yolkan6" />
  <meta name="twitter:creator" content="@Yolkan6" />
  <!--  Open Graph -->
  <meta property="og:title" content="Acerca de Yolkan" />
  <meta property="og:description" content="Nuestra fuerza se basa en los productos orgánicos,
  transformando vidas de una manera más natural, con apoyo a los pequeños productores mexicanos."/>
  <meta property="og:type" content="og:website" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:image" content="{{asset('/img/gallery/UE-ECO-Agriculture.png')}}" />
  <meta property="og:site_name" content="Yolkan" />
  <meta name="author" content="Veno0M" />
  <meta name="robots" content="index, follow" />
  <style>
    p {
      font-size: 16px;
      line-height: 1.8em;
    }
    .parallax{
      background-image: url('{{asset('img/gallery/UE-ECO-Agriculture.png')}}');
      height: 500px;
      width: 100vw;
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
    .parallax h1 {
      position: absolute;
      bottom: 48%;
      right: 35%;
      background: #ffffffd6;
      color: #41671a;
      border-radius: 8px;
      padding: 5px 25px;
      font-size: 44px;
      font-weight: 600;
      line-height: 1.4em;
    }
    @media only screen and (max-width: 600px) {
      .parallax h1{
        left: 14px;
        right: 14px;
        line-height: 1.4em;
      }
    }
  </style>
@endsection
@section('content')
  <div class="container-fluid pb-4">
    <div class="row justify-content-center">
      <div class="parallax"><h1>Acerca de Yolkan</h1></div>
    </div>
    <!-- content -->
    <div class="row justify-content-center pt-5">
      <div class="col-lg-8">
        <p>Nuestra fuerza se basa en los productos orgánicos, transformando vidas de una manera más natural,
          con apoyo a los pequeños productores mexicanos y con hermandad con productores de Latinoamérica que
          comparten el mismo sentir y responsabilidad con el medio ambiente, fortaleciendo lazos que beneficien
          a la sociedad.</p>
        <h2>Nuestra empresa</h2>
        <p>Es creada a partir de la necesidad de fortalecer al campo y a las producciones que puedan
          desarrollarse en base a procesos orgánicos, que permitan el consumo de manera natural.
          (El saber que dichos productos, no contienen fertilizantes artificiales y en general químicos que dañen el
          cuerpo humano. </p>
        <p>Con este mismo compromiso es que YOLKAN se funda en México en agosto de 2020 para dar a conocer sus productos
          en beneficio de los productos orgánicos y como parte humana a los campesinos pequeños que trabajan la tierra
          día a día, a los que con apoyo del conocimiento tecnológico, realizan procesamientos adherentes a la tierra.</p>
        <h2>Yolkan</h2>
        <p>En parte humana pone a disposición los productos para consumo personal, beneficiando a las personas que
          aprovechan estos beneficios, esto en un primer eslabón del esquema de producción</p>
        <p>En un segundo plano se realiza la comercialización por diferentes medios, los cuales son para un consumo personal,
          pero también permite generar ganancias con la invitación a más personas de consumir nuestros productos,
          para que se vean beneficiados con el esquema de ganancias personales y bienestar. Lo cual permite llegar a más
          personas y generar una cadena de bienestar social, con lo que productores del campo ven ingresos por la venta
          y distribución de sus mercancías y a su vez, volvemos a la producción del campo.</p>
        <p>Nuestra hermandad con los productores del campo es muy estrecha, un sector que ha sido duramente castigado, pero que es muy noble y sale avante cada vez que es
          requerido. Si vemos la situación del campo mexicano y en general de Latinoamérica, nos damos cuenta de cuan valiosa
          es la capacidad para subsistir aún en estados de necesidad y austeridad. Tienen tierras fértiles y productivas,
          pero en muchas ocasiones por la falta de recursos no pueden ser fácilmente comercializadas y llegan a perderse o
          malbaratarse, dejando en estado de indefensión ante los abusos de depredadores que obtienen ganancias a costa de
          ellos.</p>
        <p class="text-center"><img src="{{asset('img/gallery/work-team.jpg')}}" class="img-fluid lazyload" alt="trabajo en equipo"></p>
        <p>Por todo ello, es que YOLKAN  se preocupa por las necesidades primarias que la sociedad requiere, poniendo su
          granito de arena para poder tener un trato justo y equitativo con los productores del campo, con su distribución
          y alcance que pueden tener, beneficiando a miles de familias. Desarrollando de manera ética su actividad comercial.</p>
        <h2>Nuestros valores</h2>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <h3>Honestidad:</h3>
            <p>Con nuestros productores, proveedores, socios y equipo de trabajo que día a día se esfuerzan por hacer del
              campo un mejor medio de subsistencia, así como con las personas a quienes les llegan los productos finales.</p>
          </li>
          <li class="list-group-item">
            <h3>Respeto</h3>
            <p>Hacía la madre tierra, hacía los campesinos que la producen, nuestros proveedores y todo el sector productivo que nos rodea.</p>
          </li>
          <li class="list-group-item">
            <h3>Confianza</h3>
            <p>Generada a través de las relaciones comerciales, convenios y cumplimiento de los mismos que les otorga certeza a las personas
              con las que tenemos relación directa.</p>
          </li>
          <li class="list-group-item">
            <h3>Humildad</h3>
            <p>Con el que tratamos nuestros productos, de un trato equitativo con nuestros campesinos, sabiendo que no hay jerarquías,
              sino de un trato de igual a igual con todos aquellos con quienes comercializamos. </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
