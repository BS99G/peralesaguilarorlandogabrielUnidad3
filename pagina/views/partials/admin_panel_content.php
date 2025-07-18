<h2 class="mb-4"><i class="bi bi-people-fill"></i> Lista de Usuarios</h2>
<a href="register.php" class="btn btn-success mb-3"><i class="bi bi-person-plus-fill"></i> Registrar nuevo usuario</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Creado en</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nombre']) ?></td>
            <td><?= htmlspecialchars($u['correo']) ?></td>
            <td><?= $u['rol'] ?></td>
            <td><?= $u['creado_en'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="../controllers/delete_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
