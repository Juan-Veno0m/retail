<fieldset class="parent">
    <div class="card-body needs-validation shipping">
        <div class="form-group row">
          <h2 class="fs-title col-xl-8 ml-3">Información de envío</h2>
          <div class="custom-control custom-radio text-left" id="shipping-edit">
            <input type="checkbox" id="radio-shipping" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="radio-shipping">Editar</label>
          </div>
        </div>
        <div class="container-fluid mt-3 text-left">
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="fullname">Nombre y apellido</label>
              <input type="text" class="form-control validated" name="fullname" placeholder="ej: Jorge Perez" maxlength="50" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label for="postalcode">Código postal</label>
              <input type="text" class="form-control validated" name="postalcode" placeholder="ej: 48430" maxlength="6" required>
            </div>
            <div class="col-sm-6">
              <label for="telefono">Teléfono de contacto</label>
              <input type="tel" class="form-control validated" name="telefono" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Ej: 222-123-1234" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="estado">Estado</label>
              <select name="estado" class="custom-select validated" required>
                <option value="">Selecciona</option>
                @for ($i=1; $i <=32; $i++)
                  <option value="{{$i}}">{{$estadosmx[$i]}}</option>
                @endfor
              </select>
            </div>
            <div class="col-sm-6">
              <label for="delegacion">Delegación / Municipio</label>
              <input type="text" class="form-control validated" name="delegacion" placeholder="ej: Puebla" maxlength="50" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label for="colonia">Colonia / Asentamiento</label>
              <input type="text" class="form-control validated" name="colonia" placeholder="ej: Serdán" maxlength="70" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="Calle">Calle</label>
              <input type="text" class="form-control validated" name="Calle" maxlength="70" required>
            </div>
            <div class="col-sm-6">
              <label for="exterior">Nº exterior</label>
              <input type="text" class="form-control validated" name="exterior" maxlength="7" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-5">
              <label for="interior">Nº Interior / Depto (opcional)</label>
              <input type="text" class="form-control validated" maxlength="120" name="interior">
            </div>
          </div>
          <label class="form-group">¿Entre qué calles está? (opcional)</label>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="Calle1">Calle 1</label>
              <input type="text" class="form-control validated" maxlength="50" name="Calle1">
            </div>
            <div class="col-sm-6">
              <label for="Calle2">Calle 2</label>
              <input type="text" class="form-control validated" maxlength="50" name="Calle2">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="adicional">Indicaciones adicionales para entregar tus compras en esta dirección</label>
              <textarea class="form-control validated" maxlength="120" name="adicional"></textarea>
            </div>
          </div>
        </div>
    </div>
    <button type="button" name="update" class="update btn btn-success btn-lg d-none">Actualizar información de envío</button>
    <button type="button" name="next" class="next btn btn-success btn-lg"> Siguiente </button>
</fieldset>
