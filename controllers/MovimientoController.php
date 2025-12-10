<?php
require_once './models/Movimiento.php';
require_once './vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class MovimientoController {

    public function index() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?c=auth&a=login");
            exit();
        }

        if ($_SESSION['user']['rol'] !== 'admin') {
            echo "<h3 style='color:red;text-align:center'>Acceso denegado</h3>";
            exit();
        }

        $movimientos = Movimiento::getAll();
        require './views/movimientos/index.php';
    }

    public function pdfProducto() {
        if (!isset($_GET['id'])) die("ID no recibido");

        $mov = Movimiento::getById($_GET['id']);
        if (!$mov) die("Movimiento no encontrado.");

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        ob_start();
        require './views/movimientos/ticket.php';
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 220, 600]);
        $dompdf->render();

        $dompdf->stream("ticket_producto.pdf", ["Attachment" => true]);
    }
}
?>
