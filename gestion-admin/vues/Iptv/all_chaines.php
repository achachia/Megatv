<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-primary">

            <div class="panel-heading">GENERATEURS PLAYLIST M3U EN LIGNE</div>

            <div class="panel-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Type logiciel IPTV</th>                            
                            <th>Type fichier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info">
                            <td>KODI</td>
                            <td>M3U-MONDE</td>
                            <td><a href="<?= $host; ?>/fichier_m3u_perso.php"><button   class="btn btn-primary btn-lg"  > Générer le fichier</button></a></td>
                        </tr> 
                        <tr class="danger">
                            <td>KODI</td>
                            <td>M3U-FRANCOPHONE</td>
                            <td><a href="<?= $host; ?>/fichier_m3u_fr.php"><button   class="btn btn-primary btn-lg"  > Générer le fichier</button></a></td>
                        </tr>      
                                          
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-primary">

            <div class="panel-heading">GENERATEURS PLAYLIST M3U [LOCAL]</div>

            <div class="panel-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Type logiciel IPTV</th>                            
                            <th>Type fichier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info">
                            <td>KODI</td>
                            <td>M3U-MONDE</td>
                            <td><a href="<?= $host; ?>/fichier_m3u_perso.php"><button   class="btn btn-primary btn-lg"  > Générer le fichier</button></a></td>
                        </tr> 
                        <tr class="danger">
                            <td>KODI</td>
                            <td>M3U-FRANCOPHONE</td>
                            <td><a href="<?= $host; ?>/fichier_m3u_fr.php"><button   class="btn btn-primary btn-lg"  > Générer le fichier</button></a></td>
                        </tr>      
                        <tr class="success">
                            <td>OTT PLAYER</td>
                            <td>M3U</td>
                            <td><a href="<?= $host; ?>/fichier_m3u_ottplayer.php"><button   class="btn btn-primary btn-lg"  > Générer le fichier</button></a></td>
                        </tr>                       
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-lg-12">

        <div class="panel panel-primary">

            <div class="panel-heading">LISTES DES CHAINES IPTV</div>

            <div class="panel-body">


                <table  id="liste_films_non_enregistre" name="liste_films_non_enregistre" class="table table-striped table-hover">

                    <thead>

                        <tr>

                            <th>LOGO CHAINE</th>

                            <th>NOM CHAINE</th>

                            <th>CATEGORIE</th>

                            <th>Activation chaine</th>

                            <th class="sort-alpha">ACTION</th> 

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        if (isset($liste_chaines_iptv)) {

                            $tr = '';
                            $j = 0;

                            foreach ($liste_chaines_iptv as $value) {

                                $tr .= '<tr>';
                                $tr .= '<td><img src="' . $value ['icone_chaine'] . '"   style="width:70px;height:70px"/></td>';

                                $tr .= '<td>' . $value ['nom'] . '</td>';

                                $tr .= '<td>' . $value ['groupe'] . '</td>';


                                $tr .= '<td>';

                                if ($value ['option_actif'] == '1') {

                                    $tr .='<button   class="btn btn-success"  >ACTIF</button>';
                                } else {

                                    $tr .='<button   class="btn btn-danger"  >INACTIF</button>';
                                }


                                $tr .= '</td>';


                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_nom_chaine_' . $j . '"  class="btn btn-primary btn-lg"  > Editer </button></td>';


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

                                <input type="text" name="filter_browser" placeholder="Filter GROUPE" class="form-control input-sm datatable_input_col_search">

                            </th>
                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter GROUPE" class="form-control input-sm datatable_input_col_search">

                            </th>

                            <th>

                                <input type="text" name="filter_browser" placeholder="Filter ACTIVATION" class="form-control input-sm datatable_input_col_search">

                            </th>



                        </tr>

                    </tfoot>



                </table>

            </div>

        </div>

    </div>

</div>
<!-------------------- Consultation fiche --------------------->

<?php
if (isset($liste_chaines_iptv) && sizeof($liste_chaines_iptv) > 0) {

    $j = 0;

    foreach ($liste_chaines_iptv as $value) {
        ?>

        <div id="myModal_nom_chaine_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_fichier_<?= $j; ?>" name="form1_add_fichier_<?= $j; ?>" method="POST" action="./controleurs/Iptv/set_chaine_iptv.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            <h4 id="myModalLabel" class="modal-title"><img src="<?= $value ['icone_chaine']; ?>"   style="width:70px;height:70px"/> Edition la fiche de la chaine TV</h4>
                        </div>
                        <div class="modal-body">


                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_<?= $j; ?>" style="color:blue;font-size:16px">Nom chaine: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_chaine"  name="nom_chaine"  placeholder="Entrer nom de chaine" value="<?= $value['nom']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="logo_<?= $j; ?>" style="color:blue;font-size:16px">Logo chaine: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="logo_chaine"  name="logo_chaine"  placeholder="Entrer le logo de la chaine" value="<?= $value['logo']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_m3u_<?= $j; ?>" style="color:blue;font-size:16px">Nom M3U: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nom_m3u"  name="nom_m3u"  placeholder="Entrer nom de chaine" value="<?= $value['Nom_m3u']; ?>" >

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom_categorie_<?= $j; ?>" style="color:blue;font-size:16px">BOUQUET TV: </label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="categorie_tv"  id="categorie_tv" >

                                        <?php
                                        $tr = '<option value="">Select categorie TV</option>';

                                        foreach ($liste_categorie_tv as $value1) {


                                            $tr.="<option value='" . $value1['id_categorie'] . "' ";

                                            if ($value1['id_categorie'] == $value['id_categorie']) {

                                                $tr.=' selected="selected" ';
                                            }
                                            $tr.= ">" . $value1['nom_bouquet'] . "</option>";
                                        }

                                        echo $tr;
                                        ?>

                                    </select>

                                </div>



                            </div>  
                            <div class="form-group">

                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="active_chaine_<?= $j; ?>" style="color:blue;font-size:16px">ACTIVATION: </label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="active_chaine"  id="active_chaine" >


                                        <option value="">Activation chaine</option>
                                        <option value="1"  <?php
                                        if ($value['option_actif'] == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>Actif</option>
                                        <option value="0" <?php
                                        if ($value['option_actif'] == '0') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>Inactif</option>                                    

                                    </select>

                                </div>



                            </div>

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="link_<?= $j; ?>" style="color:blue;font-size:16px">Lien chaine: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="link_chaine"  name="link_chaine"  placeholder="Entrer lien de chaine" value="<?= $value['link_chaine']; ?>" >

                                </div>
                            </div>

                            <input type="hidden"  name="id_chaine"  value="<?= $value['id_chaine']; ?>" >



                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>
                            <button type="submit" class="btn btn-danger"  name="button_delete"  value="delete_chaine">Supprimer la chaine</button>
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_chaine">Enregistrer la chaine</button>
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

<!----------------------   consultation fiche ----------------------------->
