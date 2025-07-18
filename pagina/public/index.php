<?php
session_start();

if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    // No logueado → login
    header("Location: ../views/login.php");
    exit;
}

// Logueado → redirigir según rol
if ($_SESSION['usuario_rol'] === 'admin') {
    header("Location: ../views/admin_dashboard.php");
} elseif ($_SESSION['usuario_rol'] === 'usuario') {
    header("Location: ../views/user_dashboard.php");
} else {
    // Rol desconocido → cerrar sesión por seguridad
    session_destroy();
    header("Location: ../views/login.php");
}
exit;
