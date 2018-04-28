<section>
    <section class="main-content">
        <div class="row">
            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-info text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">FILMS</h4>
                                <p class="mb0 text-muted"><?= $nbr_films; ?> films</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_films; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            <div class="col-lg-4">
                <!-- START widget--> 
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-danger text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">CARTOON</h4>
                                <p class="mb0 text-muted"><?= $nbr_cartoon; ?> films</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_cartoon; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>

            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-success text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">SERIE TV</h4>
                                <p class="mb0 text-muted"><?= $nbr_serie_tv; ?> serie</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_serie_tv; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>


        </div>
    </section>

</section>
<!-------------------------------------------------------------------------------->
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-default">

            <div class="panel-heading" style="color:red;">LISTES DES SERIES TV NON ENREGISTRE</div>

            <div class="panel-body">


                <table  id="liste_serie_non_enregistre" name="liste_serie_non_enregistre" class="table table-striped table-hover"> 

                    <thead  style="background-color:#D8ECF7">

                        <tr>                          

                            <th>NOM SERIE</th>                            

                            <th class="sort-alpha">ACTION</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        if (isset($liste_serie_non_enregistre)) {

                            $tr = '';
                            $j = 1;

                            foreach ($liste_serie_non_enregistre as $value) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value['nom_serie'] . '</td>';

                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_non_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Enregistrer </button></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                        }
                        ?>



                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<!--------------------------------------------------------------------------------------------------------------->

<?php if (sizeof($liste_serie_enregistre) > 0) { ?>
    <div class="row" style="margin-left:100px">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-heading" style="color:red">LISTES DES SERIES TV  ENREGISTRE</div>

                <div class="panel-body">


                    <table  id="liste_serie_enregistre" name="liste_serie_enregistre" class="table table-striped table-hover"> 

                        <thead  style="background-color:#D0D1D2">

                            <tr>                          

                                <th>NOM SERIE</th>                            

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            if (isset($liste_serie_enregistre)) {

                                $tr = '';
                                $j = 1;

                                foreach ($liste_serie_enregistre as $value) {

                                    $tr .= '<tr>';

                                    $tr .= '<td>' . $value['nom_serie'] . '</td>';

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Editer </button>';

                                    $tr .= '<a href="' . $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $value['id_serie'] . '&nom_serie=' . $value['nom_serie'] . '" ><button    class="btn btn-primary btn-lg"  > CONSULTER LES SAISONS</button></a></td>';


                                    $tr .= '</tr>';

                                    $j++;
                                }

                                echo $tr;
                            }
                            ?>



                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
<?php } ?>
<!------------------------------------------------------->

<?php if (isset($_GET['id_serie']) && !empty($_GET['id_serie'])) { ?>

    <?php if (isset($liste_saisons_non_enregistre) && sizeof($liste_saisons_non_enregistre) > 0) { ?>
        <div class="row"  style="margin-left:180px">

            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading" style="color:red;">LISTES DES SAISONS TV NON ENREGISTRE</div>

                    <div class="panel-body">


                        <table  id="liste_saisons_enregistre" name="liste_saisons_non_enregistre" class="table table-striped table-hover"> 

                            <thead style="background-color:#F2DDDD">

                                <tr>                          

                                    <th>N° SAISON</th>                            

                                    <th class="sort-alpha">ACTION</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $tr = '';
                                $j = 1;

                                foreach ($liste_saisons_non_enregistre as $value) {

                                    $tr .= '<tr>';

                                    $tr .= '<td>' . $value['nom_saison'] . '</td>';

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_saison_non_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Enregistrer la saison </button></td>';


                                    $tr .= '</tr>';

                                    $j++;
                                }

                                echo $tr;
                                ?>



                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    <?php } ?>   
    <!-------------------------------------------------------------------------------------------------------->

    <?php if (isset($liste_saisons_enregistre) && sizeof($liste_saisons_enregistre) > 0) { ?>

        <div class="row"  style="margin-left:220px">

            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading" >LISTES DES SAISONS TV  ENREGISTRE</div>

                    <div class="panel-body">


                        <table  id="liste_saisons_enregistre" name="liste_saisons_enregistre" class="table table-striped table-hover"> 

                            <thead style="color:#red">

                                <tr>                          

                                    <th>N° SAISON</th>                            

                                    <th class="sort-alpha">ACTION</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $tr = '';
                                $j = 1;

                                foreach ($liste_saisons_enregistre as $value) {

                                    $tr .= '<tr>';

                                    $tr .= '<td>' . $value['nom_saison'] . '</td>';

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > EDITER </button>';

                                    $tr .= '<a href="' . $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $value['id_serie'] . '&nom_serie=' . $_GET['nom_serie'] . '&id_saison=' . $value['id_saison'] . '&nom_saison=' . $value['nom_saison'] . '"><button   class="btn btn-primary btn-lg"  > CONSULTER LES EPISODES </button></a></td>';


                                    $tr .= '</tr>';

                                    $j++;
                                }

                                echo $tr;
                                ?>



                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>

    <?php if (isset($_GET['id_serie']) && !empty($_GET['id_serie']) && isset($_GET['id_saison']) && !empty($_GET['id_saison'])) {       ?> 

        <?php if (isset($liste_episodes_saison_enregistre) && sizeof($liste_episodes_saison_enregistre) > 0) {        ?>


            <div class="row"  style="margin-left:200px">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading" >LISTES DES EPISODES TV  ENREGISTRE</div>

                        <div class="panel-body">


                            <table  id="liste_episodes_saison_enregistre" name="liste_episodes_saison_enregistre" class="table table-striped table-hover"> 

                                <thead style="color:#3797DA">

                                    <tr>                          

                                        <th>Titre originale</th>

                                        <th>NOM DE FICHIER</th>

                                        <th>ID TMD</th>

                                        <th class="sort-alpha">ACTION</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    $tr = '';
                                    $j = 1;

                                    foreach ($liste_episodes_saison_enregistre as $value) {

                                        $tr .= '<tr>';

                                        $tr .= '<td>' . $value['titre_originale'] . '</td>';

                                        $tr .= '<td>' . $value['nom_episode'] . '</td>';

                                        $tr .= '<td>' . $value['id_TMD'] . '</td>';

                                        $tr .= '<td><button data-toggle="modal" data-target="#myModal_episode_saison_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > EDITER </button></td>';


                                        $tr .= '</tr>';

                                        $j++;
                                    }

                                    echo $tr;
                                    ?>



                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        <?php } ?>
        <?php if (isset($liste_episodes_saison_non_enregistre) && sizeof($liste_episodes_saison_non_enregistre) > 0) { ?>


            <div class="row"  style="margin-left:320px">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading" >LISTES DES EPISODES TV  NON ENREGISTRE</div>

                        <div class="panel-body">


                            <table  id="liste_episodes_saison_non_enregistre" name="liste_episodes_saison_non_enregistre" class="table table-striped table-hover"> 

                                <thead  style="color:#3797DA">

                                    <tr>                  

                                        <th>NOM DE FICHIER</th>                                       


                                        <th class="sort-alpha">ACTION</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    $tr = '';
                                    $j = 1;

                                    foreach ($liste_episodes_saison_non_enregistre as $value) {

                                        $tr .= '<tr>';

                                        $tr .= '<td>' . $value['nom_episode'] . '</td>';


                                        $tr .= '<td><button data-toggle="modal" data-target="#myModal_episode_saison_non_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Enregistrer </button></td>';


                                        $tr .= '</tr>';

                                        $j++;
                                    }

                                    echo $tr;
                                    ?>



                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        <?php } ?>



    <?php } ?>

<?php } ?>


<!----------------------------------------------------------------------------------------------------------------------------------->

<?php
if (isset($liste_serie_non_enregistre) && sizeof($liste_serie_non_enregistre) > 0) {

    $j = 1;

    foreach ($liste_serie_non_enregistre as $value) {
        ?>

        <div id="myModal_serie_non_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_serie_<?= $j; ?>" name="form1_add_serie_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Enregistrer une serie tv</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="serie_<?= $j; ?>" style="color:blue;font-size:16px">Nom Serie: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_serie"  name="nom_serie"  placeholder="Entrer nom de serie" value="<?= $value['nom_serie']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="idtmd_<?= $j; ?>" style="color:blue;font-size:16px">ID TMDB: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idtmd"  name="idtmd"   value="" >

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer la serie</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_file">Enregistrer la serie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $j++;
    }
}
?>
<!------------------------------------------------------------------------------------------------------------------------------>

<?php
if (isset($liste_serie_enregistre) && sizeof($liste_serie_enregistre) > 0) {

    $j = 1;

    foreach ($liste_serie_enregistre as $value) {
        ?>

        <div id="myModal_serie_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_update_serie_<?= $j; ?>" name="form1_update_serie_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Editer une serie tv</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="serie_<?= $j; ?>" style="color:blue;font-size:16px">Nom Serie: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_serie"  name="nom_serie"  placeholder="Entrer nom de serie" value="<?= $value['nom_serie']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="idtmd_<?= $j; ?>" style="color:blue;font-size:16px">ID TMDB: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idtmd"  name="idtmd"   value="<?= $value['id_TMD']; ?>" >

                                </div>
                            </div>

                            <input type="hidden"  name="id_serie"   value="<?= $value['id_serie']; ?>"/>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer la serie</button>
                            <button type="submit" class="btn btn-primary" name="button_update"  value="update_file">Enregistrer la serie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $j++;
    }
}
?>

<!---------------------------------------------------------------------------------------------------------------------------->

<?php
if (isset($liste_saisons_non_enregistre) && sizeof($liste_saisons_non_enregistre) > 0) {

    $j = 1;

    foreach ($liste_saisons_non_enregistre as $value) {
        ?>

        <div id="myModal_saison_non_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_saison_<?= $j; ?>" name="form1_add_saison_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_saison_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Enregistrer une saison</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="saison_<?= $j; ?>" style="color:blue;font-size:16px">Nom saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_saison"  name="nom_saison"   value="<?= $value['nom_saison']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="idtmd_saison_<?= $j; ?>" style="color:blue;font-size:16px">ID TMDB [Saison]: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idtmd_saison"  name="idtmd_saison"   value="" >

                                </div>
                            </div>
                             <input type="hidden" name="id_serie" value="<?= $_GET['id_serie']; ?>">                          

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer la saison</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_saison">Enregistrer la saison</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $j++;
    }
}
?>
<?php
if (isset($liste_episodes_saison_non_enregistre) && sizeof($liste_episodes_saison_non_enregistre) > 0) {

    $j = 1;

    foreach ($liste_episodes_saison_non_enregistre as $value) {
        ?>

        <div id="myModal_episode_saison_non_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_saison_<?= $j; ?>" name="form1_add_saison_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_episode_saison_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Enregistrer une episode</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_originale_episode_<?= $j; ?>" style="color:blue;font-size:16px">Titre originale: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="titre_originale"  name="titre_originale"   value="" >

                                </div>
                            </div>

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="saison_<?= $j; ?>" style="color:blue;font-size:16px">Nom saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_fichier"  name="nom_fichier"   value="<?= $value['nom_episode']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="idtmd_episode_<?= $j; ?>" style="color:blue;font-size:16px">ID TMDB [Episode]: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idtmd_episode"  name="idtmd_episode"   value="" >

                                </div>
                            </div>

                            <input type="hidden" name="id_serie" value="<?= $_GET['id_serie']; ?>">

                            <input type="hidden" name="id_saison" value="<?= $_GET['id_saison']; ?>">
                            
                            <input type="hidden" name="nom_serie" value="<?= $_GET['nom_serie']; ?>">
                            
                            <input type="hidden" name="nom_saison" value="<?= $_GET['nom_saison']; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer episode</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_saison">Enregistrer episode</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $j++;
    }
}
?>









