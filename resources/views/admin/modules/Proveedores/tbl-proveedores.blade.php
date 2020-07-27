<div class="table-responsive" style="min-height:350px;">
  <!-- tabla pedidos -->
  <table class="table" id="tabla-proveedores">
    <thead>
      <tr>
        <th scope="col">No. Registro</th>
        <th scope="col">Empresa</th>
        <th scope="col">Telefono</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($proveedores as $key =>$p)
        <tr data-key="{{$p->ProveedorID+532359}}">
          <td name="NoRegistro">{{$p->ProveedorID+532359}}</td>
          <td name="EmpresaNombre">{{$p->EmpresaNombre}}</td>
          <td name="Telefono">{{$p->Telefono}}</td>
          <td>
            <a type="button" name="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-info"></i> Editar</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="d-flex">
    <div class="col-xl-10">{{ $proveedores->links() }}</div>
    <div class="col-xl-2">
      <nav>
        <span class="navbar-text">Registros: {{$proveedores->total()}}</span>
      </nav>
    </div>
  </div>
</div>
