<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serie = $_POST['nom_serie'];

$idtmd = $_POST['idtmd'];

$etat = TRUE;

$date_created = date("Y-m-d");

if (!empty($_POST['button_register'])) {
    
    try {

        $sql = " INSERT INTO  SerieTvFr (nom_serie,id_TMD,date_created) VALUES (:param1,:param2,:param3)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_serie); 

        $stmt->bindParam(':param2', $idtmd);

        $stmt->bindParam(':param3', $date_created);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

if (!empty($_POST['button_update'])) {

    $id_serie = $_POST['id_serie'];

    try {

        $sql = " UPDATE  SerieTvFr  SET  nom_serie=:param1,id_TMD=:param2   WHERE id_serie=:param3 ";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_serie);

        $stmt->bindParam(':param2', $idtmd);

        $stmt->bindParam(':param3', $id_serie);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&message=success';

   
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&message=echec';

    
}

header("Location:  $url");
?>

