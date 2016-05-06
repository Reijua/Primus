<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function pdf_create($filename="", $content="", $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->set_paper("A4", 'portrait');
    $dompdf->load_html($content);
    $dompdf->render();

    if ($stream) {
        $dompdf->stream($filename.".pdf",array('Attachment'=>0));
    } else {
        return $dompdf->output();
    }
}
?>