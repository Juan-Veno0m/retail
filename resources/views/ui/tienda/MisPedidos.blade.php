@extends('master-ui')
@section('title', 'Mis Pedidos')
@section('description','Tienda en linea Yolkan')
@section('content')
  <div class="container pt-5">
    <div class="row text-center mt-2"><h1 class="col custom-font font-lg">Mi Perfil</h1></div>
    <div class="row justify-content-center mt-2">
      <div class="col-lg-10">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{url('/Cuenta/MisPedidos')}}">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Direcciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link">Detalles de la cuenta</a>
          </li>
          <li class="nav-item">
            <form id="logout-form" action="{{ url('logout') }}" method="POST">
              {{ csrf_field() }}
              <button class="nav-link" type="submit">Cerrar Sesión</button>
            </form>
          </li>
        </ul>
        <div class="tab-content px-md-5 py-4">
          <div class="tab-pane fade show active">
            @include('ui.parts.tbl-pedidos')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
