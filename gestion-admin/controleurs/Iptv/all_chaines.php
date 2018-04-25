<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";

$liste_chaines_iptv=ListeChainesIptv();

$liste_categorie_tv=liste_categorie_tv();

//var_dump($liste_bouquets_tv);  



include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php"; 

?>