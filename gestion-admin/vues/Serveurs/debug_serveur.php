<div class="row" style="margin-top: 5%">
    <h2>Resulat de parsing :</h2>

    <h2>

        <?php
        if (isset($_GET['key_block_script']) && !empty($_GET['key_block_script'])) {
            echo $_GET['key_block_script'] . '-';
        }
        ?>

        <?php
        if (isset($_GET['key_ligne_script']) && !empty($_GET['key_ligne_script'])) {
            echo $_GET['key_ligne_script'] . '-';
        }
        ?>

        <?php
        if (isset($_GET['nbr_lettres']) && !empty($_GET['nbr_lettres'])) {
            echo $_GET['nbr_lettres'] . '-';
        }
        ?>

        <?php
        if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {
            echo $_GET['identifiant_streaming'];
        }
        ?>




    </h2>
</div>

<div class="row" style="margin-top: 5%">
    <form class="form-horizontal" id="debug_server" name="debug_server" method="GET" action="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur">
        <div class="row" style="margin-top: 5%">
            <div class="col-sm-4"  style="text-align: center">
                <label class="control-label" for="nom" style="color:blue;font-size:16px">IDENTIFIANT STREAMING: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            </div>   
            <div class="col-sm-8">
                <div class="form-group"  style="padding-top:1%">

                    <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"  placeholder="Entrer identifiant_streaming"  value="<?php
                    if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {
                        echo $_GET['identifiant_streaming'];
                    }
                    ?>">

                </div>

            </div>    
        </div>



        <div class="row" style="margin-top: 5%">
            <div class="col-sm-4" style="text-align: center">
                <label class="control-label" for="nom" style="color:blue;font-size:16px">NOMBRE DE LETTRES: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            </div>   
            <div class="col-sm-8">
                <div class="form-group"  style="padding-top:1%">

                    <input type="text" class="form-control" id="nbr_lettres"  name="nbr_lettres"  placeholder="Entrer le numero de ligne de script" value="<?php
                    if (isset($_GET['nbr_lettres']) && !empty($_GET['nbr_lettres'])) {
                        echo $_GET['nbr_lettres'];
                    }
                    ?>">


                </div>

            </div>    
        </div>





        <input type="hidden"  name="module"  value="Serveurs">

        <input type="hidden"  name="action"  value="debug_serveur">

        <div class="row" style="margin-top: 5%">

            <div class="col-sm-12" style="text-align: center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary block" name="envoyer"  value="envoyer" >Envoyer</button> 
                </div>
            </div>   

        </div>




    </form>

</div>




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

        $parsing = '';

        $contenu_affiche = '';

        foreach ($wikipediaPage->getElementsByTagName('script') as $key => $script) {


            if (strpos($script->textContent, '$( document ).ready(function()') !== FALSE) {

                $parsing.=$key . '-';

                $contenus = explode(",", $script->textContent);


                foreach ($contenus as $key1 => $contenu) {

                    if (strpos($contenu, 'window.player = player') !== FALSE) {

                        $parsing.=$key1 . '-';



                        $parsing.=$nbr_lettres . '-' . $_GET['identifiant_streaming'];


                        $chaine = substr($contenu, $nbr_lettres);

                        $chaine = substr($chaine, 0, -1);

                        $lien1 = stripslashes($chaine);


                         $contenu_affiche.=$parsing."</br/>".$contenu . "<br/>" . $lien1;
                         
                         echo $contenu_affiche;
                    }
                }
            }
        }
    }
    ?>
</div>
</div>

