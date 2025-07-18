<?php
require_once '../models/User.php';
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $token = bin2hex(random_bytes(32)); // token único

    $usuario = new User();
    $usuario->generarTokenRecuperacion($correo, $token);

    // Enviar correo
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Host = 'smtp.gmail.com'; // o smtp.mailtrap.io si estás en desarrollo
        $mail->SMTPAuth = true;
        $mail->Username = 'nexusgamingsuppo@gmail.com';
        $mail->Password = 'phfv vxuw bwds kmby';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('nexusgamingsuppo@gmail.com', 'Sitio Seguro');
        $mail->addAddress($correo);

        $link = "http://localhost/pagina/views/new_password.php?token=" . $token;

        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body = "Haz clic en el siguiente enlace para cambiar tu contraseña: <a href='$link'>Cambiar contraseña</a>";

        $mail->send();
        echo "Correo enviado. Revisa tu bandeja. <a href='../views/login.php'>Volver</a>";
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
    }
}
