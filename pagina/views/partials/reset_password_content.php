<h2 class="mb-4"><i class="bi bi-shield-lock-fill"></i> Nueva Contraseña</h2>

<form action="../controllers/update_password.php" method="POST" class="col-md-6">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <div class="mb-3">
        <label for="password" class="form-label">Nueva contraseña</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Actualizar</button>
</form>
