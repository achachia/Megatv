
<div class="row">
    <div class="col-md-9 column">
        <div class='row'>
            <div class="page-header">
                <h3>
                    <strong>Consultation la facture N: <?php echo $_GET['N_facture']; ?></strong>
                </h3>
            </div>
        </div>
        <div class='row'>
            <form class="form-horizontal" id="update_etat_facture"
                  name="update_etat_facture" method="POST"
                  action="./controleurs/facturation/update_etat_facture.php">
                <ul class="nav nav-pills nav-justified" style="margin-bottom: 15px;">
                    <li class="active"><a href="#fiche_facture" data-toggle="tab">FICHE
                            FACTURE</a></li>
                    <li><a href="#encaissements_facture" data-toggle="tab">Encaissements-
                            FACTURE</a></li>
                    <li><a href="#fiche_famille" data-toggle="tab">FICHE FAMILLE</a></li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="fiche_facture">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Information facture</strong>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped ">
                                    <tbody>
                                        <tr>
                                            <th>REFERENCE :</th>
                                            <td><?php echo $infos_facture['reference']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>DATE FACTURE :</th>
                                            <td><?php echo $infos_facture['date_facture']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>DATE EXCUTION FACTURE :</th>
                                            <td><?php echo $infos_facture['date_excution']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>OBJET FACTURE:</th>
                                            <td><?php echo $infos_facture['objet_facture']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>DESIGNATION :</th>
                                            <td><?php echo $infos_facture['designation_facture']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>MONTANT FACTURE :</th>
                                            <td><?php echo $infos_facture['total_facture']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL REGLE :</th>
                                            <td><?php echo $infos_facture['total_regle_facture']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL RESTANT :</th>
                                            <td><?php echo $infos_facture['total_rest_facture']; ?></td>
                                        </tr>								
                                        <tr>
                                            <th>ETAT FACTURE :</th>
                                            <td id="etat_facture"><?php echo $infos_facture['etat_facture']; ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="row">								
                                    <?php if (isset($etat_facture_possible) && sizeof($etat_facture_possible) > 0) { ?>				
                                        <div class="col-md-4"
                                             id="liste_etat_facture">
                                            <select class="form-control" id="changer_etat_facture"
                                                    name="changer_etat_facture">												
                                                        <?php
                                                        $tr = "<option value=''>Modifier etat facture</option>";
                                                        foreach ($etat_facture_possible as $key => $value) {
                                                            $tr .= "<option value='" . $key . "'>" . $value . "</option>";
                                                        }
                                                        echo $tr;
                                                        ?>			

                                            </select>
                                        </div>
                                    <?php } ?>				
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="encaissements_facture">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Liste des encaissements</strong>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <?php if (('en_cours_reglement' == $infos_facture ['etat_facture_encaiss']) || ('attente' == $infos_facture ['etat_facture_encaiss'])) { ?>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-8">
                                            <button type="button" class="btn btn-primary"
                                                    value="add_encaissement">Ajouter un encaissement</button>
                                        </div>

                                    </div>
                                    <hr>

                                <?php } ?>
                                <?php if(sizeof($liste_encaissements_facture)!=0){    ?>    
                                <table id="liste_encaissements_facture"
                                       class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Date prevu</th>
                                            <th>Montant</th>
                                            <th>Etat</th>
                                            <th>N cheque</th>
                                            <th>Changer etat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($liste_encaissements_facture)) {
                                            $tr = '';
                                            foreach ($liste_encaissements_facture as $value) {
                                                $tr .= '<tr>';
                                                $tr .= '<td>' . $value ['N_encaissement'] . '</td><td>' . $value ['date_encaissemnt'] . '</td><td>' . $value ['montant_encaissemnt'] . '</td><td>' . $value ['etat_encaissemnt'] . '</td><td>' . $value ['N_cheque'] . '</td>';
                                                $tr .= '<td>';
                                                if (is_array($value ['changer_etat_encaissement'])) {
                                                    $tr .= '<select class="form-control" id="changer_etat_encaissement"  name="changer_etat_encaissement">';
                                                    $tr .= "<option value=''>Modifier etat encaissement</option>";
                                                    foreach ($value ['changer_etat_encaissement'] as $key => $value) {
                                                        $tr .= "<option value='" . $key . "'>" . $value . "</option>";
                                                    }
                                                    $tr .= '</select>';
                                                } else {
                                                    $tr .= $value ['changer_etat_encaissement'];
                                                }
                                                $tr .= '</td>';
                                                $tr .= '</tr>';
                                            }
                                            echo $tr;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php }else{  ?>
                                    <h3>Aucun encaissement trouve</h3>
                                <?php }  ?> 
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="fiche_famille">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>FICHE FAMILLE</strong>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 column"></div>
                                    <figure>
                                        <img
                                            src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png"
                                            alt="" class="img-circle img-responsive"
                                            style="width: 100px; height: 100px">
                                    </figure>
                                </div>
                                <h5>
                                    <strong>CIVILITE :</strong>  <?php echo $infos_facture['civilite']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-user"></span> NOM :</strong>
                                    <?php echo $infos_facture['identite_famille']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-qrcode"></span> Code
                                        client :</strong>  <?php echo $infos_facture['code_client']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-tree-conifer"></span>
                                        Adresse :</strong>
                                    <?php echo $infos_facture['adresse']; ?></h5>
                                <h5>
                                    <strong>Code postale :</strong>  <?php echo $infos_facture['code_postale']; ?></h5>
                                <h5>
                                    <strong>Ville :</strong> <?php echo $infos_facture['ville']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-phone-alt"></span>
                                        Tél Fixe:</strong>
                                    <?php echo $infos_facture['tel_fixe']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-earphone"></span> Tél
                                        Portable :</strong>
                                    <?php echo $infos_facture['tel_portable']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-earphone"></span> Tél
                                        Travail :</strong>
                                    <?php echo $infos_facture['tel_travail']; ?></h5>
                                <h5>
                                    <strong><span class="glyphicon glyphicon-envelope"></span>
                                        Email : </strong>
                                    <?php echo $infos_facture['email']; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="reference_facture" id="reference_facture"
                       value="<?php echo $_GET['N_facture']; ?>" /> <input type="hidden"
                       name="code_client" id="code_client"
                       value="<?php echo $infos_facture['code_client']; ?>" />
            </form>
        </div>
        <div class="col-md-3 offset4">
            <button type="button" class="btn btn-primary" id="retour">
                <span class="glyphicon glyphicon-backward"></span> RETOUR
            </button>
        </div>
        <div class="col-md-3 offset2">
            <button type="button" class="btn btn-primary" id="view_facture">
                <span class="glyphicon glyphicon-eye-open"></span> Visualiser la facture
            </button>
        </div>
        <div class="col-md-3 offset2">
            <button type="button" class="btn btn-primary" id="view_liste_coupons">
                <span class="glyphicon glyphicon-eye-open"></span> Visualiser la fiche des coupons
            </button>
        </div>

    </div>
</div>



