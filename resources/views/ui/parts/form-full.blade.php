<section class="ftco-section contact-section">
  <div class="container">
    <div class="row block-9">
      <div class="col">
        <div class="bg-white p-5 contact-form needs-validation">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control array" placeholder="Nombre" name="nombre" required>
          </div>
          <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control array" placeholder="Correo eléctronico" name="correo" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control array" placeholder="Télefono" name="telefono" required>
          </div>
          <div class="form-group">
            <label for="asunto">Departamento:</label>
            <select class="form-control custom-select array" name="asunto" required>
              <option selected="" value="">Departamento...</option>
              <option value="Información General">Información General</option>
              <option value="Tienda en linea">Tienda en linea</option>
              <option value="Afiliación">Afiliación</option>
            </select>
          </div>
          <div class="form-group">
            <label for="mensaje">Mensaje:</label>
            <textarea cols="30" rows="7" class="form-control array" placeholder="Mensaje" name="mensaje" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Enviar mensaje" class="btn btn-dark btn-lg">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
