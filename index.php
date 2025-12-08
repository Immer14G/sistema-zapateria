<?php
session_start();
require_once 'config/database.php';

// Obtener controlador y acción
$c = $_GET['c'] ?? 'auth';
$a = $_GET['a'] ?? 'login';

// Rutas públicas (no necesitan sesión)
$rutasPublicas = [
    'auth-login',
    'auth-autenticar'
];

$controllerFile = "controllers/" . ucfirst($c) . "Controller.php";
$rutaActual = "$c-$a";

// Si NO es pública y NO hay sesión → mandar al login
if (!in_array($rutaActual, $rutasPublicas) && !isset($_SESSION['user'])) {
    header("Location: index.php?c=auth&a=login");
    exit;
}

// Cargar controlador
if (file_exists($controllerFile)) {
    require $controllerFile;
    $class = ucfirst($c) . "Controller";

    if (class_exists($class) && method_exists($class, $a)) {
        $controller = new $class();
        $controller->$a();
        exit;
    }
}

// Si algo falla, mandar al login
header("Location: index.php?c=auth&a=login");
exit;
?>
