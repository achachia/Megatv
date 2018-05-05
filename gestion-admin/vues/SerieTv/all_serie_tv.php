
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-primary">

            <div class="panel-heading">LISTES DES SERIES TV NON ENREGISTRE</div>

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

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES SERIES TV  ENREGISTRE</div>

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

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-primary btn-lg" style="margin:5px" > Editer </button>';

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

                <div class="panel panel-primary">

                    <div class="panel-heading">LISTES DES SAISONS TV NON ENREGISTRE  [<?= $_GET['nom_serie']; ?>]</div>

                    <div class="panel-body">


                        <table  id="liste_saisons_enregistre" name="liste_saisons_non_enregistre" class="table table-striped table-hover"> 

                            <thead style="background-color:#F2DDDD">

                                <tr>                          

                                    <th>Nom SAISON</th>                            

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

                <div class="panel panel-primary">

                    <div class="panel-heading" >LISTES DES SAISONS TV  ENREGISTRE [<?= $_GET['nom_serie']; ?>]</div>

                    <div class="panel-body">


                        <table  id="liste_saisons_enregistre" name="liste_saisons_enregistre" class="table table-striped table-hover"> 

                            <thead style="color:#red">

                                <tr>  

                                    <th>Num SAISON</th>

                                    <th>Nom SAISON</th>                            

                                    <th class="sort-alpha">ACTION</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $tr = '';
                                $j = 1;

                                foreach ($liste_saisons_enregistre as $value) {

                                    $tr .= '<tr>';

                                    $tr .= '<td>' . $value['Num_saison'] . '</td>';

                                    $tr .= '<td>' . $value['nom_saison'] . '</td>';

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  style="margin:5px" > EDITER </button>';

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

    <?php if (isset($_GET['id_serie']) && !empty($_GET['id_serie']) && isset($_GET['id_saison']) && !empty($_GET['id_saison'])) { ?> 

        <?php if (isset($liste_episodes_saison_enregistre) && sizeof($liste_episodes_saison_enregistre) > 0) { ?>


            <div class="row"  style="margin-left:200px">

                <div class="col-lg-12">

                    <div class="panel panel-primary">

                        <div class="panel-heading" >LISTES DES EPISODES TV  ENREGISTRE [<?= $_GET['nom_serie']; ?>][<?= $_GET['nom_saison']; ?>]</div>

                        <div class="panel-body">


                            <table  id="liste_episodes_saison_enregistre" name="liste_episodes_saison_enregistre" class="table table-striped table-hover"> 

                                <thead style="color:#3797DA">

                                    <tr>                          

                                        <th>Titre originale</th>

                                        <th>NOM DE FICHIER</th>

                                        <th>Numero épisode</th>

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

                                        $tr .= '<td>' . $value['Num_episode'] . '</td>';

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

                    <div class="panel panel-primary">

                        <div class="panel-heading" >LISTES DES EPISODES TV  NON ENREGISTRE [<?= $_GET['nom_serie']; ?>][<?= $_GET['nom_saison']; ?>]</div>

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
                            <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une serie TV</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                            <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Modifier la fiche</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                            <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une saison [<?= $_GET['nom_serie']; ?>]</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="saison_<?= $j; ?>" style="color:blue;font-size:16px">Nom saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_saison"  name="nom_saison"   value="<?= $value['nom_saison']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="Num_saison_<?= $j; ?>" style="color:blue;font-size:16px">Numero saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Num_saison"  name="Num_saison"   value="" >

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

                            <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une episode [<?= $_GET['nom_serie']; ?>][<?= $_GET['nom_saison']; ?>]</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_originale_episode_<?= $j; ?>" style="color:blue;font-size:16px">Titre originale: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="titre_originale"  name="titre_originale"   value="" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="Num_episode_<?= $j; ?>" style="color:blue;font-size:16px">Numero [Episode]: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Num_episode"  name="Num_episode"   value="" >

                                </div>
                            </div>

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_fichier_<?= $j; ?>" style="color:blue;font-size:16px">Nom saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_fichier"  name="nom_fichier"   value="<?= $value['nom_episode']; ?>" >

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









