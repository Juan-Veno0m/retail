let path = $('.main-content').data('path');
// Suggestions
$('#search').val('');
$('#search').keyup(function(event) {
  /* Act on the event */
  let search = $(this);
  let group = $(this).parents('.form-suggestions').find('.list-ajax');
  $.ajax({
    url: path+'/Suggestions',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    dataType: 'json',
    data: {term: $(this).val()}
  })
  .done(function(data) {
    let list=''; group.empty(); let url, slug,common;
    let str = ['/',' '];
    $.each(data.data, function(index, el) {
      common = el.ProductosNombre+'-'+el.Cantidad+'-'+el.Unidad;
      slug = common.replace(str,'-').split(" ").join("-");
      url=path+'/producto/'+slug+'/'+parseInt(el.ProductosID+3301);
      list+='<a class="list-group-item" href="'+url+'">'+el.ProductosNombre+' '+el.Cantidad+' '+el.Unidad+'</a>';
    });
    group.append(list); group.show();
  });

});
// on lost focus hide div
$(document).on('focusout', '.form-suggestions', function(event) {
  event.preventDefault();
  /* Act on the event */
  setTimeout(function(){
        var focus=$(document.activeElement);
        if (focus.is(".form-suggestions") || $('.form-suggestions').has(focus).length) {
            console.log("still focused");
        } else {
            $('.form-suggestions').find('.list-group').hide();
        }
    },0);
});
