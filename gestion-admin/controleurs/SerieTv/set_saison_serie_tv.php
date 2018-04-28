<?php
require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_saison = $_POST['nom_saison'];

$id_serie = $_POST['id_serie'];

$idtmd_saison = $_POST['idtmd_saison'];

$etat = TRUE;

$date_created = date("Y-m-d");

if (!empty($_POST['button_register'])) {
    
    try {

        $sql = " INSERT INTO  SaisonsTvFr (nom_saison,id_serie,id_TMD,date_created) VALUES (:param1,:param2,:param3,:param4)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_saison); 

        $stmt->bindParam(':param2', $id_serie);

        $stmt->bindParam(':param3', $idtmd_saison);
        
        $stmt->bindParam(':param4', $date_created);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}


if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie='.$id_serie.'&message=succes';

   
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie='.$id_serie.'&message=echec';

    
}

header("Location:  $url");
?>

