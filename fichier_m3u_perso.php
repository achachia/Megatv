<?php
 header("Content-Type: audio/mpegurl");
 header("Content-Disposition: attachment; filename=playlist.m3u");
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "connection/config.php";
$code_activation='094581502560920';

header("Content-Type: audio/mpegurl");
header("Content-Disposition: attachment; filename=playlist.m3u");

print "#EXTM3U\r\n";

/* * ***********generer les links TV Bouquets valides **************** */
try {
    $sql = " SELECT ChainesTv.id AS id_chaine,ChainesTv.nom,LinkTv.link AS source,CategorieTv.nom AS nom_categorie   FROM  LinkTv,ChainesTv,CategorieTv  WHERE  LinkTv.id_link=ChainesTv.id  AND ChainesTv.categorie=CategorieTv.id_categorie  AND ChainesTv.active='1' ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    while ($enregistrement = $resultat->fetch()) {
        print "#EXTINF:-1, group-title='" . $enregistrement['nom_categorie'] . "'," . $enregistrement['nom'] ."-".$enregistrement['id_chaine']. "\r\n";
        // print "#EXTREM: Sport\r\n";

        print $enregistrement['source'] . $code_activation . "\r\n";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données1";
}
/* * ***********generer les links TV Bouquets non-valides **************** */
try {
    $sql = " SELECT ChainesTv.id AS id_chaine,ChainesTv.nom,LinkTv.link AS source,CategorieTv.nom AS nom_categorie   FROM  LinkTv,ChainesTv,CategorieTv  WHERE  LinkTv.id_link=ChainesTv.id  AND ChainesTv.categorie=CategorieTv.id_categorie  AND ChainesTv.active='0' ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    while ($enregistrement = $resultat->fetch()) {
        print "#EXTINF:-1, group-title='Hors-Service'," . $enregistrement['nom']."-".$enregistrement['id_chaine'] . "\r\n";
        // print "#EXTREM: Sport\r\n";

        print $enregistrement['source'] . $code_activation . "\r\n";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données1";
}

/* * ***********generer les links TV Bonus **************** */
try {
    $sql = " SELECT  nom,link FROM  LinkBonus ";
    $resultat = $cxn->prepare($sql);
    $resultat->execute();
    while ($enregistrement = $resultat->fetch()) {
        print "#EXTINF:-1, group-title='Bonus-Tv'," . $enregistrement['nom'] . "\r\n";
        // print "#EXTREM: Sport\r\n";

        print $enregistrement['link'] . $code_activation . "\r\n";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données1";
}

?>



