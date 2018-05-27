
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
                            if (isset($liste_demandes_attente)) {

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
                            }
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
<?php }  ?>
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

<?php
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = '';
   $db      = 'megatv_vod';
   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn 	= "mysql:host=" . $hn . ";dbname=" . $db . ";charset=" . $cs;
   
   $opt 	= array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo 	= new PDO($dsn, $un, $pwd, $opt);
   
   $id_device='1a25';
   $plate_form='android';
   $code_activation='415755';
   
   
   $date_start = date("Y-m-d  H:i:s");
   $periode='+7 days';
   
   $periode='+2 week';
   
   $periode='+1 month';
   
   $periode='+1 year';
     
   $date_end = date("Y-m-d  H:i:s", strtotime($date_start." $periode"));
   
   echo $date_end;

try {

    $sql = " SELECT   id_code,date_start,date_end  FROM  CodesMegaTv  WHERE  id_device='" . $id_device . "'  AND  plate_form='" . $plate_form . "'   AND  code_activation='" . $code_activation . "' ";


    $select = $pdo->query($sql);

    $nb = $select->rowCount();    
   

    if ($nb > 0) {
        
       

        $enregistrement = $select->fetch();
        
        var_dump($enregistrement['date_start']);

        if ($enregistrement['date_start'] == '' && $enregistrement['date_end'] == '') {

            echo $nb;

            /*             * **************** Mettre a jour lenregistrement ******************* */

            $id_code = $enregistrement['id_code'];

            $date_start = date("Y-m-d  H:i:s");

            $date_end = $sql1 = " UPDATE  CodesMegaTv  SET  date_start='" . $date_start . "',date_end='" . $date_end . "'  WHERE  id_code='" . $id_code . "' ";


            $select = $pdo->query($sql);
        }

        /*         * ************************** Recuperation des informations ******************************** */

        $sql2 = " SELECT  token_device AS token,code_iptv,plate_form FROM  CodesMegaTv  WHERE  id_device='" . $id_device . "'  AND  plate_form='" . $plate_form . "'  AND date_start<='" . $date_connection . "'  AND date_end>='" . $date_connection . "' ";

        try {
            $stmt = $pdo->query($sql2);

            $row = $stmt->fetch(PDO::FETCH_OBJ);

            $data = $row;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>




