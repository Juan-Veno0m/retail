<table class="table" id="tabla-productos">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Categoria</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $key =>$p)
      <tr data-id="{{$p->ProductosID}}" data-index="{{$loop->index+1}}">
        <th scope="row">{{$p->uk+3303}}</th>
        <td name="producto">{{$p->ProductosNombre.' '.$p->Cantidad.' '.$p->Unidad}}</td>
        <td name="categoria">{{$p->CategoriaNombre}}</td>
        <td name="precio">{{$p->PrecioUnitario}}</td>
        <td name="stock">{{$p->UnidadesEnStock}}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" name="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-edit"></i></button>
            <button type="button" name="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-trash"></i></button>
            <button type="button" name="imagenes" class="btn btn-sm btn-light"><i class="far fa-images"></i></button>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex">
  <div class="col-xl-10">{{ $productos->links() }}</div>
  <div class="col-xl-2">
    <nav>
      <span class="navbar-text">Registros: {{$productos->total()}}</span>
    </nav>
  </div>
</div>