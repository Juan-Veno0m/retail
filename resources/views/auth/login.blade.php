@extends('master-ui')
@section('title', 'Inicio de Sesión')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="form-group row">
        <div class="col text-center">
          <h1><img src="{{asset('/img/label-yolkan@74.png')}}" height="74px" alt="Iniciar sesión"></h1>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4 form-login">
          <div class="form-group row mx-1">
            <label for="NoEmpresario">No. Empresario:</label>
            <input id="NoEmpresario" type="text" placeholder="Número de Empresario" class="form-control" name="NoEmpresario" required autofocus>
            <span class="invalid-feedback" role="alert"></span>
          </div>
          <div class="form-group row mx-1">
            <label for="password">Contraseña:</label>
            <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password" required autocomplete="current-password">
            <span class="invalid-feedback" role="alert"></span>
          </div>
          <div class="form-group row text-center">
            <div class="col">
              @if (Route::has('password.request'))
                <small><a href="{{ route('password.request') }}">
                  ¿Olvidaste la contraseña?
                </a></small>
              @endif
            </div>
          </div>
          <div class="form-group row mx-1">
            <button id="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
          </div>
        </div>
      </div>
      <div class="form-group row mt-3">
        <div class="col">
          <p class="text-center"><small>¿Quieres ser empresario? <a href="{{url('registro')}}">Únete a nosotros</a>.</small></p>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
<script src="{{asset('js/ui/login.js?x=2')}}" defer></script>
@endsection
