<form method="get" role="search" class="search row align-items-center mb-3 mr-1">
  <div class="input-group col">
    <input class="form-control" type="text" name="q" value="{{$q}}" placeholder="Ingrese el número del asociado a buscar y presione Enter">
    <div class="input-group-prepend">
      <a href="{{url('asociados')}}" class="input-group-text btn" type="button"><i class="fas fa-home"></i></a>
    </div>
  </div>
</form>
