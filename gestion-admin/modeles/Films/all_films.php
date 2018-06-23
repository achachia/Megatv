<?php//modelefunction listeQualiteVod() {    global $cxn;    $liste = array();    try {        $sql = " SELECT  id_qualite,qualite   FROM  QualiteVod    ";        $resultat = $cxn->prepare($sql);        $resultat->execute();        $i = 0;        while ($enregistrement = $resultat->fetch()) {            $liste[$i]['id_qualite'] = $enregistrement['id_qualite'];            $liste[$i]['nom_qualite'] = $enregistrement['qualite'];            $i++;        }    } catch (Exception $e) {        echo $e->getMessage();    }    return $liste;}function liste_fichiers_enregistre(){	    global $cxn;        $liste_fichier_enregistre = array();        try {                $sql = " SELECT LinksServersFichierVod.nom_fichier,FichierVod.id_fichier,FichierVod.titre_originale,FichierVod.section_fichier,FichierVod.taille_fichier,FichierVod.id_TMD,FichierVod.genre,FichierVod.overview,FichierVod.poster,FichierVod.annee_release "                        . " FROM  FichierVod,LinksServersFichierVod"                        . " WHERE FichierVod.id_fichier=LinksServersFichierVod.id_fichier "                        . "  AND FichierVod.langage='VF'  AND   LinksServersFichierVod.nom_fichier IS NOT NULL AND  FichierVod.section_fichier=2  ORDER BY  FichierVod.id_fichier ASC ";                                                //echo $sql;                $resultat = $cxn->query($sql);                                $i=0;               while ($enregistrement = $resultat->fetch()) {              	                                   $liste_fichier_enregistre[$i]['id_fichier'] = $enregistrement['id_fichier'];                   $liste_fichier_enregistre[$i]['nom_fichier_complet'] = $enregistrement['nom_fichier'];                    $liste_fichier_enregistre[$i]['taille_fichier'] = $enregistrement['taille_fichier'];                    $liste_fichier_enregistre[$i]['titre_originale'] = $enregistrement['titre_originale'];                    $liste_fichier_enregistre[$i]['date_upload'] = $enregistrement['date_upload'];                    $liste_fichier_enregistre[$i]['id_TMD'] = $enregistrement['id_TMD'];                    $liste_fichier_enregistre[$i]['section_fichier'] = getNomSection($enregistrement['section_fichier']);                                  //  $parseHeaders = parseHeaders('https://api.themoviedb.org/3/movie/' . $enregistrement['id_TMD'] . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');                   // $liste_fichier_enregistre[$i]['messageStatutCheckJson'] = getMessageStatut($parseHeaders);                                       $liste_fichier_enregistre[$i]['messageStatutCheckJson']='en test';                                           $liste_fichier_enregistre[$i]['poster_path'] = $enregistrement['poster'];                                                   $i++;                }            } catch (Exception $e) {                echo $e->getMessage();            }		 	return $liste_fichier_enregistre;	}function liste_fichiers_non_enregistre() {    global $cxn;    $liste_fichiers = array();      $liste_fichier_non_enregistre = array();    if ($_SERVER['SERVER_NAME'] == 'localhost') {        $dir = "C:\wamp64\www\MegaTV-Backend\Media-Vod\Films-HD";    } else {        $dir = "/volume1/web/media/Films-HD";    }    $dh = opendir($dir);    $i = 0;    while (false !== ($filename = readdir($dh))) {        if ($filename != '.' && $filename != '..') {            $info = new SplFileInfo($dir . '/' . $filename);            try {                $sql = " SELECT FichierVod.id_fichier,FichierVod.titre_originale,FichierVod.section_fichier,FichierVod.taille_fichier,FichierVod.id_TMD,FichierVod.genre,FichierVod.overview,FichierVod.poster,FichierVod.annee_release "                        . " FROM  FichierVod,LinksServersFichierVod"                        . " WHERE FichierVod.id_fichier=LinksServersFichierVod.id_fichier "                        . "  AND    LinksServersFichierVod.nom_fichier='" . $filename . "'   ORDER BY  FichierVod.id_fichier ASC ";                $select = $cxn->query($sql);                $nb = $select->rowCount();                if ($nb <= 0) {                    $liste_fichier_non_enregistre[$i]['nom_fichier'] = substr($info->getBasename($info->getExtension()), 0, -1);                    $liste_fichier_non_enregistre[$i]['nom_fichier_complet'] = $filename;                    $liste_fichier_non_enregistre[$i]['taille_fichier'] = FileSizeConvert(filesize($dir . '/' . $filename));                    $liste_fichier_non_enregistre[$i]['extention_fichier'] = $info->getExtension();                    $liste_fichier_non_enregistre[$i]['date_modification'] = date('d-m-Y', $info->getCTime());                    $liste_fichier_non_enregistre[$i]['RealPath'] = $info->getRealPath();                 }            } catch (Exception $e) {                echo $e->getMessage();            }            $i++;        }    }    return $liste_fichier_non_enregistre;}    function UpdateItem($id_fichier, $id_TMD) {        global $cxn;        $json_source = file_get_contents('https://api.themoviedb.org/3/movie/' . $id_TMD . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');        // Dï¿½code le JSON        $json_data = json_decode($json_source);        $tab = explode("-", $json_data->release_date);        $annee_release = $tab[0];        $poster = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;        $overview = $json_data->overview;        try {            $sql = " UPDATE  FichierVod  SET   annee_release='" . $annee_release . "' ,overview='" . $overview . "',poster='" . $poster . "'    WHERE  id_fichier='" . $id_fichier . "' ";            $resultat = $cxn->prepare($sql);            $resultat->execute();        } catch (Exception $e) {            echo $e->getMessage();        }    }    function UpdateItemBizNf($id_fichier, $id_TMD) {        // Define database connection parameters        $hn = 'fdb19.biz.nf';        $un = '2654214_wordpress';        $pwd = '7130Achachia';        $db = '2654214_wordpress';        $cs = 'utf8mb4';        // Set up the PDO parameters        $dsn = "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;        $opt = array(            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,            PDO::ATTR_EMULATE_PREPARES => false,        );        // Create a PDO instance (connect to the database)        $cxn = new PDO($dsn, $un, $pwd, $opt);        $json_source = file_get_contents('https://api.themoviedb.org/3/movie/' . $id_TMD . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');        // Dï¿½code le JSON        $json_data = json_decode($json_source);        $tab = explode("-", $json_data->release_date);        $annee_release = $tab[0];        $poster = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;        $overview = $json_data->overview;        try {            $sql = " UPDATE  FichierVod  SET   annee_release='" . $annee_release . "' ,overview='" . $overview . "',poster='" . $poster . "'    WHERE  id_fichier='" . $id_fichier . "' ";            $resultat = $cxn->prepare($sql);            $resultat->execute();        } catch (Exception $e) {            echo $e->getMessage();        }    }    function InsertGenreMovie($id, $name) {        global $cxn;        try {            $sql = " INSERT INTO  ListeGenreMovieTmdb (id_Tmdb,nom_genre) VALUES ('" . $id . "','" . $name . "') ";            $resultat = $cxn->prepare($sql);            //  $resultat->execute();        } catch (Exception $e) {            echo $e->getMessage();        }    }    function InsertGenreFichierVod($id_fichier, $genre) {        global $cxn;        try {            $sql = " UPDATE  FichierVod  SET  genre='" . $genre . "'    WHERE  id_fichier='" . $id_fichier . "'     ";            $resultat = $cxn->prepare($sql);            $resultat->execute();        } catch (Exception $e) {            echo $e->getMessage();        }    }    function getNomSection($id_section) {        global $cxn;        try {            $sql = " SELECT nom_section FROM  SectionVod   WHERE id_section=:param ";            $resultat = $cxn->prepare($sql);            $resultat->bindParam(':param', $id_section);            $resultat->execute();            $enregistrement = $resultat->fetch();            $string = $enregistrement['nom_section'];        } catch (Exception $e) {            echo $e->getMessage();        }        return $string;    }    function getListeGenreFilms() {        global $cxn;        $liste = array();        try {            $sql = " SELECT id_section,nom_section FROM  SectionVod  ";            $resultat = $cxn->prepare($sql);            $resultat->execute();            $i = 0;            while ($enregistrement = $resultat->fetch()) {                $liste[$i]['id_section'] = $enregistrement['id_section'];                $liste[$i]['nom_section'] = $enregistrement['nom_section'];                $i++;            }        } catch (Exception $e) {            echo $e->getMessage();        }        return $liste;    }    function listeServeursVod() {        global $cxn;        $liste = array();        try {            $sql = " SELECT  id_serveur,url_serveur,emplacement,nom_serveur  FROM  ListeServeursVod   ";            $resultat = $cxn->prepare($sql);            $resultat->execute();            $i = 0;            while ($enregistrement = $resultat->fetch()) {                $liste[$i]['id_serveur'] = $enregistrement['id_serveur'];                $liste[$i]['url_serveur'] = $enregistrement['url_serveur'];                $liste[$i]['emplacement_serveur'] = $enregistrement['emplacement'];                $liste[$i]['nom_serveur'] = $enregistrement['nom_serveur'];                $i++;            }        } catch (Exception $e) {            echo $e->getMessage();        }        return $liste;    }    ?>