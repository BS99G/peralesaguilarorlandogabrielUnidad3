<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table = 'usuarios';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function registrar($nombre, $correo, $password, $rol = 'usuario') {
        $sql = "INSERT INTO $this->table (nombre, correo, password, rol) 
                VALUES (:nombre, :correo, :password, :rol)";

        $stmt = $this->conn->prepare($sql);

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    public function verificarLogin($correo, $password) {
        $sql = "SELECT * FROM $this->table WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }

    public function guardarSessionID($id_usuario, $session_id) {
        $sql = "UPDATE $this->table SET session_id = :session_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':session_id', $session_id);
        $stmt->bindParam(':id', $id_usuario);
        $stmt->execute();
    }

    public function generarTokenRecuperacion($correo, $token) {
        $sql = "UPDATE $this->table SET token_recuperacion = :token WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
    }

    public function buscarPorToken($token) {
        $sql = "SELECT * FROM $this->table WHERE token_recuperacion = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPassword($id, $nuevaPassword) {
        $sql = "UPDATE $this->table SET password = :password, token_recuperacion = NULL WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllUsers() {
    $sql = "SELECT id, nombre, correo, rol, creado_en FROM $this->table ORDER BY creado_en DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getUserById($id) {
    $sql = "SELECT * FROM $this->table WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function eliminarUsuario($id) {
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public function actualizarUsuario($id, $nombre, $rol) {
    $sql = "UPDATE $this->table SET nombre = :nombre, rol = :rol WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':rol', $rol);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

}
?>
