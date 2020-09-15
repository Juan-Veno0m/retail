@extends('master-admin')
@section('title', 'Asociados')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .loading {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      text-align: center;
      background: #ffffff36;
      bottom: 0;
    }
    .loading .title {
      font-size: 30px;
      color: #343a40;
      font-weight: 700;
    }.message {font-size: 15px;}
  </style>
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-asociados">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          @include('admin.modules.Asociados.search')
          <!-- tbl asociados -->
          <div class="table-responsive" style="min-height:350px;">
            <!-- tabla pedidos -->
            <table class="table" id="tabla-proveedores">
              <thead>
                <tr>
                  <th scope="col">No. Empresario</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Iniciales</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($asociados as $key =>$p)
                  <tr class="root">
                    <td name="NoEmpresario">{{$p->NoEmpresario}}</td>
                    <td name="Nombre">{{$p->ApellidoPaterno.' '.$p->ApellidoMaterno.' '.$p->Nombre}}</td>
                    <td name="Iniciales">{{$p->Iniciales}}</td>
                    <td name="Solicitud">{{$p->FechaSolicitud}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" name="editar" class="btn btn-sm btn-light mr-3" data-id="{{$p->id}}" data-key="{{$p->NoEmpresario}}" data-name="{{$p->Nombre}}"><i class="fas fa-eye"></i> Detalles</a>
                        <a type="button" name="acceso" class="btn btn-sm btn-light mr-3" data-id="{{$p->id}}" data-key="{{$p->NoEmpresario}}" data-name="{{$p->Nombre}}"><i class="fas fa-key"></i> Acceso</a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex">
              <div class="col-xl-10">{{ $asociados->links() }}</div>
              <div class="col-xl-2">
                <nav>
                  <span class="navbar-text">Registros: {{$asociados->total()}}</span>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Access -->
    @include('admin.modules.Asociados.modal-access')
    <!-- Modal Form Asociados -->
    @include('admin.modules.Asociados.modal-asociados')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<script>
  let accessmodal = $('#access-modal'); let path = $('.root').data('path'); let flag= false;
  let formasociados = $('#form-asociados'); let formcontent= $('.visible'); let TblProv = $('#tabla-proveedores');
  // generar contraseña
  function generar() {
    let caracteres = "a9b{cde7fgh+¡2ijk3mnpq46rtuv[wxyzABCD7E3FGH}IJKLMNPQRTU[VWXYZ8$@$!%*?.&_-}[";
    let password = "";
    re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?.&_-]|[^ ]){8,15}$/;
    for (var i = 0; i < 1; i++) {
      for (x=0; x<=12; x++) password += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    }
    return password;
  }
  // test password streng
  function validatePassword(password) {

      // Do not show anything when the length of password is zero.
      if (password.length === 0) {
          document.getElementById("msg").innerHTML = "";
          return;
      }
      // Create an array and push all possible values that you want in password
      var matchedCase = new Array();
      matchedCase.push("[$@$!%*#?&]"); // Special Charector
      matchedCase.push("[A-Z]");      // Uppercase Alpabates
      matchedCase.push("[0-9]");      // Numbers
      matchedCase.push("[a-z]");     // Lowercase Alphabates

      // Check the conditions
      var ctr = 0;
      for (var i = 0; i < matchedCase.length; i++) {
          if (new RegExp(matchedCase[i]).test(password)) {
              ctr++;
          }
      }
      // Display it
      var color = "";
      var strength = "";
      switch (ctr) {
          case 0:
          case 1:
          case 2:
              strength = "Muy debil";
              color = "red";
              break;
          case 3:
              strength = "Regular";
              color = "orange";
              break;
          case 4:
              strength = "Fuerte";
              color = "green";
              break;
      }
      accessmodal.find('.fa-key').css('color', color);
      accessmodal.find('#text-help').html('Tu contraseña es '+strength);
  }
  // on click generate password
  $('body').on('click', '#generador', function(event) {
    event.preventDefault();
    /* Act on the event */
    let hash = generar();
    accessmodal.find('#password').val(hash);
  });
  // test password
  $('body').on('click', 'a[name="test"]', function(event) {
    event.preventDefault();
    let btn = accessmodal.find('#password').val();
    console.log('click');
    /* Act on the event */
    if (btn!="") {
      validatePassword(btn);
    }
  });
  // click access user
  TblProv.on('click', 'a[name= "acceso"]', function(event) {
    event.preventDefault();
    let key = $(this).data('key'); let body=''; let array = {};
    let name =  $(this).data('name'); let id = $(this).data('id');
    accessmodal.find('.modal-title').empty();
    /* Act on the event */
    $.ajax({
      url: path+'/asociados/acceso',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id:id }
    })
    .done(function(data) {
      //
      accessmodal.find('#email').val(null);accessmodal.find('#password').val(null);
      if (data.email) {
        // fill input and action update
        accessmodal.find('#email').val(data.email);
        accessmodal.find('a[name="save"]').data('action','update');
        accessmodal.find('a[name="save"]').data('id',data.id);
        array['id'] = accessmodal.find('a[name="save"]').data('id');
        accessmodal.find('.messages').html('<div class="alert alert-success col">Credenciales de acceso</div>');
      }else{
          // title and action set
          array['name'] = name; array['AsociadosID'] = id;
          accessmodal.find('a[name="save"]').data('action','create');
          accessmodal.find('.messages').html('<div class="alert alert-warning col">No se han generado las credenciales</div>');
      }
      accessmodal.find('.modal-title').html('Acceso para asociado No.'+key);
      accessmodal.modal('show'); // modalform.modal('toggle');
      accessmodal.on('click', 'a[name="save"]', function(event) {
        event.preventDefault();
        /* Act on the event */
        Swal.fire({
          title: '¿Estás seguro de continuar?',
          icon: 'warning',
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonColor: '#595959',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, continuar!'
        }).then((result) => {
          if (result.value) {
            /* get values */
            array['action'] = accessmodal.find('a[name="save"]').data('action');
            array['email'] = accessmodal.find('#email').val();
            array['password'] = accessmodal.find('#password').val();
            /* send ajax */
            $.ajax({
              url: path+'/asociados/acceso_tx',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'POST',
              dataType: 'json',
              data: {array:array}
            })
            .done(function(data) {
              switch(data.tipo) {
                case 200:
                  //
                  accessmodal.find('.messages').empty();
                  accessmodal.find('.messages').append('<div class="alert alert-success col" role="alert">Credenciales generadas</div>');
                  Swal.fire(
                    'Cambios aplicados!',
                    'La información se aplico correctamente.',
                    'success'
                  );
                  break;
                case 501:
                  //
                  Swal.fire(
                    'Correo duplicado',
                    'El correo ya existe en el sistema.',
                    'warning'
                  );
                  break;
                case 502:
                  //
                  Swal.fire(
                    'Correo duplicado',
                    'El correo ya existe con otro asociado.',
                    'warning'
                  );
                  break;
              }
            });
          }
        }); // end confirm
      });
    });

  });
  // click Detalles
  TblProv.on('click', 'a[name="editar"]', function(event) {
    event.preventDefault(); let btn = $(this);
    /* Act on the event */
    formasociados.find('a[name="save"]').data('action','update');
    /* ajax */
    $.ajax({
      url: path+'/asociados/detalles',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id: btn.data('id')}
    })
    .done(function(data) {
      if (data.tipo==200) {
        // empty and setup
        $('#form-asociados .array').val('');
        /* set */
        formasociados.find('[name="noasociado"]').val(data.data.NoEmpresario);
        formasociados.find('[name="iniciales"]').val(data.data.Iniciales);
        formasociados.find('[name="fecha"]').val(data.data.FechaSolicitud);
        /* second line */
        formasociados.find('[name="nombre"]').val(data.data.Nombre);
        formasociados.find('[name="ApellidoP"]').val(data.data.ApellidoPaterno);
        formasociados.find('[name="ApellidoM"]').val(data.data.ApellidoMaterno);
        // 3tr
        formasociados.find('[name="direccion"]').val(data.dir.Direccion);
        formasociados.find('[name="Colonia"]').val(data.dir.Colonia);
        // fourth line
        formasociados.find('[name="Ciudad"]').val(data.dir.Ciudad);
        formasociados.find('[name="estado"]').val(data.dir.EstadoID);
        formasociados.find('[name="CP"]').val(data.dir.CP);
        // 5th
        formasociados.find('[name="telefonoh"]').val(data.tel[0].Telefono);
        //formasociados.find('[name="telefonop"]').val(data.dir.telefonop);
        formasociados.find('[name="Sexo"]').val(data.data.Sexo);
        formasociados.find('[name="Nacimiento"]').val(data.data.FechaNacimiento);
        formasociados.modal('show');}
      else{console.log(data.tipo);}

    });
  });
  /* Asociados Modal */
  $('a[name="agregar-asociados"]').click(function(event) {
    /* Act on the event */
    formasociados.find('a[name="save"]').data('action','create');
    formasociados.modal('show');
  });
  /* on save action */
  formasociados.on('click', 'a[name="save"]', function(event) {
    event.preventDefault();
    /* Act on the event */
    let btn = $(this);
    formasociados.addClass('was-validated');
    formasociados.find('.loading').remove();
    /* verificar */
    let error=0; let arraydata= {};
    $('#form-asociados .array').map(function () {
      if ($(this).val()=="" && $(this).prop('required')) {error++;}
      else{ arraydata[$(this).attr("name")] = $(this).val();}
    }).get();
    if (error>0) {Swal.fire('Por favor, llene los campos requeridos'); flag_agregar_producto=false;}
    else {
      // ready for send ajax
      if (flag == false) {
        // true
        flag=true;
        arraydata['action'] = formasociados.find('a[name="save"]').data('action');
        formcontent.css({ opacity: 0.1 });
        formasociados.find('.modal-body').append('<div class="loading d-flex align-items-center"><div class="col-12">'+
          '<h3 class="title">Guardando cambios</h3>'+
          '<div class="message">Por favor, espere...</div>'+
          '<img class="icon" src="https://thumbs.gfycat.com/LameDifferentBalloonfish-small.gif" height="350">'+
        '</div></div>');
        /* ajax */
        $.ajax({
          url: path+'/asociados/action',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: 'POST',
          dataType: 'json',
          data: {arraydata:arraydata}
        })
        .done(function(data) {
          /* done */
          if (data.tipo==200) {
            formasociados.find('.loading .title').html('Asociado creado');
            formasociados.find('.loading .message').html(data.mensaje);
            formasociados.find('.loading .icon').attr('src', 'https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png');
            setTimeout(function() {
              document.location.reload()
            }, 3000);
          }else if (data.tipo==500) {
            formasociados.find('.loading .title').html('Ocurrió un problema');
            formasociados.find('.loading .message').html(data.mensaje);
            formasociados.find('.loading .icon').attr('src', 'https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Close_Icon_Dark-512.png');
            // then close div
            setTimeout(function() {
              flag=true;formcontent.css({ opacity: 1 });formasociados.find('.loading').remove();
              formasociados.find('input[name="noasociado"]').val('');
            }, 3000);
          }
        });

      }
      else{Swal.fire('Espere un momento, mientras finaliza.');}

    }
  });
</script>
@endsection
