@extends('master-ui')
@section('title', 'Producto')
@section('description','Tienda en linea Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button
    {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type=number]
    {
      -moz-appearance: textfield;
    }

    .quantity input {
      font-size: 18px;
      width: 75px;
      height: 42px;
      line-height: 1.65;
      float: left;
      display: block;
      padding: 0;
      margin: 0;
      padding-left: 20px;
      border: 1px solid #eee;
    }

    .quantity input:focus {
      outline: 0;
    }

    .quantity-nav {
      float: left;
      position: relative;
      height: 42px;
    }

    .quantity-button {
      position: relative;
      cursor: pointer;
      border-left: 1px solid #eee;
      width: 20px;
      text-align: center;
      color: #333;
      font-size: 13px;
      font-family: "Trebuchet MS", Helvetica, sans-serif !important;
      line-height: 1.7;
      -webkit-transform: translateX(-100%);
      transform: translateX(-100%);
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      user-select: none;
    }

    .quantity-button.quantity-up {
      position: absolute;
      height: 50%;
      top: 0;
      border-bottom: 1px solid #eee;
    }

    .quantity-button.quantity-down {
      position: absolute;
      bottom: -1px;
      height: 50%;
    }
  </style>
  <div class="breadcrumb">@include('ui.parts.breadcrumbs')</div>
  <div class="container my-3">
    <div class="row">
      <!-- Col Slider -->
      <div class="col-xl-6">@include('ui.parts.product-slider')</div>
      <!-- Col Description -->
      <div class="col-xl-6 my-4">@include('ui.parts.product-description')</div>
    </div>
  </div>
  <div class="container my-4">
    <div class="row">
      <div class="col">@include('ui.parts.product-related')</div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function() {
    var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });
  // Change img src
  $('#gallery-tab').on('click', '.child-picture > img ', function(event) {
    event.preventDefault();
    /* Act on the event */
    let img = $(this);
    let src = img.attr('src');
    $('#gallery-tab').find('#main-picture > img').attr('src',src);
  });
</script>
@endsection
