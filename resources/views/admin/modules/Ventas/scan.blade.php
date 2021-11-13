<div class="form-row pb-3" id="item">
  <div class="col">
    <select class="selectpicker form-control" data-size="8" id="producto" data-live-search="true">
      <option selected disabled value="default">Seleccione producto</option>
      @foreach ($producto as $key => $value)
        <option value="{{$value->ProductosID  }}" data-name="{{$value->ProductosNombre}}" data-sku="{{$value->ProductosID+3303}}"
          data-max="{{$value->UnidadesEnStock}}" data-value="{{number_format($value->PrecioUnitario*2,2)}}" data-by="{{$value->PrecioBy}}">
            {{($value->ProductosID+3303).' - '.$value->ProductosNombre}}
        </option>
      @endforeach
    </select>
  </div>
</div>
