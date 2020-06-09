<div class="modal fade" id="form-producto" tabindex="-1" role="dialog" aria-labelledby="form-producto" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xl-12">
            <div class="form-group row">
              <label class="col-xl-12 col-form-label text-left" for="producto">Producto:</label>
              <div class="col-xl-12">
                <div class="input-group input-group-solid">
                  <input type="text" name="producto" class="form-control form-control-solid validated" placeholder="Nombre del Producto" aria-label="producto" aria-describedby="producto">
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="form-group row">
              <label class="col-xl-12 col-form-label text-left" for="proveedor">Proveedor:</label>
              <div class="col-xl-12">
                <div class="input-group input-group-solid">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                  </div>
                  <select class="selectpicker my-select" name="proveedor" data-width="90%" data-live-search="true">
                    <option value="0" selected>-- seleccionar proveedor --</option>
                    @foreach ($proveedores as $key => $value)
                      <option value="{{$value->ProveedorID }}">{{$value->EmpresaNombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="form-group row">
              <label class="col-xl-12 col-form-label text-left" for="categoria">Categoria:</label>
              <div class="col-xl-12">
                <div class="input-group input-group-solid">
                  <select class="selectpicker my-select" name="categoria" data-width="100%" data-live-search="true">
                    <option value="0">-- seleccionar categoria --</option>
                    @foreach ($categorias as $key => $value)
                      <option value="{{$value->CategoriaID}}">{{$value->CategoriaNombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="form-group row">
              <label class="col-xl-12 col-form-label text-left" for="unidad">Unidad:</label>
              <div class="col-xl-12">
                <div class="input-group input-group-solid">
                  <input type="text" name="cantidad" class="form-control form-control-solid validated" placeholder="Cantidad" aria-label="Cantidad" aria-describedby="Cantidad">
                  <select name="unidad" class="custom-select form-control form-control-solid col-xl-4 validated" id="inputGroupSelect01">
                    <option value="" selected>-- seleccione unidad --</option>
                    <option value="kg">kg</option>
                    <option value="gr">gr</option>
                    <option value="l">l</option>
                    <option value="ml">ml</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="form-group row">
              <label class="col-xl-12 col-form-label text-left" for="precio">Precio Unitario:</label>
              <div class="col-xl-12">
                <div class="input-group input-group-solid">
                  <input type="number" step="0.5" min="1" name="precio" class="form-control form-control-solid validated" placeholder="Precio del Producto" aria-label="producto" aria-describedby="producto">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardar-producto">Guardar</button>
      </div>
    </div>
  </div>
</div>
