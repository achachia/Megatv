

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
<?php if (isset($liste_codes_enregistre) && sizeof($liste_codes_enregistre) > 0) { ?>
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES CODES </div>

                <div class="panel-body">


                    <table  id="liste_codes_enregistre" name="liste_codes_enregistre" class="table table-striped table-hover">

                        <thead>

                            <tr>

                               <!--     <th>Email</th>-->

                                <th>CODE ACTIVATION</th>

                                <th>ID-DEVICE</th>

                                <th>Plate-form</th> 

                                <th>Type Periode</th> 

                                <th>DATE START</th>

                                <th>DATE END</th> 

                                <th>Code IPTV</th> 

                                <th>Type Code</th> 



                                <th>Expiration</th>

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $tr = '';
                            $j = 1;

                            foreach ($liste_codes_enregistre as $value2) {

                                $tr .= '<tr>';

                                //  $tr .= '<td>' . $value2 ['email'] . '</td>';

                                $tr .= '<td>' . $value2 ['code_activation'] . '</td>';

                                $tr .= '<td>' . $value2 ['id_device'] . '</td>';

                                $tr .= '<td>' . $value2 ['plate_form'] . '</td>';

                                $tr .= '<td>' . $value2 ['type_periode'] . '</td>';

                                $tr .= '<td>' . $value2 ['date_start'] . '</td>';

                                $tr .= '<td>' . $value2 ['date_end'] . '</td>';

                                $tr .= '<td>' . $value2 ['code_iptv'] . '</td>';

                                $tr .= '<td>' . $value2 ['type_code'] . '</td>';



                                $tr .= '<td>' . $value2 ['expiration_code'] . '</td>';


                                $tr .= '<td><button  data-toggle="modal" data-target="#myModal_edit_code_' . $j . '"  type="button" class="btn btn-oval btn-warning">Editer</button></td>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                            ?>



                        </tbody>

                        <tfoot>

                            <tr>

                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter code activation" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter Id device" class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter plate forme " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter type periode " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date start " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter date end " class="form-control input-sm datatable_input_col_search">

                                </th>
                                <th>

                                    <input type="text" name="filter_browser" placeholder="Filter code iptv " class="form-control input-sm datatable_input_col_search">

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
if (isset($liste_codes_enregistre) && sizeof($liste_codes_enregistre) > 0) {

    $j = 1;

    foreach ($liste_codes_enregistre as $value3) {
        ?>

        <div id="myModal_edit_code_<?= $j; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="form1_edit_code_<?= $j; ?>"  name="form1_edit_code_<?= $j; ?>" method="POST" action="./controleurs/Utilisateurs/update_fiche_code.php">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">Ã—</button>
                            <h4 id="myModalLabel" class="modal-title">Editer un code N° <?= $value3['code_activation'] . $value3['id_periode']; ?> </h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="code_iptv_<?= $j; ?>" style="color:blue;font-size:16px">CODE IPTV: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="code_iptv"  name="code_iptv"   value="<?= $value2['code_iptv']; ?>" >

                                </div>
                            </div>                         
                            <div class="form-group"  style="padding-top:1%">
                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="date_end_<?= $j; ?>" style="color:blue;font-size:16px">DATE END: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="date_end"  name="date_end"   value="<?= $value3['date_end']; ?>" >

                                </div>
                            </div>
                            <div class="form-group">

                                <label class="control-label col-lg-3 col-md-3 col-sm-4" for="periode_<?= $j; ?>" style="color:blue;font-size:16px">TYPE PERIODE: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="periode_code"  id="periode_code" >

                                        <?php
                                        $tr = '<option value="">Select-periode</option>';

                                        foreach ($liste_periode as $value4) {


                                            $tr.="<option value='" . $value4['id_periode'] . "' ";

                                            if ($value4['id_periode'] == $value3['id_periode']) {

                                                $tr.= 'selected';
                                            }

                                            $tr.= ">" . $value4['nom_periode'] . "</option>";
                                        }

                                        echo $tr;
                                        ?>

                                    </select>

                                </div>
                            </div>


                            <input type="hidden" name="code_activation"  value="<?= $value3['code_activation']; ?>">                         


                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>                           
                            <button type="submit" class="btn btn-primary" name="button_register"  value="register_file">Editer le code</button>
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