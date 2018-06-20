
<div class="row">

    <div class="col-lg-12">

        <?php if (isset($_GET['message']) && $_GET['message'] == 'echec') { ?>

            <div class="alert alert-warning alert-dismissible  show" role="alert">
                <strong>Votre opération a été échoué.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php } ?>
        <?php if (isset($_GET['message']) && $_GET['message'] == 'success') { ?> 
            <div class="alert alert-success alert-dismissible  show" role="alert">
                <strong>Votre opération a été enregistré avec succées</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

    </div>
</div>
<div class="row" style="margin-bottom:2%;margin-left: 1%;margin-right: 1% ">					

    <div class="btn-group btn-group-justified" role="group">


        <div class="btn-group" role="group">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_add_serie">

                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

                Enregistrer une nouvelle serie arabe

            </button>  

        </div>


    </div>				

</div>

<?php if (sizeof($liste_serie_non_enregistre) > 0) { ?>
    <div class="row" style="margin-left:100px">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES SERIES TV ARABE NON ENREGISTRE</div>

                <div class="panel-body">


                    <table     id="liste_serie_non_enregistre" name="liste_serie_non_enregistre" class="table table-striped table-hover table-bordered"> 

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
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->

<?php if (sizeof($liste_serie_enregistre) > 0) { ?>
    <div class="row" style="margin-left:100px">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES SERIES TV ARABE  ENREGISTRE</div>

                <div class="panel-body">


                    <table   id="liste_serie_enregistre" name="liste_serie_enregistre" class="table table-striped table-hover table-bordered"> 

                        <thead  style="background-color:#D0D1D2">

                            <tr> 

                                <th>JAQUETTE SERIE</th> 

                                <th>NOM SERIE</th> 

                                                                                                                    <!--                                <th>Progression</th>-->

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

                                    $tr .= '<td><img src="' . $value['poster_path'] . '" class="img-rounded"  width="100" height="100"></td>';

                                    $tr .= '<td style="text-align:center;padding-top:2%">' . $value['nom_serie'] . '</td>';

                                    //   $tr .= '<td><div data-label="'.$value['progression'].'%" class="radial-bar radial-bar-'.$value['progression'].'"></div></td>';
                                    //   $tr .= '<td><div data-label="'.$value['progression'].'%" class="radial-bar radial-bar-'.$value['progression'].'"></div></td>';

                                    $tr .= '<td style="text-align:left;padding-top:2%"><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-info btn-lg" style="margin:5px" > Editer </button>';


                                    if ($value['SaisonTv'] == '0') {

                                        $tr .= '<a href="' . $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $value['id_serie'] . '&nom_serie=' . $value['nom_serie'] . '&saisonTV=no" ><button    class="btn btn-primary btn-lg"  > CONSULTER LES EPISODES</button></a>';

                                        if (isset($_GET['id_serie']) && isset($_GET['nom_serie'])) {

                                            $tr .= '<button data-toggle="modal" data-target="#myModal_add_episode"  class="btn btn-success btn-lg" style="margin:5px" > AJOUTER UNE EPISODE TV </button></td>';
                                        }
                                    } else {

                                        $tr .= '<a href="' . $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $value['id_serie'] . '&nom_serie=' . $value['nom_serie'] . '&saisonTV=yes" ><button    class="btn btn-primary btn-lg"  > CONSULTER LES SAISONS</button></a>';
                                    }
                                    if (isset($_GET['id_serie']) && isset($_GET['nom_serie']) && $value['SaisonTv'] == '1') {

                                        $tr .= '<button data-toggle="modal" data-target="#myModal_add_saison"  class="btn btn-primary btn-lg" style="margin:5px" > AJOUTER UNE SAISON TV </button></td>';
                                    }





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

<?php if (isset($_GET['id_serie']) && !empty($_GET['id_serie']) && $_GET['saisonTV'] != 'no') { ?>

    <?php if (isset($liste_saisons_non_enregistre) && sizeof($liste_saisons_non_enregistre) > 0) { ?>

        <div class="row"  style="margin-left:180px">

            <div class="col-lg-12">

                <div class="panel panel-primary">

                    <div class="panel-heading">LISTES DES SAISONS TV NON ENREGISTRE  [<?= $_GET['nom_serie']; ?>]</div>

                    <div class="panel-body">


                        <table   id="liste_saisons_non_enregistre" name="liste_saisons_non_enregistre" class="table table-striped table-hover"> 

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

    <?php if (isset($liste_saisons_enregistre) && sizeof($liste_saisons_enregistre) > 0 && $_GET['saisonTV'] != 'no') { ?>

        <div class="row"  style="margin-left:220px">

            <div class="col-lg-12">

                <div class="panel panel-primary">

                    <div class="panel-heading" >LISTES DES SAISONS TV  ENREGISTRE [<?= $_GET['nom_serie']; ?>]</div>

                    <div class="panel-body">


                        <table   id="liste_saisons_enregistre" name="liste_saisons_enregistre" class="table table-striped table-hover"> 

                            <thead style="color:#red">

                                <tr>                                    

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

                                    $tr .= '<td>' . $value['nom_saison'] . '</td>';

                                    $tr .= '<td><button data-toggle="modal" data-target="#myModal_serie_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  style="margin:5px" > EDITER </button>';

                                    $tr .= '<a href="' . $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $value['id_serie'] . '&nom_serie=' . $_GET['nom_serie'] . '&id_saison=' . $value['id_saison'] . '&nom_saison=' . $value['nom_saison'] . '"><button   class="btn btn-primary btn-lg"  > CONSULTER LES EPISODES </button></a>';

                                    $tr .= '<button data-toggle="modal" data-target="#myModal_add_episode_saison_' . $j . '"  class="btn btn-success btn-lg" style="margin:5px" > AJOUTER UNE EPISODE TV </button></td>';


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

        <?php
    }
}
?>

<?php if (isset($_GET['id_serie']) && !empty($_GET['id_serie']) && isset($_GET['id_saison']) && !empty($_GET['id_saison']) && $_GET['saisonTV'] != 'no') { ?> 


<?php } ?>




<?php if (isset($liste_episodes_enregistre) && sizeof($liste_episodes_enregistre) > 0) { ?>


    <div class="row"  style="margin-left:20%">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading" >LISTES DES EPISODES TV  ENREGISTRE [<?= $_GET['nom_serie']; ?>]</div>

                <div class="panel-body">


                    <table   id="liste_episodes_enregistre" name="liste_episodes_enregistre" class="table table-striped table-hover"> 

                        <thead style="color:#3797DA">

                            <tr>                          

                                <th>Titre originale</th>                      

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $tr = '';
                            $j = 1;

                            foreach ($liste_episodes_enregistre as $value) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value['titre_originale'] . '</td>';

                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_episode_saison_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > EDITER </button>';

                                $tr .= '<button  style="margin:5px"  data-toggle="modal" data-target="#myModal_list_serveurs_' . $j . '"  class="btn btn-primary btn-lg"  > Consulter les serveurs </button>';


                                $tr .= '<button    data-toggle="modal" data-target="#myModal_add_link_serveur_' . $j . '"  class="btn btn-primary btn-lg"  > ADD LINK SERVEUR </button></td>';


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
<?php if (isset($liste_episodes_non_enregistre) && sizeof($liste_episodes_non_enregistre) > 0) { ?>


    <div class="row"  style="margin-left:320px">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading" >LISTES DES EPISODES TV  NON ENREGISTRE [<?= $_GET['nom_serie']; ?>]</div>

                <div class="panel-body">


                    <table   id="liste_episodes_non_enregistre" name="liste_episodes_non_enregistre" class="table table-striped table-hover"> 

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






<?php
if (isset($liste_serie_non_enregistre) && sizeof($liste_serie_non_enregistre) > 0) {

    $j = 1;

    foreach ($liste_serie_non_enregistre as $value) {
        ?>

        <div id="myModal_serie_non_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_serie_<?= $j; ?>" name="form1_add_serie_<?= $j; ?>" method="POST"  enctype="multipart/form-data"  action="./controleurs/SerieTvArabic/set_serie_tv.php">
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

                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="periode_<?= $j; ?>" style="color:blue;font-size:16px">TYPE PERIODE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="SaisonTv"  id="SaisonTv" >
                                        <option value="">Select-periode</option>

                                        <option value="1">La serie contient des saisons </option>

                                        <option value="0">La serie ne contient pas  des saisons </option>

                                    </select>

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="overview_<?= $j; ?>" style="color:blue;font-size:16px">Description: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <textarea rows="4" cols="50" id="overview"  name="overview" ><?= $value['overview']; ?></textarea> 

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="tannee_release_<?= $j; ?>" style="color:blue;font-size:16px">Annee release: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="annee_release"  name="annee_release"  placeholder="Entrer Année de realisation" value="<?= $value['annee_release']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="source_serie_<?= $j; ?>" style="color:blue;font-size:16px">SOURCE SERIE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="file" name="affiche_serie" id="affiche_serie" />

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="source_serie_<?= $j; ?>" style="color:blue;font-size:16px">SOURCE SERIE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="source_serie" id="source_serie" value="<?= $value['source_serie']; ?>" />

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

<div id="myModal_add_serie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form1_add_serie" name="form1_add_serie" method="POST"  enctype="multipart/form-data"  action="./controleurs/SerieTvArabic/set_serie_tv.php">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une serie TV</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_serie" style="color:blue;font-size:16px">Nom Serie: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom_serie"  name="nom_serie"  placeholder="Entrer nom de serie" value="" >

                        </div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="periode_serie" style="color:blue;font-size:16px">TYPE PERIODE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="SaisonTv"  id="SaisonTv" >
                                <option value="">Select-periode</option>

                                <option value="1">La serie contient des saisons </option>

                                <option value="0">La serie ne contient pas  des saisons </option>

                            </select>

                        </div>
                    </div>
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="overview" style="color:blue;font-size:16px">Description: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <textarea rows="4" cols="50" id="overview"  name="overview" ></textarea> 

                        </div>
                    </div>
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="tannee_release" style="color:blue;font-size:16px">Année release: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="annee_release"  name="annee_release"  placeholder="Entrer Année de realisation" value="" >

                        </div>
                    </div>
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="affiche_serie" style="color:blue;font-size:16px">AFFICHE SERIE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <input type="file" name="affiche_serie" id="affiche_serie" />

                        </div>
                    </div>
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="source_serie" style="color:blue;font-size:16px">SOURCE SERIE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="source_serie" id="source_serie" />

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

<!---------------------------------------------------------------------------------->

<?php if (isset($_GET['id_serie']) && isset($_GET['nom_serie']) && $_GET['saisonTV'] != 'no') { ?>

    <div id="myModal_add_saison" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="form1_add_saison" name="form1_add_saison" method="POST" action="./controleurs/SerieTvArabic/set_saison_serie_tv.php">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une saison [<?= $_GET['nom_serie']; ?>]</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group"  style="padding-top:1%">
                            <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_saison" style="color:blue;font-size:16px">Nom saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nom_saison"  name="nom_saison"   value="" >

                            </div>
                        </div>                                    
                        <input type="hidden" name="id_serie" value="<?= $_GET['id_serie']; ?>"> 

                        <input type="hidden" name="nom_serie" value="<?= $_GET['nom_serie']; ?>">                   

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

<?php } ?>   

<!---------------------------------------------------------------------->

<?php if (isset($_GET['id_serie']) && isset($_GET['nom_serie'])) { ?>

    <div id="myModal_add_episode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="form1_add_episode" name="form1_add_episode" method="POST" action="./controleurs/SerieTvArabic/set_episode_serie_tv.php">
                    <div class="modal-header">

                        <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une episode [<?= $_GET['nom_serie']; ?>]</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">

                        <div class="col-sm-12">

                            <label class="control-label" for="titre_originale_episode" style="color:blue;font-size:16px">Titre originale: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="titre_originale"  name="titre_originale"   value="" >

                            </div>
                        </div>                                




                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label" for="url_episode" style="color:blue;font-size:16px">URL: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label> 
                            </div>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="url"  name="url"   value="" >

                            </div>
                        </div> 

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label" for="identifiant_streaming_episode" style="color:blue;font-size:16px">IDENTIFIANT: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label> 
                            </div>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"   value="" >

                            </div>
                        </div> 
                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="serveur" style="color:blue;font-size:16px">SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <select class="form-control" name="serveur_film"  id="serveur_film" >

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
                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="qualite_video_<?= $j; ?>" style="color:blue;font-size:16px">QUALITE VIDEO: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <select class="form-control" name="qualite_video"  id="qualite_video" >

                                    <?php
                                    $tr = '<option value="">Select-qualite</option>';

                                    foreach ($listeQualiteVod as $qualite) {


                                        $tr.="<option value='" . $qualite['id_qualite'] . "' ";

                                        $tr.= ">" . $qualite['nom_qualite'] . "</option>";
                                    }

                                    echo $tr;
                                    ?>

                                </select>

                            </div>
                        </div>
                        <input type="hidden" name="id_serie" value="<?= $_GET['id_serie']; ?>">                   

                        <input type="hidden" name="nom_serie" value="<?= $_GET['nom_serie']; ?>">

                        <input type="hidden" name="saisonTV" value="<?= $_GET['saisonTV']; ?>">                   

                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                        <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer episode</button>
                        <button type="submit" class="btn btn-primary" name="button_register"  value="register_episode">Enregistrer episode</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>  

<?php if (isset($liste_saisons_enregistre) && sizeof($liste_saisons_enregistre) > 0 && $_GET['saisonTV'] != 'no') { ?>

    <?php
    $j = 1;
    foreach ($liste_saisons_enregistre as $saison) {
        ?>

        <div id="myModal_add_episode_saison_<?= $j ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_episode-saison" name="form1_add_episode-saison" method="POST" action="./controleurs/SerieTvArabic/set_episode_serie_tv.php">
                        <div class="modal-header">

                            <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer une episode [<?= $_GET['nom_serie']; ?>][<?= $saison['nom_saison'] ?>]</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">

                            <div class="col-sm-12">

                                <label class="control-label" for="titre_originale_episode" style="color:blue;font-size:16px">Titre originale: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>

                            </div>

                            <div class="form-group">

                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="titre_originale"  name="titre_originale"   value="" >

                                </div>
                            </div>                                




                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="control-label" for="url_episode" style="color:blue;font-size:16px">URL: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label> 
                                </div>

                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="url"  name="url"   value="" >

                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="control-label" for="identifiant_streaming_episode" style="color:blue;font-size:16px">IDENTIFIANT: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label> 
                                </div>

                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"   value="" >

                                </div>
                            </div> 
                            <div class="form-group"  style="padding-top:1%">
                                <div class="col-sm-12">
                                    <label class="control-label" for="serveur" style="color:blue;font-size:16px">SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                </div>

                                <div class="col-sm-12">
                                    <select class="form-control" name="serveur_film"  id="serveur_film" >

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
                            <div class="form-group"  style="padding-top:1%">
                                <div class="col-sm-12">
                                    <label class="control-label" for="qualite_video_<?= $j; ?>" style="color:blue;font-size:16px">QUALITE VIDEO: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                </div>

                                <div class="col-sm-12">
                                    <select class="form-control" name="qualite_video"  id="qualite_video" >

                                        <?php
                                        $tr = '<option value="">Select-qualite</option>';

                                        foreach ($listeQualiteVod as $qualite) {


                                            $tr.="<option value='" . $qualite['id_qualite'] . "' ";

                                            $tr.= ">" . $qualite['nom_qualite'] . "</option>";
                                        }

                                        echo $tr;
                                        ?>

                                    </select>

                                </div>
                            </div>
                            <input type="hidden" name="id_serie" value="<?= $_GET['id_serie']; ?>">                   

                            <input type="hidden" name="nom_serie" value="<?= $_GET['nom_serie']; ?>">

                            <input type="hidden" name="saisonTV" value="yes">

                            <input type="hidden" name="id_saison" value="<?= $saison['id_saison']; ?>">

                            <input type="hidden" name="nom_saison" value="<?= $saison['nom_saison']; ?>"> 

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer episode</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_episode">Enregistrer episode</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>
<?php } ?>   


<?php
$j = 1;
foreach ($liste_episodes_enregistre as $episode_enregistre) {
    ?>
    <div id="myModal_add_link_serveur_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="form_add_link_<?= $j; ?>" name="form_add_link_<?= $j; ?>" method="POST" action="./controleurs/SerieTvArabic/add_link_servers.php">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel" style="color:blue">AJOUTER UN SERVEUR </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="identifiant_<?= $j; ?>" style="color:blue;font-size:16px">Identifiant streaming: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="identifiant_streaming"  name="identifiant_streaming"  placeholder="Entrer identifiant streaming" value="" >

                            </div>
                        </div> 
                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="serveur_<?= $j; ?>" style="color:blue;font-size:16px">SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <select class="form-control" name="serveur_film"  id="serveur_film" >

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
                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="qualite_video_<?= $j; ?>" style="color:blue;font-size:16px">QUALITE VIDEO: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <select class="form-control" name="qualite_video"  id="qualite_video" >

                                    <?php
                                    $tr = '<option value="">Select-qualite</option>';

                                    foreach ($listeQualiteVod as $qualite) {


                                        $tr.="<option value='" . $qualite['id_qualite'] . "' ";

                                        $tr.= ">" . $qualite['nom_qualite'] . "</option>";
                                    }

                                    echo $tr;
                                    ?>

                                </select>

                            </div>
                        </div>
                        <div class="form-group"  style="padding-top:1%">
                            <div class="col-sm-12">
                                <label class="control-label" for="url_<?= $j; ?>" style="color:blue;font-size:16px">URL: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                            </div>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="url"  name="url"   value="" >

                            </div>
                        </div> 


                        <input type="hidden"  name="id_fichier"  value="<?= $episode_enregistre['id_episode']; ?>">

                        <input type="hidden"  name="id_serie"  value="<?= $episode_enregistre['id_serie']; ?>">

                        <input type="hidden"  name="nom_serie"  value="<?= $episode_enregistre['nom_serie']; ?>">

                        <input type="hidden"  name="optionSaisonTV"  value="<?= $episode_enregistre['optionSaisonTV']; ?>">

                       <?php if ($episode_enregistre['optionSaisonTV'] == 'yes') { ?>

                       <input type="hidden"  name="id_saison"  value="<?= $episode_enregistre['id_saison']; ?>">
                       
                       <input type="hidden"  name="nom_saison"  value="<?= $episode_enregistre['nom_saison']; ?>">

                      <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>                         
                        <button type="submit" class="btn btn-primary" name="button_update"  value="update_file">Enregistrer le link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    $j++;
}
?>
<?php
if (isset($liste_episodes_enregistre) && sizeof($liste_episodes_enregistre) > 0) {


    $j = 1;

    foreach ($liste_episodes_enregistre as $episode_enregistre) {
        ?>

        <div id="myModal_list_serveurs_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel" style="color:blue">LA LISTE DES SERVEURS</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">



                        <?php
                        $k = 1;
                        foreach ($episode_enregistre['list_serveurs'] as $serveur) {
                            ?>

                            <h3 style="color:red">SERVEUR N° <?= $k ?></h3>

                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <th scope="row" style="color:blue">DATE CREATION :</th>
                                        <td><?= $serveur['date_created'] ?></td>

                                    </tr>
                                    <tr>
                                        <th scope="row"  style="color:blue">NOM SERVEUR :</th>
                                        <td><?= $serveur['nom_serveur'] ?></td>

                                    </tr>
                                    <tr>
                                        <th scope="row"  style="color:blue">IDENTIFIANT :</th>
                                        <td><?= $serveur['identifiant_streaming'] ?></td>

                                    </tr>
            <?php if ($serveur['url'] != '') { ?>
                                        <tr>
                                            <th scope="row"  style="color:blue">URL :</th>
                                            <td><?= $serveur['url'] ?></td>
                                        </tr>

            <?php } ?>
                                    <tr>
                                        <th scope="row"  style="color:blue">ACTIVATION :</th>
                                        <td><?= $serveur['activation'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"  style="color:blue">ACTION :</th>
                                        <td>
                                            <a href="<?= $url_espace_admin; ?>/controleurs/SerieTvArabic/delete_links_serveur.php?id_link=<?= $serveur['id_link']; ?>&id_serie=<?= $episode_enregistre['id_serie']; ?>&nom_serie=<?= $episode_enregistre['nom_serie']; ?>&optionSaisonTV=<?= $episode_enregistre['optionSaisonTV']; ?>&id_saison=<?= $episode_enregistre['id_saison']?>&nom_saison=<?= $episode_enregistre['nom_saison']?>"><button    class="btn btn-danger btn-md"  > Supprimer </button></a>
                                            <a  target="_blank"  href="<?= $url_espace_admin; ?>/index.php?module=Serveurs&action=debug_serveur&id_link=<?= $serveur['id_link']; ?>&=identifiant_streaming=<?= $serveur['identifiant_streaming'] ?>&serveur_video=<?= $serveur['id_serveur'] ?>"><button    class="btn btn-primary btn-md"  > Checker le serveur </button></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>        


                            <?php
                            $k++;
                        }
                        ?>




                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>     

                    </div>

                </div>
            </div>
        </div>   

        <?php
        $j++;
    }
    ?>
<?php } ?> 



