<table class="table table-select table-bordered-bottom" id="tabla-productos">
  <thead>
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">Producto</th>
      <th scope="col">Categoria</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($productos as $key =>$p)
      <tr data-id="{{$p->ProductosID}}" data-index="{{$p->uk+3303}}">
        <th scope="row">{{$p->uk+3303}}</th>
        <td name="producto">{{$p->ProductosNombre.' '.$p->Cantidad.' '.$p->Unidad}}</td>
        <td name="categoria">{{$p->CategoriaNombre}}</td>
        <td name="precio">{{$p->PrecioUnitario}}</td>
        <?php $string='btn-light'; if ($p->UnidadesEnStock==0) {$string='btn-danger';} ?>
        <td name="stock"><button type="button" name="stock" class="btn btn-sm {{$string}}" value="{{$p->UnidadesEnStock}}"><i class="fas fa-layer-group"></i> {{$p->UnidadesEnStock}}</button></td>
        <td>
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" name="editar" title="editar" class="btn btn-sm btn-light mr-3"><i class="fas fa-edit"></i></button>
            <button type="button" name="eliminar" title="eliminar" class="btn btn-sm btn-light mr-3"><i class="fas fa-trash"></i></button>
            <button type="button" name="imagenes" title="imagenes" class="btn btn-sm btn-light mr-3"><i class="far fa-images"></i></button>
            <!-- <button type="button" name="localidades" title="localidades" class="btn btn-sm btn-light mr-3"><i class="fas fa-city"></i></button> -->
            <?php if ($p->Descontinuado== 0) {
              // false then on
              $icon = '<i class="fas fa-toggle-on"></i>';}else{$icon= '<i class="fas fa-toggle-off"></i>';} ?>
            <button type="button" name="descontinuado" title="habilitar / deshabilitar" class="btn btn-sm btn-light" value="{{$p->Descontinuado}}"><?php echo $icon ?></button>
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
