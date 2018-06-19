<?php
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


function get_link_vidoza($identifiant, $nbr_lettres) {

    //https://vidoza.net/embed-728qedpneqz1.html

    $wikipediaURL = 'https://vidoza.net/embed-' . $identifiant . '.html';


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $wikipediaURL);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_USERAGENT, 'Le blog de Samy Dindane (www.dinduks.com');

    $resultat = curl_exec($ch);

    curl_close($ch);


    $wikipediaPage = new DOMDocument();

    $wikipediaPage->loadHTML($resultat);

    $parsing = '';

    $contenu_affiche = '';

    foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {


        if (strpos($script->textContent, '$( document ).ready(function()') !== FALSE) {

            $parsing.=$key . '-';

            $contenus = explode(",", $script->textContent);


            foreach ($contenus as $key1 => $contenu) {

                if (strpos($contenu, 'window.player = player') !== FALSE) {

                    $parsing.=$key1 . '-';



                    $parsing.=$nbr_lettres . '-' . $identifiant;


                    $chaine = substr($contenu, $nbr_lettres);

                    $chaine = substr($chaine, 0, -1);

                    $lien1 = stripslashes($chaine);


                    $contenu_affiche.=$parsing . "</br/>" . $contenu . "<br/>" . $lien1;

                    echo $contenu_affiche;
                }
            }
        }
    }
}

function get_link_uptostream($identifiant,$nbr_lettres) {
    
    //$nbr_lettres=117

    $wikipediaURL = 'https://uptostream.com/iframe/' . $identifiant;

    //On initialise cURL
    $ch = curl_init();
    //On lui transmet la variable qui contient l'URL
    curl_setopt($ch, CURLOPT_URL, $wikipediaURL);
    //On lui demdande de nous retourner la page
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //On envoie un user-agent pour ne pas être considéré comme un bot malicieux
    curl_setopt($ch, CURLOPT_USERAGENT, 'Le blog de Samy Dindane (www.dinduks.com');
    //On exécute notre requête et met le résultat dans une variable
    $resultat = curl_exec($ch);
    //On ferme la connexion cURL
    curl_close($ch);

    //On crée un nouveau document DOMDocument
    $wikipediaPage = new DOMDocument();
    //On y charge le contenu qu'on a récupéré avec cURL
    $wikipediaPage->loadHTML($resultat);

    $parsing = '';

    $contenu_affiche = '';


    foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {


        if (strpos($script->textContent, 'var videoId') !== FALSE) {


            $contenus = explode(",", $script->textContent);

            foreach ($contenus as $key1 => $contenu) {

                if (strpos($contenu, 'sources') !== FALSE) {

                    // echo $key1;
                    //var_dump($contenu);
                    //echo '<br/>';

                    $parsing.=$key1 . '-';

                    $parsing.=$nbr_lettres . '-' . $identifiant;

                    $chaine = substr($contenu, $nbr_lettres);

                    $chaine = substr($chaine, 0, -1);

                    $lien1 = stripslashes($chaine);


                    $contenu_affiche.=$parsing . "</br/>" . $contenu . "<br/>" . $lien1;

                    echo $contenu_affiche;
                }
            }
        }
    }
}

?>
