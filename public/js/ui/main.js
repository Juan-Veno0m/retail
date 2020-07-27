// Global
let path = $('.main-content').data('path');
/* Read Cart Number */
$.get(path+"/carrito/read", function(data) {
  if (data.cart!= null) {
    $('.cart-items').html(Object.keys(data.cart).length);
  }
});
// click add to cart from feactured // produts view
$('.product').on('click', '#add-cart', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  add_cart(btn.data('id'),null);
});
// click add to cart from product single
$('.summary').on('click', '.btn-cart', function(event) {
  event.preventDefault();
  /* Act on the event */
  let btn = $(this);
  let quantity = $('.summary .quantity :input[type="number"]').val();
  add_cart(btn.data('id'),quantity);
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
      let alert = $('.notification-cart');
      let src = path+'/uploads/'+data.cart[data.id]['photo'];
      //
      alert.find('.img').attr('src',src);
      alert.find('.title-producto').html(data.cart[data.id]['name']);
      alert.find('.price').html('$'+data.cart[data.id]['price']);
      $('.cart-items').html(Object.keys(data.cart).length);
      alert.css("display", "flex").hide().fadeIn();
      alert.delay(1500).fadeOut("slow");
    }
  });
}
