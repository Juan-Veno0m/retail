@extends('master-ui')
@section('title', 'Contacto')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
    <!-- Section Content Header -->
    @include('ui.parts.hero-wrap')
    <!-- Section Form contact -->
    @include('ui.parts.form-full')
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
