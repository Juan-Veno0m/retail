@extends('master-ui')
@section('title', 'Reestablecer Contraseña')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group row">
                  <div class="col text-center">
                    <img src="http://localhost:8000/img/label-yolkan@74.png" height="74px" alt="Logo Yolkan">
                    <h2 class="my-2">{{ __('Nueva contraseña') }}</h2>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="email">{{ __('Correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="password-confirm">{{ __('Confirmar contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col">
                        <button type="submit" class="btn-dark btn-lg btn-block">
                            {{ __('Cambiar') }}
                        </button>
                    </div>
                </div>
            </form>
      </div>
  </div>
  </section>
@endsection
@section('scripts')
@endsection
