<?php
session_start();
require_once '../models/User.php';

if ($_SESSION['usuario_rol'] !== 'admin') {
    die("Unauthorized access");
}

$id = $_GET['id'] ?? null;


if ($id && $id != $_SESSION['usuario_id']) {
    $usuario = new User();
    $usuario->eliminarUsuario($id);
}

header("Location: ../views/admin_panel.php");
exit;

