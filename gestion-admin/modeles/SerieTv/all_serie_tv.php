<?php

//modele
function liste_episodes_saison($id_serie, $nom_serie, $nom_saison, $mod) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:/wamp64/www/MegatvProcedural/Media-Vod/Serie-Tv/" . $nom_serie . "/" . $nom_saison;
    } else {

        $dir = "/volume1/web/media/Serie-Tv/" . $nom_serie . "/" . $nom_saison;
    }
   

    $liste_episodes_saison_enregistre = array();

    $liste_episodes_saison_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {           


                /*                 * ***************** requette sql ******************************** */

                try {

                    $sql = " SELECT  id_episode,titre_originale,nom_fichier,date_created,id_serie,id_saison,id_TMD   FROM  EpisodesSerieTvFr   WHERE   nom_fichier='" . $value . "' ";
                    
                     

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();
                    
                  

                    if ($nb <= 0) {

                        $liste_episodes_saison_non_enregistre[$j]['nom_episode'] = $value;
                    } else {
                       

                        $enregistrement = $select->fetch();


                        $liste_episodes_saison_enregistre[$j]['id_episode'] = $enregistrement['id_episode'];

                        $liste_episodes_saison_enregistre[$j]['nom_episode'] = $enregistrement['nom_fichier'];
                        
                        $liste_episodes_saison_enregistre[$j]['titre_originale'] = $enregistrement['titre_originale'];

                        $liste_episodes_saison_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

                        $liste_episodes_saison_enregistre[$j]['id_saison'] = $enregistrement['id_saison'];

                        $liste_episodes_saison_enregistre[$j]['id_TMD'] = $enregistrement['id_TMD'];

                        $liste_episodes_saison_enregistre[$j]['date_created'] = $enregistrement['date_created'];
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }


                /*                 * ****************************************************************** */
            }
       
        $j++;
    }

    if ($mod == 'enregistre') {


        return $liste_episodes_saison_enregistre;
    }

    if ($mod == 'non_enregistre') {

        return $liste_episodes_saison_non_enregistre;
    }
}

function liste_saisons($id_serie, $nom_serie, $mod) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:/wamp64/www/MegatvProcedural/Media-Vod/Serie-Tv/" . $nom_serie;
    } else {

        $dir = "/volume1/web/media/Serie-Tv/" . $nom_serie;
    }

    $liste_saison_enregistre = array();

    $liste_saison_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {


                /*                 * ***************** requette sql ******************************** */

                try {

                    $sql = " SELECT  id_saison,nom_saison,id_TMD,date_created,id_serie   FROM  SaisonsTvFr   WHERE   id_serie='" . $id_serie . "'  AND   nom_saison='" . $value . "' ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_saison_non_enregistre[$j]['nom_saison'] = $value;
                    } else {

                        $enregistrement = $select->fetch();


                        $liste_saison_enregistre[$j]['id_saison'] = $enregistrement['id_saison'];

                        $liste_saison_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

                        $liste_saison_enregistre[$j]['nom_saison'] = $enregistrement['nom_saison'];

                        $liste_saison_enregistre[$j]['id_TMD'] = $enregistrement['id_TMD'];

                        $liste_saison_enregistre[$j]['date_created'] = $enregistrement['date_created'];
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }


                /*                 * ****************************************************************** */
            }
        }
        $j++;
    }

    if ($mod == 'enregistre') {


        return $liste_saison_enregistre;
    }

    if ($mod == 'non_enregistre') {

        return $liste_saison_non_enregistre;
    }
}

function liste_serie($mod) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Serie-Tv";
    } else {

        $dir = "/volume1/web/media/Serie-Tv";
    }

    $liste_serie_enregistre = array();
    $liste_serie_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {


                /*                 * ***************** requette sql ******************************** */

                try {

                    $sql = " SELECT  id_serie,nom_serie,id_TMD,date_created    FROM  SerieTvFr   WHERE  nom_serie='" . $value . "' ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_serie_non_enregistre[$j]['nom_serie'] = $value;
                    } else {

                        $enregistrement = $select->fetch();


                        $liste_serie_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

                        $liste_serie_enregistre[$j]['nom_serie'] = $enregistrement['nom_serie'];

                        $liste_serie_enregistre[$j]['id_TMD'] = $enregistrement['id_TMD'];

                        $liste_serie_enregistre[$j]['date_created'] = $enregistrement['date_created'];
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }


                /*                 * ****************************************************************** */
            }
        }
        $j++;
    }
    if ($mod == 'enregistre') {


        return $liste_serie_enregistre;
    }

    if ($mod == 'non_enregistre') {

        return $liste_serie_non_enregistre;
    }
}

function liste_fichiers($mod = '') {

    global $cxn;

    $liste_episode_enregistre = array();

    $liste_episode_non_enregistre = array();

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Serie-Tv";
    } else {

        $dir = "/volume1/web/media/Serie-Tv";
    }


    $result = dirToArray($dir);

    $j = 1;


    foreach ($result as $serie => $value) {



        foreach ($value as $saison => $value1) {



            foreach ($value1 as $num_episode => $nom_episode) {

                $filename = $dir . '/' . $serie . '/' . $saison . '/' . $nom_episode;

                $info = new SplFileInfo($filename);

                try {

                    $sql = " SELECT id_episode,titre_originale,nom_fichier,date_upload,taille_fichier,nom_serie,num_saison   FROM  SerieTv  WHERE  nom_fichier='" . $nom_episode . "' ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_episode_non_enregistre[$j]['nom_serie'] = $serie;

                        $liste_episode_non_enregistre[$j]['num_saison'] = $saison;

                        $liste_episode_non_enregistre[$j]['episode'] = $nom_episode;

                        $liste_episode_non_enregistre[$j]['taille_fichier'] = FileSizeConvert(filesize($filename));

                        $liste_episode_non_enregistre[$j]['extention_fichier'] = $info->getExtension();

                        $liste_episode_non_enregistre[$j]['nom_fichier'] = substr($info->getBasename($info->getExtension()), 0, -1);

                        $liste_episode_non_enregistre[$j]['date_created_fichier'] = date("d-m-Y H:i:s", filectime($filename));

                        $liste_episode_non_enregistre[$j]['date_update_fichier'] = date("d-m-Y H:i:s", filemtime($filename));
                    } else {

                        $enregistrement = $select->fetch();


                        $liste_episode_enregistre[$j]['nom_serie'] = $enregistrement['nom_serie'];

                        $liste_episode_enregistre[$j]['num_saison'] = $enregistrement['num_saison'];

                        $liste_episode_enregistre[$j]['nom_fichier_complet'] = $enregistrement['nom_fichier'];

                        $liste_episode_enregistre[$j]['taille_fichier'] = $enregistrement['taille_fichier'];

                        $liste_episode_enregistre[$j]['titre_originale'] = $enregistrement['titre_originale'];

                        $liste_episode_enregistre[$j]['extention_fichier'] = $info->getExtension();

                        $liste_episode_enregistre[$j]['nom_fichier'] = substr($info->getBasename($info->getExtension()), 0, -1);

                        $liste_episode_enregistre[$j]['date_created_fichier'] = date("d-m-Y H:i:s", filectime($filename));

                        $liste_episode_enregistre[$j]['date_update_fichier'] = date("d-m-Y H:i:s", filemtime($filename));
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }



                $j++;
            }
        }
    }






    if ($mod == 'enregistre') {


        return $liste_episode_enregistre;
    }

    if ($mod == 'non_enregistre') {

        return $liste_episode_non_enregistre;
    }
}
?>


