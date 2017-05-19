<?php
require_once './../../../connection/config.php';
if (isset($_POST['code_famille'])) {
    $sql = " SELECT code_eleve,nom,prenom  FROM eleve_famille  WHERE code_famille=:param ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = $_POST['code_famille'];
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $liste[$i]['code_eleve'] = $enregistrement['code_eleve'];
        $liste[$i]['identite_eleve'] = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
        $i++;
    }
}
$objet['liste_eleve'] = $liste;
header('Content-type: application/json');
echo json_encode($objet);
?>

