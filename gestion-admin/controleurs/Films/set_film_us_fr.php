<?phpsession_start();session_regenerate_id();//header('Content-type: application/json');require_once './../../connection/config.php';ini_set('date.timezone', 'Europe/Paris');function creerFichierStrm($fichierChemin, $fichierNom, $fichierExtension, $fichierContenu, $droit = "") {    $fichierCheminComplet = $fichierChemin . $fichierNom . $fichierExtension;// création du fichier sur le serveur    $leFichier = fopen($fichierCheminComplet, "wb");    fwrite($leFichier, $fichierContenu);    fclose($leFichier);// la permission    if ($droit == "") {        $droit = 0777;    }// on vérifie que le fichier a bien été créé    $t_infoCreation['fichierCreer'] = false;    if (file_exists($fichierCheminComplet) == true) {        $t_infoCreation['fichierCreer'] = true;    }// on applique les permission au fichier créé    $retour = chmod($fichierCheminComplet, $droit);    // var_dump($retour);    $t_infoCreation['permissionAppliquer'] = $retour;    return $t_infoCreation;}//ftp://achachia2003:7130chachia@pool182.seedbox.fr:21/VOD/FilmsArabic/Ahwak.HD.720p.mkv//dav://myvod69800%40netcmail.com:myvod69800@webdav.4shared.com:80/Jupiter.Ascending.avi// recuperation des informations de la source et compte$etat = TRUE;$date_upload = date("Y-m-d");$objet = array();/* * *********** recuperer les informations de host-user *********************** */try {    $sql = " SELECT * FROM  CompteVod  WHERE  code_user=:param";    $stmt = $cxn->prepare($sql);    $stmt->bindParam(':param', $_SESSION ['code_admin']);    $stmt->execute();    $enregistrement = $stmt->fetch();    $host = $enregistrement['host'];    $port = $enregistrement['port'];    $protocole = $enregistrement['protocole'];    $user = $enregistrement['user'];    $password = $enregistrement['password'];} catch (Exception $e) {    $etat = FALSE;    echo $e->getMessage();}/* * **************************************************************************** */$droit = 0777;$section_film = $_POST['section_film'];$titre_original = $_POST['titre_original'];$taille_fichier = $_POST['taille_fichier'];$nv_nom_fichier = $_POST['nv_nom_fichier'];$nom_fichier_complet = $_POST['nom_fichier_complet'];$extention_fichier = $_POST['extention_fichier'];$idtmd = $_POST['idtmd'];if ($_SERVER['SERVER_NAME'] == 'localhost') {    $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-HD";    $source_fichier = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-HD";    $fichierChemin = 'C:\wamp64\www\MegatvProcedural\Kodi_strm\Films-HD';    } else {    $dir = "/volume1/web/media/Films-HD/";    $source_fichier = '/web/media/Films-HD/';    $fichierChemin = '/volume1/web/Kodi_strm/Films-HD/';}$fichierExtension = '.strm';$fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . $source_fichier . $nom_fichier_complet;// Renomer le fichier rename($dir . $nom_fichier_complet, $dir . $nv_nom_fichier . '.' . $extention_fichier);$nom_fichier = $nv_nom_fichier . '.' . $extention_fichier;/* * ********************************************** *//* * ******************************************** */$sql = " SELECT id_fichier,titre_originale FROM  FichierVod    WHERE  nom_fichier='" . $nom_fichier . "'";$select = $cxn->query($sql);$nb = $select->rowCount();if ($nb <= 0) {    //var_dump('non_existe_deja');    if (!empty($_POST['button_register'])) {        try {            $sql = " INSERT INTO  FichierVod (titre_originale,nom_fichier,date_upload,section_fichier,taille_fichier,id_TMD) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";            $stmt = $cxn->prepare($sql);            $stmt->bindParam(':param1', $titre_original);            $stmt->bindParam(':param2', $nom_fichier);            $stmt->bindParam(':param3', $date_upload);            $stmt->bindParam(':param4', $section_film);            $stmt->bindParam(':param5', $taille_fichier);            $stmt->bindParam(':param6', $idtmd);            $stmt->execute();            // creation fichier strm sur le serveur             //  echo $fichierChemin.$titre_original.$fichierExtension.$fichierContenu.$droit;             $t_infoCreation = creerFichierStrm($fichierChemin, $titre_original, $fichierExtension, $fichierContenu, $droit);            if ($t_infoCreation['fichierCreer'] != '1' || $t_infoCreation['permissionAppliquer'] != '1') {                $objet ['message_erreur'] [] = $t_infoCreation['fichierCreer'];                $objet ['message_erreur'] [] = $t_infoCreation['permissionAppliquer'];                $etat = FALSE;                $objet ['message_erreur'] [] = 'Probleme dans la creation de fichier strm dans le serveur';                //  var_dump($objet ['message_erreur']);            }        } catch (Exception $e) {            $etat = FALSE;            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;        }    }    if (!empty($_POST['button_delete'])) {        $fichierCheminComplet = '/volume1' . $source_fichier . $nom_fichier;        if (file_exists($fichierCheminComplet) == true) {            unlink($fichierCheminComplet);        }    }} else {    // var_dump('existe_deja');    $enregistrement = $select->fetch();    $id_fichier = $enregistrement['id_fichier'];    $precedent_nom_fichier = $enregistrement['titre_originale'];    if (!empty($_POST['button_register'])) {        try {            $sql = " UPDATE  FichierVod  SET  titre_originale=:param1,date_upload=:param2,section_fichier=:param3,id_TMD=:param5   WHERE id_fichier=:param4";            $stmt = $cxn->prepare($sql);            $stmt->bindParam(':param1', $titre_original);            $stmt->bindParam(':param2', $date_upload);            $stmt->bindParam(':param3', $section_film);            $stmt->bindParam(':param4', $id_fichier);            $stmt->bindParam(':param5', $idtmd);            $stmt->execute();        } catch (Exception $e) {            $etat = FALSE;            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;        }    }    if (!empty($_POST['button_delete'])) {        //Suppression fichier de la base de donne        try {            $sql = " DELETE FROM  FichierVod   WHERE id_fichier=:param";            $stmt = $cxn->prepare($sql);            $stmt->bindParam(':param', $id_fichier);            $stmt->execute();        } catch (Exception $e) {            $etat = FALSE;            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;        }        //  Suppression fichier sur le serveur        $fichierCheminComplet = '/volume1' . $source_fichier . $nom_fichier;        if (file_exists($fichierCheminComplet) == true) {            unlink($fichierCheminComplet);        }    }    // Supprission fichier strm  sur le serveur     $fichierCheminComplet = $fichierChemin . $precedent_nom_fichier . $fichierExtension;    if (file_exists($fichierCheminComplet) == true) {        unlink($fichierCheminComplet);    }    if (!empty($_POST['button_register'])) {        // creation fichier strm  sur le serveur         $t_infoCreation = creerFichierStrm($fichierChemin, $titre_original, $fichierExtension, $fichierContenu, $droit);        if ($t_infoCreation['fichierCreer'] != '1' || $t_infoCreation['permissionAppliquer'] != '1') {            $objet ['message_erreur'] [] = $t_infoCreation['fichierCreer'];            $objet ['message_erreur'] [] = $t_infoCreation['permissionAppliquer'];            $etat = FALSE;            $objet ['message_erreur'] [] = 'Probleme dans la creation de fichier strm dans le serveur';        }    }}if ($etat) {    header("Location:  http://megatv.ovh/gestion-admin/index.php?module=Films&action=all_films ");} else {    //header("Location:  login.php?message_erreur=erreur");}//exit();//$objet ['message'] = array(////    'reponse' => $etat////);////echo json_encode($objet);// chercher le chemin de dossier strm//        try {////////            $sql = "   SELECT chemin_strm FROM SectionVod WHERE id_section='" . $section_film . "' ";////            $select = $cxn->query($sql);////            $enregistrement = $select->fetch();////            $fichierChemin = html_entity_decode($enregistrement ['chemin_strm']);////            if ($protocole == 'ftp') {////                if ($source_fichier == '') {////                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;////                } else {////                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;////                }////            } elseif ($protocole == 'webdav') {////                if ($source_fichier == '') {////                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $nom_fichier;////                } else {////                    $fichierContenu = $protocole . '://' . $user . ':' . $password . '@' . $host . ':' . $port . '/' . $source_fichier . '/' . $nom_fichier;////                }////            }////            ////        } catch (Exception $ex) {////            $etat = FALSE;////            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;////        }?>