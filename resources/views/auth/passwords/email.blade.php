@extends('master-ui')
@section('title', 'Reestablecer Contraseña')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="col">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">
                  <div class="col text-center">
                    <img src="http://localhost:8000/img/label-yolkan@74.png" height="74px" alt="Logo Yolkan">
                    <h2 class="my-2">{{ __('Restablecer contraseña') }}</h2>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="email">{{ __('Correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-dark btn-lg btn-block">
                            {{ __('Restablecer') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('scripts')
@endsection
