<div class="modal fade needs-validation" id="form-asociados" tabindex="-1" role="dialog" aria-labelledby="form-asociados" aria-hidden="true">
  <?php $estadosmx = [
			'1' => 'Aguascalientes',
			'2' => 'Baja California',
			'3' => 'Baja California Sur',
			'4' => 'Campeche',
			'5' => 'Chiapas',
			'6' => 'Chihuahua',
			'7' => 'Coahuila de Zaragoza',
			'8' => 'Colima',
			'9' => 'Ciudad de México',
			'10' => 'Durango',
			'11' => 'Guanajuato',
			'12' => 'Guerrero',
			'13' => 'Hidalgo',
			'14' => 'Jalisco',
			'15' => 'Mexico',
			'16' => 'Michoacan de Ocampo',
			'17' => 'Morelos',
			'18' => 'Nayarit',
			'19' => 'Nuevo Leon',
			'20' => 'Oaxaca',
			'21' => 'Puebla',
			'22' => 'Queretaro de Arteaga',
			'23' => 'Quintana Roo',
			'24' => 'San Luis Potosi',
			'25' => 'Sinaloa',
			'26' => 'Sonora',
			'27' => 'Tabasco',
			'28' => 'Tamaulipas',
			'29' => 'Tlaxcala',
			'30' => 'Veracruz-Llave',
			'31' => 'Yucatan',
			'32' => 'Zacatecas',
		]; ?>
  <div class="modal-dialog modal-xl">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <span class="mr-3"><img src="http://localhost:8000/img/label-yolkan@36.png" height="36px"></span>
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="visible">
          <div class="row messages"></div>
          <div class="form-row">
            <div class="form-group input-group-sm input-group-sm col-lg-5">
              <label for="noasociado">Número de Asociado</label>
              <input type="text" class="form-control array" name="noasociado" placeholder="Número de asociado" required>
            </div>
            <div class="form-group input-group-sm col-lg-2">
              <label for="iniciales">Iniciales</label>
              <input type="text" class="form-control array" name="iniciales" placeholder="Iniciales" required>
            </div>
            <div class="form-group input-group-sm col-lg-5">
              <label for="fecha">Fecha de Solicitud</label>
              <input type="date" class="form-control array" name="fecha" required>
            </div>
          </div>
          <!-- Nombre -->
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-4">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control array" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="ApellidoP">Apellido Paterno</label>
              <input type="text" class="form-control array" name="ApellidoP" placeholder="Apellido Paterno" required>
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="ApellidoM">Apellido Materno</label>
              <input type="text" class="form-control array" name="ApellidoM" placeholder="Apellido Materno" required>
            </div>
          </div>
          <!-- Dirección -->
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-8">
              <label for="direccion">Dirección</label>
              <input type="text" class="form-control array" name="direccion" placeholder="Dirección" required>
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="Colonia">Colonia</label>
              <input type="text" class="form-control array" name="Colonia" placeholder="Colonia" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-7">
              <label for="Ciudad">Ciudad</label>
              <input type="text" class="form-control array" name="Ciudad" placeholder="Ciudad" required>
            </div>
            <div class="form-group input-group-sm col-lg-3">
              <label for="Estado">Estado</label>
              <select name="estado" class="custom-select array validated" name="Estado" required>
                <option value="">Selecciona</option>
                @for ($i=1; $i <=32; $i++)
                  <option value="{{$i}}">{{$estadosmx[$i]}}</option>
                @endfor
              </select>
            </div>
            <div class="form-group input-group-sm col-lg-2">
              <label for="CP">CP</label>
              <input type="text" class="form-control array" name="CP" placeholder="CP" required>
            </div>
          </div>
          <!-- Telefonos -->
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-4">
              <label for="telefonoc">Telefono (casa)</label>
              <input type="text" class="form-control array" name="telefonoh" placeholder="Teléfono casa" required>
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="telefonop">Teléfono (celular)</label>
              <input type="text" class="form-control array" name="telefonop" placeholder="Teléfono celular">
            </div>
            <div class="form-group input-group-sm col-lg-1">
              <label for="Sexo">Sexo</label>
              <input type="text" class="form-control array" name="Sexo" placeholder="M/F" required>
            </div>
            <div class="form-group input-group-sm col-lg-3">
              <label for="Nacimiento">Fecha de Nacimiento</label>
              <input type="date" class="form-control array" name="Nacimiento" required>
            </div>
          </div>
          <!-- RFC -->
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-8">
              <label for="RFC">RFC</label>
              <input type="text" class="form-control array" name="RFC" placeholder="RFC">
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="Homoclave">Homoclave</label>
              <input type="text" class="form-control array" name="Homoclave" placeholder="Homoclave">
            </div>
          </div>
          <!-- Presentador -->
          <div class="form-row">
            <div class="form-group input-group-sm col-lg-3">
              <label for="NoPresentador">No Presentador</label>
              <input type="text" class="form-control array" name="NoPresentador" placeholder="No Presentador">
            </div>
            <div class="form-group input-group-sm col-lg-2">
              <label for="inicialesp">Iniciales</label>
              <input type="text" class="form-control" name="inicialesp" disabled>
            </div>
            <div class="form-group input-group-sm col-lg-4">
              <label for="nombrep">Nombre</label>
              <input type="text" class="form-control" name="nombrep" disabled>
            </div>
            <div class="form-group input-group-sm col-lg-3">
              <label for="telefonop">Teléfono</label>
              <input type="text" class="form-control" name="telefonop" disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group" role="group" aria-label="Basic example">
          <a type="button" class="btn btn-dark btn-sm ml-3" name="save">Guardar</a>
        </div>
      </div>
    </div>
  </div>
</div>
