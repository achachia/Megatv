<?phprequire './librairie/redirection.php';redirection_membre($_SESSION ['user_admin'] ['code_user']);require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";$liste_fichiers=liste_fichiers();$liste_genre_films=getListeGenreFilms();$liste_fichiers_non_enregistre=$liste_fichiers['liste_fichier_non_enregistre'];$liste_fichiers_enregistre=$liste_fichiers['liste_fichier_enregistre'];$liste_serveurs_vod=listeServeursVod();include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php"; ?>