<?php

//header('Content-type: application/json');

require_once './../../connection/config.php';

ini_set('date.timezone', 'Europe/Paris');

function creerFichierStrm($fichierChemin, $fichierNom, $fichierExtension, $fichierContenu, $droit = "") {




    $fichierCheminComplet = $fichierChemin . $fichierNom . $fichierExtension;


// création du fichier sur le serveur

    $leFichier = fopen($fichierCheminComplet, "wb"); 

    fwrite($leFichier, $fichierContenu);

    fclose($leFichier);



// la permission

    if ($droit == "") {

        $droit = 0777;
    }



// on vérifie que le fichier a bien été créé

    $t_infoCreation['fichierCreer'] = false;

    if (file_exists($fichierCheminComplet) == true) {

        $t_infoCreation['fichierCreer'] = true;
    }



// on applique les permission au fichier créé



    $retour = chmod($fichierCheminComplet, $droit);

    // var_dump($retour);

    $t_infoCreation['permissionAppliquer'] = $retour;



    return $t_infoCreation;
}

//ftp://achachia2003:7130chachia@pool182.seedbox.fr:21/VOD/FilmsArabic/Ahwak.HD.720p.mkv
//dav://myvod69800%40netcmail.com:myvod69800@webdav.4shared.com:80/Jupiter.Ascending.avi
// recuperation des informations de la source et compte

$nom_serie = $_POST['nom_serie'];

$num_saison = $_POST['num_saison'];

$titre_original = $_POST['titre_original'];

$taille_fichier = $_POST['taille_fichier'];

$nv_nom_fichier = $_POST['nv_nom_fichier'];

$nom_fichier_complet = $_POST['nom_fichier_complet'];

$extention_fichier = $_POST['extention_fichier'];

$etat = TRUE;

$date_upload = date("Y-m-d");

$objet = array();

/* * *********** recuperer les informations de host-user *********************** */

try {

    $sql = " SELECT * FROM  CompteVod  WHERE  code_user=:param";

    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param', $_SESSION ['code_admin']);

    $stmt->execute();

    $enregistrement = $stmt->fetch();

    $host = $enregistrement['host'];
    
    $port = $enregistrement['port'];
    
    $protocole = $enregistrement['protocole'];
    
    $user = $enregistrement['user'];
    
    $password = $enregistrement['password'];    

    
} catch (Exception $e) {
    
    $etat = FALSE;

    echo $e->getMessage();
}



/* * **************************************************************************** */

/* * ********** Creation dossier de nom serie-saison  si n'ilexiste pas ************** */

$dir_serie = '/volume1/web/Kodi_strm/SerieTv/' . $nom_serie . '/';

if (!is_dir($dir_serie) == true) {

    mkdir($dir_serie, 0777);
}

/* * ********** Creation dossier de la saison  serie si n'ilexiste pas ************** */

$dir_saison = '/volume1/web/Kodi_strm/SerieTv/' . $nom_serie . '/' . $num_saison . '/';


if (!is_dir($dir_saison) == true) {

    mkdir($dir_saison, 0777);
}


/* * ***************************************************** */


$source_fichier = '/web/media/SerieTv/' . $nom_serie . '/' . $num_saison . '/';

$fichierExtension = '.strm';

$fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . $source_fichier . $nom_fichier_complet;

$fichierChemin = '/volume1/web/Kodi_strm/SerieTv/' . $nom_serie . '/' . $num_saison . '/';

$droit = 0777;



// Renomer le fichier 



rename($dir . $nom_fichier_complet, $dir . $nv_nom_fichier . '.' . $extention_fichier);



$nom_fichier = $nv_nom_fichier . '.' . $extention_fichier;



/* * ********************************************** */


/* * ******************************************** */




$sql = " SELECT id_episode,titre_originale FROM  SerieTv    WHERE  nom_fichier='" . $nom_fichier . "'";



$select = $cxn->query($sql);

$nb = $select->rowCount();

if ($nb <= 0) {

    //var_dump('non_existe_deja');

    if (!empty($_POST['button_register'])) {
        try {

            $sql = " INSERT INTO  SerieTv (titre_originale,nom_fichier,date_upload,nom_serie,num_saison,taille_fichier) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";

            $stmt = $cxn->prepare($sql);

            $stmt->bindParam(':param1', $titre_original);

            $stmt->bindParam(':param2', $nom_fichier);

            $stmt->bindParam(':param3', $date_upload);

            $stmt->bindParam(':param4', $nom_serie);

            $stmt->bindParam(':param5', $num_saison);

            $stmt->bindParam(':param6', $taille_fichier);

            $stmt->execute();

            // creation fichier strm sur le serveur 
            //  echo $fichierChemin.$titre_original.$fichierExtension.$fichierContenu.$droit; 

            $t_infoCreation = creerFichierStrm($fichierChemin, $titre_original, $fichierExtension, $fichierContenu, $droit);


            if ($t_infoCreation['fichierCreer'] != '1' || $t_infoCreation['permissionAppliquer'] != '1') {

                $objet ['message_erreur'] [] = $t_infoCreation['fichierCreer'];

                $objet ['message_erreur'] [] = $t_infoCreation['permissionAppliquer'];

                $etat = FALSE;

                $objet ['message_erreur'] [] = 'Probleme dans la creation de fichier strm dans le serveur';

                //  var_dump($objet ['message_erreur']);
            }
        } catch (Exception $e) {

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }
    }

    if (!empty($_POST['button_delete'])) {

        $fichierCheminComplet = '/volume1' . $source_fichier . $nom_fichier;


        if (file_exists($fichierCheminComplet) == true) {

            unlink($fichierCheminComplet);
        }
    }
} else {

    // var_dump('existe_deja');

    $enregistrement = $select->fetch();

    $id_episode = $enregistrement['id_episode'];



    $precedent_nom_fichier = $enregistrement['titre_originale'];

    if (!empty($_POST['button_register'])) {

        try {

            $sql = " UPDATE  SerieTv  SET  titre_originale=:param1,date_upload=:param2   WHERE id_episode=:param3";

            $stmt = $cxn->prepare($sql);

            $stmt->bindParam(':param1', $titre_original);

            $stmt->bindParam(':param2', $date_upload);

            $stmt->bindParam(':param3', $id_episode);

            $stmt->execute();
        } catch (Exception $e) {

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }
    }

    if (!empty($_POST['button_delete'])) {

        //Suppression fichier de la base de donne

        try {

            $sql = " DELETE FROM  SerieTv   WHERE id_episode=:param";

            $stmt = $cxn->prepare($sql);

            $stmt->bindParam(':param', $id_episode);

            $stmt->execute();
        } catch (Exception $e) {

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }

        //  Suppression fichier sur le serveur

        $fichierCheminComplet = '/volume1' . $source_fichier . $nom_fichier;


        if (file_exists($fichierCheminComplet) == true) {

            unlink($fichierCheminComplet);
        }
    }


    // Supprission fichier strm  sur le serveur 

    $fichierCheminComplet = $fichierChemin . $precedent_nom_fichier . $fichierExtension;


    if (file_exists($fichierCheminComplet) == true) {

        unlink($fichierCheminComplet);
    }

    if (!empty($_POST['button_register'])) {

        // creation fichier strm  sur le serveur 

        $t_infoCreation = creerFichierStrm($fichierChemin, $titre_original, $fichierExtension, $fichierContenu, $droit);


        if ($t_infoCreation['fichierCreer'] != '1' || $t_infoCreation['permissionAppliquer'] != '1') {

            $objet ['message_erreur'] [] = $t_infoCreation['fichierCreer'];

            $objet ['message_erreur'] [] = $t_infoCreation['permissionAppliquer'];

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans la creation de fichier strm dans le serveur';
        }
    }
}



if ($etat) {

    header("Location:  http://marocshop.ddns.net/gestion-admin/gestion-vod/index.php?module=SerieTv&action=all_serie_tv ");
} else {

    // header("Location:  login.php?message_erreur=erreur");
}
//exit();
//$objet ['message'] = array(
//
//    'reponse' => $etat
//
//);
//
//echo json_encode($objet);
// chercher le chemin de dossier strm
//        try {
//
//
//
//            $sql = "   SELECT chemin_strm FROM SectionVod WHERE id_section='" . $section_film . "' ";
//
//            $select = $cxn->query($sql);
//
//            $enregistrement = $select->fetch();
//
//            $fichierChemin = html_entity_decode($enregistrement ['chemin_strm']);
//
//            if ($protocole == 'ftp') {
//
//                if ($source_fichier == '') {
//
//                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;
//
//                } else {
//
//                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;
//
//                }
//
//            } elseif ($protocole == 'webdav') {
//
//                if ($source_fichier == '') {
//
//                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;
//
//                } else {
//
//                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;
//
//                }
//
//            }
//
//            
//
//        } catch (Exception $ex) {
//
//            $etat = FALSE;
//
//            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
//
//        }
?>



