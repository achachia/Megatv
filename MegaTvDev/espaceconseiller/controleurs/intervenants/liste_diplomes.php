<?php
require_once './../../../connection/config.php';
if (isset($_POST['type_niveau'])) {
    $sql = " SELECT id_liaison,diplome  FROM niveau_diplomes  WHERE niveau_etude=:param ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = $_POST['type_niveau'];
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $liste[$i]['id_liaison'] = $enregistrement['id_liaison'];
        $liste[$i]['nom_diplome'] = $enregistrement['diplome'];
        $i++;
    }
}
$objet['liste_diplomes'] = $liste;
header('Content-type: application/json');
echo json_encode($objet);
?>
