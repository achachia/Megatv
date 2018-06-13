<?php

function get_link_vidoza($identifiant, $param1 = NULL, $param2 = NULL, $nbr = NULL) {

    //https://vidoza.net/embed-728qedpneqz1.html

    $wikipediaURL = 'https://vidoza.net/embed-' . $identifiant . '.html';



//echo $wikipediaURL;
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
   


    foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {

        echo $key;
        var_dump($script->textContent);
        echo '<br/>';




        if ($key == $param1) {



            $contenus = explode(",", $script->textContent);


            foreach ($contenus as $key1 => $contenu) {

                // echo $key1;
                //var_dump($contenu);
                //echo '<br/>';


                if ($key1 == $param2) {

                    $chaine = substr($contenu, $nbr);

                    $chaine = substr($chaine, 0, -1);

                    $lien1 = stripslashes($chaine);
                }
            }
        }
    }



    if (!is_null($nbr)) {

        echo $lien1;
    }
}

?>
