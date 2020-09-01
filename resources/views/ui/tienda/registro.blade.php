@extends('master-ui')
@section('title', 'Registro')
@section('description','Queremos que tu negocio sea exitoso y generes ganancias con Yolkan desde el inicio, por esto es importante que trabajes enfocado y te visualices como empresario.') <!-- Meta Description -->
@section('content')
    <style>
      .hero-wrap{
        background-image: url('{{asset('/img/business-team.jpg')}}');
        background-size: contain;border-bottom:
        solid 2px #cbe0fe;
      }
      .lines {
        margin-left: 25px;
        position: relative;
      }
      .line-1 {
        content: '';
        left: 0;
        right: 0;
        position: absolute;
        background: #28599a;
        height: 3px;
        z-index: 1;
        top: 62px;
      }
      .line-2 {
        content: '';
        left: 80px;
        right: 0;
        position: absolute;
        background: #75a1de;
        height: 3px;
        z-index: 1;
        top: 68px;
      }
      .line-3 {
        content: '';
        left: 160px;
        right: 0;
        position: absolute;
        background: #9ec8ff;
        height: 3px;
        z-index: 1;
        top: 74px;
      }
      .line-4 {
        content: '';
        left: 260px;
        right: 0;
        position: absolute;
        background: #e5e5e5;
        height: 3px;
        z-index: 1;
        top: 80px;
      }
    </style>
    <!-- Section Content Header -->
    <div class="hero-wrap hero-bread">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated"></div>
        </div>
      </div>
    </div>
    <!-- Section Form contact -->
    <section class="ftco-section contact-section">
      <div class="container">
        <div class="lines">
          <h1 class="mb-0 bread">@yield('title')</h1>
          <span class="line-1"></span>
          <span class="line-2"></span>
          <span class="line-3"></span>
          <span class="line-4"></span>
        </div>
        <div class="row block-9">
          <div class="col">
            <div class="bg-white p-5 contact-form needs-validation">
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control array" placeholder="Nombre" name="nombre" required>
              </div>
              <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control array" placeholder="Correo eléctronico" name="correo" required>
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control array" placeholder="Télefono" name="telefono" required>
              </div>
              <div class="form-group">
                <label for="asunto">Departamento:</label>
                <select class="form-control custom-select array" name="asunto" required>
                  <option selected value="Afiliación">Afiliación</option>
                </select>
              </div>
              <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea cols="30" rows="7" class="form-control array" placeholder="Mensaje" name="mensaje" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Enviar mensaje" class="btn btn-success btn-lg">
              </div>
            </div>
            <div class="lines">
              <span class="line-1"></span>
              <span class="line-2"></span>
              <span class="line-3"></span>
              <span class="line-4"></span>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('scripts')
  <script>
    $('.contact-form').on('click', '.btn', function(event) {
      event.preventDefault();
      /* Act on the event */
      let btn = $(this);
      let btnParent = btn.parents('.contact-form');
      /* set array */
      let error=0; let arraydata={};
      btnParent.find('.array').map(function () {
        if ($(this).val()=="" && $(this).prop('required')) {error++;}
        else if($(this).is(":invalid")){error++;}
        else{ arraydata[$(this).attr("name")] = $(this).val();}
      }).get();
      btnParent.addClass('was-validated');
      if (error>0) {
        console.log(error);
      }
      else{
        btn.val('Enviando mensaje...');
        /* Ajax */
        $.ajax({
          url: 'email/contacto',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          data: {arraydata:arraydata}
        })
        .done(function(data) {
          if (data.mensaje == 'ok') { btn.val('Mensaje enviado correctamente'); btn.prop( "disabled", true );
          btnParent.find('.array').val("");btnParent.removeClass('was-validated');
          }
        });
      }

    });
  </script>
@endsection
