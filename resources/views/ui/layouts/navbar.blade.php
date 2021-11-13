<nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light px-lg-4 sleep border-nav-bottom" id="ftco-navbar" itemtype="https://schema.org/SiteNavigationElement" itemscope="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14">
          <g class="fa-group">
            <path fill="currentColor" d="M16 288h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16z" class="fa-secondary"></path>
            <path fill="currentColor" d="M432 384H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 80v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16z" class="fa-primary"></path>
          </g>
        </svg>
    </button>
    <!-- logo brand -->
    <a class="navbar-brand mr-0 mx-md-2" href="{{url('/')}}" aria-label="Yolkan.net" data-label="Yolkan.net" title="Yolkan.net" rel="home">
      <img srcset="{{asset('/img/label-yolkan-xs.webp')}}" src="{{asset('/img/label-yolkan-xs.webp')}}" height="34px" width="98px" alt="Logo Yolkan" class="img-fluid">
    </a>
    <ul class="navbar-nav ml-md-auto nav-custom">
      @if(Auth::check())
        @if(Auth::user()->isAsociado())
          <li class="nav-item d-none d-lg-block dropdown {{ (request()->is('MisPedidos')) ? 'active' : '' }}">
              <a class="nav-link dropdown-toggle" href="#" id="dropdowperfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 fa-fw fa-lg"><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z" class=""></path></svg>
                </svg> {{Auth::user()->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdowperfil">
                  <a class="dropdown-item" href="{{url('/Cuenta')}}">Mi Cuenta</a>
                  <a class="dropdown-item {{ (request()->is('MisPedidos')) ? 'active' : '' }}" href="{{url('/Cuenta/MisPedidos')}}">Mis Pedidos</a>
                  <form id="logout-form" action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                  </form>
              </div>
          </li>
        @elseif (Auth::user()->isUser())
          <li class="nav-item d-none d-lg-block dropdown {{ (request()->is('MisPedidos')) ? 'active' : '' }}">
              <a class="nav-link dropdown-toggle" href="#" id="dropdowperfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 fa-fw fa-lg"><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z" class=""></path></svg>
                </svg> {{Auth::user()->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdowperfil">
                  <a class="dropdown-item" href="{{url('/Cuenta')}}">Mi Cuenta</a>
                  <form id="logout-form" action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                  </form>
              </div>
          </li>
        @endif
      @else
        <li class="nav-item d-none d-lg-block">
          <a href="{{url('/login')}}" class="nav-link pr-lg-0" title="iniciar sesión">
            Login  &nbsp;/
          </a>
        </li>
      @endif
      <li class="nav-item cta cta-colored">
        <a href="{{url('/carrito')}}" class="nav-link pl-lg-2" title="carrito de compras">
          <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-shopping-cart fa-w-18 fa-lg"><path fill="currentColor" d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z" class=""></path></svg>
          <span class="cart-items item-number">
            @if(session('cart')){{count(session('cart'))}}
            @else 0 @endif
            </span>
        </a>
      </li>
    </ul>
    <!-- collapse menu -->
    <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav custom-font">
            <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
              <a href="{{url('/')}}" title="pestaña principal" class="nav-link">Principal</a></li>
            <li class="nav-item dropdown">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="submenú tienda">
                Tienda
              </a>
              <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bd-versions">
                <a class="dropdown-item {{ (request()->is('tienda')) ? 'active' : '' }}" title="Menú de la tienda principal" href="{{url('/tienda')}}">Tienda</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/despensa/node1')}}" title="Menú categoría despensa">Despensa</a>
                <a class="dropdown-item" href="{{url('/dulces-y-botanas/node5')}}" title="Menú categoría lácteos">Dulces y Botanas</a>
                <a class="dropdown-item" href="{{url('/higiene-y-belleza/node65')}}" title="Menú categoría higiene y belleza">Higiene y Belleza</a>
                <a class="dropdown-item" href="{{url('/limpieza-del-hogar/node93')}}" title="Menú categoría panadería y tortillería">Limpieza del hogar</a>
              </div>
            </li>
            @if(Auth::check())
              @if(Auth::user()->isAsociado())
                <li class="nav-item d-block d-md-none dropdown  {{ (request()->is('MisPedidos')) ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdowperfil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 fa-fw fa-lg"><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z" class=""></path></svg>
                      </svg> {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdowperfil">
                        <a class="dropdown-item" href="{{url('/Cuenta')}}">Mi Cuenta</a>
                        <a class="dropdown-item {{ (request()->is('MisPedidos')) ? 'active' : '' }}" href="{{url('/Cuenta/MisPedidos')}}">Mis Pedidos</a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST">
                          {{ csrf_field() }}
                          <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                        </form>
                    </div>
                </li>
              @endif
            @else
              <li class="nav-item d-block d-md-none">
                <a href="{{url('/login')}}" class="nav-link" title="iniciar sesión">Iniciar sesión</a>
              </li>
            @endif
            <li class="nav-item"><a href="#" class="nav-link" title="acerca de">Acerca de</a></li>
            <li class="nav-item {{ (request()->is('contacto')) ? 'active' : '' }}"><a href="{{url('contacto')}}" class="nav-link" title="contacto">Contacto</a></li>
        </ul>
    </div>
    <!-- search -->
    <form class="navbar-collapse my-2 my-lg-0 form-suggestions input-group" tabindex="-1" action="/buscar?">
      <input class="form-control" type="search" placeholder="<?php if (isset($k)){ echo $k;}else echo "¿Qué estás buscando?"; ?>" name="k" id="search">
      <div class="input-group-append btn-warning">
        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fas" width="36px" height="36px">
          <g class="fa-group">
            <path fill="currentColor" d="M208 80a128 128 0 1 1-90.51 37.49A127.15 127.15 0 0 1 208 80m0-80C93.12 0 0 93.12 0 208s93.12 208 208 208 208-93.12 208-208S322.88 0 208 0z" class="fa-secondary"></path>
            <path fill="currentColor" d="M504.9 476.7L476.6 505a23.9 23.9 0 0 1-33.9 0L343 405.3a24 24 0 0 1-7-17V372l36-36h16.3a24 24 0 0 1 17 7l99.7 99.7a24.11 24.11 0 0 1-.1 34z" class="fa-primary"></path>
          </g>
        </svg>
        <input type="submit" class="btn" value="Ir" style="opacity: 0;">
      </div>
      <ul class="list-group list-ajax list-group-flush" style="display:none;"></ul>
    </form>
</nav>
