<h2 class="mb-4"><i class="bi bi-envelope-arrow-up-fill"></i> Recuperar Contraseña</h2>

<form action="../controllers/send_token.php" method="POST" class="col-md-6">
    <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="correo" id="correo" required>
    </div>
    <button type="submit" class="btn btn-warning w-100">Enviar enlace</button>
</form>
