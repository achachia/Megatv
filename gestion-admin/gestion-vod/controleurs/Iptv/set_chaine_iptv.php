<?php

session_start();
session_regenerate_id();
//header('Content-type: application/json');

$dns = 'mysql:host=localhost;dbname=megatv_ip';

$user = 'achachia';

$password = '7130chachia';

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

ini_set('date.timezone', 'Europe/Paris');

var_dump($_POST);

$etat = TRUE;

$date_upload = date("Y-m-d");

$objet = array();

$id_chaine = $_POST['id_chaine'];

$nom_chaine = $_POST['nom_chaine'];

$categorie_tv = $_POST['categorie_tv'];

$active_chaine = $_POST['active_chaine'];

$link_chaine = $_POST['link_chaine'];

$nom_m3u = $_POST['nom_m3u'];

/* * *********** Mise a jour-1  *********************** */

try {

    $sql = " UPDATE  ChainesTv  SET  nom=:param1,categorie=:param2,active=:param3,Nom_m3u=:param5    WHERE id=:param4";

    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param1', $nom_chaine);

    $stmt->bindParam(':param2', $categorie_tv);

    $stmt->bindParam(':param3', $active_chaine);

    $stmt->bindParam(':param4', $id_chaine);

    $stmt->bindParam(':param5', $nom_m3u);

    $stmt->execute();
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}

/* * *********** Mise a jour-2  *********************** */

try {

    $sql = " UPDATE  LinkTv  SET  link=:param5  WHERE id_chaine=:param6 ";

    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param5', $link_chaine);

    $stmt->bindParam(':param6', $id_chaine);


    $stmt->execute();
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}

if ($etat) {

    header("Location: http://megatv.ovh/gestion-admin/gestion-vod/index.php?module=Iptv&action=all_chaines ");
} else {
    
}
?>



