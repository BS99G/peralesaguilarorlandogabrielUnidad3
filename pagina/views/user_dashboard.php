<?php
require_once '../routes/auth_guard.php';
onlyFor('usuario');

$contenido = __DIR__ . '/partials/user_dashboard_content.php';
include 'layout.php';