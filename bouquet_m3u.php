<?php
 header("Content-Type: audio/mpegurl");
 header("Content-Disposition: attachment; filename=playlist.m3u");
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "connection/config_vod.php";

/* * ***********generer les links Films edition public **************** */
// fichier de connection

try {
    
    $sql = " SELECT  UPPER(LinkVodFilms.nom) AS nom_film,LinkVodFilms.link AS 

             link_film,CategorieVodFilms.nom_categorie 

             FROM  LinkVodFilms,CategorieVodFilms 

             WHERE LinkVodFilms.categorie=CategorieVodFilms.id_categorie
             
             AND plate_forme = '2'

             ORDER BY LinkVodFilms.date_ajout DESC ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute(); 

    print "#EXTM3U\r\n";
    while ($enregistrement = $resultat->fetch()) {
        print "#EXTINF:-1, group-title='" . $enregistrement['nom_categorie'] . "'," . $enregistrement['nom_film'] . "\r\n";
        
        print $enregistrement['link_film']  . "\r\n";

    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données1";
}
?>




