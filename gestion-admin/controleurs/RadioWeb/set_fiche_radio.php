<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

/* * *********************** Donnes recus par le navigateur client *************************** */

$nv_nom_fichier = $_POST['nv_nom_fichier']; //nouveau nom complet

$logo_chaine = $_POST['logo_chaine'];

$pays_chaine = $_POST['pays_chaine']; // nouveau

$activation = $_POST['activation_chaine'];

$theme_chaine = $_POST['theme_chaine']; // ancien nom  complet

$url = $_POST['url_chaine'];

$langage = $_POST['langage_chaine'];

$date_created = date("Y-m-d  H:i:s");

$etat = true;


/* * ************************************************************************************************************ */

if (!empty($_POST['add_fiche_radio'])) {

    try {

        $sql = " INSERT INTO  ListeRadioWeb (nom_radio,affiche,pays,theme,activation,url,date_created,langage) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nv_nom_fichier);

        $stmt->bindParam(':param2', $logo_chaine);

        $stmt->bindParam(':param3', $pays_chaine);

        $stmt->bindParam(':param4', $theme_chaine);

        $stmt->bindParam(':param5', $activation);

        $stmt->bindParam(':param6', $url);

        $stmt->bindParam(':param7', $date_created);

        $stmt->bindParam(':param8', $langage);

        $stmt->execute();
    } catch (Exception $e) {

        echo $e->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

/* * ********************************************************************************************** */

if (!empty($_POST['update_chaine'])) {


    if (isset($_POST['id_chaine']) && !empty($_POST['id_chaine'])) {


        $id_fichier = $_POST['id_chaine'];
    }



    /*     * *********************************Mettre a jour le fichier dans la base de donnees*********************************************************** */

    try {

        $sql = " UPDATE  ListeRadioWeb   SET  nom_radio=:param1,affiche=:param2,pays=:param3,theme=:param4,activation=:param5,url=:param6,langage=:param8   WHERE  id_radio=:param7";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nv_nom_fichier);

        $stmt->bindParam(':param2', $logo_chaine);

        $stmt->bindParam(':param3', $pays_chaine);

        $stmt->bindParam(':param4', $theme_chaine);

        $stmt->bindParam(':param5', $activation);

        $stmt->bindParam(':param6', $url);

        $stmt->bindParam(':param7', $id_fichier);

        $stmt->bindParam(':param8', $langage);

        $stmt->execute();
    } catch (Exception $e) {

        echo $e->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

if (!empty($_POST['button_delete'])) {

    /*     * ****************** Suppression enregistrement dans la base de donnees ***************************************** */


    if (isset($_POST['id_chaine']) && !empty($_POST['id_chaine'])) {

        $id_fichier = $_POST['id_chaine'];

        try {

            $sql = " DELETE FROM  ListeRadioWeb   WHERE id_radio=:id_fichier";

            $stmt = $cxn->prepare($sql);

            $stmt->bindParam(':id_fichier', $id_fichier);

            $stmt->execute();
        } catch (Exception $e) {

            echo $e->getMessage();

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }
    }
}

/* * ******************************************** ***************************************************** */


if ($etat) {

    $url = $url_espace_admin . "/index.php?module=RadioWeb&action=all_radio&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=RadioWeb&action=all_radio=echec";
}

header("Location:  $url ");

exit();
?>



