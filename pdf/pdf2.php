<?php
//En los comentarios del código para descargar
//están explicadas a detalle las siguientes líneas
    ob_start();
    include(dirname(__FILE__).'\vistas\pdf.php');
    $content = ob_get_clean();
 
    //Se obtiene la librería
    require_once(dirname(__FILE__).'\vendor\autoload.php'); 
    use Spipu\Html2Pdf\Html2Pdf;
    try
    {
        $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', array(8, 5,2, 20));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output('exemple03.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>