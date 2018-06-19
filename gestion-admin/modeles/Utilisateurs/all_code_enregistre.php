<?php

function liste_codes_enregistre() {

    global $cxn;

    $liste = array();

    $i = 0;

    $date_connection = date("Y-m-d H:i:s");



    try {

        $sql = " SELECT CodesMegaTv.code_activation,CodesMegaTv.id_device,CodesMegaTv.date_start,CodesMegaTv.date_end
            
                 ,CodesMegaTv.type_code,CodesMegaTv.code_iptv,ListePeriodeAbonnement.nom_periode AS type_periode,CodesMegaTv.plate_form,CodesMegaTv.Type_periode AS id_periode

                 FROM  CodesMegaTv,ListePeriodeAbonnement
                 
                 WHERE CodesMegaTv.Type_periode=ListePeriodeAbonnement.id_periode";


        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {



         //   $liste[$i]['email'] = $enregistrement['email'];

            $liste[$i]['code_activation'] = $enregistrement['code_activation'];

            $liste[$i]['id_device'] = $enregistrement['id_device'];

            $liste[$i]['plate_form'] = $enregistrement['plate_form'];

            $liste[$i]['date_start'] = $enregistrement['date_start'];

            $liste[$i]['date_end'] = $enregistrement['date_end'];
            
            $liste[$i]['code_iptv'] = $enregistrement['code_iptv'];
            
            /*************************************** Experation code ************************************************/

            if ($enregistrement['date_end'] >= $date_connection && $enregistrement['date_end'] != '') {


                $liste[$i]['expiration_code'] = '<button type="button" class="btn btn-oval btn-primary">En cours</button>';
            }
            if ($enregistrement['date_end'] < $date_connection && $enregistrement['date_end'] != '') {


                $liste[$i]['expiration_code'] = '<button type="button" class="btn btn-oval btn-danger">Expiré</button>';
            }
            if ($enregistrement['date_end'] == '' && $enregistrement['date_end'] == '') {


                $liste[$i]['expiration_code'] = '<button type="button" class="btn btn-oval btn-warning">En attente</button>';
            }
            /*******************************************  Type code *******************************************/
             if ($enregistrement['type_code']=='1') {


                $liste[$i]['type_code'] = '<button type="button" class="btn btn-oval btn-primary">TEST</button>';
                
            }
             if ($enregistrement['type_code']=='2') {


                $liste[$i]['type_code'] = '<button type="button" class="btn btn-oval btn-warning">ABONNEMENT</button>';
            }
            /**********************************************************************************/
            
            $liste[$i]['type_periode'] = $enregistrement['type_periode'];
            
            $liste[$i]['id_periode'] = $enregistrement['id_periode'];
            


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}

function liste_periode() {

    global $cxn;

    $liste = array();

    $i = 0;


    try {

        $sql = " SELECT id_periode,nom_periode   FROM   ListePeriodeAbonnement ";

        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_periode'] = $enregistrement['id_periode'];

            $liste[$i]['nom_periode'] = $enregistrement['nom_periode'];

            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}
?>
