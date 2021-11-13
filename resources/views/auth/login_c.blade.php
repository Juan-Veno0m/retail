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
        <div class="col-md-4">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <h5>¿Eres cliente?</h5>
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
                <button type="submit" class="btn btn-success">Iniciar Sesión</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4 form-login">
          <div class="form-group row">
            <label for="NoEmpresario">No. Empresario:</label>
            <input id="NoEmpresario" type="text" placeholder="Número de Empresario" class="form-control" name="NoEmpresario" required autofocus>
            <span class="invalid-feedback" role="alert"></span>
          </div>
          <div class="form-group row">
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
          <div class="form-group row">
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
<script>
  var link = document.createElement('link');
  link.setAttribute("rel", "stylesheet");
  link.setAttribute("type", "text/css");
  link.onload = function(){ }
  link.setAttribute("href", 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14.0/css/all.min.css');
  document.getElementsByTagName("head")[0].appendChild(link);
  let flag=false;
  /* ajax login */
  $('.form-login').on('click', '#submit', function(event) {
    event.preventDefault();
    let btn = $(this);
    let form = btn.parents('.form-login');
    /* Act on the event */

    if (flag==false) {
      //
      flag=true;
      $.ajax({
        url: '/AjaxLogin',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: {NoEmpresario: form.find('#NoEmpresario').val(),Password: form.find('#password').val()}
      })
      .done(function(data) {
        flag=false;
        switch(data.tipo) {
          case 200:
            //passed
            btn.html('<i class="fas fa-check-circle"></i>');
            setTimeout(function(){
              window.location.href = path;
           }, 1500);
            break;
          case 500:
            //Bad Password
            $('#password').addClass('is-invalid');
            $('#password').next('.invalid-feedback').html(data.mensaje)
            break;
        }
      });

    }
  });
</script>
@endsection
