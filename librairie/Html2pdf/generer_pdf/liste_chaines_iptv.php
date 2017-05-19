<?php

ob_start();
require "./../../../connection/config.php";
require './../fonctions/frond_end/chaines.php';
$liste_chaines = liste_chaines();
include(dirname(__FILE__) . '/res/liste_chaines.php');
$content = ob_get_clean();

// convert in PDF
require_once(dirname(__FILE__) . '/../html2pdf.class.php');
try {
    
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    //      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
 
    $nom_pdf = 'liste_chaines.pdf';

    $html2pdf->Output($nom_pdf);
    
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>

