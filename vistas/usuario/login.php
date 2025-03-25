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
                    <h5 class="mb-4 text-center">Iniciar Sesión</h5>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form action="?c=usuario&a=IniciarSesion" method="POST">
                        <div class="form-group mb-3 text-center">
                            <input type="email" class="form-control input-custom mx-auto" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group mb-3 text-center">
                            <input type="password" class="form-control input-custom mx-auto" name="password" placeholder="Contraseña" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary input-custom mx-auto">Iniciar Sesión</button>
                        </div>
                    </form>
                    <!-- Enlaces centrados dentro de la columna -->
                    <div class="text-center mt-3">
                        <a href="#" class="link-secondary">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
