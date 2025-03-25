<div class="col-md-9 content">
  <div class="container my-5">
    <h2 class="mb-4 text-center">Lista de Usuarios</h2>
    <div class="table-responsive">
      <table class="table-success table-striped table-sm align-middle">
        <thead class="encabezado-azul-oscuro">
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th style="width: 150px;">Password</th>
            <th>Rol</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cédula</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->modelo->Listar() as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r->id_usuario) ?></td>
              <td><?= htmlspecialchars($r->email) ?></td>
              <td class="password-column"><?= htmlspecialchars($r->password) ?></td>
              <td><?= htmlspecialchars($r->rol) ?></td>
              <td><?= htmlspecialchars($r->nombres) ?></td>
              <td><?= htmlspecialchars($r->apellidos) ?></td>
              <td><?= htmlspecialchars($r->cedula) ?></td>
              <td>
                <!-- Botón Editar -->
                <a href="?c=usuario&a=Editar&id=<?= $r->id_usuario ?>" 
                   class="btn btn-sm btn-warning" 
                   title="Editar">
                   <i class="bi bi-arrow-repeat icon-large"></i>
                </a>

                <!-- Botón Eliminar -->
                <a href="?c=usuario&a=Eliminar&id=<?= $r->id_usuario ?>" 
                   class="btn btn-sm btn-danger icon-large" 
                   title="Eliminar" 
                   onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
