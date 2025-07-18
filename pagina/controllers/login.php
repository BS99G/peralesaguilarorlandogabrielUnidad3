<?php
session_start();
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    $usuario = new User();
    $resultado = $usuario->verificarLogin($correo, $password);

    if ($resultado) {
        // Guardar datos en sesión
        $_SESSION['usuario_id'] = $resultado['id'];
        $_SESSION['usuario_nombre'] = $resultado['nombre'];
        $_SESSION['usuario_rol'] = $resultado['rol'];
        $_SESSION['logueado'] = true;

        // Guardar session_id en BD para control de multisesiones
        $usuario->guardarSessionID($resultado['id'], session_id());

        // Redirigir según el rol
        if ($resultado['rol'] === 'admin') {
            header("Location: ../views/admin_dashboard.php");
        } else {
            header("Location: ../views/user_dashboard.php");
        }
        exit;
    } else {
        echo "Correo o contraseña incorrectos. <a href='../views/login.php'>Volver</a>";
    }
}
