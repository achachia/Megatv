<?php
require_once './../../../connection/config.php';
ini_set('date.timezone', 'Europe/Paris'); 
if (isset($_POST['liste'])) {
    $sql = " SELECT id_option,nom_option  FROM liste_niveau_option ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $liste[$i]['id_option'] = $enregistrement['id_option'];
        $liste[$i]['nom_option'] = html_entity_decode($enregistrement['nom_option']);
        $i++;
    }
}
$objet['liste'] = $liste;
header('Content-type: application/json');
echo json_encode($objet);
?>