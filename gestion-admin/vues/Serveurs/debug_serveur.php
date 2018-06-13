<div class="row" style="margin-top: 5%">
    <form class="form-horizontal" id="debug_server" name="debug_server" method="GET" action="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur">

        <div class="form-group"  style="padding-top:1%">
            <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom" style="color:blue;font-size:16px">IDENTIFIANT STREAMING: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            <div class="col-sm-8">

                <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"  placeholder="Entrer identifiant_streaming"  value="<?php
                if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {
                    echo $_GET['identifiant_streaming'];
                }
                ?>">

<?php if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) { ?>


                    <input type="text" class="form-control" id="key_block_script"  name="key_block_script"  placeholder="Entrer le key block script"  value="<?php
    if (isset($_GET['key_block_script']) && !empty($_GET['key_block_script'])) {
        echo $_GET['key_block_script'];
    }
    ?>">

<?php } ?>

                <?php if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming']) && isset($_GET['key_block_script']) && !empty($_GET['key_block_script'])) { ?>


                    <input type="text" class="form-control" id="nbr_lettres"  name="nbr_lettres"  placeholder="Entrer le nombre de caracteres" value="<?php
                if (isset($_GET['nbr_lettres']) && !empty($_GET['nbr_lettres'])) {
                    echo $_GET['nbr_lettres'];
                }
                ?>">

<?php } ?>

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





            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $wikipediaURL);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_USERAGENT, 'Le blog de Samy Dindane (www.dinduks.com');

            $resultat = curl_exec($ch);

            curl_close($ch);


            $wikipediaPage = new DOMDocument();

            $wikipediaPage->loadHTML($resultat);



            foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {

                if (empty($_GET['key_block_script'])) {

                    echo $key;

                    var_dump($script->textContent);

                    echo '<br/>';
                }



                if ($key == $_GET['identifiant_streaming']) {



                    $contenus = explode(",", $script->textContent);


                    foreach ($contenus as $key1 => $contenu) {

                        if (empty($_GET['nbr_lettres'])) {

                            echo $key1;

                            var_dump($contenu);

                            echo '<br/>';
                        }




                        if ($key1 == $_GET['key_block_script']  && !empty($_GET['key_block_script'])) {

                            $chaine = substr($contenu, $_GET['nbr_lettres']);

                            $chaine = substr($chaine, 0, -1);

                            $lien1 = stripslashes($chaine);

                            echo $lien1;
                        }
                    }
                }
            }
        }
        ?>
    </div>
</div>

