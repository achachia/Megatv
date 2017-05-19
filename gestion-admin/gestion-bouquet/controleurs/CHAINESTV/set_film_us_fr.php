<?php

header('Content-type: application/json');
require_once './../../connection/config.php';
include './../../../librairie/fonctions.php';
ini_set('date.timezone', 'Europe/Paris');


//ftp://achachia2003:7130chachia@pool182.seedbox.fr:21/VOD/FilmsArabic/Ahwak.HD.720p.mkv
//dav://myvod69800%40netcmail.com:myvod69800@webdav.4shared.com:80/Jupiter.Ascending.avi
// recuperation des informations de la source et compte
$etat = TRUE;
$id_source = $_POST['select_source'];
$id_compte = $_POST['select_compte'];
$section_film = $_POST['section_film'];
$fichierNom = $_POST['titre'];
$nom_fichier = $_POST['nom_fichier'];
$on_strm=$_POST['on_strm'];
$taille_fichier=$_POST['taille_fichier'];
$fichierExtension = "strm";
$date_upload = $_POST['date_upload'];
$objet = array();
//echo $id_compte.'-'.$section_film; 

try {
    $sql = "    SELECT SourcesVod.host,SourcesVod.protocole,SourcesVod.port, ";
    $sql .= "   CompteVod.user,CompteVod.password,CheminSourcesComptes.chemin AS chemin_cible  ";
    $sql .= "   FROM SourcesVod,CompteVod,CheminSourcesComptes  ";
    $sql .= "   WHERE SourcesVod.id_source=CompteVod.source ";
    $sql .= "   AND CheminSourcesComptes.id_compte=CompteVod.id_compte ";
    $sql .= "   AND SourcesVod.id_source='" . $id_source . "' ";
    $sql .= "   AND CompteVod.id_compte='" . $id_compte . "' ";
    $sql .= "   AND CheminSourcesComptes.section_vod='" . $section_film . "' ";
    $select = $cxn->query($sql);
    $nb = $select->rowCount();
    if ($nb <= 0) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'Aucun element ne correspond a votre requette';
    } else {
        $enregistrement = $select->fetch();
        $host = html_entity_decode($enregistrement ['host']);
        $port = html_entity_decode($enregistrement ['port']);
        $protocole = html_entity_decode($enregistrement ['protocole']);
        $user = html_entity_decode($enregistrement ['user']);
        $password = html_entity_decode($enregistrement ['password']);
        $source_fichier = html_entity_decode($enregistrement ['chemin_cible']);


        // chercher le chemin de dossier strm
        try {

            $sql = "   SELECT chemin_strm FROM SectionVod WHERE id_section='" . $section_film . "' ";
            $select = $cxn->query($sql);
            $enregistrement = $select->fetch();
            $fichierChemin = html_entity_decode($enregistrement ['chemin_strm']);
            if ($protocole == 'ftp') {
                if ($source_fichier == '') {
                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;
                } else {
                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;
                }
            } elseif ($protocole == 'webdav') {
                if ($source_fichier == '') {
                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;
                } else {
                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;
                }
            }
            
        } catch (Exception $ex) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }


        // Enregistrement les infos de fichier dans la base de donnee

        try {
            $sql = " INSERT INTO  FichierVod (titre_originale,nom_fichier,date_upload,compte_source,section_fichier,taille_fichier) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param1', $fichierNom);
            $stmt->bindParam(':param2', $nom_fichier);
            $stmt->bindParam(':param3', $date_upload);
            $stmt->bindParam(':param4', $id_compte);
            $stmt->bindParam(':param5', $section_film);
            $stmt->bindParam(':param6', $taille_fichier);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }
    }
} catch (Exception $e) {
    $etat = FALSE;
    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}

// creation fichier dans le serveur 
if ($etat && $on_strm=='1') {
    $droit = "0777";
    $t_infoCreation = creerFichier($fichierChemin, $fichierNom, $fichierExtension, $fichierContenu, $droit);
    //$objet ['message_erreur'] []=$t_infoCreation;
    if ($t_infoCreation['fichierCreer'] != '1' || $t_infoCreation['permissionAppliquer'] != '1') {
        $objet ['message_erreur'] []=$t_infoCreation['fichierCreer'];
        $objet ['message_erreur'] []=$t_infoCreation['permissionAppliquer'];
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'Probleme dans la creation de fichier strm dans le serveur';
    }
}
$objet ['message'] = array(
    'reponse' => $etat
);
echo json_encode($objet);
?>
