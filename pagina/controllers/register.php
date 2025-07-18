<?php
session_start();
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
    die("Acceso denegado");
}

require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? 'usuario';

    $usuario = new User();

    // Verifica si el correo ya está registrado
    $existe = $usuario->verificarLogin($correo, $password); // Este método busca por correo
    if ($existe) {
        echo "El correo ya está registrado. <a href='../views/register.php'>Volver</a>";
        exit;
    }

    $resultado = $usuario->registrar($nombre, $correo, $password, $rol);

    if ($resultado) {
        echo "Usuario registrado correctamente. <a href='../views/login.php'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar el usuario. <a href='../views/register.php'>Volver</a>";
    }
}
