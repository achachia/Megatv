<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serie = $_POST['nom_serie'];

$SaisonTv = $_POST['SaisonTv'];

$overview = $_POST['overview'];

$annee_release = $_POST['annee_release'];

$source_serie = $_POST['source_serie'];

$etat = TRUE;

$date_created = date("Y-m-d");

if ($_SERVER['SERVER_NAME'] == 'localhost') {


    $dir_jaquette = 'C:/wamp64/www/MegaTV-Backend/gestion-admin/images/JaquetteSerieEtrangere/JaquetteSerieArabic/JaquetteSerieArabe/';
} else {



    $dir_jaquette = '/volume1/web/Megatv/MegatvProcedural/gestion-admin/images/JaquetteSerieEtrangere/JaquetteSerieArabic/JaquetteSerieArabe/';
}

if ($SaisonTv == '0') {

    $optionSaison = 'no';
} else {

    $optionSaison = 'yes';
}

function upload_fichier($FILES, $upload_dir, $id_image) {
    // var_dump($FILES);
    $controle = TRUE;
    $imgFile = $FILES['name'];
    $tmp_dir = $FILES['tmp_name'];
    $imgSize = $FILES['size'];
    if (!empty($imgFile)) {

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions   
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '5MB'
            if ($imgSize < 5000000) {

                $distination_img = $upload_dir . 'poster_' . $id_image . '.' . $imgExt;

                if (file_exists($distination_img)) {
                    unlink($distination_img);
                }

                if (!move_uploaded_file($tmp_dir, $distination_img)) {
                    $controle = FALSE;
                    //echo 'entre-2';
                }
            }
        }
    }
    return $controle;
}

if (!empty($_POST['button_register'])) {

    try {



        $sql = " INSERT INTO  SerieTvEtrangere  (nom_serie,saisonsTv,type_serie,annee_release,overview,source) VALUES ('" . $nom_serie . "','" . $SaisonTv . "',1,'" . $annee_release . "','" . $overview . "','" . $source_serie . "')";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    /*     * ******************* Recuperation Id d'enregistrement ***************************** */
    try {

        $sql = " SELECT MAX(id_serie) AS MaxId  FROM SerieTvEtrangere ";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();

        $enregistrement = $stmt->fetch();

        $MaxId = $enregistrement['MaxId'];
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    /*     * ************************* Upload image dans le serveur ******************************** */

    if (isset($_FILES['affiche_serie']['name']) && !empty($_FILES['affiche_serie']['name']) && $etat) {

        upload_fichier($_FILES['affiche_serie'], $dir_jaquette, $MaxId);
    }

    /*     * ********************** Update l'enregistrement ***************************** */

    if (isset($_FILES['affiche_serie']['name']) && !empty($_FILES['affiche_serie']['name'])) {

        $imgExt = strtolower(pathinfo($_FILES['affiche_serie']['name'], PATHINFO_EXTENSION));

        $affiche_serie = 'poster_' . $MaxId . '.' . $imgExt;
    }


    try {

        $sql = " UPDATE  SerieTvEtrangere  SET   poster='" . $affiche_serie . "'   WHERE id_serie='" . $MaxId . "'";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

//if (!empty($_POST['button_update'])) {
//
//    $id_serie = $_POST['id_serie'];
//
//    try {
//
//        $sql = " UPDATE  SerieTvFr  SET  nom_serie=:param1,id_TMD=:param2   WHERE id_serie=:param3 ";
//
//        $stmt = $cxn->prepare($sql);
//
//        $stmt->bindParam(':param1', $nom_serie);
//
//        $stmt->bindParam(':param2', $idtmd);
//
//        $stmt->bindParam(':param3', $id_serie);
//
//        $stmt->execute();
//    } catch (Exception $e) {
//
//        $etat = FALSE;
//
//        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
//    }
//}

if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&saisonTV=' . $optionSaison . '&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&saisonTV=' . $optionSaison . '&message=echec';
}

header("Location:  $url");
?>

