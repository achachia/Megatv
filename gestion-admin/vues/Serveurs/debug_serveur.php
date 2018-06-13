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


        <?php if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) { ?>

            <div class="row" style="margin-top: 5%"  >
                <div class="col-sm-4" style="text-align: center">
                    <label class="control-label" for="nom" style="color:blue;font-size:16px">ID BLOCK SCRIPT: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                </div>   
                <div class="col-sm-8">
                    <div class="form-group"  style="padding-top:1%">

                        <input type="text" class="form-control" id="key_block_script"  name="key_block_script"  placeholder="Entrer le key block script"  value="<?php
                        if (isset($_GET['key_block_script']) && !empty($_GET['key_block_script'])) {
                            echo $_GET['key_block_script'];
                        }
                        ?>">

                    </div>

                </div>    
            </div>


        <?php } ?>

        <?php if (isset($_GET['key_block_script']) && !empty($_GET['key_block_script'])) { ?>

            <div class="row" style="margin-top: 5%">
                <div class="col-sm-4"  style="text-align: center">
                    <label class="control-label" for="nom" style="color:blue;font-size:16px">NUMERO LIGNE SCRIPT: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                </div>   
                <div class="col-sm-8">
                    <div class="form-group"  style="padding-top:1%">

                        <input type="text" class="form-control" id="key_ligne_script"  name="key_ligne_script"  placeholder="Entrer le numero de ligne de script" value="<?php
                        if (isset($_GET['key_ligne_script']) && !empty($_GET['key_ligne_script'])) {
                            echo $_GET['key_ligne_script'];
                        }
                        ?>">


                    </div>

                </div>    
            </div>
        <?php } ?>




        <?php if (isset($_GET['key_ligne_script']) && !empty($_GET['key_ligne_script'])) { ?>

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
        <?php } ?>




        <input type="hidden"  name="module"  value="Serveurs">

        <input type="hidden"  name="action"  value="debug_serveur">

        <div class="row" style="margin-top: 5%">

            <div class="col-sm-12" style="text-align: center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary block" name="envoyer"  value="envoyer" >Envoyer</button> 
                </div>
            </div>   

        </div>






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


            if (strpos($script->textContent, 'var player = this; window.player = player') !== FALSE) {
                echo $key . '-test-<br/>';
            }

            if (empty($_GET['key_block_script'])) {

                echo $key . '<br/>';

                echo $script->textContent . '<br/>';
            }



            if ($key == $_GET['key_block_script']) {




                $contenus = explode(",", $script->textContent);


                foreach ($contenus as $key1 => $contenu) {

                    if (empty($_GET['key_ligne_script'])) {


                        echo $key1;

                        var_dump($contenu);

                        echo '<br/>';
                    }




                    if ($key1 == $_GET['key_ligne_script']) {

                        echo $contenu . "<br/>";

                        if (!empty($_GET['nbr_lettres'])) {

                            $chaine = substr($contenu, $_GET['nbr_lettres']);

                            $chaine = substr($chaine, 0, -1);

                            $lien1 = stripslashes($chaine);

                            echo $lien1;
                        }
                    }
                }
            }
        }
    }
    ?>
</div>
</div>

