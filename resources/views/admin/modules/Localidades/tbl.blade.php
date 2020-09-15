<table class="table table-select table-bordered-bottom" id="tabla-localidades">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Estado</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($local as $key =>$lo)
      <tr>
        <th scope="row">{{$loop->index+1}}</th>
        <td name="Nombre">{{$lo->nombre}}</td>
        <td name="Estado">{{$lo->estado}}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" name="editar" title="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-edit"></i></button>
            <button type="button" name="eliminar" title="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-trash"></i></button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex">
  <div class="col-xl-10">{{ $local->links() }}</div>
  <div class="col-xl-2">
    <nav>
      <span class="navbar-text">Registros: {{$local->total()}}</span>
    </nav>
  </div>
</div>
