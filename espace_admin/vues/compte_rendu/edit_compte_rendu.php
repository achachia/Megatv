<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Modifier un compte-rendu</h4></div>
            <div class="panel-body">
                <div id="message"></div>
                <form class="form-horizontal" id="update_compte_rendu"
                      name='update_compte_rendu' method="POST"
                      action="index.php?module=compte_rendu&action=update_compte_rendu">
                  
                        <div class="form-group">
                            <label for="nom_eleve" class="control-label">Eleve</label> <input
                                type="text" class="form-control" id="nom_eleve" name="nom_eleve"
                                value='<?php echo $infos_compte_rendu['eleve']; ?>' disabled>
                        </div>
                
                        <div class="form-group">
                            <label for="code_coupon" class="control-label">Code coupon</label>
                            <input type="text" class="form-control" id="code_coupon"
                                   name="code_coupon"
                                   value='<?php echo $infos_compte_rendu['e_coupon']; ?>' disabled>
                        </div>
                  
                        <div class="form-group">
                            <label for="date_cours" class="control-label">Date cours</label>
                            <input type="text" class="form-control"
                                   id="date_cours" name="date_cours"
                                   value='<?php echo $infos_compte_rendu['date_cours']; ?>'> 
                        </div>
                   
                        <div class="form-group">
                            <label for="heure_cours" class=" control-label">Heure cours</label>
                            <input type="text" class="form-control"
                                   id="datetime_picker" name="datetime_picker"
                                   value='<?php echo $infos_compte_rendu['heure_cours']; ?>'>
                        </div>
                
                        <div class="form-group">
                            <label for="progression" class="control-label">Progression</label>
                            <select class="form-control"
                                    id="progression_cours" name="progression_cours">
                                <option value=''>Progression cours</option>
                                <?php
                                $progression = [
                                    '3' => 'Excellent',
                                    '2' => 'Moyen',
                                    '1' => 'Faible'
                                ];
                                foreach ($progression as $key => $value) {
                                    ?>  
                                    <option
                                        value='<?php echo $key; ?>'
                                        <?php
                                        if ($key == $infos_compte_rendu ['progression_cours']) {
                                            echo "selected='selected'";
                                        }
                                        ?>><?php echo $value; ?></option>                                   
                                    <?php } ?>  
                            </select> 
                        </div>
               
                        <div class="form-group">
                            <label for="compte_rendu" class="control-label">Compte-rendu</label>							
                            <textarea class="form-control" id="compte_rendu" rows="10"
                                      name="compte_rendu"><?php echo $infos_compte_rendu['resume_compte_rendu']; ?></textarea>
                            <span class="help-block">Qu'avez-vous
                                fait pendant la séance et que conseillez-vous à votre élève
                                pour continuer sa progression ? (entre 10 et 200 mots) *</span>

                        </div>
                   
                    <input type="hidden" class="form-control" id="id_compte_rendu"
                           name="id_compte_rendu"
                           value='<?php echo $infos_compte_rendu['id_compte']; ?>'>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default" type="reset">Annuller</button>
                            <button type="submit" class="btn btn-primary" id="modifier">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

