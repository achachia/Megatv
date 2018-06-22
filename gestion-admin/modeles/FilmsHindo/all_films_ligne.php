<?php

//modele
function listeQualiteVod() {

    global $cxn;

    $liste = array();

    try {

        $sql = " SELECT  id_qualite,qualite   FROM  QualiteVod    ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_qualite'] = $enregistrement['id_qualite'];

            $liste[$i]['nom_qualite'] = $enregistrement['qualite'];


            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $liste;
}

function liste_films_en_ligne() {

    global $cxn;

    $liste = array();



    $i = 0;

    try {

        $sql = "  SELECT  Movies_arabic_hindo.titre_originale,Movies_arabic_hindo.id_movie,Movies_arabic_hindo.categorie,Movies_arabic_hindo.activation,Movies_arabic_hindo.cover,Movies_arabic_hindo.source"
                . " FROM  Movies_arabic_hindo  WHERE  Movies_arabic_hindo.categorie='10' ";



        $resultat = $cxn->query($sql);



        while ($enregistrement = $resultat->fetch()) {

            $id_fichier = $enregistrement['id_movie'];



            /*             * ********************************************************************* */

            try {

                $sql1 = "  SELECT  LinksServersMoviesArabicHindo.id_serveur,LinksServersMoviesArabicHindo.id_link,LinksServersMoviesArabicHindo.identifiant_streaming,LinksServersMoviesArabicHindo.url,LinksServersMoviesArabicHindo.activation,LinksServersMoviesArabicHindo.date_created,"
                        . " ListeServeursVod.nom_serveur "
                        . "    FROM  LinksServersMoviesArabicHindo,ListeServeursVod   WHERE LinksServersMoviesArabicHindo.id_serveur=ListeServeursVod.id_serveur   AND  LinksServersMoviesArabicHindo.id_fichier='" . $id_fichier . "' ";





                $select = $cxn->query($sql1);

                $nb = $select->rowCount();



                if ($nb > 0) {

                    $j = 0;

                    while ($enregistrement1 = $select->fetch()) {

                        if ($enregistrement1['identifiant_streaming'] != '') {
                            /*                             * ****************************************************************************** */


                            $liste[$i]['id_fichier'] = $enregistrement['id_movie'];

                            $liste[$i]['titre_originale'] = $enregistrement['titre_originale'];

                            $liste[$i]['poster_path'] =  $enregistrement['cover'];
                            
                            $liste[$i]['source'] = $enregistrement['source'];


                            /*                             * ******************************************************************************************* */


                            $liste[$i]['list_serveur'][$j]['id_link'] = $enregistrement1['id_link'];

                            $liste[$i]['list_serveur'][$j]['id_serveur'] = $enregistrement1['id_serveur'];

                            $liste[$i]['list_serveur'][$j]['identifiant_streaming'] = $enregistrement1['identifiant_streaming'];

                            $liste[$i]['list_serveur'][$j]['nom_serveur'] = $enregistrement1['nom_serveur'];

                            $liste[$i]['list_serveur'][$j]['url'] = $enregistrement1['url'];

                            $liste[$i]['list_serveur'][$j]['date_created'] = $enregistrement1['date_created'];

                            if ($enregistrement1['activation'] == '0') {

                                $liste[$i]['list_serveur'][$j]['activation'] = '<button    class="btn btn-danger btn-md"  > Inactif </button>';
                            }
                            if ($enregistrement1['activation'] == '1') {

                                $liste[$i]['list_serveur'][$j]['activation'] = '<button    class="btn btn-success btn-md"  > Actif </button>';
                            }


                            $j++;
                        }
                    }
                }
            } catch (Exception $e2) {

                echo $e2->getMessage();
            }



            /*             * ******************************************************** */

            $i++;
        }
    } catch (Exception $e1) {

        echo $e1->getMessage();
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


