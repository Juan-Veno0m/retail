<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title') - Yolkan</title>
        <meta name="description" content="@yield('description')">
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="http://localhost/" />
        <!-- styles -->
        @include('ui.layouts.styles-main')
    </head>
    <body>
        <!-- Header -->
        <header>
            <!-- Top Header -->
            @include('ui.layouts.top-header')
            <!-- Navbar -->
            @include('ui.layouts.navbar')
        </header>
        <!-- End Header -->
        <!-- Section content -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- End content -->
        <!-- Footer -->
        @include('ui.layouts.footer-public')
        <!-- Scripts -->
        @yield('scripts')
    </body>
</html>
