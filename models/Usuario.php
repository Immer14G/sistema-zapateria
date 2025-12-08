<?php
require_once 'config/database.php';
class Usuario {
    public static function buscarUsuario($usuario) {
        global $conexion;
        $stmt = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $stmt->execute([$usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function existeUsuario($usuario) {
        global $conexion;
        $stmt = $conexion->prepare('SELECT id FROM usuarios WHERE usuario = ?');
        $stmt->execute([$usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
    public static function create($nombre, $usuario, $password, $rol = 'vendedor') {
        global $conexion;
        $stmt = $conexion->prepare('INSERT INTO usuarios (nombre, usuario, password, rol) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$nombre, $usuario, $password, $rol]);
    }
}
?>