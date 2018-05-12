<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$date_created=date("Y-m-d  H:i:s");

$etat=true;


/* * *********************** Donnes recus par le navigateur client *************************** */

$nv_nom_pays = $_POST['nv_nom_pays']; //nouveau nom complet


try {

    $sql = " INSERT INTO  ListePays (nom_pays,date_created) VALUES (:param1,:param2)";

    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param1', $nv_nom_pays);

    $stmt->bindParam(':param2', $date_created);

    $stmt->execute();
    
} catch (Exception $e) {

    echo $e->getMessage();

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}

/* * ******************************************** ***************************************************** */


if ($etat) {

    $url = $url_espace_admin . "/index.php?module=RadioWeb&action=all_radio&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=RadioWeb&action=all_radio&message=echec";
}

header("Location:  $url ");

exit();
?>



