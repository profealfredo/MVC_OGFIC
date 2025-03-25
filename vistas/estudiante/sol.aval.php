<div class="col-md-9 content">
  <div class="container mt-5">
    <div class="custom-card p-4 rounded-3 shadow">
      <h3 class="text-center mb-3">Solicitud Aval Opción de Grado</h3>
      
      <button type="submit" form="solicitudForm" class="btn btn-primary w-100 mb-3">
        Enviar solicitud de aval de opción de grado...
      </button>
      <p class="text-muted mb-4">
        Nota: Descargar el Formato F-FIC-CG-003-Solicitud-Aprobacion-Opcion-de-Grado y diligenciarlo.
      </p>
      <!-- Formulario de solicitud con id definido -->
      <form id="solicitudForm" method="POST" action="?c=estudiante&a=GuardarSolicitud" enctype="multipart/form-data">
        <div class="gray-section">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="director" class="form-label" >Director sugerido por Estudiante...</label>
              <select class="form-select" id="director" name="director" required>
                <option value="">Seleccionar...</option>
                <?php foreach ($listaDocentes as $doc): ?>
                  <option value="<?= $doc->id_usuario ?>">
                    <?= htmlspecialchars($doc->nombres . ' ' . $doc->apellidos) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="especialidad" class="form-label">Selección de la especialidad...</label>
              <select class="form-select" id="especialidad" name="especialidad" required>
                <option value="">Seleccionar...</option>
                <?php foreach ($listaAreas as $area): ?>
                  <option value="<?= htmlspecialchars($area->area_docente) ?>">
                    <?= htmlspecialchars($area->area_docente) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="modalidad" class="form-label">Selección de la modalidad de opción de grado...</label>
              <select class="form-select" id="modalidad" name="modalidad" required>
                <option value="">Seleccionar...</option>
                <?php foreach ($listaModalidades as $mod): ?>
                  <option value="<?= $mod->id_modalidad ?>">
                    <?= htmlspecialchars($mod->nombre_modalidad) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-12">
            <label for="formato" class="form-label">Adjunte el Formato F-FIC-CG-003 Diligenciado y Firmado</label>
            <input class="form-control" type="file" id="formato" name="formato" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-12">
            <label for="registro" class="form-label">Adjunte su Registro completo Notas SAC</label>
            <input class="form-control" type="file" id="registro" name="registro" required>
          </div>
        </div>
      </form>
    </div>
    <div class="text-center mt-4">
      <a href="?c=estudiante&a=Bienvenida" class="btn btn-primary">Regresar</a>
    </div>
  </div>
</div>
