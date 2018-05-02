<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$titre_originale = $_POST['titre_originale'];

$nom_fichier = $_POST['nom_fichier'];

$date_created = date("Y-m-d");

$id_serie = $_POST['id_serie'];

$id_saison = $_POST['id_saison'];

$nom_serie=$_POST['nom_serie'];

$nom_saison=$_POST['nom_saison'];

$Num_episode=$_POST['Num_episode'];

$etat = TRUE;



if (!empty($_POST['button_register'])) {

    try {

        $sql = " INSERT INTO  EpisodesSerieTvFr (titre_originale,nom_fichier,date_created,id_saison,Num_episode) VALUES (:param1,:param2,:param3,:param4,:param5)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_originale);

        $stmt->bindParam(':param2', $nom_fichier);

        $stmt->bindParam(':param3', $date_created);

        $stmt->bindParam(':param4', $id_saison);      
        
         $stmt->bindParam(':param5', $Num_episode);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}


if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=succes';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=echec';
}

header("Location:  $url");
?>
