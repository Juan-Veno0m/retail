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
    <body class="sb-nav-fixed root sb-sidenav-toggled" data-path="{{url('/')}}">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <div id="layoutSidenav">
            <!-- SideNav -->
            @include('admin.layouts.sidenav')
            <div id="layoutSidenav_content">
                <main class="content d-flex flex-column flex-column-fluid">
                    <div class="container-fluid">
                      <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mb-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                          <div class="d-flex align-items-baseline">
                            <h2 class="subheader-title text-dark font-weight-bold my-2 mr-3">@yield('title')</h2>
                            <!--
                            <ol class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                                <li class="breadcrumb-item text-muted active">@yield('title')</li>
                            </ol> -->
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
        <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
        <script src="{{asset('js/admin/scripts.js')}}" defer></script>
        @yield('scripts')
    </body>
</html>
