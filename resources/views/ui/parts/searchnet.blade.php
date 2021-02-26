<form role="search" method="GET" class="search row justify-content-between mb-3 mr-1">
  <div class="input-group col-xl-6 my-2 my-md-0">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
    <input type="search" name="q" value="{{$q}}" class="form-control" placeholder="Ingrese No. de empresario a buscar" disabled>
  </div>
  <div class="form-group col-xl-4 my-2 my-md-0">
    <div class="d-flex align-items-center">
      <label class="mr-3 mb-0 d-none d-md-block">Fecha:</label>
      <input type="month" name="f" class="form-control" value="{{$f}}">
    </div>
  </div>
  <div class="input-group col-xl-1 my-2 my-md-0">
    <button type="submit" class="btn btn-sm btn-light">Buscar</button>
  </div>
</form>
