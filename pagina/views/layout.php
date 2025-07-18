<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioNombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
$usuarioRol = $_SESSION['usuario_rol'] ?? 'guest';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sitio Seguro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos opcionales -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar-brand i {
            margin-right: 5px;
        }
        footer {
            background: #212529;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
        }
        .content-wrapper {
            min-height: 80vh;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-shield-lock"></i> Sitio Seguro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($usuarioRol === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_panel.php"><i class="bi bi-people"></i> Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php"><i class="bi bi-person-plus"></i> Registrar</a></li>
                    <?php elseif ($usuarioRol === 'usuario'): ?>
                        <li class="nav-item"><a class="nav-link" href="user_dashboard.php"><i class="bi bi-house"></i> Inicio</a></li>
                    <?php endif; ?>
                </ul>
                <span class="navbar-text text-white me-3">
                    <i class="bi bi-person-circle"></i> <?= htmlspecialchars($usuarioNombre) ?>
                </span>
                <a href="../controllers/logout.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container my-4 content-wrapper">
        <?php
        // Aquí se carga la vista específica
        if (isset($contenido)) {
            include $contenido;
        } else {
            echo "<div class='alert alert-warning'>No se encontró contenido para mostrar.</div>";
        }
        ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; <?= date('Y') ?> Sitio Seguro. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_SESSION['toast'])): ?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="liveToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?= $_SESSION['toast'] ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<?php unset($_SESSION['toast']); endif; ?>


</body>
</html>
