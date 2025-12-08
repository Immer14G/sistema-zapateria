<?php
require_once './models/Reporte.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

class ReporteController {

    public function facturas() {
        $facturas = Reporte::getFacturasDetalladasAgrupadas();
        require './views/reportes/facturas.php';
    }

    public function facturaPDF() {
        $id = $_GET['id'] ?? null;
        if (!$id) { die("Factura no válida"); }

        $factura = Reporte::getFacturaById($id);
        if (!$factura) { die("Factura vacía"); }

        ob_start();
        require './views/reportes/ticket.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("factura_$id.pdf", ["Attachment" => true]);
        exit;
    }
}
?>