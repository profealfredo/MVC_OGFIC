<!-- Main content -->
<div class="col-md-9 content">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-card p-4">
      <div class="row align-items-center">
        <!-- Columna del logo -->
        <div class="col-auto text-center">
          <img src="assets/images/logo2.png" alt="Universidad Santo Tomás" class="img-fluid logo">
        </div>
        <!-- Columna del formulario -->
        <div class="col">
          <h6 class="mb-4 text-center">Registro en el Sistema OGFIC</h6>
          <form method="POST" action="?c=usuario&a=Guardar">
            <!-- Campos comunes -->
            <div class="form-group mb-3 text-center">
              <input type="email" class="form-control input-custom mx-auto" name="email" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group mb-3 text-center">
              <input type="password" class="form-control input-custom mx-auto" name="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group mb-3 text-center">
              <select class="form-control input-custom mx-auto" name="rol" id="rolSelect" required>
                <option value="">Seleccione rol</option>
                <option value="estudiante">Estudiante</option>
                <option value="docente">Docente</option>
                <option value="admin">Administrador</option>
              </select>
            </div>
            <div class="form-group mb-3 text-center">
              <input type="text" class="form-control input-custom mx-auto" name="nombres" placeholder="Nombres" required>
            </div>
            <div class="form-group mb-3 text-center">
              <input type="text" class="form-control input-custom mx-auto" name="apellidos" placeholder="Apellidos" required>
            </div>
            <div class="form-group mb-3 text-center">
              <input type="text" class="form-control input-custom mx-auto" name="cedula" placeholder="Cédula" required>
            </div>
            
            <!-- Campos adicionales para Estudiante -->
            <div id="estudianteFields" style="display: none;">
              <div class="form-group mb-3 text-center">
                <input type="text" class="form-control input-custom mx-auto" name="codigo" placeholder="Código (Estudiante)">
              </div>
            </div>
            <!-- Campos adicionales para Docente -->
            <div id="docenteFields" style="display: none;">
              <div class="form-group mb-3 text-center">
                <select class="form-control input-custom mx-auto" name="area_docente">
                  <option value="">Seleccione área docente</option>
                  <option value="aguas">Aguas</option>
                  <option value="administrativo">Administrativo</option>
                  <option value="estructuras">Estructuras</option>
                  <option value="suelos">Suelos</option>
                  <option value="vías">Vías</option>
                </select>
              </div>
            </div>
            <!-- Fin de campos adicionales -->
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary input-custom mx-auto">Registrarse</button>
            </div>
          </form>
          <!-- Enlaces centrados dentro de la columna -->
          <div class="text-center mt-3">
            <a href="#" class="link-secondary">☑️ Consulte los requisitos previos para el registro</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script para mostrar/ocultar campos según rol -->
<script>
  document.getElementById('rolSelect').addEventListener('change', function() {
    var rol = this.value;
    // Ocultar ambos grupos
    document.getElementById('estudianteFields').style.display = 'none';
    document.getElementById('docenteFields').style.display = 'none';
    // Mostrar campos según rol
    if (rol === 'estudiante') {
      document.getElementById('estudianteFields').style.display = 'block';
    } else if (rol === 'docente') {
      document.getElementById('docenteFields').style.display = 'block';
    }
  });
</script>
