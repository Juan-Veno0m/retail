<table class="table table-select table-bordered-bottom" id="tabla-compras">
  <thead>
    <tr>
      <th scope="col">Orden</th>
      <th scope="col">Fecha</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Total</th>
      <th scope="col">Estatus</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($compras as $key =>$c)
      <tr data-orden="{{$c->ComprasID+24500}}" data-prov="{{$c->EmpresaNombre}}" data-total="{{$c->Total}}" data-key="{{$c->key}}">
        <th scope="row">{{$c->ComprasID+24500}}</th>
        <td name="FechaCompra">{{$c->FechaCompra}}</td>
        <td name="EmpresaNombre">{{$c->EmpresaNombre}}</td>
        <td name="Total">${{$c->Total}}</td>
        <td name="status"><button type="button" name="status" title="status" class="btn btn-sm {{$c->attribute}}" value="{{$c->Compra_Status}}">{{$c->status}}</button></td>
        <td>
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <a name="pago" title="pago" class="btn btn-sm btn-light mr-3"><i class="fas fa-money-check-alt"></i> Pago</a>
            <a name="envio" title="envio" class="btn btn-sm btn-light mr-3"><i class="fas fa-shipping-fast"></i> Envío</a>
            <a name="detalles" title="detalles" class="btn btn-sm btn-light mr-3"><i class="fas fa-clipboard-list"></i> detalles</a>
            <a target="_blank" href="{{url('/inventarios/compras/orden/'.($c->ComprasID+24500))}}" name="pdf" title="pdf" class="btn btn-sm btn-light mr-3"><i class="fas fa-file-pdf"></i> PDF</a>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex">
  <div class="col-xl-10">{{ $compras->links() }}</div>
  <div class="col-xl-2">
    <nav>
      <span class="navbar-text">Registros: {{$compras->total()}}</span>
    </nav>
  </div>
</div>
