<?php

//modele



function liste_fichiers($mod = '') {

    global $cxn;

    $liste_episode_enregistre = array();
 
    $liste_episode_non_enregistre = array();


    $dir = "/volume1/web/media/Serie-Tv";

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


