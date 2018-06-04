<?php

//modele

function liste_films_en_ligne() {

    global $cxn;

    $liste = array();



    $i = 0;

    try {

        $sql = " SELECT  FichierVod.titre_originale,FichierVod.id_fichier,FichierVod.identifiant_streaming,FichierVod.date_upload,FichierVod.section_fichier,FichierVod.id_TMD,"
                . "FichierVod.genre,FichierVod.langage,FichierVod.url,FichierVod.id_serveur,FichierVod.activation,"
                . " ListeServeursVod.nom_serveur "
                . "FROM  FichierVod,ListeServeursVod "
                . "WHERE FichierVod.id_serveur=ListeServeursVod.id_serveur "
                . " AND   FichierVod.section_fichier=5  ";

        
      
        $resultat= $cxn->query($sql);


        while ($enregistrement = $resultat->fetch()) {


            $liste[$i]['id_fichier'] = $enregistrement['id_fichier'];

            $liste[$i]['titre_originale'] = $enregistrement['titre_originale'];

            $liste[$i]['date_upload'] = $enregistrement['date_upload'];

            $liste[$i]['id_TMD'] = $enregistrement['id_TMD'];

            $liste[$i]['id_serveur'] = $enregistrement['id_serveur'];

            $liste[$i]['identifiant_streaming'] = $enregistrement['identifiant_streaming'];

            $liste[$i]['nom_serveur'] = $enregistrement['nom_serveur'];

            /*             * ******************************************************* */

          $json_source = file_get_contents('https://api.themoviedb.org/3/movie/' .  $enregistrement['id_TMD'] . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');

            // Décode le JSON
            $json_data = json_decode($json_source);

            $liste[$i]['poster_path'] = 'https://image.tmdb.org/t/p/w600_and_h900_bestv2' . $json_data->poster_path;

            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}

function getNomSection($id_section) {

    global $cxn;

    try {

        $sql = " SELECT nom_section FROM  SectionVod   WHERE id_section=:param ";


        $resultat = $cxn->prepare($sql);

        $resultat->bindParam(':param', $id_section);

        $resultat->execute();

        $enregistrement = $resultat->fetch();

        $string = $enregistrement['nom_section'];
    } catch (Exception $e) {

        echo $e->getMessage();
    }


    return $string;
}

function getListeGenreFilms() {

    global $cxn;

    $liste = array();

    try {

        $sql = " SELECT id_section,nom_section FROM  SectionVod  ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_section'] = $enregistrement['id_section'];

            $liste[$i]['nom_section'] = $enregistrement['nom_section'];


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $liste;
}

function listeServeursVod() {

    global $cxn;

    $liste = array();

    try {

        $sql = " SELECT  id_serveur,url_serveur,emplacement,nom_serveur  FROM  ListeServeursVod   ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_serveur'] = $enregistrement['id_serveur'];

            $liste[$i]['url_serveur'] = $enregistrement['url_serveur'];

            $liste[$i]['emplacement_serveur'] = $enregistrement['emplacement'];

            $liste[$i]['nom_serveur'] = $enregistrement['nom_serveur'];


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $liste;
}
?>


