<h2 class="mb-4 text-center"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</h2>

<?php if (isset($_GET['error']) && $_GET['error'] === 'multisesion'): ?>
<div class="alert alert-warning">⚠️ Tu sesión fue cerrada porque otro dispositivo inició sesión.</div>
<?php endif; ?>

<form action="../controllers/login.php" method="POST" class="col-md-6 offset-md-3">
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" name="correo" id="correo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Entrar</button>
    <div class="mt-3 text-center">
        <a href="recover.php" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
    </div>
</form>
