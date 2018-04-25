<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']); 

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";

$liste_serie_non_enregistre=liste_serie('non_enregistre');

$liste_serie_enregistre=liste_serie('enregistre');

//$liste_fichiers_non_enregistre=liste_fichiers('non_enregistre');

//var_dump($liste_fichiers_non_enregistre);

//$liste_fichiers_enregistre=liste_fichiers('enregistre');





include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";

?>
