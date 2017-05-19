<div class="row">
    <div class="col-md-9 column">
        <div class='row'>
            <div id='load'></div>
            <div id='form'>
                <form class="form-horizontal" id="update_fiche_beneficiaire"   name="update_fiche_beneficiaire" method="POST"      action="./controleurs/beneficiaires/update_fiche_beneficiaire.php">
                    <div id="message"></div>
                    <!-- --------------------------------------- -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 id="css_titre">
                                <span class=" glyphicon glyphicon-pencil"></span> Modification la fiche de [<?php echo $infos_benef['identite_beneficiaire']; ?>]
                            </h3>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                <li class="active"><a href="#etat_civil" data-toggle="tab">Etat civil</a></li>
                                <li><a href="#disponibilite" data-toggle="tab" id="tab_dispo">Disponibilite</a></li>
                                <li><a href="#info" data-toggle="tab">Infos</a></li>
                                <li><a href="#fiche_peda" data-toggle="tab">Fiche pedagogique </a></li>
                                <li><a href="#gestion" data-toggle="tab">Gestion</a></li>
                                <li><a href="#fichier_joints" data-toggle="tab">Fichiers joints
                                    </a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content" style="height: 80%">
                                <div class="tab-pane fade active in" id="etat_civil"	style="width: 100%">                                                              
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="nom_beneficiaire" class="control-label">Nom :</label>
                                            <input type="text" class="form-control" id="nom_beneficiaire"   name="nom_beneficiaire" value="<?php echo $infos_benef['nom']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">  
                                        <div class="col-lg-7">
                                            <label for="prenom_beneficiaire" class="control-label">Prénom :</label>
                                            <input type="text" class="form-control"    id="prenom_beneficiaire" name="prenom_beneficiaire" value="<?php echo $infos_benef['prenom']; ?>">
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-lg-7">
                                            <label for="prenom_beneficiaire" class="control-label">Date de naissance :</label> 
                                            <input type="text" class="form-control"  id="date_naissance" name="date_naissance" value="<?php echo $infos_benef['date_naissance']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label for="adresse" class="control-label">Adresse</label> <input
                                                type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $infos_benef['adresse']; ?>">
                                        </div>
                                        <div class="col-lg-5">
                                            <label for="adresse_suite" class="control-label">Complément
                                                d'adresse</label> <input type="text" class="form-control"
                                                                     id="adresse_suite" name="adresse_suite" value="<?php echo $infos_benef['adresse_suite']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label for="cp" class="control-label">Code postale</label> <input
                                                type="text" class="form-control" id="cp" name="cp" value="<?php echo $infos_benef['code_postale']; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="ville" class="control-label">Ville</label> <input
                                                type="text" class="form-control" id="ville" name="ville" value="<?php echo $infos_benef['ville']; ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="pays" class="control-label">Pays</label> <input
                                                type="text" class="form-control" id="pays" name="pays"
                                                value="<?php echo $infos_benef['pays']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="tel_fixe" class="control-label">Tél Domicile :</label>
                                            <input type="text" class="form-control" id="tel_fixe" name="tel_fixe" value="<?php echo $infos_benef['tel_fixe']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="tel_portable" class="control-label">Tél Portable :</label>
                                            <input type="text" class="form-control" id="tel_portable" name="tel_portable" value="<?php echo $infos_benef['tel_portable']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="email" class="control-label">E-mail :</label> <input
                                                type="text" class="form-control" id="email" name="email" value="<?php echo $infos_benef['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <label for="site_web" class="control-label">Site-web</label> <input
                                                type="text" class="form-control" id="site_web" name="site_web">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="disponibilite" style="width: 100%">
                                    <div class="row">
                                        <div class="col-lg-12">
<?php include './vues/beneficiaires/formulaire_disponibilite.php'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="infos_interne" class="control-label">Informations
                                                internes : </label>
                                            <textarea class="form-control" rows="8" id="infos_interne"
                                                      name="infos_interne"><?php echo $infos_benef['infos_interne']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="infos_intervenants" class="control-label">Information
                                                à communiquer aux intervenants : </label>
                                            <textarea class="form-control" rows="8" cols="100"
                                                      id="infos_intervenant" name="infos_intervenant"><?php echo $infos_benef['infos_intervenant']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="fiche_peda">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="niveau_peda" class="control-label">Niveau  pedagogique :</label> 
                                            <select class="form-control"    id="niveau_peda" name="niveau_peda">                                              
<?php
$option = "<option value=''>Choisir niveau pedagogique</option>";
foreach ($liste_niveau_peda as $value) {
    $option.= "<option  value='" . $value ['id_option'] . "' ";
    if ($value ['id_option'] == $infos_benef['id_option']) {
        $option.= " selected";
    }
    $option.=">" . $value ['nom_option'] . "</option>";
}
echo $option;
?>


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="gestion">
                                    <div class="row">

                                        <div class="col-lg-4">
                                            <label for="date_adhesion" class="control-label">Date d'adhésion :</label>
                                            <input type="text" class="form-control"   id="date_adhesion" name="date_adhesion" value="<?php echo $infos_benef['date_adhesion']; ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="fichier_joints">
                                    <div class="row"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="text-align: center">
                            <input type="hidden" class="form-control" id="code_beneficiaire"	name="code_beneficiaire" value="<?php echo $_GET['code_beneficiaire']; ?>">
                            <button class="btn btn-default" type="reset">Annuller</button>
                            <button type="submit" class="btn btn-primary" id="bouton_submit">Enregistrer
                                la fiche</button>
                        </div>

                    </div>


                </form>
            </div>
        </div>

    </div>
</div>







