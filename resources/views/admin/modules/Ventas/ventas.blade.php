@extends('master-admin')
@section('title', 'Ventas')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <style>
    .btn-xs {
      padding: .2em .6em .3em;
      font-size: 14px;
      line-height: 1;
      border-radius: .25em;
    }
    .table .btn {
      width: 112px;
    }
    .table .dropdown-toggle {
      width: 24px;
    }
    .table-sm th, .table-sm td {font-size: 14px;}
    .table-xs th, .table-xs td {
      padding: 0px 5px;
      font-size: 14px;
      line-height: 1.42857143;
      font-family: 'Arial';
    }
    .btn-default {
      color: #4f4f4f;
      background: #e9ecef;
      border: solid 1px #ced4da;
    }
    .custom-file-ok::after {
      background: #06bd67 !important;
      color: #fff !important;
      content: '\f058' !important;
      font-family: "Font Awesome 5 Free";
    }
    .custom-alert {
      display: none;
      background-color: rgba(0, 0, 0, 0.8);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      outline: none;
      z-index: 1090;
    }
    .custom-alert > .title {
      background-color: #fff;
      position: absolute;
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
      top: 0;
      left: 0;
      width: 100%;
      height: 30px;
      max-height: 30px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.5);
      /*! background-color: rgba(255, 255, 255, 0.1); */
      color: #fff;
      padding: 5px 45px 5px 5px;
      border-bottom: 3px solid #0288D1;
    }
    .custom-alert img {
      border: 1px solid transparent;
      background-color: rgba(28, 41, 49, 0.20);
      width: auto;
      max-width: 90%;
      height: auto;
      max-height: 90%;
      margin: 2.5% auto;
      display: block;
      transition: all 1s;
    }
    .custom-alert .title a {
      position: absolute;
      background-color: transparent;
      display: inline-block;
      border: none;
      color: #fff;
      right: 30px;
      outline: none;
    }
    .custom-alert .title button {
      font-size: 25px;
      position: absolute;
      background-color: transparent;
      display: inline-block;
      border: none;
      color: #fff;
      right: 0;
      top: -6px;
      outline: none;
    }
    td>span:after {
      content: "Primer compra";
      font-size: 10px;
      position: absolute;
      color: #fff;
      background-color: #012626;
      height: 15px;
      border: 1px solid #404040;
      padding: 0px 4px;
      border-radius: 1px;
      bottom: -15px;
    }
    .first {
      position: relative;
      display: flex;
    }
    .table-select > tbody > tr.active {
      border-left: solid 5px #036665;
      background: #c5f2c3;
    }
    .table-bordered-bottom th, .table-bordered-bottom td {
      border-bottom: 1px solid #dee2e6;
      text-align: center;
    }
    .table thead th{
      border-bottom: none;
      background: #2f6766;
      color: #fff;
      border-radius: 12px;
      border-right: solid 2px #fff;
      text-align: center;
    }
    #change .btn-outline-dark.active::before {
      content: "\f058";
      font-family: "Font Awesome 5 Free";
    }
    form .form-control {
      width: 80%;
      text-align: center;
      height: 34px;
      font-size: 12px;
      border: 1px solid #E5EAEE;
      border-radius: 0.85rem !important;
    }
  </style>
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          @include('admin.modules.Ventas.search')
          <table class="table table-select table-bordered-bottom" id="tblVnt">
            <thead>
              <tr>
                <th># Ticket</th>
                <th>Tienda</th>
                <th>Caja</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Operación</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0; ?>
              @foreach ($ventas as $key => $v)
                <tr>
                  <td>{{$v->ventasID}}</td>
                  <td>{{$v->Nombre}}</td>
                  <td>{{$v->CajaID}}</td>
                  <td>${{number_format($v->Total,2)}}</td> <?php $total+=$v->Total; ?>
                  <td>{{$v->paymentMethodAdmin}}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye fa-fw"></i> Opciones</button>
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item btn-sm" target="_blank" name="ticket" href="{{url('ventas/ticket/'.($v->ventasID))}}"><i class="fas fa-ticket-alt fa-fw"></i> Ticket</a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex">
            <div class="col-xl-10">{{ $ventas->links() }}</div>
            <div class="col-xl-2">
              <nav>
                <span class="navbar-text">Total Ventas: ${{number_format($total,2)}}</span>
                <span class="navbar-text">Registros: {{$ventas->total()}}</span>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<script src="{{asset('/js/accounting.min.js')}}" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
  let path = $('.root').data('path'),
  tblVnt= $('#tblVnt');;
  // active tr table products
  tblVnt.on('click', 'tr', function(event) {
    let tr = $(this);
    // find the one
    tr.parents('tbody').find('.active').removeClass('active');
    if (!tr.hasClass('active')) {
      tr.addClass('active');
    }else{tr.removeClass('active');}
  });
  // data range calendar
  $("input[name^=daterange]" ).on( "focus", function() {
    if($(this).data('released')==null){
      $(this).data('released','open');
      $(this).daterangepicker({
          "showCustomRangeLabel": false,
          "locale": {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "a",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
          }
      }, function(start, end, label) {});
    }

  });
</script>
@endsection
