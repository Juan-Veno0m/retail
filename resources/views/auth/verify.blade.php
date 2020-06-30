@extends('master-ui')
@section('title', 'Confirma tu correo electrónico')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <!-- Section Content -->
  <section class="ftco-section login-form border-nav-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="col">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Una nuevo enlace de verificación ah sido enviado a su correo electronico.') }}
                    </div>
                @endif
            </div>
            <div class="form-group row">
              <div class="col text-center">
                <img src="http://localhost:8000/img/label-yolkan@74.png" height="74px" alt="Logo Yolkan">
                <h2 class="my-2">{{ __('Confirma tu correo electrónico') }}</h2>
              </div>
            </div>
            {{ __('Antes de continua, por favor revisa un enlace de verificación en tu correo.') }}
            {{ __('Si no lo has recibido') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aqui para enviar de nuevo.') }}</button>.
            </form>
        </div>
      </div>
  </div>
</section>
@endsection
@section('scripts')
@endsection
