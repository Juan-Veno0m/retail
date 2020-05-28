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
    <body class="sb-nav-fixed">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <div id="layoutSidenav">
            <!-- SideNav -->
            @include('admin.layouts.sidenav')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">@yield('title')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
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
