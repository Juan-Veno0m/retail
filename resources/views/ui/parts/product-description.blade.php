<div class="row summary">
  <div class="col-xl-12"><h2 class="product-tittle">{{$producto->ProductosNombre}}</h2></div>
  <div class="product-seperator-line"></div>
  <div class="col-xl-12">
    <span class="product-price">{{ '$'.number_format($producto->PrecioUnitario*2,2)}}</span>
  </div>
  <div class="product-seperator-line"></div>
  <div class="col-xl-12 mt-2">
    <div class="quantity">
      <input type="number" min="1" max="9" step="1" value="1">
    </div>
    <button type="button" class="btn btn-dark btn-cart ml-3" data-id="{{$id}}">Agregar al Carrito</button>
  </div>
  <div class="col-xl-12 mt-4">
    <div class="d-block">
      <span><b>SKU:&nbsp;</b>{{$ProductosID}}</span>
    </div>
    <div class="d-block">
      <span><b>Categoria:&nbsp;</b>{{$producto->CategoriaNombre}}</span>
    </div>
  </div>
  <div class="col-xl-12 mt-3">
    <div class="accordion description" id="accordionExample">
      <div class="card">
        <div class="card-header bg-white" id="headingOne">
          <h2 class="mb-0">
            <a class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Descripción <div class="float-right"><i class="fas fa-plus"></i></div>
            </a>
          </h2>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <p>{{$producto->Descripcion}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
