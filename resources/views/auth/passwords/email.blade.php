@extends('master-ui')
@section('title', 'Inicio de Sesión')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">{{ __('Reset Password') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  <form method="POST" action="{{ route('password.email') }}">
                      @csrf

                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                          <div class="col-md-6">
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
                                  {{ __('Send Password Reset Link') }}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('scripts')
    <script src="{{mix('/js/all.js')}}"></script>
@endsection
