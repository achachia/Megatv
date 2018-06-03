<?php

//modele
function liste_episodes_saison($id_serie, $nom_serie, $nom_saison, $mod) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv/" . $nom_serie . "/" . $nom_saison;
    } else {

        $dir = "/volume1/web/media/Serie-Tv/" . $nom_serie . "/" . $nom_saison;
    }


    $liste_episodes_saison_enregistre = array();

    $liste_episodes_saison_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {


            /*             * ***************** requette sql ******************************** */

            try {

                $sql = " SELECT  id_episode,titre_originale,nom_fichier,date_created,id_saison,Num_episode  FROM  EpisodesSerieTvFr   WHERE   nom_fichier='" . $value . "' ORDER BY id_episode DESC";



                $select = $cxn->query($sql);

                $nb = $select->rowCount();



                if ($nb <= 0) {

                    $liste_episodes_saison_non_enregistre[$j]['nom_episode'] = $value;
                } else {


                    $enregistrement = $select->fetch();


                    $liste_episodes_saison_enregistre[$j]['id_episode'] = $enregistrement['id_episode'];

                    $liste_episodes_saison_enregistre[$j]['nom_episode'] = $enregistrement['nom_fichier'];

                    $liste_episodes_saison_enregistre[$j]['titre_originale'] = $enregistrement['titre_originale'];

                    $liste_episodes_saison_enregistre[$j]['id_saison'] = $enregistrement['id_saison'];

                    $liste_episodes_saison_enregistre[$j]['date_created'] = $enregistrement['date_created'];

                    $liste_episodes_saison_enregistre[$j]['Num_episode'] = $enregistrement['Num_episode'];
                }
            } catch (Exception $e) {

                echo $e->getMessage();
            }


            /*             * ****************************************************************** */
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

        $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv/" . $nom_serie;
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

                    $sql = " SELECT  id_saison,nom_saison,date_created,id_serie,Num_saison   FROM  SaisonsTvFr   WHERE   id_serie='" . $id_serie . "'  AND   nom_saison='" . $value . "' ORDER BY id_saison DESC ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_saison_non_enregistre[$j]['nom_saison'] = $value;
                    } else {

                        $enregistrement = $select->fetch();


                        $liste_saison_enregistre[$j]['id_saison'] = $enregistrement['id_saison'];

                        $liste_saison_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

                        $liste_saison_enregistre[$j]['nom_saison'] = $enregistrement['nom_saison'];

                        $liste_saison_enregistre[$j]['Num_saison'] = $enregistrement['Num_saison'];

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

        $dir = "C:\wamp64\www\MegaTV-Backend\Media-Vod\Serie-Tv";
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

                    $sql = " SELECT  id_serie,nom_serie,id_TMD,date_created    FROM  SerieTvFr   WHERE  nom_serie='" . $value . "' ORDER BY id_serie DESC ";

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
                        
                        /************************** Progression d'enregistrement ***************************************/
                        
                       $nbr=liste_fichiers($enregistrement['nom_serie']);
                       
                       $pourcentage=$nbr['nbr_fichier_enregistre'] / $nbr['nbr_total_fichier'] * 100;
                       
                      $liste_serie_enregistre[$j]['progression']=  intval($pourcentage);                
                  
                       
                     //  $liste_serie_enregistre[$j]['progression']=intval('45.5');
                        
                        /*******************************************************************/
                        
                        
                        
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

function liste_fichiers($serie) {

    global $cxn;

    $nbr_fichiers = 0;

    $nbr_episode_enregistre = 0;

    $nbr_episode_non_enregistre = 0;

    $nbr = array();

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv/".$serie;
    } else {

        $dir = "/volume1/web/media/Serie-Tv/".$serie;
    }


    $result = dirToArray($dir);

    $j = 1;


        foreach ($result  as $saison => $value) {



            foreach ($value as $num_episode => $nom_episode) {

                $filename = $dir  . '/' . $saison . '/' . $nom_episode;

                $nbr_fichiers++;
                
                
                try {

                    $sql = " SELECT id_episode   FROM  EpisodesSerieTvFr  WHERE  nom_fichier='" . $nom_episode . "' ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $nbr_episode_non_enregistre++;
                    } else {

                        $nbr_episode_enregistre++;
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }



                $j++;
            }
        }
  

    $nbr['nbr_total_fichier'] = $nbr_fichiers;

    $nbr['nbr_fichier_enregistre'] = $nbr_episode_enregistre;

    $nbr['nbr_fichier_non_enregistre'] = $nbr_episode_non_enregistre;

    return $nbr;
}
?>


