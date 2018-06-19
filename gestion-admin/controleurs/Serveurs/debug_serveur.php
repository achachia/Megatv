<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__))) . chemin_modele . $module . "/" . $action . ".php";

if (isset($_GET['serveur_video']) && $_GET['serveur_video'] == '3') {

    if (!empty($_GET['nbr_lettres'])) {

        $nbr_lettres = $_GET['nbr_lettres'];
    } else {

        $nbr_lettres = 144;
    }
}

if (isset($_GET['serveur_video']) && $_GET['serveur_video'] == '1') {

    if (!empty($_GET['nbr_lettres'])) {

        $nbr_lettres = $_GET['nbr_lettres'];
    } else {

        $nbr_lettres = 117;
    }
}


$liste_serveurs_vod = listeServeursVod();


include dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . "/" . $action . ".php";
?>
