<?php//modelefunction liste_fichiers($mod = '') {    global $cxn;    $liste_fichier_enregistre = array();    $liste_fichier_non_enregistre = array();    if ($_SERVER['SERVER_NAME'] == 'localhost') {        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Cartoon";    } else {        $dir = "/volume1/web/media/Cartoon";    }    $dh = opendir($dir);    $i = 0;    while (false !== ($filename = readdir($dh))) {         if ($filename != '.' && $filename != '..') {            $info = new SplFileInfo($dir . '/' . $filename);                                  try {                $sql = " SELECT id_fichier,titre_originale,nom_fichier,section_fichier,taille_fichier,id_TMD  FROM  FichierVod  WHERE  nom_fichier='" . $filename . "' ";                $select = $cxn->query($sql);                $nb = $select->rowCount();                if ($nb <= 0) {                    $liste_fichier_non_enregistre[$i]['nom_fichier'] = substr($info->getBasename($info->getExtension()), 0, -1);                    $liste_fichier_non_enregistre[$i]['nom_fichier_complet'] = $filename;                    $liste_fichier_non_enregistre[$i]['taille_fichier'] = FileSizeConvert(filesize($dir . '/' . $filename));                    $liste_fichier_non_enregistre[$i]['extention_fichier'] = $info->getExtension();                            } else {                    $enregistrement = $select->fetch();                    $liste_fichier_enregistre[$i]['id_fichier'] = $enregistrement['id_fichier'];                  //  $liste_fichier_enregistre[$i]['nom_fichier'] = substr($info->getBasename($info->getExtension()), 0, -1);                    $liste_fichier_enregistre[$i]['nom_fichier_complet'] = $filename;                    $liste_fichier_enregistre[$i]['taille_fichier'] = $enregistrement['taille_fichier'];                    $liste_fichier_enregistre[$i]['titre_originale'] = $enregistrement['titre_originale'];                    $liste_fichier_enregistre[$i]['date_upload'] = $enregistrement['date_upload'];                    $liste_fichier_enregistre[$i]['id_TMD'] = $enregistrement['id_TMD'];                    $liste_fichier_enregistre[$i]['section_fichier'] = getNomSection($enregistrement['section_fichier']);                  //  $liste_fichier_enregistre[$i]['extention_fichier'] = $info->getExtension();                                 /*                     * ******************************************************** */                    $parseHeaders = parseHeaders('https://api.themoviedb.org/3/movie/' . $enregistrement['id_TMD'] . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');                    $liste_fichier_enregistre[$i]['messageStatutCheckJson']  = getMessageStatut($parseHeaders);                    /*                     * ******************************************************* */                }            } catch (Exception $e) {                echo $e->getMessage();            }            $i++;        }    }    if ($mod == 'enregistre') {        return $liste_fichier_enregistre;    }    if ($mod == 'non_enregistre') {        return $liste_fichier_non_enregistre;    }}function getNomSection($id_section) {    global $cxn;    try {        $sql = " SELECT nom_section FROM  SectionVod   WHERE id_section=:param ";        $resultat = $cxn->prepare($sql);        $resultat->bindParam(':param', $id_section);        $resultat->execute();        $enregistrement = $resultat->fetch();        $string = $enregistrement['nom_section'];    } catch (Exception $e) {        echo $e->getMessage();    }    return $string;}function getListeGenreFilms() {    global $cxn;    $liste = array();    try {        $sql = " SELECT id_section,nom_section FROM  SectionVod  ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_section'] = $enregistrement['id_section'];            $liste[$i]['nom_section'] = $enregistrement['nom_section'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;}?>