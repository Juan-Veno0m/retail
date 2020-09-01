<form role="search" method="GET" class="search row align-items-center mb-3 mr-1">
  <div class="input-group icon-search col-xl-5 my-2 my-md-0">
    <span><i class="fas fa-search"></i></span>
    <input type="search" name="q" value="{{$q}}" class="form-control" placeholder="Ingrese su busqueda">
  </div>
  <div class="form-group col-xl-3 my-2 my-md-0">
    <div class="d-flex align-items-center">
      <label class="mr-3 mb-0 d-none d-md-block">Categoria:</label>
      <select class="selectpicker form-control" name="categoria" data-live-search="true">
        <option value="">All</option>
        @foreach ($categorias as $key => $value)
          @if ($c == $value->CategoriaID)
            <option value="{{$value->CategoriaID}}" selected>{{$value->CategoriaNombre}}</option>
          @else
            <option value="{{$value->CategoriaID}}">{{$value->CategoriaNombre}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group col-xl-3 my-2 my-md-0">
    <div class="d-flex align-items-center">
      <label class="mr-3 mb-0 d-none d-md-block">Proveedor:</label>
      <select class="selectpicker form-control" name="proveedor" data-live-search="true">
        <option value="" selected>All</option>
        @foreach ($proveedores as $key => $value)
          @if ($p == $value->ProveedorID)
            <option value="{{$value->ProveedorID }}" selected>{{$value->EmpresaNombre}}</option>
          @else
            <option value="{{$value->ProveedorID }}">{{$value->EmpresaNombre}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="input-group col-xl-1 my-2 my-md-0">
    <button type="submit" class="btn btn-outline-dark">Buscar</button>
  </div>
</form>
