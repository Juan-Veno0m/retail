<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light bg-white" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{url('/dashboard')}}">
                  <i class="fas fa-tachometer-alt"></i>
                    Dashboard</a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                  <i class="fas fa-box-open"></i>
                  Productos
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{url('productos/index')}}">
                        <i class="menu-bullet menu-bullet-dot"><span></span></i>Productos</a>
                      <a class="nav-link" href="{{url('productos/proveedores')}}">
                        <i class="menu-bullet menu-bullet-dot"><span></span></i>Proveedores</a>
                      <a class="nav-link" href="{{url('productos/categorias')}}">
                        <i class="menu-bullet menu-bullet-dot"><span></span></i>Categorías</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                  <i class="fas fa-book-open"></i>
                    Categorías
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"
                            >Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                        ></a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.html">Login</a><a class="nav-link" href="register.html">Register</a><a class="nav-link" href="password.html">Forgot Password</a></nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError"
                            >Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                        ></a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                  <i class="fas fa-chart-area"></i>
                    Charts</a>
                <a class="nav-link" href="tables.html">
                  <i class="fas fa-table"></i>
                    Tables</a>
            </div>
        </div>
    </nav>
</div>
