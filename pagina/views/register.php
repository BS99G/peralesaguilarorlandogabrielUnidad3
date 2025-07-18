<?php
require_once '../routes/auth_guard.php';
onlyFor('admin');

$contenido = __DIR__ . '/partials/register_content.php';
include 'layout.php';