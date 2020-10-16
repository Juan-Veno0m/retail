<table class="table table-select table-bordered-bottom" id="tabla-productos">
  <thead>
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">Producto</th>
      <th scope="col">Categoria</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
      <th scope="col">Enviado</th>
      <th scope="col">Recibido</th>
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
        <td name="despachado"><button type="button" name="despachado" class="btn btn-sm btn-primary"><i class="fas fa-shipping-fast"></i> {{$p->UnidadesEnviadas}}</button></td>
        <td name="recibido"><button type="button" name="recibido" class="btn btn-sm btn-success"><i class="fas fa-calendar-check"></i> {{$p->UnidadesRecibidas}}</button></td>
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
