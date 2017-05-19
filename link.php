<?php

// parametres de connection
$dns = 'mysql:host=localhost;dbname=megacour_iptv';
$user = 'megacour_user2';
$password = '7130chachia';
// Options de connection
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

$ip = $_SERVER['REMOTE_ADDR'];

$code_user = $_GET['user'];

$nav = $_SERVER['HTTP_USER_AGENT'];

$date_created = date("Y-m-d  H:i:s");

//preg_match("/VLC/i", $nav) 

if ($code_user=='abdel') {
    /*     * **************** Verification adresse Ip ******************* */
//    try {
//        $sql = " SELECT id_ip  FROM  user_ip  WHERE ip='" . $ip . "'  AND  user='" . $code_user . "' ";
//        $resultat = $cxn->query($sql);
//        $nb = $resultat->rowCount();
//        if ($nb <= 0) {
//            /*             * **************** Intertion adresse Ip ******************* */
//            try {
//                $sql = " INSERT INTO user_ip (ip,user,navigateur,date_cretead) VALUES (:param1,:param2,:param3,:param4)   ";
//                $resultat = $cxn->prepare($sql);
//                $resultat->bindParam(':param1', $ip);
//                $resultat->bindParam(':param2', $code_user);
//                $resultat->bindParam(':param3', $nav);
//                $resultat->bindParam(':param4', $date_created);
//                $resultat->execute();
//            } catch (Exception $e) {
//                echo "Une erreur est survenue lors de la récupération des données1";
//            }
//        }
//    } catch (Exception $e) {
//        echo "Une erreur est survenue lors de la récupération des données2";
//    }



    /*     * ************generer les links TV-radio **************** */

    header("Content-Type: audio/mpegurl");
    header("Content-Disposition: attachment; filename=playlist.m3u");

    print "#EXTM3U\r\n";

    try {
        $sql = " SELECT nom,source  FROM  link ORDER BY link.order DESC  ";
        $resultat = $cxn->query($sql);
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
       // $new_code = '155020464983010';
        while ($enregistrement = $resultat->fetch()) {
            print "#EXTINF:-1, group-title=''," . $enregistrement['nom'] . "\r\n";
            // print "#EXTREM: Sport\r\n";
           // print str_replace("080751219467318", $new_code, $enregistrement['source']) . "\r\n";
            print $enregistrement['source'] . "\r\n";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données3";
    }
}
?>

