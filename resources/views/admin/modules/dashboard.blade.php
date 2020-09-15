@extends('master-admin')
@section('title', 'Analytics Dashboard')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
    <!-- Section  -->
    <style>
    .icon {
      width: 74px;
      height: 74px;
      background: #2d2d2d;
      color: #fff;
      font-size: 36px;
      text-align: center;
      display: inline;
      margin: 0px 15px 15px 5px;
      border-radius: 40px;
      }
      .icon > i {
      vertical-align: bottom;
      }
      .widget-numbers {
        font-size: 1.9rem;
        font-weight: 700;
        line-height: 1;
        margin: 1rem auto;
        color: #495057;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }
    </style>
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-header bg-white">
          Estadistica principal
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="media mt-3">
                <div class="icon align-self-center"><i class="fas fa-user-tie"></i></div>
                <div class="media-body">
                  <h5 class="mt-0">Empresarios</h5>
                  <div class="widget-numbers">1,7M</div>
                </div>
              </div>
            </div>
            <!-- object -->
            <div class="col">
              <div class="media mt-3">
                <div class="icon align-self-center"><i class="fab fa-product-hunt"></i></div>
                <div class="media-body">
                  <h5 class="mt-0">Productos</h5>
                  <div class="widget-numbers">1,7M</div>
                </div>
              </div>
            </div>
            <!-- object -->
            <div class="col">
              <div class="media mt-3">
                <div class="icon align-self-center"><i class="fas fa-shopping-cart"></i></div>
                <div class="media-body">
                  <h5 class="mt-0">Pedidos</h5>
                  <div class="widget-numbers">1,7M</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white">
          Acumulado
        </div>
      </div>
    </div>
@endsection
@section('scripts')
@endsection
