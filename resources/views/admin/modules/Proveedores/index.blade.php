@extends('master-admin')
@section('title', 'Proveedores')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <!-- toolkit -->
  @section('toolkit')
    <a class="btn btn-sm btn-secondary ml-2" name="agregar-proveedores" data-toggle="modal" data-target="#form-proveedores">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!-- Search Form - Filter -->
          @include('admin.modules.Proveedores.search')
          <!-- tbl proveedores -->
          @include('admin.modules.Proveedores.tbl-proveedores')
        </div>
      </div>
    </div>
    <!-- Modal -->
    @include('admin.modules.Proveedores.modalform')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
<script src="{{asset('/js/admin/modules/proveedores/main.js?x=1')}}" defer></script>
@endsection
