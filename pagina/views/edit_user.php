<?php
require_once '../routes/auth_guard.php';
onlyFor('admin');

require_once '../models/User.php';
$userModel = new User();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid user ID");
}

$usuario = $userModel->getUserById($id);
if (!$usuario) {
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <h2>Edit User: <?php echo htmlspecialchars($usuario['nombre']); ?></h2>
        <form action="../controllers/update_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="rol" class="form-select" required>
                    <option value="usuario" <?php if ($usuario['rol'] === 'usuario') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">💾 Save Changes</button>
            <a href="admin_panel.php" class="btn btn-secondary">⬅ Back</a>
        </form>
    </div>
</body>
</html>
