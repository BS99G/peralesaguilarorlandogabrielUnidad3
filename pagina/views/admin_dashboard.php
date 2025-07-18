<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['logueado']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require_once '../routes/auth_guard.php';
onlyFor('admin');

$contenido = __DIR__ . '/partials/admin_dashboard_content.php';
include 'layout.php';
?>

