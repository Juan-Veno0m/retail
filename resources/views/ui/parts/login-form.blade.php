<div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <section class="ftco-section shadow-none py-0 login-form border-nav-bottom">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group row">
                    <div class="col text-center">
                      <img src="{{asset('/img/label-yolkan@74.png')}}" height="74px" alt="Logo Yolkan">
                    </div>
                    <div class="col-1">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="email">Correo:</label>
                      <input id="email" type="email" placeholder="Dirección de correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label for="password">Contraseña:</label>
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
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Recordarme</label>
                      </div>
                    </div>
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
                      <p class="text-center"><small>Al iniciar sesión, aceptas la Política de privacidad y los Términos de uso de Yolkan.</small></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <button type="submit" class="btn btn-dark btn-lg btn-block">Iniciar Sesión</button>
                    </div>
                  </div>
                  <div class="form-group row">
                        <div class="col">
                          <p class="text-center"><small>¿No eres miembro? <a href="{{url('register')}}">Únete a nosotros</a>.</small></p>
                        </div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
