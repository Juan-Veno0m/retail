<nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light sleep border-nav-bottom" id="ftco-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('/img/yolkan-logo-organic.png')}}" height="56px" alt="Logo Yolkan"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"><a href="{{url('/')}}" class="nav-link">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tienda</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="shop.html">Tienda</a>
                    </div>
                </li>
                <li class="nav-item"><a href="about.html" class="nav-link">Acerca de</a></li>
                <li class="nav-item {{ (request()->is('contacto')) ? 'active' : '' }}"><a href="{{url('contacto')}}" class="nav-link">Contacto</a></li>
                @if (Auth::check())
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="dropdowperfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> {{Auth::user()->name}}</a>
                      <div class="dropdown-menu" aria-labelledby="dropdowperfil">
                          <a class="dropdown-item" href="{{url('/perfil')}}">Perfil</a>
                          <a class="dropdown-item" href="{{url('/MisPedidos')}}">Mis Pedidos</a>
                          <form id="logout-form" action="{{ url('logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                          </form>
                      </div>
                  </li>
                @else
                  <li class="nav-item"><a href="{{url('/login')}}" class="nav-link"><i class="fas fa-user"></i> Entrar </a></li>
                @endif
                <li class="nav-item cta cta-colored">
                  <a href="{{url('/carrito')}}" class="nav-link">
                    <span class="fas fa-shopping-cart"></span>
                    <span class="cart-items badge badge-success">0</span>
                  </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- notification -->
    <div class="notification-cart">
      <div class="card">
        <div class="card-body">
          <div class="col px-0 pb-2">
            <span class="badge badge-success"><i class="fas fa-check"></i></span>
            <span class="message">Agregado correctamente a la bolsa</span>
          </div>
          <div class="media">
            <img src="" class="img mr-3" width="150px" alt="...">
            <div class="media-body text-dark">
              <p class="title-producto">Media heading</p>
              <span class="price">$1,232</span>
            </div>
          </div>
          <div class="col mt-3">
            <a href="{{url('/carrito')}}" class="btn btn-outline-dark">Ver la Bolsa</a>
            <a href="#" class="btn btn-dark">Realizar Pedido</a>
          </div>
        </div>
      </div>
    </div>
</nav>
