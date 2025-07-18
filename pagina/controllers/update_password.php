<?php
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $nueva = $_POST['password'] ?? '';

    $usuario = new User();
    $usuario_info = $usuario->buscarPorToken($token);

    if ($usuario_info) {
        $usuario->actualizarPassword($usuario_info['id'], $nueva);
        echo "Contraseña actualizada correctamente. <a href='../views/login.php'>Iniciar sesión</a>";
    } else {
        echo "Token inválido o expirado. <a href='../views/recuperar.php'>Reintentar</a>";
    }
}
