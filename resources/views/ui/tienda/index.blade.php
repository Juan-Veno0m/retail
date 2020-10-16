<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Yolkan: Tienda de Productos Orgánicos y Artesanales</title>
        <meta name="description" content="Yolkan Tienda en línea de productos orgánicos y artesanales, 100 % naturales de pequeños productores locales.">
        <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@Yolkan6" />
        <meta name="twitter:creator" content="@Yolkan6" />
        <!--  Open Graph -->
        <meta property="og:title" content="Yolkan: Tienda de Productos Orgánicos y Artesanales" />
        <meta property="og:description" content="Yolkan Tienda en línea de productos orgánicos y artesanales, 100 % naturales de pequeños productores locales.">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:image" content="{{url('/img/label-yolkan.png')}}" />
        <meta property="og:site_name" content="Yolkan" />
        <meta name="author" content="Veno0M" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{url()->current()}}" />
        <!-- styles -->
        <style>
          /* cyrillic-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNa7lqDY.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
          }
          /* cyrillic */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qPK7lqDY.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
          }
          /* greek-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNK7lqDY.woff2) format('woff2');
          unicode-range: U+1F00-1FFF;
          }
          /* greek */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qO67lqDY.woff2) format('woff2');
          unicode-range: U+0370-03FF;
          }
          /* vietnamese */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qN67lqDY.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
          }
          /* latin-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNq7lqDY.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7l.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }/* sans pro */
          @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap');
          /* devanagari */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
          }
          /* latin-ext */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }
        </style>
        @include('ui.layouts.styles-main')
        <link href="{{asset('/css/ui/index/main.css?x=2')}}" rel="stylesheet">
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
        <div class="main-content" data-path="{{url('/')}}">
          <!-- Section Carousel -->
          @include('ui.parts.main-carousel')
          <!-- Grid -->
          @include('ui.parts.featured-products')
          <!-- Section Services -->
          @include('ui.parts.services-shop')
          <!-- banner -->
          @include('ui.parts.banner')
          <!-- Section categories -->
          @include('ui.parts.catalogo')
        </div>
        <!-- End content -->
        <!-- Footer -->
        @include('ui.layouts.footer-public')
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" defer></script>
        <script src="{{asset('js/lazysizes.min.js')}}" async></script>
        <script src="{{asset('js/ui/main.js?x=9')}}" defer></script>
        @yield('scripts')
    </body>
</html>
