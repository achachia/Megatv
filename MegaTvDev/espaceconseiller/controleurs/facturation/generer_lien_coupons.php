<?php
require_once './../../../connection/config.php';
$N_facture = $_POST['id_facture'];
try {
    $sql = "    SELECT  code_famille AS code_user ";   
    $sql .= "   FROM facture_famille ";  
    $sql .= "   WHERE  N_facture='" . $N_facture . "' ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $code_user=$enregistrement['code_user'];
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
}

$objet['lien_pdf']  ='http://docs.google.com/viewer?url=';
$objet['lien_pdf'] .= 'http://mega-cours.fr/telechargement/liste_coupon/' . $code_user . '/liste_coupon_N' . $N_facture . '.pdf';
$objet['lien_pdf'] .= '&amp;embedded=true';
header('Content-type: application/json');
echo json_encode($objet);
?>

