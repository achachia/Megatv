<?php

function get_link_vidoza($identifiant,$nbr_lettres) {

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

?>
