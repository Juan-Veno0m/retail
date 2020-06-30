<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Yolkan</title>
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Veno0M" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{url('/')}}" />
        <!-- styles -->
        <style>
          /* devanagari */
          @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
          }
          /* latin-ext */
          @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }
          /* latin-ext */
          @font-face {
            font-family: 'Great Vibes';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Great Vibes'), local('GreatVibes-Regular'), url(https://fonts.gstatic.com/s/greatvibes/v7/RWmMoKWR9v4ksMfaWd_JN9XLiaQoDmlrMlY.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
            font-family: 'Great Vibes';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Great Vibes'), local('GreatVibes-Regular'), url(https://fonts.gstatic.com/s/greatvibes/v7/RWmMoKWR9v4ksMfaWd_JN9XFiaQoDmlr.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }
          .cover {
            object-fit: cover;
            height: 264px !important;
          }
          .main-content {min-height: 60vh;}
        </style>
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
        <div class="main-content" data-path="{{url('/')}}">
            @yield('content')
        </div>
        <!-- End content -->
        <!-- Footer -->
        @include('ui.layouts.footer-public')
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
        <script src="{{asset('js/lazysizes.min.js')}}" async=""></script>
        <script>
          // Global
          let path = $('.main-content').data('path');
          /* Read Cart Number */
          $.get(path+"/carrito/read", function(data) {
            if (data.cart!= null) {
              $('.cart-items').html(Object.keys(data.cart).length);
            }
          });
          // click add to cart from feactured // produts view
          $('.product').on('click', '#add-cart', function(event) {
            event.preventDefault();
            /* Act on the event */
            let btn = $(this);
            add_cart(btn.data('id'),null);
          });
          // click add to cart from product single
          $('.summary').on('click', '.btn-cart', function(event) {
            event.preventDefault();
            /* Act on the event */
            let btn = $(this);
            let quantity = $('.summary .quantity :input[type="number"]').val();
            add_cart(btn.data('id'),quantity);
          });
          // Function add to cart
          function add_cart(id,quantity){
            /* ajax */
            $.ajax({
              url: path+'/carrito/create',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              dataType: 'json',
              data: {id: id,quantity:quantity}
            })
            .done(function(data) {
              if (data.tipo == 'success') {
                let alert = $('.notification-cart');
                let src = path+'/uploads/'+data.cart[data.id]['photo'];
                //
                alert.find('.img').attr('src',src);
                alert.find('.title-producto').html(data.cart[data.id]['name']);
                alert.find('.price').html('$'+data.cart[data.id]['price']);
                $('.cart-items').html(Object.keys(data.cart).length);
                alert.css("display", "flex").hide().fadeIn();
                alert.delay(1500).fadeOut("slow");
              }
            });
          }
        </script>
        @yield('scripts')
    </body>
</html>
