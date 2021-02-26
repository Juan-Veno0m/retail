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
