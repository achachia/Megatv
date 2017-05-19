<?php
header('Content-type: application/json');
require_once './../connection/config.php';
 
if (isset($_POST['code_source'])) {
    $code_source=$_POST['code_source'];
    $sql = " SELECT user AS nom_compte,id_compte  FROM  CompteVod  WHERE source=:param ";
    $stmt = $cxn->prepare($sql);
    $stmt->bindParam ( ':param',  $code_source );
    $stmt->execute ();
    $i = 0;
    while ($enregistrement = $stmt->fetch()) {
        $liste[$i]['code_compte'] = $enregistrement['id_compte'];
        $liste[$i]['nom_compte'] = html_entity_decode($enregistrement['nom_compte']);
        $i++;
    }
}
$objet['liste'] = $liste;

echo json_encode($objet);
?>

