<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__))) . chemin_modele . $module . "/" . $action . ".php";

$liste_serie_non_enregistre = liste_serie('non_enregistre');

$liste_serie_enregistre = liste_serie('enregistre');


if (isset($_GET['id_serie']) && isset($_GET['nom_serie'])) {

    $id_serie = $_GET['id_serie'];

    $nom_serie = $_GET['nom_serie'];

    $liste_saisons_non_enregistre = liste_saisons($id_serie, $nom_serie, 'non_enregistre');

    $liste_saisons_enregistre = liste_saisons($id_serie, $nom_serie, 'enregistre');
}
if (isset($_GET['id_serie']) && isset($_GET['nom_serie']) && isset($_GET['nom_saison'])) {

    $id_serie = $_GET['id_serie'];

    $nom_serie = $_GET['nom_serie'];
    
    $nom_saison=$_GET['nom_saison'];

    $liste_episodes_saison_non_enregistre = liste_episodes_saison($id_serie, $nom_serie, $nom_saison, 'non_enregistre');

    $liste_episodes_saison_enregistre = liste_episodes_saison($id_serie, $nom_serie, $nom_saison, 'enregistre');
    
    //var_dump($liste_episodes_saison_non_enregistre);
}

$liste_serveurs_vod=listeServeursVod();

$listeQualiteVod=listeQualiteVod();

       

include dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . "/" . $action . ".php";
?>
