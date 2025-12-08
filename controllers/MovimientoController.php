<?php
require_once './models/Movimiento.php';

class MovimientoController {

    public function index() {
        // Seguridad: bloquear acceso si NO hay sesión
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?c=auth&a=login");
            exit();
        }

        // Solo admin puede ver movimientos
        if ($_SESSION['user']['rol'] !== 'admin') {
            echo "<h3 style='color:red;text-align:center'>Acceso denegado</h3>";
            exit();
        }

        $movimientos = Movimiento::getAll();
        require './views/movimientos/index.php';
    }
}
?>