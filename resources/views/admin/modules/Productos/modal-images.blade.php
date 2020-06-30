<div class="modal fade needs-validation" id="form-images" tabindex="-1" role="dialog" aria-labelledby="form-images" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Imagenes del Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <nav>
          <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-crear-imagenes-tab" data-toggle="tab" href="#nav-crear-imagenes" role="tab" aria-controls="nav-crear-imagenes" aria-selected="true"><i class="far fa-image"></i> Agregar Fotos</a>
            <a class="nav-item nav-link" id="nav-cargar-imagenes-tab" data-toggle="tab" href="#nav-cargar-imagenes" role="tab" aria-controls="nav-cargar-imagenes" aria-selected="false"><i class="far fa-images"></i> Ver Fotos</a>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-crear-imagenes" role="tabpanel" aria-labelledby="nav-crear-imagenes-tab">
            <div class="row">
              <div class="col-md-12">
                <form action="{{url('/productos/images/create')}}" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                  @csrf
                  <input type="hidden" name="producto">
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-cargar-imagenes" role="tabpanel" aria-labelledby="nav-cargar-imagenes-tab">
            <div class="container">
              <div class="row justify-content-end my-2">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" name="actualizar" class="btn btn-sm btn-outline-secondary"><i class="fas fa-sync"></i> Sync</button>
                    <button type="button" name="editar" class="btn btn-sm btn-outline-secondary disabled"><i class="far fa-edit"></i> Editar</button>
                    <button type="button" name="eliminar" class="btn btn-sm btn-outline-secondary"><i class="far fa-trash-alt"></i> Eliminar</button>
                    <button type="button" name="principal" class="btn btn-sm btn-outline-secondary"><i class="fas fa-camera-retro"></i> Principal</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="container-imagenes"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
