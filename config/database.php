<?php
$DB_HOST = 'localhost';
$DB_NAME = 'zapateria1';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $conexion = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Error conexión: " . $e->getMessage());
}
?>