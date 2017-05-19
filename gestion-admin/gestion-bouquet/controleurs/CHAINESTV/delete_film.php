<?php

header('Content-type: application/json');
require_once './../../connection/config.php';
include './../../../librairie/fonctions.php';
ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;
$id_film = $_POST['id_film'];
// suppression le fichier strm de serveur
try {

    $sql = "   SELECT titre_originale FROM FichierVod WHERE id_fichier='" . $id_film . "' ";
    $select = $cxn->query($sql);
    $enregistrement = $select->fetch();
    $nom_fichier = html_entity_decode($enregistrement ['titre_originale']);
    $fichier_strm = "/home/megatvfr/public_html/kodi/FilmsHD/" . $nom_fichier . ".strm";
    if (file_exists($fichier_strm)) {
        unlink($fichier_strm);
    }
} catch (Exception $ex) {
    $etat = FALSE;
    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}
// suppression l'enregistrement de la base de donnée strm de serveur
if ($etat) {
    try {

        $sql = "   DELETE  FROM FichierVod WHERE id_fichier='" . $id_film . "' ";
        $select = $cxn->query($sql);
    } catch (Exception $ex) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}
$objet ['message'] = array(
    'reponse' => $etat
);
echo json_encode($objet);
?>


