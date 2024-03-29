<form role="search" method="GET" class="search row align-items-center mb-3 mr-1">
  <div class="input-group icon-search col-xl-5 my-2 my-md-0">
    <span><i class="fas fa-search"></i></span>
    <input type="search" name="q" value="{{$q}}" class="form-control" placeholder="Ingrese No. de Ticket a buscar">
  </div>
  <div class="form-group col-xl-2 my-2 my-md-0">
    <div class="d-flex align-items-center">
      <label class="mr-3 mb-0 d-none d-md-block">Estatus:</label>
      <select class="form-control" name="estatus" disabled>
        <option value="">All</option>
      </select>
    </div>
  </div>
  <div class="form-group col-xl-4 my-2 my-md-0">
    <div class="d-flex align-items-center">
      <label class="mr-3 mb-0 d-none d-md-block">Fecha:</label>
      <input type="text" name="daterange" class="form-control" value="{{$from.' - '.$to}}"/>
    </div>
  </div>
  <div class="input-group col-xl-1 my-2 my-md-0">
    <button type="submit" class="btn btn-sm btn-default">Buscar</button>
  </div>
</form>
