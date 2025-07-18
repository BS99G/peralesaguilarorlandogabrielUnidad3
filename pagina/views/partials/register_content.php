<h2 class="mb-4"><i class="bi bi-person-plus-fill"></i> Registrar Usuario</h2>

<form action="../controllers/register.php" method="POST" class="col-md-6">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>
    <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="correo" id="correo" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" id="rol" class="form-select">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary w-100">Registrar</button>
</form>
