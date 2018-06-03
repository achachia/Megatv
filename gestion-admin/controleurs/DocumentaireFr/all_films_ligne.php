<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";

$liste_genre_films=getListeGenreFilms();

$liste_films_en_ligne=liste_films_en_ligne();

$liste_serveurs_vod=listeServeursVod();


include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php"; 

?>

