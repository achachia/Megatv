<div class="row" style="margin-top: 5%">
    <form class="form-horizontal" id="debug_server" name="debug_server" method="GET" action="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur">

        <div class="form-group"  style="padding-top:1%">
            <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom" style="color:blue;font-size:16px">IDENTIFIANT STREAMING: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            <div class="col-sm-8">

                <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"  placeholder="Entrer identifiant_streaming">

                <input type="hidden"  name="module"  value="Serveurs">

                <input type="hidden"  name="action"  value="debug_serveur">

                <button type="submit" class="btn btn-primary" name="envoyer"  value="envoyer" style="margin-top:2% ">Envoyer</button>


            </div>
        </div> 

    </form>

    <div class="row" style="margin-top: 5%">

        <?php
        if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {





            $wikipediaURL = 'https://vidoza.net/embed-' . $_GET['identifiant_streaming'] . '.html';
            
          



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
            
            var_dump($wikipediaPage->getElementsByTagName('script'));



            foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {

                echo $key;
                var_dump($script->textContent);
                echo '<br/>';
            }
        }
        ?>
    </div>
</div>

