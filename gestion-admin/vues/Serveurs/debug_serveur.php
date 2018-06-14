
<div class="row" style="margin-top: 5%">
    <form class="form-horizontal" id="debug_server" name="debug_server" method="GET" action="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur">
        <div class="row" style="margin-top: 1%">
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



        <div class="row" style="margin-top: 1%">
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

        <div class="row" style="margin-top: 2%">

            <div class="col-sm-12" style="text-align: center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary block" name="envoyer"  value="envoyer" >Envoyer</button> 
                </div>
            </div>   

        </div>




    </form>

</div>




<div class="row" style="margin-top: 3%">

    <?php
    if (isset($_GET['identifiant_streaming']) && !empty($_GET['identifiant_streaming'])) {


        get_link_vidoza($_GET['identifiant_streaming'],$nbr_lettres);
    }
    ?>
</div>


