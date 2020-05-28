@extends('master-admin')
@section('title', 'Productos')
@section('description','Administrador Yolkan') <!-- Meta Description -->
@section('content')
  <!-- toolkit -->
  @section('toolkit')
    <a href="#" class="btn btn-sm btn-outline-primary ml-2">Agregar</a>
  @endsection
    <!-- Section  -->
    <div class="container-fluid">
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <form role="search" method="GET" action="{{url('productos/index')}}" class="search d-flex align-items-center">
            <div class="input-group mb-3 icon-search">
              <span><i class="fas fa-search"></i></span>
              <input type="search" name="q" value="{{$q}}" class="form-control" placeholder="Ingrese su busqueda y presione Enter">
            </div>
          </form>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
@endsection
