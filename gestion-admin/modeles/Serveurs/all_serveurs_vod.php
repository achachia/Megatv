<?php

function liste_serveurs_vod() {

    global $cxn;

    $liste = array();

    $i = 0;



    try {

        $sql = " SELECT  id_serveur,logo,nom_serveur,emplacement,url_serveur,activation,date_created FROM  ListeServeursVod ";



        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_serveur'] = $enregistrement['id_serveur'];

            $liste[$i]['logo_serveur'] = $enregistrement['logo'];

            $liste[$i]['nom_serveur'] = $enregistrement['nom_serveur'];

            $liste[$i]['url_serveur'] = $enregistrement['url_serveur'];

            $liste[$i]['emplacement_serveur'] = $enregistrement['emplacement'];

            $liste[$i]['activation'] = $enregistrement['activation'];

            $liste[$i]['date_created'] = $enregistrement['date_created'];

            /*             * ************************************* Experation code *********************************************** */

            if ($enregistrement['activation'] == '0') {

                $liste[$i]['statut_serveur'] = '<button type="button" class="btn btn-oval btn-danger">Inactif</button>';
            } else {

                $liste[$i]['statut_serveur'] = '<button type="button" class="btn btn-oval btn-primary">Actif</button>';
            }


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}
