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
        <div class="accordion col-md-6 " id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Acceso a Socios
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="form-login">
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
                  <div class="form-group row mt-3">
                    <div class="col">
                      <p class="text-center"><small>¿Quieres ser empresario? <a href="{{url('registro')}}">Únete a nosotros</a>.</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Acceso a Usuarios
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <div class="container">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                      <label for="email">Correo:</label>
                      <div class="input-group">
                        <input id="email" type="email" placeholder="Dirección de correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password">Contraseña:</label>
                      <div class="input-group">
                        <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
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
                      <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
                    </div>
                    <div class="form-group row mt-3">
                      <div class="col">
                        <p class="text-center"><small><a href="{{url('register')}}">Crear cuenta nueva.</a></small></p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
<script src="{{asset('js/ui/login.js?x=2')}}" defer></script>
@endsection
