<?php
require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_saison = $_POST['nom_saison'];

$id_serie = $_POST['id_serie'];

$Num_saison = $_POST['Num_saison'];

$etat = TRUE;

$date_created = date("Y-m-d");

/* * ************************************************************************** */

try {

    $sql = "  SELECT    SerieTvFr.id_TMD  FROM  SerieTvFr    WHERE    SerieTvFr .id_serie='" . $id_serie . "'  ";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();

    $enregistrement = $stmt->fetch();

    $id_TMD = $enregistrement['id_TMD'];  

    
    
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}

/* * ********************************************************************** */

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $id_TMD . '/season/' . $Num_saison . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');


$json_data = json_decode($json_source);

$tab = explode("-", $json_data->air_date);

$date_release = $tab[2] . '-' . $tab[1] . '-' . $tab[0];

$date_release = $date_release;

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;



$overview = addslashes($json_data->overview);

/* * ********************************************************************** */

if (!empty($_POST['button_register'])) {
    
    try {

        $sql = " INSERT INTO  SaisonsTvFr (nom_saison,id_serie,date_created,Num_saison,overview,annee_release,poster_path) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_saison); 

        $stmt->bindParam(':param2', $id_serie);

        $stmt->bindParam(':param3', $date_created);
        
        $stmt->bindParam(':param4',$Num_saison ); 
        
        $stmt->bindParam(':param5',$overview ); 
        
        $stmt->bindParam(':param6',$date_release ); 
        
        $stmt->bindParam(':param7',$poster_path ); 

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

