@extends('master-ui')
@section('title', 'Registrarse')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group row">
                <div class="col text-center">
                  <img src="http://localhost:8000/img/label-yolkan@74.png" height="74px" alt="Logo Yolkan">
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label for="name">{{ __('Nombre') }}</label>
                  <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                  <div class="col">
                    <label for="email">{{ __('Correo eléctronico') }}</label>
                    <input id="email" type="email" placeholder="Correo eléctronico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col">
                    <label for="password">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col">
                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col">
                      <button type="submit" class="btn btn-lg btn-block btn-dark">
                          {{ __('Register') }}
                      </button>
                  </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <p class="text-center"><small>¿Ya eres miembro? <a href="{{url('login')}}">Iniciar sesión</a>.</small></p>
                </div>
              </div>
          </form>
      </div>
  </div>
  </section>
@endsection
@section('scripts')
    <script src="{{mix('/js/all.js')}}"></script>
@endsection
