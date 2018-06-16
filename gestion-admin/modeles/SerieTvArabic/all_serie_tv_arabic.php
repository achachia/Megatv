<?php

//modele
function listeQualiteVod() {

    global $cxn;

    $liste = array();

    try {

        $sql = " SELECT  id_qualite,qualite   FROM  QualiteVod    ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_qualite'] = $enregistrement['id_qualite'];

            $liste[$i]['nom_qualite'] = $enregistrement['qualite']; 


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $liste;
}
function liste_serie() {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegaTV-Backend\Media-Vod\Serie-Tv-arabic";
    } else {

        $dir = "/volume1/web/media/Serie-Tv-arabic";
    }

    $liste_serie = array();

    $liste_serie_enregistre = array();

    $liste_serie_non_enregistre = array();

    /*     * ************************* Liste des series non enregistre sur le serveur local ******************************* */

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {


                /*                 * ***************** requette sql ******************************** */

                try {

                    $sql = " SELECT  id_serie,nom_serie,poster,activation,SaisonsTv   FROM  SerieTvEtrangere   WHERE  nom_serie='" . $value . "'  AND   type_serie=1    ORDER BY id_serie DESC ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_serie_non_enregistre[$j]['nom_serie'] = $value;
                    }
                } catch (Exception $e) {

                    echo $e->getMessage();
                }


                /*                 * ****************************************************************** */
            }
        }
        $j++;
    }

    /*     * ************************* Liste des series  enregistre sur la base de donneds******************************* */

    try {

        $sql = " SELECT  id_serie,nom_serie,poster,activation,SaisonsTv,overview,annee_release,source   FROM  SerieTvEtrangere     ORDER BY id_serie DESC ";

        $resultat = $cxn->query($sql);

        $j = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste_serie_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

            $liste_serie_enregistre[$j]['nom_serie'] = $enregistrement['nom_serie'];

            $liste_serie_enregistre[$j]['poster'] = $enregistrement['poster'];

            $liste_serie_enregistre[$j]['activation'] = $enregistrement['activation'];

            $liste_serie_enregistre[$j]['SaisonTv'] = $enregistrement['SaisonsTv'];

            $liste_serie_enregistre[$j]['overview'] = $enregistrement['overview'];

            $liste_serie_enregistre[$j]['annee_release'] = $enregistrement['annee_release'];

            $liste_serie_enregistre[$j]['source_serie'] = $enregistrement['source'];

            /*             * ************************ Progression d'enregistrement ************************************** */

            //  $nbr=liste_fichiers($enregistrement['nom_serie']);
            //$pourcentage=$nbr['nbr_fichier_enregistre'] / $nbr['nbr_total_fichier'] * 100;
            //$liste_serie_enregistre[$j]['progression']=  intval($pourcentage);                
            //  $liste_serie_enregistre[$j]['progression']=intval('45.5');

            /*             * **************************************************************** */

            $j++;
        }
    } catch (Exception $e2) {

        echo $e2->getMessage();
    }




    /*     * ****************************************************************************************** */
    $liste_fichiers['serie_enregistre'] = $liste_serie_enregistre;

    $liste_fichiers['serie_non_enregistre'] = $liste_serie_non_enregistre;

    return $liste_fichiers;
}

function liste_saisons($id_serie, $nom_serie) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv-arabic/" . $nom_serie;
    } else {

        $dir = "/volume1/web/media/Serie-Tv-arabic/" . $nom_serie;
    }

    $liste_saison = array();

    $liste_saison_enregistre = array();

    $liste_saison_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {


                /*                 * ***************** requette sql ******************************** */

                try {

                    $sql = " SELECT  id_saison    FROM  SaisonsTvEtrangere   WHERE   id_serie='" . $id_serie . "'  AND   nom_saison='" . $value . "' ORDER BY id_saison DESC ";

                    $select = $cxn->query($sql);

                    $nb = $select->rowCount();

                    if ($nb <= 0) {

                        $liste_saison_non_enregistre[$j]['nom_saison'] = $value;
                    }
                } catch (Exception $e1) {

                    echo $e1->getMessage();
                }


                /*                 * ****************************************************************** */
            }
        }
        $j++;
    }
    /*     * ************************* Liste des series  enregistre sur la base de donneds******************************* */

    $j = 0;

    try {

        $sql = " SELECT  id_saison,nom_saison,id_serie,activation  FROM  SaisonsTvEtrangere   WHERE   id_serie='" . $id_serie . "'  ORDER BY id_saison DESC ";

        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {

            $liste_saison_enregistre[$j]['id_saison'] = $enregistrement['id_saison'];

            $liste_saison_enregistre[$j]['id_serie'] = $enregistrement['id_serie'];

            $liste_saison_enregistre[$j]['nom_saison'] = $enregistrement['nom_saison'];

            $liste_saison_enregistre[$j]['activation'] = $enregistrement['activation'];

            $j++;
        }
    } catch (Exception $e2) {

        echo $e2->getMessage();
    }
    /*     * ************************************************************************ */

    $liste_saison['saisons_enregistre'] = $liste_saison_enregistre;

    $liste_saison['saisons_non_enregistre'] = $liste_saison_non_enregistre;

    return $liste_saison;
}

function liste_episodes($id_serie, $nom_serie, $nom_saison = NULL) {

    global $cxn;

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        if (is_null($nom_saison)) {

            $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv-arabic/" . $nom_serie;
        } else {

            $dir = "C:/wamp64/www/MegaTV-Backend/Media-Vod/Serie-Tv-arabic/" . $nom_serie . "/" . $nom_saison;
        }
    } else {

        if (is_null($nom_saison)) {

            $dir = "/volume1/web/media/Serie-Tv-arabic/" . $nom_serie;
        } else {

            $dir = "/volume1/web/media/Serie-Tv-arabic/" . $nom_serie . "/" . $nom_saison;
        }
    }


    $liste_episodes = array();

    $liste_episodes_enregistre = array();

    $liste_episodes_non_enregistre = array();

    $cdir = scandir($dir);

    $j = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {


            /*             * ***************** requette sql ******************************** */

            try {

                $sql = " SELECT  id_episode,titre_originale,nom_fichier  FROM   EpisodesSerieTvEtrangere   WHERE   nom_fichier='" . $value . "' ORDER BY id_episode DESC";



                $select = $cxn->query($sql);

                $nb = $select->rowCount();



                if ($nb <= 0) {

                    $liste_episodes_non_enregistre[$j]['nom_episode'] = $value;
                }
            } catch (Exception $e1) {

                echo $e1->getMessage();
            }


            /*             * ****************************************************************** */
        }

        $j++;
    }
    /*     * ********************************************************************* */
    try {

        $sql = " SELECT  EpisodesSerieTvEtrangere.id_episode,EpisodesSerieTvEtrangere.titre_originale,EpisodesSerieTvEtrangere.identifiant_streaming,ListeServeursVod.nom_serveur  "
                . " FROM  EpisodesSerieTvEtrangere,ListeServeursVod "
                . "  WHERE  EpisodesSerieTvEtrangere.id_serveur=ListeServeursVod.id_serveur "
                . "  AND EpisodesSerieTvEtrangere.id_serie='" . $id_serie . "'   ORDER BY EpisodesSerieTvEtrangere.id_episode DESC";




        $resultat = $cxn->query($sql);

        $j = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste_episodes_enregistre[$j]['id_episode'] = $enregistrement['id_episode'];

            $liste_episodes_enregistre[$j]['titre_originale'] = $enregistrement['titre_originale'];

            $liste_episodes_enregistre[$j]['identifiant_streaming'] = $enregistrement['identifiant_streaming'];

            $liste_episodes_enregistre[$j]['nom_serveur'] = $enregistrement['nom_serveur'];

            // $liste_episodes_saison_enregistre[$j]['date_created'] = $enregistrement['date_created'];

            $j++;
        }
    } catch (Exception $e2) {

        echo $e2->getMessage();
    }

    /*     * *************************************************************************** */



    $liste_episodes['episodes_enregistre'] = $liste_episodes_enregistre;

    $liste_episodes['episodes_non_enregistre'] = $liste_episodes_non_enregistre;

    return $liste_episodes;
}

function listeServeursVod() {

    global $cxn;

    $liste = array();

    try {

        $sql = " SELECT  id_serveur,url_serveur,emplacement,nom_serveur  FROM  ListeServeursVod   ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_serveur'] = $enregistrement['id_serveur'];

            $liste[$i]['url_serveur'] = $enregistrement['url_serveur'];

            $liste[$i]['emplacement_serveur'] = $enregistrement['emplacement'];

            $liste[$i]['nom_serveur'] = $enregistrement['nom_serveur'];


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $liste;
}
?>



