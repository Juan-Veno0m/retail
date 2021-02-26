let form = $('.form'); let flag = false;
form.on('click', 'button[name="modificar"]', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this); let content = btn.parents('.list-group-item');
  if (!btn.hasClass('active')) {
    btn.addClass('active'); btn.text('cancelar');
    /* append */
    content.append('<div class="col-lg-12 content">'+
    '<form class="needs-validation">'+
      '<div class="form-group">'+
        '<label for="replace">Modificar</label>'+
        '<input type="text" class="form-control" id="replace" required>'+
        '<small class="form-text text-muted">Ingresa el nuevo valor.</small>'+
      '</div>'+
      '<div class="form-group">'+
        '<label for="password">Autorizar</label>'+
        '<input type="password" class="form-control" id="password" required>'+
        '<small class="form-text text-muted" id="passhint">Ingresa tu contraseña para autorizar.</small>'+
      '</div>'+
      '<button type="button" class="btn btn-success" name="guardar">Cambiar</button>'+
      '</form>'+
    '</div>');
  }else{btn.removeClass('active'); btn.text('modificar'); content.find('.content').remove();}
});
// guardar send ajax
form.on('click', 'button[name="guardar"]', function(event) {
  event.preventDefault();
  /* Act on the event was-validated */
  let btn = $(this);
  let btnForm = btn.parents('.needs-validation');
  let parentBtn = btn.parents('.list-group-item');
  let action = parentBtn.find('.btn.active').data('label');
  let replace = btnForm.find('#replace').val();
  let password = btnForm.find('#password').val();
  //
  btnForm.addClass('was-validated');
  let error = false;
  if (replace == '' || password == '') {error=true;}
  else{
    error=false;
    if (flag==false) {
      flag=true;
      /* ajax */
      $.ajax({
        url: path+'/Cuenta/Seguridad/update',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        dataType: 'json',
        data: {action: action, replace:replace,password:password}
      })
      .done(function(data) {
        if (data.success==false) {
          btn.removeClass('btn-success'); btn.addClass('btn-danger');
          btnForm.find('#passhint').text('Contraseña incorrecta, verifica nuevamente.');flag=false;
        }else{btn.removeClass('btn-danger'); btn.html('<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-fw fa-lg" style="height: 16px;"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" class=""></path></svg> Guardado');
          setTimeout(function() {
            document.location.reload()
          }, 3000);
        }
      });

    }
  }
});
