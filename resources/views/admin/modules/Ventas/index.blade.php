<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ventas - Yolkan Admin</title>
        <meta name="description" content="@yield('description')">
        <meta name="author" content="Veno0M" />
        <!-- Header Scripts -->
        @include('admin.layouts.header-scripts')
        <!-- Favicon -->
        @include('admin.layouts.favicon')
        <style>
          .custom-select {
            padding: 8px;
            height: 36px !important;
            font-size: 12px !important;
            color: #3c3b3b !important;
          }
          .bootstrap-select > .dropdown-toggle {
            max-width: 100%;
            font-size: 14px;
            padding: 10px 18px;
          }
          .input-group-text {font-size: 14px;}
          .bootstrap-select .text {font-size: 12px !important;}
          .btn-default {
            color: #4f4f4f;
            background: #e9ecef;
            border: solid 1px #ced4da;
          }
          .table thead th {
            border-bottom: solid 1px #eeee;
            color: #555353;
            font-weight: 600;
            font-size: 13px;
            /*! font-family: sans-serif; */
          }
          .font-medium {
            font-size: 1.2rem;
            color: #5e5e5e;
            font-weight: 600;
          }
          .font-large {
            font-size: 1.6rem;
            font-weight: 600;
            color: #000;
          }
          #table-items > tbody > .active {
            border-left: solid 4px #439f83;
            background: #f8f9fa;
          }
          .swal2-input {font-size: 18px !important;}
          @media (min-width: 768px) {
            .col-lg-6.btn.card-body {max-width: 48%;}
            .fixed-b {
              position: fixed;
              bottom: 0;
              left: 0;
              right: 35%;
              background: #fff;
              padding: 20px 30px;
            }
            body {
              overflow-y: hidden;
            }
            .form-row.table-responsive {
              overflow-y: auto;
              max-height: 386px;
            }
          }
          /* swal2 dialog */
          .swal2-content label {font-size: 12px;text-align: left;display: block;}
          .custom-input {
            padding: 8px;
            height: 36px !important;
            font-size: 12px !important;
            color: #3c3b3b !important;
            margin: 0;
            width: 100%;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
          }
          .swal2-title {
            font-size: 12px !important;
            text-align: left !important;
            line-height: 0 !important;
          }
          .swal2-header {
            display: block !important;
            padding: 0 !important;
          }
          .swal2-close {
            font-size: 1.9rem !important;
            color: #545454 !important;
          }
          .swal2-content {padding: 0 !important;}
          .icon-circle {
            background: #353535;
            border-radius: 22px;
            width: 36px !important;
            height: 36px;
            flex: inherit;
            padding: 4px;
            color: #fff;
          }
          /* fa spin */
          @-webkit-keyframes
            fa-spin{
              0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}
              to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}
          @keyframes
            fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}
            to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}
        </style>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    </head>
    <body class="sb-nav-fixed root sb-sidenav-toggled" data-path="{{url('/')}}">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <div id="layoutSidenav">
            <!-- SideNav -->
            @if(Auth::user()->hasAnyRole('admin'))@include('admin.layouts.sidenav')@endif
            <div id="layoutSidenav_content">
                <main class="d-flex flex-column flex-column-fluid">
                  <form class="needs-validation" novalidate>
                    <div class="row mx-2">
                      <div class="col-lg-8">
                        <div class="card-body">
                            @include('admin.modules.Ventas.scan')
                            <!-- table items -->
                            @include('admin.modules.Ventas.table')
                        </div>
                      </div>
                      <div class="col-lg-4 mt-3">
                        <!-- first row -->
                        <div class="row card-body btn-block bg-light">
                            <span class="col-lg-3 font-medium">Total</span>
                            <span class="col-lg-3 font-large totalSale">$0.0</span>
                            <span class="col-lg-6 alert-danger d-none ajax-desc"></span>
                        </div>
                        <!-- second row -->
                        <button class="row card-body btn btn-primary btn-block" type="button" id="pay">
                          <svg width="24px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-hand-holding-usd fa-w-18 fa-5x"><path fill="currentColor" d="M271.06,144.3l54.27,14.3a8.59,8.59,0,0,1,6.63,8.1c0,4.6-4.09,8.4-9.12,8.4h-35.6a30,30,0,0,1-11.19-2.2c-5.24-2.2-11.28-1.7-15.3,2l-19,17.5a11.68,11.68,0,0,0-2.25,2.66,11.42,11.42,0,0,0,3.88,15.74,83.77,83.77,0,0,0,34.51,11.5V240c0,8.8,7.83,16,17.37,16h17.37c9.55,0,17.38-7.2,17.38-16V222.4c32.93-3.6,57.84-31,53.5-63-3.15-23-22.46-41.3-46.56-47.7L282.68,97.4a8.59,8.59,0,0,1-6.63-8.1c0-4.6,4.09-8.4,9.12-8.4h35.6A30,30,0,0,1,332,83.1c5.23,2.2,11.28,1.7,15.3-2l19-17.5A11.31,11.31,0,0,0,368.47,61a11.43,11.43,0,0,0-3.84-15.78,83.82,83.82,0,0,0-34.52-11.5V16c0-8.8-7.82-16-17.37-16H295.37C285.82,0,278,7.2,278,16V33.6c-32.89,3.6-57.85,31-53.51,63C227.63,119.6,247,137.9,271.06,144.3ZM565.27,328.1c-11.8-10.7-30.2-10-42.6,0L430.27,402a63.64,63.64,0,0,1-40,14H272a16,16,0,0,1,0-32h78.29c15.9,0,30.71-10.9,33.25-26.6a31.2,31.2,0,0,0,.46-5.46A32,32,0,0,0,352,320H192a117.66,117.66,0,0,0-74.1,26.29L71.4,384H16A16,16,0,0,0,0,400v96a16,16,0,0,0,16,16H372.77a64,64,0,0,0,40-14L564,377a32,32,0,0,0,1.28-48.9Z" class=""></path></svg>
                          Pagar
                        </button>
                        <!-- third row -->
                        <div class="row d-flex justify-content-between btn-block">
                          <button class="col-lg-6 btn card-body bg-light" type="button">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="24px"><path fill="currentColor" d="M256.47 216.77l86.73 109.18s-16.6 102.36-76.57 150.12C206.66 523.85 0 510.19 0 510.19s3.8-23.14 11-55.43l94.62-112.17c3.97-4.7-.87-11.62-6.65-9.5l-60.4 22.09c14.44-41.66 32.72-80.04 54.6-97.47 59.97-47.76 163.3-40.94 163.3-40.94zM636.53 31.03l-19.86-25c-5.49-6.9-15.52-8.05-22.41-2.56l-232.48 177.8-34.14-42.97c-5.09-6.41-15.14-5.21-18.59 2.21l-25.33 54.55 86.73 109.18 58.8-12.45c8-1.69 11.42-11.2 6.34-17.6l-34.09-42.92 232.48-177.8c6.89-5.48 8.04-15.53 2.55-22.44z" class=""></path></svg>
                            Void
                          </button>
                          <button class="col-lg-6 btn card-body bg-light" type="button">Hold</button>
                        </div>
                        <!-- fourth row -->
                        <div class="row d-flex justify-content-between btn-block">
                          <select class="col-lg-6 btn card-body bg-light border-0" id="typeOfsale">
                            <option value="public" selected>Venta al Publico</option>
                            <option value="private">Empresario</option>
                          </select>
                          <input class="col-lg-6 btn card-body bg-light border-0" id="empresario" placeholder="Ingrese No. Empresario" disabled>
                        </div>
                        <!-- sixth row -->
                        <div class="row d-flex justify-content-between btn-block">
                          <button class="col-lg-12 btn card-body bg-light label-name" type="button">&nbsp;</button>
                        </div>
                        <!-- seventh row -->
                        <div class="row d-flex justify-content-between btn-block">
                          <button class="col-lg-6 btn card-body bg-light cupon" type="button">&nbsp;</button>
                          <button class="col-lg-6 btn card-body bg-light descuento" type="button">&nbsp;</button>
                        </div>
                        <!-- eight row -->
                        <div class="row d-flex justify-content-between btn-block">
                          <button class="col-lg-6 btn card-body bg-light border" type="button">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="24px"><path fill="currentColor" d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z" class=""></path></svg>
                            Opciones
                          </button>
                          <button class="col-lg-6 btn card-body bg-light border" type="button">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24px"><path fill="currentColor" d="M180 448H96c-53 0-96-43-96-96V160c0-53 43-96 96-96h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H96c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm117.9-303.1l77.6 71.1H184c-13.3 0-24 10.7-24 24v32c0 13.3 10.7 24 24 24h191.5l-77.6 71.1c-10.1 9.2-10.4 25-.8 34.7l21.9 21.9c9.3 9.3 24.5 9.4 33.9.1l152-150.8c9.5-9.4 9.5-24.7 0-34.1L353 88.3c-9.4-9.3-24.5-9.3-33.9.1l-21.9 21.9c-9.7 9.6-9.3 25.4.7 34.6z" class=""></path></svg>
                            Salir
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </main>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" defer></script>
        <script src="{{asset('/js/accounting.min.js')}}" defer></script>
        <script src="{{asset('/js/admin/modules/ventas/main.js?x=3')}}" defer></script>
    </body>
</html>
