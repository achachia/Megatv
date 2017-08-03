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
                                <p class="mb0 text-muted"><?= $nbr_films;?> films</p>

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
                                <p class="mb0 text-muted"><?= $nbr_cartoon;?> films</p>

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
                            <p class="mb0 text-muted"><?= $data_serie_tv;?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>


        </div>
    </section>

</section>
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-default">

            <div class="panel-heading">LISTES DES SERIES TV NON ENREGISTRE</div>

            <div class="panel-body">


                <table  id="liste_films_non_enregistre" name="liste_films_non_enregistre" class="table table-striped table-hover"> 

                    <thead>

                        <tr>

                            <th>NOM</th>

                            <th>NOM SERIE</th>

                            <th>N° SAISON</th>

                            <th>NOM FICHIER COMPLET</th>

                            <th>EXTENTION</th>

                            <th>TAILLE</th>

                            <th>DATE CREATION</th>

                            <th>DATE MODIFICATION</th>

                            <th class="sort-alpha">ACTION</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        if (isset($liste_fichiers_non_enregistre)) {

                            $tr = '';
                            $j = 0;

                            foreach ($liste_fichiers_non_enregistre as $value) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value ['nom_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['nom_serie'] . '</td>';

                                $tr .= '<td>' . $value ['num_saison'] . '</td>';

                                $tr .= '<td>' . $value ['episode'] . '</td>';

                                $tr .= '<td>' . $value ['extention_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['taille_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['date_created_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['date_update_fichier'] . '</td>';


                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_nom_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Editer </button></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                        }
                        ?>



                    </tbody>

                    <tfoot>

                        <tr>



                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM" class="form-control input-sm datatable_input_col_search">

                            </th>

                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM SERIE " class="form-control input-sm datatable_input_col_search">

                            </th>

                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter N° SAISON" class="form-control input-sm datatable_input_col_search">

                            </th>


                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM COMPLET" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter EXTENTION" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter TAILLE" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter Date creation" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter Date modification" class="form-control input-sm datatable_input_col_search">

                            </th>


                        </tr>

                    </tfoot>



                </table>

            </div>

        </div>

    </div>

</div>
<!-------------------- Consultation fiche --------------------->

<!----------------------   consultation fiche ----------------------------->
<?php
if (isset($liste_fichiers_non_enregistre) && sizeof($liste_fichiers_non_enregistre) > 0) {

    $j = 0;

    foreach ($liste_fichiers_non_enregistre as $value) {
        ?>

        <div id="myModal_nom_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_fichier_<?= $j; ?>" name="form1_add_fichier_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_episode_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Edition fichier</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="serie_<?= $j; ?>" style="color:blue;font-size:16px">Nom Serie: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_serie"  name="nom_serie"  placeholder="Entrer nom de serie" value="<?= $value['nom_serie']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="num_saison_<?= $j; ?>" style="color:blue;font-size:16px">N° Saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="num_saison"  name="num_saison"  placeholder="Entrer nom de fichier" value="<?= $value['num_saison']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_<?= $j; ?>" style="color:blue;font-size:16px">Nom fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nv_nom_fichier"  name="nv_nom_fichier"  placeholder="Entrer nom de fichier" value="<?= $value['nom_fichier']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_original_<?= $j; ?>" style="color:blue;font-size:16px">Titre original: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="titre_original"  name="titre_original"  placeholder="Entrer titre original" value="" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="extention_<?= $j; ?>" style="color:blue;font-size:16px">Exention fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">

                                    <input type="text" class="form-control" id="extention_fichier"  name="extention_fichier"  placeholder="Entrer nom de fichier" value="<?= $value['extention_fichier']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_<?= $j; ?>" style="color:blue;font-size:16px">Nom complet fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">

                                    <input type="text" class="form-control" id="nom_fichier_complet"  name="nom_fichier_complet"  placeholder="Entrer nom de fichier" value="<?= $value['episode']; ?>">

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="taille_fichier_<?= $j; ?>" style="color:blue;font-size:16px">Taille fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="taille_fichier"  name="taille_fichier"   value="<?= $value['taille_fichier']; ?>" >

                                </div>
                            </div>                                       



                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer le fichier</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_file">Enregistrer le fichier</button>
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

<!---------------------------------------------------------->
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-default">

            <div class="panel-heading">LISTES DES FILMS CARTOON ENREGISTRE</div>

            <div class="panel-body">


                <table  id="liste_films_enregistre" name="liste_films_enregistre" class="table table-striped table-hover">

                    <thead>

                        <tr>

                            <th>NOM</th>

                            <th>NOM SERIE</th>

                            <th>N° SAISON</th>

                            <th>NOM FICHIER COMPLET</th>

                            <th>EXTENTION</th>

                            <th>TAILLE</th>

                            <th>DATE CREATION</th>

                            <th>DATE MODIFICATION</th>

                            <th class="sort-alpha">ACTION</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        if (isset($liste_fichiers_enregistre)) {

                            $tr = '';
                            $j = 0;

                            foreach ($liste_fichiers_enregistre as $value) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value ['nom_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['nom_serie'] . '</td>';

                                $tr .= '<td>' . $value ['num_saison'] . '</td>';

                                $tr .= '<td>' . $value ['episode'] . '</td>';

                                $tr .= '<td>' . $value ['extention_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['taille_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['date_created_fichier'] . '</td>';

                                $tr .= '<td>' . $value ['date_update_fichier'] . '</td>';


                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_nom_enregistre_' . $j . '"  class="btn btn-primary btn-lg"  > Editer </button></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                        }
                        ?>



                    </tbody>

                    <tfoot>

                        <tr>



                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM" class="form-control input-sm datatable_input_col_search">

                            </th>

                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM SERIE " class="form-control input-sm datatable_input_col_search">

                            </th>

                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter N° SAISON" class="form-control input-sm datatable_input_col_search">

                            </th>


                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter NOM COMPLET" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter EXTENTION" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter TAILLE" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter Date creation" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter Date modification" class="form-control input-sm datatable_input_col_search">

                            </th>


                        </tr>

                    </tfoot>



                </table>
                <!----------------------   consultation fiche ----------------------------->


            </div>

        </div>

    </div>

</div>

<?php
if (isset($liste_fichiers_enregistre) && sizeof($liste_fichiers_enregistre) > 0) {

    $j = 0;

    foreach ($liste_fichiers_enregistre as $value) {
        ?>

        <div id="myModal_deja_enregistre_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form2_add_fichier_<?= $j; ?>" name="form2_add_fichier_<?= $j; ?>" method="POST" action="./controleurs/SerieTv/set_episode_serie_tv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title">Edition fichier-2</h4>
                        </div>
                        <div class="modal-body">


                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="serie_<?= $j; ?>" style="color:blue;font-size:16px">Nom Serie: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_serie"  name="nom_serie"  placeholder="Entrer nom de serie" value="<?= $value['nom_serie']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="num_saison_<?= $j; ?>" style="color:blue;font-size:16px">N° Saison: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="num_saison"  name="num_saison"  placeholder="Entrer nom de fichier" value="<?= $value['num_saison']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_<?= $j; ?>" style="color:blue;font-size:16px">Nom fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nv_nom_fichier"  name="nv_nom_fichier"  placeholder="Entrer nom de fichier" value="<?= $value['nom_fichier']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="titre_original_<?= $j; ?>" style="color:blue;font-size:16px">Titre original: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="titre_original"  name="titre_original"  placeholder="Entrer titre original" value="" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="extention_<?= $j; ?>" style="color:blue;font-size:16px">Exention fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">

                                    <input type="text" class="form-control" id="extention_fichier"  name="extention_fichier"  placeholder="Entrer nom de fichier" value="<?= $value['extention_fichier']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_<?= $j; ?>" style="color:blue;font-size:16px">Nom complet fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">

                                    <input type="text" class="form-control" id="nom_fichier_complet"  name="nom_fichier_complet"  placeholder="Entrer nom de fichier" value="<?= $value['episode']; ?>">

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="taille_fichier_<?= $j; ?>" style="color:blue;font-size:16px">Taille fichier: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="taille_fichier"  name="taille_fichier"   value="<?= $value['taille_fichier']; ?>" >

                                </div>
                            </div>                     



                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_file">Supprimer le fichier</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_file">Enregistrer le fichier</button>
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




