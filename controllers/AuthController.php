<?php

require_once './models/Usuario.php';

class AuthController {

    public function login() {
        require './views/auth/login.php';
    }

    public function autenticar() {

        // Capturar datos enviados desde el formulario
        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Buscar el usuario por nombre
        $user = Usuario::buscarUsuario($usuario);

        // Validar si existe
        if (!$user) {
            $error = "El usuario no existe";
            require './views/auth/login.php';
            return;
        }

        // Verificar contraseña encriptada
        if (!password_verify($password, $user['password'])) {
            $error = "Contraseña incorrecta";
            require './views/auth/login.php';
            return;
        }

        // Login correcto
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'nombre'   => $user['nombre'],
            'usuario'  => $user['usuario'],
            'rol'      => $user['rol']
        ];

        header("Location: index.php?c=home&a=index");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=auth&a=login");
        exit;
    }
}
?>
