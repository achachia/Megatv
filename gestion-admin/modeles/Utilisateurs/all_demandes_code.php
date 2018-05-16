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
