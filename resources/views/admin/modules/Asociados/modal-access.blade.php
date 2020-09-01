<div class="modal fade needs-validation" id="access-modal" tabindex="-1" role="dialog" aria-labelledby="access-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row messages"></div>
        <div class="form-row">
          <div class="form-group col-12">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="ingrese el correo electronico del asociado">
          </div>
          <div class="form-group col-12">
            <label for="password">Contraseña</label>
            <div class="input-group">
              <input type="text" class="form-control" id="password" placeholder="Ingrese contraseña o genere una automaticamente">
              <div class="input-group-prepend">
                <a class="input-group-text btn" id="generador"><i class="fas fa-key"></i></a>
              </div>
            </div>
            <small class="form-text text-dark" id="text-help"></small>
          </div>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-warning btn-sm" name="test">Probar contraseña</a>
            <a type="button" class="btn btn-dark btn-sm ml-3" name="save" data-action="create">Guardar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
