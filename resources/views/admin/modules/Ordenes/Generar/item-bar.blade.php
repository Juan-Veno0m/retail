<div class="form-row border-top pt-3" id="item">
  <div class="col-md-6 mb-3">
    <label for="producto">Producto:</label>
    <select class="selectpicker form-control" data-size="8" id="producto" data-live-search="true">
      <option selected disabled value="default">Seleccione producto</option>
      @foreach ($producto as $key => $value)
        <option value="{{$value->ProductosID  }}" data-name="{{$value->ProductosNombre}}" data-sku="{{$value->ProductosID+3303}}"
          data-max="{{$value->UnidadesEnStock}}" data-value="{{number_format($value->PrecioUnitario*2,2)}}">
            {{($value->ProductosID+3303).' - '.$value->ProductosNombre}}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="costo">Costo unitario:</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512" width="12px" height="12px"><path fill="currentColor" d="M211.9 242.1L95.6 208.9c-15.8-4.5-28.6-17.2-31.1-33.5C60.6 150 80.3 128 105 128h73.8c15.9 0 31.5 5 44.4 14.1 6.4 4.5 15 3.8 20.5-1.7l22.9-22.9c6.8-6.8 6.1-18.2-1.5-24.1C240.4 74.3 210.4 64 178.8 64H176V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48h-2.5C60.3 64 14.9 95.8 3.1 143.6c-13.9 56.2 20.2 111.2 73 126.3l116.3 33.2c15.8 4.5 28.6 17.2 31.1 33.5C227.4 362 207.7 384 183 384h-73.8c-15.9 0-31.5-5-44.4-14.1-6.4-4.5-15-3.8-20.5 1.7l-22.9 22.9c-6.8 6.8-6.1 18.2 1.5 24.1 24.6 19.1 54.6 29.4 86.3 29.4h2.8v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48h2.5c49.2 0 94.6-31.8 106.4-79.6 13.9-56.2-20.2-111.2-73-126.3z"></path></svg>
        </div>
      </div>
      <input type="text" class="form-control" id="costo" disabled>
    </div>
  </div>
  <div class="col-md-1 mb-3">
    <label for="cantidad">Cantidad:</label>
    <input type="text" class="form-control" id="cantidad">
  </div>
  <div class="col-md-2 mt-4">
    <button class="btn btn-light" type="button" name="agregar">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="14px" height="14px">
        <path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"</path>
      </svg>
      Agregar
    </button>
  </div>
</div>
