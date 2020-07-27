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
                <img src="{{asset('/img/label-yolkan@74.png')}}" height="74px" alt="Logo Yolkan">
                <h2 class="my-2">{{ __('Confirma tu correo electrónico') }}</h2>
              </div>
            </div>
            <?php $email = Auth::user()->email ?>
            {{ __('Antes de continuar, por favor Verifica tu correo electrónico ').$email }}
            {{ __('y busca el mensaje de confirmación, Sigue los pasos que aparecen en el mensaje.') }}
            <form class="form-group mt-3" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-lg text-primary"><i class="fas fa-forward"></i> {{ __('Reenviar correo de verificación.') }}</button>
            </form>
            <button class="btn btn-lg text-secondary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> Corregir correo</button>
        </div>
      </div>
  </div>
</section>
@endsection
@section('scripts')
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Corregir correo electrónico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{url('email/fix')}}">
            @csrf
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
            </div>
            <button type="submit" class="btn btn-dark">Corregir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
