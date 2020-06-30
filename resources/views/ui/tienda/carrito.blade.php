@extends('master-ui')
@section('title', 'Carrito')
@section('description','Tienda en linea Yolkan')
@section('content')
    <style>
      .product-thumbnail {
        object-fit: cover;
        height: 128px;
        border-radius: 8px;
      }
      .title-product {
        text-transform: capitalize;
        font-size: 1.2em;
        color: #000;
      }
    </style>
    <!-- Section items -->
    @include('ui.parts.cart-main')
@endsection
@section('scripts')
<script>
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
        if (sub<500) {envio=100.00;}
        total = parseFloat(sub)+parseFloat(envio);
        $('#money-summary').find('.sub').html('$'+sub);
        $('#money-summary').find('.envio').html('$'+envio);
        $('#money-summary').find('.total').html('<b>$'+total+'</b>');
      }else{console.log('t',data.tipo, 'e',data.mensaje);}
    });

  });
  // click edit quantity
  $('#cart-products').on('change', '.quantity', function(event) {
    event.preventDefault();
    /* Act on the event */
    let btn = $(this);
    let btnparent = btn.parents('.list-group-item');
    // ajax
    $.ajax({
      url: path+'/carrito/update',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      dataType: 'json',
      data: {id:btn.data('id'), quantity: btn.val(),key: btnparent.data('keygen')}
    })
    .done(function(data) {
      if (data.tipo=='success') {
        // code
        let sub=0; let = sump=0; envio=0; let total=0;
        $.each(data.cart,function(index, el) {
          sub+=parseFloat(el.price)*parseFloat(el.quantity);
          if (el.keygen == btnparent.data('keygen')) {sump = parseFloat(el.price)*parseFloat(el.quantity)}
        });
        btnparent.find('.sump').html('$'+sump);
        if (sub<500) {envio=100.00;}
        total = parseFloat(sub)+parseFloat(envio);
        $('#money-summary').find('.sub').html('$'+sub);
        $('#money-summary').find('.envio').html('$'+envio);
        $('#money-summary').find('.total').html('<b>$'+total+'</b>');
      }else{console.log('t',data.tipo, 'e',data.mensaje);}
    });
  });
</script>
<!-- Modal Form -->
@include('ui.parts.login-form')
@endsection
