
<div class="row">
    <div class="col-md-12 column">
        <div class="col-md-9 column">
            <div class='row'>
                <div class="page-header">
                    <h3><?= $title_form; ?></h3>
                </div>
                <div id='load'></div>
                <div id='form'>
                    <form class="form-horizontal" id="set_commande" name="set_commande" method="POST" action="<?= $action_form; ?>">
                        <div id="message"></div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 id="css_titre">
                                    <span class=" glyphicon glyphicon-pencil"></span> Choix fournisseur
                                </h3>
                            </div>
                            <div class="panel-body">
                                <table>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Choix fournisseur :</td>
                                        <td style="width: 50%">
                                            <select class="choix_fournisseur" style="width: 250px;" data-placeholder="Selectionnez un fournisseur" 	id="choix_fournisseur" name="choix_fournisseur">
                                                <option value="">Choisir un fournisseur</option>
                                                <?php
                                                foreach ($liste_fournisseurs as $key => $value) {

                                                    $ligne = "<option  value='" . $value ['code_fournisseur'] . "'";
                                                    if ($value ['code_fournisseur'] == $infos_commande ['code_fournisseur']) {
                                                        $ligne .= " selected ";
                                                    }
                                                    $ligne .= ">" . $value ['nom_fournisseur'] . "</option>";
                                                    echo $ligne;
                                                }
                                                ?>                                 
                                            </select></td>
                                    </tr>                       
                                </table>
                            </div>

                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 id="css_titre">
                                    <span class=" glyphicon glyphicon-pencil"></span> LE FORMULAIRE
                                </h3>
                            </div>
                            <div class="panel-body">
                                <table style='width: 100%;'>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Date commande :</td>
                                        <td style="width: 50%"><input type="text" class="form-control"	id="date_commande" name="date_commande" value="<?= $$infos_commande ['date_commande']; ?>"></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">N° order fournisseur :</td>
                                        <td style="width: 50%"><input type="text" class="form-control" 	id="n_order" name="n_order" value='<?php echo $infos_commande ['n_order']; ?>'></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Date reception :</td>
                                        <td style="width: 50%"><input type="text" class="form-control"	id="date_reception" name="date_reception" value="<?= $infos_commande ['date_reception']; ?>"></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Etat commande :</td>
                                        <td style="width: 50%">
                                            <select class="form-control" id="etat_commande" name="etat_commande">
                                                <option value="">Choisir etat commande</option>
                                                <?php
                                                foreach ($etat_commande as $key => $value) {
                                                    $ligne = "<option  value='" . $key . "'";
                                                    if ($key == $infos_commande ['etat_commande']) {
                                                        $ligne .= " selected ";
                                                    }
                                                    $ligne .= ">" . $value . "</option>";
                                                    echo $ligne;
                                                }
                                                ?> 

                                            </select>
                                        </td>
                                    </tr>
                                          
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Modéle coupon :</td>
                                        <td style="width: 50%">
                                            <select class="form-control" id="modele_coupon" name="modele_coupon">
                                                <option value="">Choisir le modéle</option>
                                                <?php
                                                foreach ($model_coupon as $key => $value) {
                                                    $ligne = "<option  value='" . $value ['id_model'] . "'";
                                                    if ($value ['id_model'] == $infos_facture ['id_model']) {
                                                        $ligne .= " selected ";
                                                    }
                                                    $ligne .= ">" . $value ['nom'] . "</option>";
                                                    echo $ligne;
                                                }
                                                ?>                                           
                                            </select>
                                        </td>
                                    </tr>


                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Nombre heure :</td>
                                        <td style="width: 50%"><input type="text" class="form-control" 	id="nb_heure" name="nb_heure" value='<?php echo $nb_heure; ?>'></td>
                                    </tr>
          
                                    <?php if (!empty($_GET ['N_facture'])) { ?>
                                        <tr style="height: 60px;" id="tr_type_remise">
                                            <td style="width: 50%">Type remise</td>
                                            <td style="width: 50%">
                                                <select class="form-control" id="type_remise" name="type_remise">
                                                    <option value="">Choisir le type de remise</option>
                                                    <option value="espece" <?php
                                                    if ($type_remise == 'espece') {
                                                        echo 'selected';
                                                    }
                                                    ?>>Espece(EUR)</option>
                                                    <option value="pourcentage" <?php
                                                    if ($type_remise == 'pourcentage') {
                                                        echo 'selected';
                                                    }
                                                    ?>>Pourcentage(%)</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px;" id="tr_valeur_remise">
                                            <td style="width: 50%">Valeur remise :</td>
                                            <td style="width: 50%">
                                                <input type="text" class="form-control" id="valeur_remise" name="valeur_remise" value="<?= $valeur_remise; ?>">
                                            </td>
                                        </tr>
<?php } ?>

                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Objet facture :</td>
                                        <td style="width: 50%">
                                            <input type="text" class="form-control"	id="objet_facture" name="objet_facture" value="<?php echo $objet_facture; ?>"></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Designation facture :</td>
                                        <td style="width: 50%">
                                            <textarea  class="form-control" id="designation_facture" name="designation_facture" rows="6"><?php echo $designation_facture; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Paiement comptant à réception de la facture :</td>
                                        <td style="width: 50%">
                                            <INPUT type="checkbox" name="paiement_cpt_rec_facture" id="paiement_cpt_rec_facture" value="1"  <?php
if (isset($infos_facture['chekbox_paiement'])) {
    echo 'checked';
}
?>></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%"><hr /></td>
                                        <td style="width: 50%"><hr /></td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">TOTAL (HT) :</td>
                                        <td style="width: 50%">
                                            <input type="text" class="form-control" 	id="total_HT" name="total_HT" disabled value='<?php echo $Total_HT; ?>'>
                                        </td>
                                    </tr>
                                    <tr style='height: 60px;'>
                                        <td style="width: 50%">Creer un acompte</td>
                                        <td style="width: 50%"><INPUT type="checkbox" 	name="section_acompte" id="section_acompte" value="true"></td>
                                    </tr>
                                </table>

                            </div>
<?php if (!empty($_GET['N_facture'])) { ?>
                                <INPUT type="hidden" name="N_facture" id="N_facture" value="<?= $_GET['N_facture']; ?>">
<?php } ?> 
                            <div class='row' id="section_acompte_view"></div>
                            <div class="panel-footer" style="text-align: center">
                                <button class="btn btn-default" type="reset">Annuller</button>
                                <button type="submit" class="btn btn-primary" id="bouton_submit"><?= $title_button ?></button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>










