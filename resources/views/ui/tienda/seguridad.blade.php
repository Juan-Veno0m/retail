@extends('master-ui')
@section('title', 'Seguridad')
@section('description','Tienda en linea Yolkan')
@section('content')
  <div class="container py-4">
    <div class="row px-3 justify-content-center">
      <div class="col-lg-7 px-0">
        <h1 class="custom-font">Inicio de sesión y seguridad</h1>
      </div>
      <ul class="list-group list-group-flush col-lg-7 form">
        <li class="list-group-item row d-flex align-items-center">
          <div class="col-lg-10">
            <span class="font-weight-bold">Nombre:</span>
            <p class="font-italic">{{$user->name}}</p>
          </div>
          <div class="col-lg-2"><button type="button" class="btn btn-secondary btn-sm" name="modificar" data-label="name">Modificar</button></div>
        </li>
        <li class="list-group-item row d-flex align-items-center">
          <div class="col-lg-10">
            <span class="font-weight-bold">Correo electrónico:</span>
            <p class="font-italic">{{$user->email}}</p>
          </div>
          <div class="col-lg-2"><button type="button" class="btn btn-secondary btn-sm" name="modificar" data-label="email" disabled>Modificar</button></div>
        </li>
        <li class="list-group-item row d-flex align-items-center">
          <div class="col-lg-10">
            <span class="font-weight-bold">Número de celular:</span>
            <p class="font-italic">+522222158982</p>
          </div>
          <div class="col-lg-2"><button type="button" class="btn btn-secondary btn-sm" name="modificar" data-label="phone" disabled>Modificar</button></div>
        </li>
        <li class="list-group-item row d-flex align-items-center">
          <div class="col-lg-10">
            <span class="font-weight-bold">Contraseña:</span>
            <p class="font-italic">********</p>
          </div>
          <div class="col-lg-2"><button type="button" class="btn btn-secondary btn-sm" name="modificar" data-label="password">Modificar</button></div>
        </li>
      </ul>
      <div class="col-lg-7 px-0 pt-3">
        <hr>
        <a href="{{url('Cuenta')}}" class="btn btn-warning" name="back">Finalizado</a>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="{{asset('js/ui/seguridad.js')}}" async></script>
@endsection
