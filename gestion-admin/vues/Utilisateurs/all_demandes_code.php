
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
<?php if (isset($liste_demandes_attente) && sizeof($liste_demandes_attente) > 0) { ?>
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES DEMANDES EN ATTENTE</div>

                <div class="panel-body">


                    <table  id="liste_demandes_attente" name="liste_demandes_attente" class="table table-striped table-hover">

                        <thead>

                            <tr>

                                <th>DEVICE</th>

                                <th>Email</th>

                                <th>PLATE FORME</th>

                                <th>DATE DEMANDE</th>                                          

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $tr = '';
                            $j = 1;

                            foreach ($liste_demandes_attente as $value1) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value1 ['id_device'] . '</td>';

                                $tr .= '<td>' . $value1 ['email'] . '</td>';

                                $tr .= '<td>' . $value1 ['platforme'] . '</td>';

                                $tr .= '<td>' . $value1 ['date_demande'] . '</td>';


                                $tr .= '<td><button data-toggle="modal" data-target="#myModal_add_code_test_' . $j . '"  class="btn btn-primary btn-lg"  > CRERER UN CODE TEST </button></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                            ?>



                        </tbody>

                        <tfoot>

                            <tr>

                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter device" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter platforme" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date " class="form-control input-sm datatable_input_col_search">

                                </th>
                            </tr>

                        </tfoot>



                    </table>

                </div>

            </div>

        </div>

    </div>
<?php } ?>
<?php
if (isset($liste_demandes_attente) && sizeof($liste_demandes_attente) > 0) {

    $j = 1;

    foreach ($liste_demandes_attente as $value2) {
        ?>

        <div id="myModal_add_code_test_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_add_code_<?= $j; ?>"  name="form1_add_code_<?= $j; ?>" method="POST" action="./controleurs/Utilisateurs/set_demande_code_test.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">Ã—</button>
                            <h4 id="myModalLabel" class="modal-title">Enregistrer un code Test</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="email_<?= $j; ?>" style="color:blue;font-size:16px">Email: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email"  name="email"  placeholder="Entrer nom de fichier" value="<?= $value2['email']; ?>" >

                                </div>
                            </div> 
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="id_device_<?= $j; ?>" style="color:blue;font-size:16px">ID DEVICE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="id_device"  name="id_device"  placeholder="Entrer titre original" value="<?= $value2['id_device']; ?>" >

                                </div>
                            </div>
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="plate_forme_<?= $j; ?>" style="color:blue;font-size:16px">PLATE FORME: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="platforme"  name="platforme"  placeholder="Entrer titre original" value="<?= $value2['platforme']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">

                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="periode_<?= $j; ?>" style="color:blue;font-size:16px">TYPE PERIODE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="periode_test"  id="periode_test" >

                                        <?php
                                        $tr = '<option value="">Select-periode</option>';

                                        foreach ($liste_periode as $value3) {


                                            $tr.="<option value='" . $value3['id_periode'] . "' ";

                                            $tr.= ">" . $value3['nom_periode'] . "</option>";
                                        }

                                        echo $tr;
                                        ?>

                                    </select>

                                </div>
                            </div>


                            <input type="hidden" name="id_demande"  value="<?= $value2['id_demande']; ?>">                         


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
<?php if (isset($liste_codes_test_valides) && sizeof($liste_codes_test_valides) > 0) { ?>
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES CODES TEST VALIDES</div>

                <div class="panel-body">


                    <table  id="liste_codes_test_valides" name="liste_codes_test_valides" class="table table-striped table-hover">

                        <thead>

                            <tr>

                                <th>DATE DEMANDE</th>

                                <th>EMAIL</th>

                                <th>CODE ACTIVATION</th>

                                <th>ID-DEVICE</th>

                                <th>DATE START</th>

                                <th>DATE END</th>   
                                
                                <th>Expiration</th>

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $tr = '';
                            $j = 1;

                            foreach ($liste_codes_test_valides as $value2) {

                                $tr .= '<tr>';

                                $tr .= '<td>' . $value2 ['date_demande'] . '</td>';

                                $tr .= '<td>' . $value2 ['email'] . '</td>';

                                $tr .= '<td>' . $value2 ['code_activation'] . '</td>';

                                $tr .= '<td>' . $value2 ['id_device'] . '</td>';

                                $tr .= '<td>' . $value2 ['date_start'] . '</td>';

                                $tr .= '<td>' . $value2 ['date_end'] . '</td>';
                                
                                 $tr .= '<td>' . $value2 ['expiration_code'] . '</td>';


                                $tr .= '<td></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                            ?>



                        </tbody>

                        <tfoot>

                            <tr>

                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date demande" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter email" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter code activation " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter id device " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date start " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date end " class="form-control input-sm datatable_input_col_search">

                                </th>
                            </tr>

                        </tfoot>



                    </table>

                </div>

            </div>

        </div>

    </div>
<?php } ?>





