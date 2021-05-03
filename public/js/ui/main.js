// Global
let path = $('.main-content').data('path'); let alert = $('.notification-cart');
// click add to cart from feactured // produts view
$('.product').on('click', '#add-cart', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  add_cart(btn.data('id'),1);
});
// click add to cart from product single
$('.summary').on('click', '.btn-cart', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  add_cart(btn.data('id'),1);
});
// Function add to cart
function add_cart(id,quantity){
  /* ajax */
  $.ajax({
    url: path+'/carrito/create',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    dataType: 'json',
    data: {id: id,quantity:quantity}
  })
  .done(function(data) {
    if (data.tipo == 'success') {
      // Sidebar Cart
      if ( $( ".fixed-cart" ).length ) {
        let url, slug,common; let options='';
        let str = ['/',' '];
        common = data.cart[data.id]['name']+'-'+data.cart[data.id]['unidad'];
        slug = common.replace(str,'-').split(" ").join("-");
        url=path+'/producto/'+slug+'/'+parseInt(data.id);
        // options
        for (var i = 1; i <= data.cart[data.id]['stock']; i++) {
          if (i==data.cart[data.id]['quantity'])
            options+= '<option value="'+i+'" selected>'+i+'</option>';
          else
            options+= '<option value="'+i+'">'+i+'</option>';
        }
        // element
        let item = '<li class="list-group-item" data-keygen="'+data.cart[data.id]['keygen']+'" data-id="'+data.id+'">'+
          '<div class="row">'+
            '<div class="col-xl-3">'+
              '<a href="'+url+'">'+
                '<img src="'+path+'/uploads/'+data.cart[data.id]['photo']+'" class="img-fluid product-thumbnail">'+
              '</a>'+
            '</div>'+
            '<div class="col-xl-9">'+
              '<div class="row">'+
                '<div class="col-xl-9">'+
                  '<div class="form-group">'+
                    '<a href="'+url+'">'+
                      '<p class="title-product">'+data.cart[data.id]['name']+','+data.cart[data.id]['unidad']+'</p>'+
                    '</a>'+
                  '</div>'+
                '</div>'+
                '<div class="col-xl-3 text-xl-right sump">$'+parseInt(data.cart[data.id]['price'] * data.cart[data.id]['quantity'])+'</div>'+
              '</div>'+
            '</div>'+
          '</div>'+
          '<div class="row">'+
            '<div class="col">'+
              '<div class="form-group d-flex">'+
                '<label class="my-1 mr-2" for="quantity">Cantidad</label>'+
                '<select class="custom-select quantity border-0" name="quantity" data-id="'+data.id+'">'+
                  options+
                '</select>'+
              '</div>'+
            '</div>'+
            '<div class="col-lg-4">'+
              '<button class="btn btn-link text-dark remove-from-cart" data-id="'+data.id+'"><u>Eliminar</u></button>'+
            '</div>'+
          '</div>'+
        '</ul>';
        //
        if ($('.fixed-cart #cart-products .no-items').length) { $('.fixed-cart #cart-products').empty();}
        // add item
        $('.fixed-cart #cart-products').append(item);
        // fix sub + shipping + total
        let envio=100; let temp = $('.fixed-cart #money-summary .sub').text().substr(1);
        let sub = parseFloat(temp) +  parseFloat(data.cart[data.id]['price'] * data.cart[data.id]['quantity']);
        $('.fixed-cart #money-summary .sub').text('$'+sub.toFixed(2));
        if (sub>=500) { $('.fixed-cart #money-summary .envio').text('$0.00'); envio=0;}else{$('.fixed-cart #money-summary .envio').text('$'+envio);}
        $('.fixed-cart #money-summary .total').text('$'+(parseFloat(sub)+parseFloat(envio)).toFixed(2));
        // update button action
        let contbtn = $('.btn-action'); let htmlcont='';
        contbtn.empty();
        htmlcont='<label for="cantidad">Cantidad</label>'+
        '<div class="quantity d-block" data-id="'+data.id+'" data-keygen="'+data.cart[data.id]['keygen']+'">'+
          '<span class="input-number-decrement">–</span><input class="input-number" type="text" value="'+data.cart[data.id]['quantity']+'" min="1" max="'+data.stock+'"><span class="input-number-increment">+</span>'+
        '</div>';
        contbtn.append(htmlcont);
      }
      // Alert
      $('.cart-items').html(Object.keys(data.cart).length);
      /* Message content
      alert.find('.title').html('<span class="badge badge-success"><i class="fas fa-check"></i></span>');
      alert.find('.message').html('Agregado correctamente al carrito');
      alert.css("display", "flex").hide().fadeIn();
      alert.delay(2500).fadeOut("slow");
      */
    }
  });
}
// function update item quantity
function updateitem(id,quantity,keygen){
  // ajax
  $.ajax({
    url: path+'/carrito/update',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    dataType: 'json',
    data: {id:id, quantity: quantity,key: keygen}
  })
  .done(function(data) {
    if (data.tipo=='success') {
      // sync value
      $("#cart-products [data-keygen='" + keygen + "']").find('.quantity ').val(quantity);
      // code
      let sub=0; let = sump=0; envio=0; let total=0;
      $.each(data.cart,function(index, el) {
        sub+=parseFloat(el.price)*parseFloat(el.quantity);
        if (el.keygen == keygen) {sump = parseFloat(el.price)*parseFloat(el.quantity)}
      });
      $("#cart-products [data-keygen='" + keygen + "']").find('.sump').html('$'+sump);
      if (sub<500) {envio=100.00;}
      total = parseFloat(sub)+parseFloat(envio);
      $('#money-summary').find('.sub').html('$'+sub);
      $('#money-summary').find('.envio').html('$'+envio);
      $('#money-summary').find('.total').html('<b>$'+total+'</b>');
      /* Message content
      alert.find('.title').html('<span class="badge badge-success"><i class="fas fa-check"></i></span>');
      alert.find('.message').html('Producto actualizado del carrito');
      alert.css("display", "flex").hide().fadeIn();
      alert.delay(2500).fadeOut("slow");*/
    }else{console.log('t',data.tipo, 'e',data.mensaje);}
  });
}
// click delete product
$('#cart-products').on('click', '.remove-from-cart', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  let btnparent = btn.parents('.list-group-item');
  // ajax
  $.ajax({
    url: path+'/carrito/delete',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    dataType: 'json',
    data: {id: btn.data('id'),key: btnparent.data('keygen')}
  })
  .done(function(data) {
    if (data.tipo=='success') {
      // code
      let sub=0; let envio=0; let total=0;
      $.each(data.cart,function(index, el) {
        sub+=parseFloat(el.price)*parseFloat(el.quantity);
      });
      btnparent.remove();
      if (sub<500) {envio=100.00;} if (sub==0) {envio=0;}
      total = parseFloat(sub)+parseFloat(envio);
      $('#money-summary').find('.sub').html('$'+sub);
      $('#money-summary').find('.envio').html('$'+envio);
      $('#money-summary').find('.total').html('<b>$'+total+'</b>');
      // Message content
      $('.cart-items').html(Object.keys(data.cart).length); // update item numbers
      alert.find('.title').html('<span class="badge badge-success"><i class="fas fa-check"></i></span>');
      alert.find('.message').html('Producto eliminado del carrito');
      alert.css("display", "flex").hide().fadeIn();
      alert.delay(2500).fadeOut("slow");
      /// update data from single product
      $('.btn-action').empty();
      $('.btn-action').append('<button type="button" class="btn btn-warning btn-cart" data-id="'+btnparent.data('keygen')+'">Agregar al Carrito</button>')
    }else{console.log('t',data.tipo, 'e',data.mensaje);}
  });

});
// click edit quantity
$('#cart-products').on('change', '.quantity', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  let btnparent = btn.parents('.list-group-item');
  $('.input-number').val(btn.val()); // sync value
  updateitem(btn.data('id'),btn.val(),btnparent.data('keygen'));
});
// on number change from quantity
$('.summary').on('click','.input-number-increment ,.input-number-decrement', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this).parents('.quantity');
  if (!$(this).data('lock') == true) {
    updateitem(btn.data('id'),btn.find('.input-number').val(),btn.data('keygen'));
  }
});
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
