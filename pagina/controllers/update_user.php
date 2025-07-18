<?php
session_start();
require_once '../models/User.php';

if ($_SESSION['usuario_rol'] !== 'admin') {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];

    $usuario = new User();
    $usuario->actualizarUsuario($id, $nombre, $rol);
    
    header("Location: ../views/admin_panel.php");
    exit;
}
