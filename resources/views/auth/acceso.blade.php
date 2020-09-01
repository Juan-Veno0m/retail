<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Acceso Administrador Yolkan</title>
        <!-- Favicon -->
        @include('admin.layouts.favicon')
        <link href="{{asset('/css/acceso.css')}}" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow border-0 rounded-lg my-5">
                                    <div class="card-body">
                                      <h3 class="text-center font-bold-light my-4">Welcome</h3>
                                      <div class="text-center">
                                        <a href="{{url('/')}}"><img src="{{asset('img/Icon-square.png')}}"></a>
                                      </div>
                                        <form method="POST" action="{{ route('login') }}" class="container my-4 py-3">
                                          @csrf
                                            <div class="form-group">
                                              <input id="email" type="email" placeholder="Dirección de correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                              @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                              @enderror
                                            </div>
                                            <div class="form-group">
                                              <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                              @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                              @enderror
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                              <button type="submit" class="btn btn-dark btn-block">Iniciar Sesión</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" defer></script>
    </body>
</html>
  <!-- Section Content
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="form-group row">
        <div class="col text-center">
          <h1><img src="{{asset('/img/label-yolkan@74.png')}}" height="74px" alt="Iniciar sesión"></h1>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
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
            <div class="form-group row">
              <div class="col">
                @if (Route::has('password.request'))
                  <small><a href="{{ route('password.request') }}">
                    ¿Olvidaste la contraseña?
                  </a></small>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <div class="col">
                <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="form-group row mt-3">
        <div class="col">
          <p class="text-center"><small>¿No eres miembro? <a href="{{url('register')}}">Únete a nosotros</a>.</small></p>
        </div>
      </div>
    </div>
  </section>

-->
