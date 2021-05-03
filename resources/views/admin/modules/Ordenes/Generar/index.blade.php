@extends('master-admin')
@section('title', 'Generar orden')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
    <style>
      .custom-select, input {
        padding: 8px;
        height: 36px !important;
        font-size: 12px !important;
        color: #3c3b3b !important;
      }
      .input-group-text {font-size: 14px;}
      .bootstrap-select .text {font-size: 12px !important;}
      .btn-default {
        color: #4f4f4f;
        background: #e9ecef;
        border: solid 1px #ced4da;
      }
      #calendar >tbody > tr .hour {
        background: #ffe455;
        position: absolute;
        width: 80px;
        height: 75px;
        padding: 20px;
        border-left: solid 1px #000;
        z-index: 1;
      }
      .day {
        display: block;
        text-align: center;
      }
      .long {
        display: none;
      }
      .short {
        display: block;
        text-align: center;
      }
      #calendar tbody tr > td {
        height: 74px;
        width: 100px;
        border-top: none !important;
        border-bottom: solid 1px #000;
        border-right: solid 1px;
      }
      #calendar > thead > tr th {
        min-width: 74px;
      }

      #calendar > tbody > tr {
        position: relative;
      }
      #calendar tbody .item:hover,#calendar .selected {
        background: #38c172;
        cursor: pointer;
        opacity: 0.7;
      }
      #calendar > tbody > tr .disabled {
        background: #dddada;
        opacity: 0.7;
      }
      #calendar > tbody > tr .full {
        background: #fb6363;
        opacity: 0.7;
      }
    </style>
    <?php $estadosmx = [
      '1' => 'Aguascalientes',
      '2' => 'Baja California',
      '3' => 'Baja California Sur',
      '4' => 'Campeche',
      '5' => 'Chiapas',
      '6' => 'Chihuahua',
      '7' => 'Coahuila de Zaragoza',
      '8' => 'Colima',
      '9' => 'Ciudad de México',
      '10' => 'Durango',
      '11' => 'Guanajuato',
      '12' => 'Guerrero',
      '13' => 'Hidalgo',
      '14' => 'Jalisco',
      '15' => 'Mexico',
      '16' => 'Michoacan de Ocampo',
      '17' => 'Morelos',
      '18' => 'Nayarit',
      '19' => 'Nuevo Leon',
      '20' => 'Oaxaca',
      '21' => 'Puebla',
      '22' => 'Queretaro de Arteaga',
      '23' => 'Quintana Roo',
      '24' => 'San Luis Potosi',
      '25' => 'Sinaloa',
      '26' => 'Sonora',
      '27' => 'Tabasco',
      '28' => 'Tamaulipas',
      '29' => 'Tlaxcala',
      '30' => 'Veracruz-Llave',
      '31' => 'Yucatan',
      '32' => 'Zacatecas',];
      ?>
    <!-- Section  -->
    <div class="row">
      <div class="card col">
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-9 mb-3">
                <label for="empresario">Empresario</label>
                <select class="selectpicker form-control array" data-size="5" name="empresario" id="empresario" data-live-search="true" required>
                  <option selected disabled value="">Seleccione empresario</option>
                  @foreach ($user as $key => $value)
                    <option value="{{$value->UsuarioID }}">{{$value->NoEmpresario.' - '.$value->Nombre.' '.$value->ApellidoPaterno.' '.$value->ApellidoMaterno}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom02">Fecha</label>
                <input type="date" name="fecha" class="form-control array" required>
              </div>
            </div>
            <!-- Envío -->
            @include('admin.modules.Ordenes.Generar.envio')
            <!-- row -->
            <div class="form-row" id="shipping">
              <!-- shipping info -->
              @include('admin.modules.Ordenes.Generar.shipping-info')
              <!-- pickup -->
              @include('admin.modules.Ordenes.Generar.pickup')
            </div>
            <!-- add item -->
            @include('admin.modules.Ordenes.Generar.item-bar')
            <!-- table items -->
            @include('admin.modules.Ordenes.Generar.table-items')
            <!-- button -->
            <button class="btn btn-primary" type="button" id="guardar">Guardar</button>
          </form>
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
@include('admin.modules.Ordenes.Generar.modalshipping')
<script src="{{asset('/js/admin/modules/ordenes/generar/main.js')}}" defer></script>
@endsection
