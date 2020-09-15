@extends('master-admin')
@section('title', 'Localidades')
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
          @include('admin.modules.Localidades.tbl')
        </div>
      </div>
    </div>
    <!-- Modal -->

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" defer></script>
@endsection
