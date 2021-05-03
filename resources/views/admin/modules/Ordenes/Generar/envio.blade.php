<div class="form-row pt-3 border-top">
  <div class="col-md-3 mb-3">
    <label for="TipoEnvio">Tipo de envío</label>
    <select class="custom-select array" id="TipoEnvio" name="TipoEnvio" required>
      <option selected disabled value="">Seleccione tipo envio</option>
      <option value="1">Local</option>
      <option value="2">Pickup</option>
      <option value="3">Paquetería</option>
    </select>
  </div>
  <div class="col-md-3 mb-3">
    <label for="Paqueteria">Paquetería</label>
    <select class="custom-select array" name="Paqueteria" id="Paqueteria" disabled>
      <option selected value="">Seleccione paquetería</option>
      <option value="2">DHL</option>
      <option value="3">Fed Ex</option>
      <option value="4">Estafeta</option>
      <option value="5">Redpack</option>
      <option value="6">UPS</option>
    </select>
  </div>
  <div class="col-md-4 mb-3">
    <label for="Rastreo">Código de rastreo</label>
    <input type="text" class="form-control array" name="Rastreo" id="Rastreo" disabled>
  </div>
  <div class="col-md-2 mb-3">
    <label for="Costo">Costo</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text bg-white">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512" width="12px" height="12px"><path fill="currentColor" d="M211.9 242.1L95.6 208.9c-15.8-4.5-28.6-17.2-31.1-33.5C60.6 150 80.3 128 105 128h73.8c15.9 0 31.5 5 44.4 14.1 6.4 4.5 15 3.8 20.5-1.7l22.9-22.9c6.8-6.8 6.1-18.2-1.5-24.1C240.4 74.3 210.4 64 178.8 64H176V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48h-2.5C60.3 64 14.9 95.8 3.1 143.6c-13.9 56.2 20.2 111.2 73 126.3l116.3 33.2c15.8 4.5 28.6 17.2 31.1 33.5C227.4 362 207.7 384 183 384h-73.8c-15.9 0-31.5-5-44.4-14.1-6.4-4.5-15-3.8-20.5 1.7l-22.9 22.9c-6.8 6.8-6.1 18.2 1.5 24.1 24.6 19.1 54.6 29.4 86.3 29.4h2.8v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48h2.5c49.2 0 94.6-31.8 106.4-79.6 13.9-56.2-20.2-111.2-73-126.3z"></path></svg>
        </div>
      </div>
      <input type="text" class="form-control array" name="costoenvio" id="costoenvio" disabled>
    </div>
  </div>
</div>
