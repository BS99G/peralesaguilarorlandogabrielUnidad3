<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/User.php';

if (!isset($_SESSION['logueado']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../views/login.php");
    exit;
}

// Verificar multisesión
$usuario = new User();
$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT session_id FROM usuarios WHERE id = :id";
$conn = (new Database())->conectar();
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $usuario_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row || $row['session_id'] !== session_id()) {
    session_destroy();
    header("Location: ../views/login.php?error=multisesion");
    exit;
}

// Validar rol (solo si se llama la función)
function onlyFor($role) {
    if ($_SESSION['usuario_rol'] !== $role) {
        header("Location: ../views/access_denied.php");
        exit;
    }
}
