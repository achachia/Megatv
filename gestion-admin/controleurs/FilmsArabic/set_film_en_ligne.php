<?php

session_start();
session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

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

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Films-Arabic/";

    $source_fichier = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Films-Arabic/";

    $fichierChemin = 'C:/wamp64/www/MegaTV-Backend/Kodi_strm/FilmsArabic/';

    $dir_jaquette = 'C:/wamp64/www/MegaTV-Backend/gestion-admin/images/JaquetteFilmsArabic/';
} else {


    $dir = "/volume1/web/media/Films-arabic/";

    $source_fichier = '/web/media/Films-arabic/';

    $fichierChemin = '/volume1/web/Kodi_strm/Films-arabic/';

    $dir_jaquette = '/volume1/web/Megatv/MegatvProcedural/gestion-admin/images/JaquetteFilmsArabic/';
}




/* * *********************** Donnes recus par le navigateur client *************************** */

$titre_original = $_POST['titre_original'];

$annee_release = $_POST['annee_release'];

$overview = $_POST['overview'];

$overview = $_POST['overview'];

$section = '9';


if (!empty($_POST['add_serveur'])) {


    try {

        $sql = " INSERT INTO  Movies_arabic_hindo (titre_originale,overview,annee_release,categorie) VALUES (:param1,:param2,:param3,:param4)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_original);

        $stmt->bindParam(':param2', $overview);

        $stmt->bindParam(':param3', $annee_release);

        $stmt->bindParam(':param4', $section);

        $stmt->execute();
    } catch (Exception $e1) {

        echo $e1->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
    /*     * ******************************************************************* */

    try {

        $sql = " SELECT MAX(id_movie) AS MaxId  FROM Movies_arabic_hindo  ";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();

        $enregistrement = $stmt->fetch();

        $MaxId = $enregistrement['MaxId'];
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    /*     * ******************************************************* */

    if (isset($_FILES['affiche_movie']['name']) && !empty($_FILES['affiche_movie']['name'])) {

        $imgExt = strtolower(pathinfo($_FILES['affiche_movie']['name'], PATHINFO_EXTENSION));

        $affiche_movie = 'http://megatv.ovh/gestion-admin/images/JaquetteFilmsArabic/poster_' . $MaxId . '.' . $imgExt;
    }

    /*     * *********************************************************************************** */

    try {

        $sql = " UPDATE  Movies_arabic_hindo   SET  cover='" . $affiche_movie . "'   WHERE  id_movie='" . $MaxId . "' ";

        $resultat = $cxn->prepare($sql);

        $resultat->execute();
        
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    /*     * **************** upload fichier image ********************************** */
    if (isset($_FILES['affiche_movie']['name']) && !empty($_FILES['affiche_movie']['name']) && $etat) {

        upload_fichier($_FILES['affiche_movie'], $dir_jaquette, $MaxId);
    }

    /*     * ******************************************************************* */

    $id_serveur = $_POST['serveur_film'];

    $identifiant_streaming = $_POST['identifiant_streaming'];

    $qualite_video = $_POST['qualite_video'];

    if (!empty($_POST['url'])) {

        $url = $_POST['url'];
    } else {

        $url = NULL;
    }

    $date_upload = date("Y-m-d");


   try {

        $sql = " INSERT INTO  LinksServersMoviesArabicHindo  (id_fichier,id_serveur,url,date_created,qualite,identifiant_streaming) VALUES ('" . $MaxId . "','" . $id_serveur . "','" . $url . "','" . $date_upload . "','" . $qualite_video . "','".$identifiant_streaming."') ";

        $resultat = $cxn->prepare($sql);

        $resultat->execute();
        
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}



if ($etat) {

    $url = $url_espace_admin . "/index.php?module=FilmsArabic&action=all_films_ligne&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=FilmsArabic&action=all_films_ligne&message=echec";
}

header("Location:  $url ");
exit();
?>

