<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light sleep border-nav-bottom" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('/img/yolkan-logo.png')}}" height="56px" alt="Logo Yolkan"></a>
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
                        <a class="dropdown-item" href="wishlist.html">Lista de Deseos</a>
                        <a class="dropdown-item" href="product-single.html">Productos Recomendados</a>
                        <a class="dropdown-item" href="cart.html">Carrito de Compras</a>
                        <a class="dropdown-item" href="checkout.html">Revisar Pedido</a>
                    </div>
                </li>
                <li class="nav-item"><a href="about.html" class="nav-link">Acerca de</a></li>
                <li class="nav-item {{ (request()->is('contacto')) ? 'active' : '' }}"><a href="{{url('contacto')}}" class="nav-link">Contacto</a></li>
                <li class="nav-item"><a href="{{url('/login')}}" class="nav-link"><i class="fas fa-user"></i> Entrar </a></li>
                <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="fas fa-shopping-cart"></span> [0]</a></li>
            </ul>
        </div>
    </div>
</nav>
