<div class="row mx-4 mt-3">
  <a href="{{url('/Cuenta/MisPedidos')}}" class="box">
    <div class="icon bg-light">
      <i class="fas fa-box-open"></i>
    </div>
    <div class="body">
      <h2 class="font-sm">Mis Pedidos</h2>
      <p>Verifica los detalles de tus pedidos.</p>
    </div>
  </a>
  <!-- column -->
  <a href="{{url('/Cuenta/Seguridad')}}" class="box">
    <div class="icon bg-warning">
      <i class="fas fa-user-lock"></i>
    </div>
    <div class="body">
      <h2 class="font-sm">Inicio de sesión y seguridad</h2>
      <p>Edita tu inicio de sesión.</p>
    </div>
  </a>
  @if(Auth::user()->isAsociado())
    <!-- column -->
    <a href="{{url('/Cuenta/Red')}}" class="box">
      <div class="icon bg-light">
        <i class="fas fa-project-diagram"></i>
      </div>
      <div class="body">
        <h2 class="font-sm">Mi red</h2>
        <p>Visualiza tu red de empresarios Yolkan.</p>
      </div>
    </a>
  @endif
</div>
<!-- row -->
<div class="row justify-content-center mx-4 mb-3">
  <a href="#" class="box">
    <div class="icon bg-dark text-white">
      <i class="fas fa-map-marker-alt"></i>
    </div>
    <div class="body">
      <h2 class="font-sm">Mis direcciones</h2>
      <p>Agrega o edita la información de entrega.</p>
    </div>
  </a>
  <!-- column -->
  <a href="https://wa.link/udi1hf" class="box" target="_blank">
    <div class="icon bg-success text-white">
      <i class="fab fa-whatsapp"></i>
    </div>
    <div class="body">
      <h2 class="font-sm">Envíanos un Whatsapp</h2>
      <p>¿Tienes dudas?</p>
    </div>
  </a>
</div>
