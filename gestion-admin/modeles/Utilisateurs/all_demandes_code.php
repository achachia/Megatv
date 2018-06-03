<?php

function liste_demandes_attente() {

    global $cxn;

    $liste = array();

    $i = 0;



    try {

        $sql = " SELECT  id_demande,email,id_device,date_demande,plate_forme FROM  DemandesCodesActivation    WHERE  statut_demande='1' ";

        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_demande'] = $enregistrement['id_demande'];

            $liste[$i]['id_device'] = $enregistrement['id_device'];

            $liste[$i]['email'] = $enregistrement['email'];

            $liste[$i]['date_demande'] = $enregistrement['date_demande'];

            $liste[$i]['platforme'] = $enregistrement['plate_forme'];

            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}

function liste_codes_test_valides() {

    global $cxn;

    $liste = array();

    $i = 0;
    
    $date_connection=date("Y-m-d H:i:s");



    try {

        $sql = " SELECT DemandesCodesActivation.date_demande,DemandesCodesActivation.email,CodesMegaTv.code_activation,DemandesCodesActivation.id_device,CodesMegaTv.date_start,CodesMegaTv.date_end

                 FROM  CodesMegaTv,DemandesCodesActivation  

                 WHERE CodesMegaTv.id_demande=DemandesCodesActivation.id_demande ";
  

        $resultat = $cxn->query($sql);

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['date_demande'] = $enregistrement['date_demande'];

            $liste[$i]['email'] = $enregistrement['email'];

            $liste[$i]['code_activation'] = $enregistrement['code_activation'];

            $liste[$i]['id_device'] = $enregistrement['id_device'];

            $liste[$i]['date_start'] = $enregistrement['date_start'];

            $liste[$i]['date_end'] = $enregistrement['date_end'];
            
            if($enregistrement['date_end']>=$date_connection && $enregistrement['date_end']!=''){
                
                
                 $liste[$i]['expiration_code'] ='<button type="button" class="btn btn-oval btn-primary">En cours</button>' ;
            }
              if($enregistrement['date_end']<$date_connection && $enregistrement['date_end']!=''){
                
                
                 $liste[$i]['expiration_code'] ='<button type="button" class="btn btn-oval btn-danger">Expiré</button>' ;
            }
                  if($enregistrement['date_end']=='' && $enregistrement['date_end']==''){
                
                
                 $liste[$i]['expiration_code'] ='<button type="button" class="btn btn-oval btn-warning">En attente</button>' ;
            }


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
