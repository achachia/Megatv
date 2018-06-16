<div>
    <?php
    $strStart = '2013-06-19 21:47:40';
    $strEnd = '2013-06-20 21:48:30';

    $dteStart = new DateTime($strStart);
    $dteEnd = new DateTime($strEnd);

    $dteDiff = $dteStart->diff($dteEnd);

    $nbr_seconde = intval($dteDiff->s);

    $nbr_minute = intval($dteDiff->i);

    $nbr_minute = intval($dteDiff->i);

    $nbr_heure = intval($dteDiff->h);

    $nbr_jour = intval($dteDiff->d);

    $nbre_seconde_totale = $nbr_jour * 86400 + $nbr_heure * 3600 + $nbr_minute * 60 + $nbr_seconde;

    echo "total seconde:" . $nbr_seconde . '<br/>';

    echo "total jour:" . $nbr_jour . '<br/>';

    echo "total heure:" . $nbr_heure . '<br/>';

    echo "total minute:" . $nbr_minute . '<br/>';

    echo "total :" . $nbre_seconde_totale.'secondes';
    ?>
</div>
<div class="row" style="margin-top: 5%">
    <form class="form-horizontal" id="debug_server" name="debug_server" method="GET" action="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur">

        <div class="row" style="margin-top: 1%">
            <div class="col-sm-4"  style="text-align: center">
                <label class="control-label" for="nom" style="color:blue;font-size:16px">SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            </div>   
            <div class="col-sm-6">
                <div class="form-group"  style="padding-top:1%">

                    <select class="form-control" name="serveur_video"  id="serveur_video" >

                        <?php
                        $tr = '<option value="">Select-serveur</option>';

                        foreach ($liste_serveurs_vod as $serveur) {


                            $tr.="<option value='" . $serveur['id_serveur'] . "' ";

                            $tr.= ">" . $serveur['nom_serveur'] . '-' . $serveur['emplacement_serveur'] . "</option>";
                        }

                        echo $tr;
                        ?>

                    </select>

                </div>

            </div>    
        </div>
        <div class="row" style="margin-top: 1%">
            <div class="col-sm-4"  style="text-align: center">
                <label class="control-label" for="nom" style="color:blue;font-size:16px">IDENTIFIANT STREAMING: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            </div>   
            <div class="col-sm-6">
                <div class="form-group"  style="padding-top:1%">

                    <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"  placeholder="Entrer identifiant_streaming"  value="<?php
                        if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {
                            echo $_GET['identifiant_streaming'];
                        }
                        ?>">

                </div>

            </div>    
        </div>



        <div class="row" style="margin-top: 1%">
            <div class="col-sm-4" style="text-align: center">
                <label class="control-label" for="nom" style="color:blue;font-size:16px">NOMBRE DE LETTRES: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
            </div>   
            <div class="col-sm-6">
                <div class="form-group"  style="padding-top:1%">

                    <input type="text" class="form-control" id="nbr_lettres"  name="nbr_lettres"  placeholder="Entrer le numero de ligne de script" value="<?php
                    if (isset($nbr_lettres) && !empty($nbr_lettres)) {
                        echo $nbr_lettres;
                    }
                        ?>">


                </div>

            </div>    
        </div>



        <input type="hidden"  name="module"  value="Serveurs">

        <input type="hidden"  name="action"  value="debug_serveur">

        <div class="row" style="margin-top: 2%;margin-left:65% ">

            <div class="col-sm-12" style="text-align: center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary block" name="envoyer"  value="envoyer" >DEBUGER</button> 
                </div>
            </div>   

        </div>




    </form>

</div>




<div class="row" style="margin-top: 3%;margin-left: 30%">

    <?php
    if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {

        if (isset($_GET['serveur_video']) && $_GET['serveur_video'] == '3') {

            get_link_vidoza($_GET['identifiant_streaming'], $nbr_lettres);
        }
        if (isset($_GET['serveur_video']) && $_GET['serveur_video'] == '1') {

            get_link_uptostream($_GET['identifiant_streaming'], $nbr_lettres);
        }
    }
    ?>
</div>


