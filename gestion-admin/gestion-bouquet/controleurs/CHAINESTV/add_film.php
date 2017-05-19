<?php
require './../librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_sources=liste_sources();
$liste_SectionVod=liste_SectionVod('1');
$value_button='ENREGISTRER';
if($_GET['mode']=='modifier'){
    $id_film=$_GET['id_film'];
    $infos_film=info_film($id_film);
    $value_button='MODIFIER';
}
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>

