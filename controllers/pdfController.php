<?php 
require_once './models/Reporte.php';
require_once './libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class ReporteController {

    public function facturas() {
        $data = Reporte::getFacturasDetalladas();
        require './views/reportes/facturas.php';
    }

    public function facturasPDF() {
        $data = Reporte::getFacturasDetalladas();

        ob_start();
        require './views/reportes/facturas_pdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("facturas.pdf", ["Attachment" => true]);
    }
}
?>