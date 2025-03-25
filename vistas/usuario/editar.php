<div class="col-md-9 content"> 
<div class="container my-5">
  <h2 class="mb-4 text-center">Editar Usuario</h2>
  <form method="POST" action="?c=usuario&a=Actualizar">
    <!-- Campo oculto con el id del usuario -->
    <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario->id_usuario) ?>">

    <!-- Datos comunes -->
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($usuario->email) ?>" required>
    </div>
    <div class="mb-3">
      <label for="rol" class="form-label">Rol</label>
      <select name="rol" id="rolSelect" class="form-select" required>
        <option value="estudiante" <?= $usuario->rol === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
        <option value="docente" <?= $usuario->rol === 'docente' ? 'selected' : '' ?>>Docente</option>
        <option value="admin" <?= $usuario->rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="nombres" class="form-label">Nombres</label>
      <input type="text" name="nombres" id="nombres" class="form-control" value="<?= htmlspecialchars($usuario->nombres) ?>" required>
    </div>
    <div class="mb-3">
      <label for="apellidos" class="form-label">Apellidos</label>
      <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= htmlspecialchars($usuario->apellidos) ?>" required>
    </div>
    <div class="mb-3">
      <label for="cedula" class="form-label">Cédula</label>
      <input type="text" name="cedula" id="cedula" class="form-control" value="<?= htmlspecialchars($usuario->cedula) ?>" required>
    </div>

    <!-- Campos específicos para Estudiante -->
    <div id="estudianteFields" style="display: <?= $usuario->rol === 'estudiante' ? 'block' : 'none' ?>;">
      <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" class="form-control" 
               value="<?= isset($estudiante->codigo) ? htmlspecialchars($estudiante->codigo) : '' ?>">
      </div>
    </div>

    <!-- Campos específicos para Docente -->
    <div id="docenteFields" style="display: <?= $usuario->rol === 'docente' ? 'block' : 'none' ?>;">
      <div class="mb-3">
        <label for="area_docente" class="form-label">Área Docente</label>
        <select name="area_docente" id="area_docente" class="form-select">
          <option value="">Seleccione área docente</option>
          <option value="aguas" <?= (isset($docente) && $docente->area_docente === 'aguas') ? 'selected' : '' ?>>Aguas</option>
          <option value="administrativo" <?= (isset($docente) && $docente->area_docente === 'administrativo') ? 'selected' : '' ?>>Administrativo</option>
          <option value="estructuras" <?= (isset($docente) && $docente->area_docente === 'estructuras') ? 'selected' : '' ?>>Estructuras</option>
          <option value="suelos" <?= (isset($docente) && $docente->area_docente === 'suelos') ? 'selected' : '' ?>>Suelos</option>
          <option value="vías" <?= (isset($docente) && $docente->area_docente === 'vías') ? 'selected' : '' ?>>Vías</option>
        </select>
      </div>
    </div>

    <!-- Botones -->
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      <a href="?c=usuario" class="btn btn-primary">Cancelar</a>
    </div>
  </form>
</div>

<!-- Script para mostrar/ocultar campos según el rol seleccionado -->
<script>
  document.getElementById('rolSelect').addEventListener('change', function() {
    var rol = this.value;
    document.getElementById('estudianteFields').style.display = (rol === 'estudiante') ? 'block' : 'none';
    document.getElementById('docenteFields').style.display = (rol === 'docente') ? 'block' : 'none';
  });
</script>

</div>