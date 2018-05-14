<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $dns = 'mysql:host=localhost;dbname=megatv_ip';
    $user = 'root';
    $password = '';
    $host = 'http://localhost/MegacoursProcedural';
} else {

    $dns = 'mysql:host=localhost;dbname=megatv_ip';
    $user = 'achachia';
    $password = '7130chachia';
    $host = 'http://' . $_SERVER['SERVER_NAME'];
}


$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {

    $cxn = new PDO($dns, $user, $password, $options);
} catch (Exception $e) {

    echo "Connection à Mysql imposible : " . $e->getMessage();

    die();
}
/**********************************************************************/
ini_set('date.timezone', 'Europe/Paris');
$ip = $_SERVER['REMOTE_ADDR'];
$code_machine = $_GET['code_machine'];
$navigateur = $_SERVER['HTTP_USER_AGENT'];
$date_connection = date("Y-m-d  H:i:s");
/* * **************** Code-activation ******************* */
try {
    $sql = "   SELECT  ClientsMateriel.categorie_user,MaterielClients.code_client AS code_client,AbonnementsTv.date_debut,AbonnementsTv.code_active AS code_activation,AbonnementsTv.categorie_abo AS categorie_abo "
            . " FROM  MaterielClients,AbonnementsTv,ClientsMateriel ";
    $sql .= "   WHERE MaterielClients.code_machine=AbonnementsTv.code_machine";
    $sql .= "  AND  AbonnementsTv.code_user=ClientsMateriel.code_client ";
   // $sql .= "  AND  AbonnementsTv.etat='1'";
    $sql .= "  AND  MaterielClients.code_machine='" . $code_machine . "' ";
    $resultat = $cxn->query($sql);
    $nb = $resultat->rowCount();
    if ($nb > 0) {
        $enregistrement = $resultat->fetch();
        $code_activation = $enregistrement['code_activation'];
        $code_client = $enregistrement['code_client'];
        $categorie_abo = $enregistrement['categorie_abo'];
        $categorie_client = $enregistrement['categorie_user'];
        $date_debut_abo = $enregistrement['date_debut'];


        /*         * ************generer les links TV-radio **************** */

        header("Content-Type: audio/mpegurl");
        header("Content-Disposition: attachment; filename=playlist.m3u");
        print "#EXTM3U\r\n";

        try {
            if ($categorie_client == '2BSZJL') {
                $sql = " SELECT ChainesTv.nom,LinkTv.link AS source,CategorieTv.nom AS nom_categorie   FROM  LinkTv,ChainesTv,CategorieTv  WHERE  LinkTv.id_link=ChainesTv.id  AND ChainesTv.categorie=CategorieTv.id_categorie  AND ChainesTv.active='1' ";
                $sql.= " AND (categorie = '2'
                            OR categorie = '5'
                            OR categorie = '11'
                            OR categorie = '13'
                            OR categorie = '28'
                            OR categorie = '30'
                            OR categorie = '32'
                            OR categorie = '33'
                            OR categorie = '34'
                            OR categorie = '35'
                            OR categorie = '36'
                            OR categorie = '42'
                            OR categorie = '43'
                            OR categorie = '44'
                            OR categorie = '45'
                            OR categorie = '46'
                            OR categorie = '47')";
            } else {
                $sql = " SELECT ChainesTv.nom,LinkTv.link AS source,CategorieTv.nom AS nom_categorie  ";
                $sql.= "FROM  LinkTv,ChainesTv,CategorieTv  WHERE  LinkTv.id_link=ChainesTv.id  AND ChainesTv.categorie=CategorieTv.id_categorie  AND ChainesTv.active='1' ";
            }
            
            

            $resultat = $cxn->prepare($sql);
            $resultat->execute();
            while ($enregistrement = $resultat->fetch()) {
                print "#EXTINF:0," . $enregistrement['nom'] . "\r\n";
                print "#EXTGRP:" . $enregistrement['nom_categorie'] . " \r\n";
                print $enregistrement['source'] . $code_activation . "\r\n";
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données1";
        }
    } else {
//        try {
//            $sql = " INSERT INTO HistoriqueEchecConnectionMateriel (date,ip,code_machine) VALUES (:param1,:param2,:param3) ";
//            $resultat = $cxn->prepare($sql);
//            $resultat->bindParam(':param1', $date_connection);
//            $resultat->bindParam(':param2', $ip);
//            $resultat->bindParam(':param3', $code_machine);
//            $resultat->execute();
//        } catch (Exception $e) {
//            echo "Une erreur est survenue lors de la récupération des données2";
//        }
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données2";
}
//preg_match("/VLC/i", $nav) 

//if (!empty($code_activation) && $code_activation != '080751219467318') {
//    /*     * **************** Historique connection dans la table HistoriqueConnectionMateriel******************* */
//    try {
//        $sql = " INSERT INTO HistoriqueConnectionMateriel (date,ip,code_machine) VALUES (:param1,:param2,:param3) ";
//        $resultat = $cxn->prepare($sql);
//        $resultat->bindParam(':param1', $date_connection);
//        $resultat->bindParam(':param2', $ip);
//        $resultat->bindParam(':param3', $code_machine);
//        $resultat->execute();
//    } catch (Exception $e) {
//        echo "Une erreur est survenue lors de la récupération des données2";
//    }
//    /*     * ********************************************************************* */
//    try {
//        $sql = "  SELECT navigateur FROM MaterielClients WHERE code_machine ='" . $code_machine . "'  AND  code_client='" . $code_client . "' ";
//        $resultat = $cxn->prepare($sql);
//        $resultat->execute();
//        $enregistrement = $resultat->fetch();
//        $nav_machine = $enregistrement['navigateur'];
//        if ($nav_machine != '') {
//            /*             * **************** Upadte variable navigateur Box dans la table MaterielClients ******************** */
//
//
//            try {
//
//                $sql = " UPDATE  MaterielClients  SET navigateur=:param1 WHERE code_machine=:param2 ";
//                $resultat = $cxn->prepare($sql);
//                $resultat->bindParam(':param1', $navigateur);
//                $resultat->bindParam(':param2', $code_machine);
//                $resultat->execute();
//            } catch (Exception $e) {
//                echo "Une erreur est survenue lors de la récupération des données3";
//            }
//        }
//
//        /*         * ********************* Mise a jour abonnement client  dans la table AbonnementsTv ********************** */
//
//        if ($date_debut_abo == '') {
//            try {
//
//                if ($categorie_abo == '14U2BL') {
//                    $sql = " UPDATE  AbonnementsTv  SET date_debut='" . $date_connection . "',date_fin=DATE_ADD('" . $date_connection . "',INTERVAL 1 YEAR),etat='1'  WHERE code_user='" . $code_client . "' ";
//                } elseif ($categorie_abo == '3V5NK0') {
//                    $sql = " UPDATE  AbonnementsTv  SET date_debut='" . $date_connection . "',date_fin=DATE_ADD('" . $date_connection . "',INTERVAL 6 MONTH),etat='1'  WHERE code_user='" . $code_client . "' ";
//                } elseif ($categorie_abo == 'Y3Q1UU') {
//                    $sql = " UPDATE  AbonnementsTv  SET date_debut='" . $date_connection . "',date_fin=DATE_ADD('" . $date_connection . "',INTERVAL 3 MONTH),etat='1'  WHERE code_user='" . $code_client . "' ";
//                }
//                $resultat = $cxn->prepare($sql);
//                $resultat->execute();
//            } catch (Exception $e) {
//                echo "Une erreur est survenue lors de la récupération des données4";
//            }
//        }
//
//        /*         * ************************************************************************ */
//    } catch (Exception $e) {
//        echo "Une erreur est survenue lors de la récupération des données5";
//    }
//}
?>






