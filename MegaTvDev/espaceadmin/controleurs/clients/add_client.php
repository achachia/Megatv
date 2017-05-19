<?php
require './librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_agent_commercial = liste_agent_commercial();
$liste_clients=liste_clients();
$liste_pays=liste_pays();
$liste_devise=liste_devise();
if(!empty($_GET['message_erreur'])){
   $liste_erreur=unserialize($_GET['message_erreur']);
   $liste_valeur_saisi=unserialize($_GET['liste_valeur_saisi']);
   //var_dump($liste_valeur_saisi);
}elseif(!empty($_GET['code_client'])){
     $liste_valeur_saisi=infos_client($_GET['code_client']);
}
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>
