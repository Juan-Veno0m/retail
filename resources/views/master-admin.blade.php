<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Yolkan Admin</title>
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Veno0M" />
        <!-- Header Scripts -->
        @include('admin.layouts.header-scripts')
        <!-- Favicon -->
        @include('admin.layouts.favicon')
    </head>
    <body class="sb-nav-fixed sb-sidenav-toggled">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <div id="layoutSidenav">
            <!-- SideNav -->
            @include('admin.layouts.sidenav')
            <div id="layoutSidenav_content">
                <main class="content d-flex flex-column flex-column-fluid">
                    <div class="container">
                      <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mb-1">
                        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                          <div class="d-flex align-items-baseline">
                            <h2 class="subheader-title text-dark font-weight-bold my-2 mr-3">@yield('title')</h2>
                            <ol class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                                <li class="breadcrumb-item text-muted active">@yield('title')</li>
                            </ol>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          @yield('toolkit')
                        </div>
                      </div>
                      <!-- Content -->
                      @yield('content')
                    </div>
                </main>
                <!-- Footer -->
                @include('admin.layouts.footer')
            </div>
        </div>
        <!-- Scripts -->
        @yield('scripts')
        <script src="{{mix('/js/all.js')}}"></script>
        <script src="{{asset('js/admin/scripts.js')}}"></script>
    </body>
</html>
