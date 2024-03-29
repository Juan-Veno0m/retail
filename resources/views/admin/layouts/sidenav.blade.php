<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light bg-white" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{url('/dashboard')}}">
                  <i class="fas fa-tachometer-alt"></i>
                    Dashboard</a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed {{ (request()->is('ordenes/*')) ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                  <i class="fas fa-file-invoice-dollar"></i>
                  Ordenes
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{url('ordenes/pedidos')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Pedidos
                      </a>
                      <a class="nav-link" href="{{url('ordenes/generar')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Generar
                      </a>
                    </nav>
                </div>
                <!-- Ventas -->
                <a class="nav-link collapsed {{ (request()->is('ventas/*')) ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseOrders">
                  <i class="fas fa-dollar-sign"></i>
                  Ventas
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{url('ventas/POS')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Terminal
                      </a>
                      <a class="nav-link" href="{{url('ventas/ventas')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Ventas
                      </a>
                    </nav>
                </div>
                <a class="nav-link collapsed {{ (request()->is('productos/*')) ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                  <i class="fas fa-box-open"></i>
                  Productos
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{url('productos/')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Productos</a>
                      <a class="nav-link" href="{{url('productos/proveedores')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Proveedores</a>
                      <a class="nav-link" href="{{url('productos/categorias')}}">
                        <i class="menu-bullet menu-bullet-dot"></i>Categorías</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                  <i class="fas fa-users"></i>
                    Asociados
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                ></a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{url('asociados/')}}">
                      <i class="menu-bullet menu-bullet-dot"></i>Asociados</a>
                    <a class="nav-link" href="{{url('asociados/consumo')}}">
                      <i class="menu-bullet menu-bullet-dot"></i>Consumo</a>
                  </nav>
                </div>
                <!-- inventarios -->
                <a class="nav-link collapsed {{ (request()->is('inventarios/*')) ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="false" aria-controls="collapseInventory">
                  <i class="fas fa-truck"></i>
                    Inventarios
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseInventory" data-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{url('inventarios')}}">
                      <i class="menu-bullet menu-bullet-dot"></i>Gestión</a>
                    <a class="nav-link" href="{{url('inventarios/generar')}}">
                      <i class="menu-bullet menu-bullet-dot"></i>Crear Compra</a>
                  </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{url('/thumbnails')}}">
                  <i class="fas fa-cogs"></i>
                    Regenerar Miniaturas</a>
                <a class="nav-link" href="{{url('/localidades')}}">
                  <i class="fas fa-city"></i>
                    Localidades</a>
            </div>
        </div>
    </nav>
</div>
