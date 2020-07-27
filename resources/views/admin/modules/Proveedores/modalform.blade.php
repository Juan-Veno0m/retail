<!-- Modal -->
<div class="modal fade" id="form-proveedores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <span class="icon"><i class="fas fa-truck"></i></span>
          Proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid needs-validation form">
          <div class="form-group">
            <label for="EmpresaNombre">Nombre de empresa *</label>
            <input type="text" class="form-control form-control-sm array" name="EmpresaNombre" placeholder="Campo requerido" required>
          </div>
          <div class="form-group">
            <label for="Direccion">Direccion</label>
            <input type="text" class="form-control form-control-sm array" name="Direccion">
            <span class="badge badge-info">Datos de la empresa.</span>
          </div>
          <div class="form-group">
            <label for="Ciudad">Ciudad</label>
            <input type="text" class="form-control form-control-sm array" name="Ciudad">
          </div>
          <div class="form-group">
            <label for="Region">Municipio</label>
            <input type="text" class="form-control form-control-sm array" name="Region">
          </div>
          <div class="form-group">
            <label for="CodigoPostal">Código postal</label>
            <input type="text" class="form-control form-control-sm array" name="CodigoPostal">
          </div>
          <div class="form-group">
            <label for="Pais">Pais</label>
            <input type="text" class="form-control form-control-sm array" name="Pais" value="México">
          </div>
          <div class="form-group">
            <label for="Telefono">Teléfono *</label>
            <input type="text" class="form-control form-control-sm array" name="Telefono" placeholder="Campo requerido" required>
          </div>
          <div class="form-group">
            <label for="Web">Página web /Facebook</label>
            <input type="text" class="form-control form-control-sm array" name="Web">
          </div>
          <div class="form-group">
            <label for="ContactoNombre">Nombre de contacto</label>
            <input type="texxt" class="form-control form-control-sm array" name="ContactoNombre">
            <span class="badge badge-info">Información del contacto.</span>
          </div>
          <div class="form-group">
            <label for="ContactoTitulo">Cargo</label>
            <input type="text" class="form-control form-control-sm array" name="ContactoTitulo">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aplicar cambios</button>
      </div>
    </div>
  </div>
</div>
