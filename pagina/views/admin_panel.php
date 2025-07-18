<?php
require_once '../routes/auth_guard.php';
onlyFor('admin');

require_once '../models/User.php';
$userModel = new User();
$usuarios = $userModel->getAllUsers();

$contenido = __DIR__ . '/partials/admin_panel_content.php';
include 'layout.php';