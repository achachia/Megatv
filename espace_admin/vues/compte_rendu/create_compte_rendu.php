
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Rediger un compte-rendu [<?php echo $identite_eleve; ?>]</h4></div>
            <div class="panel-body">
                <form class="form-horizontal" id="create_compte_rendu" method="POST"
                      action="index.php?module=compte_rendu&action=check_compte_rendu">
                    <div id="message"></div>
                    <fieldset>                  

                        <div class="form-group">
                            <label for="date_cours" class="control-label">Date cours :</label>
                            <input type="text" class="form-control" id="date_cours"
                                   name="date_cours">
                        </div>


                        <div class="form-group">
                            <label for="heure_cours" class=" control-label">Heure cours :</label>
                            <input type="text" class="form-control" id="datetime_picker"
                                   name="datetime_picker">
                        </div>


                        <div class="form-group">
                            <table>
                                <tr>
                                <label for="theme_cours" class=" control-label">Le theme
                                    travaille</label>
                                </tr>
                                <tr>
                                    <td style='width:70%;'><select class="form-control" id="theme_cours"
                                                                   name="theme_cours">
                                            <option value=''>Choisir votre theme :</option>
                                            <?php
                                            foreach ($liste_theme as $value) {
                                                echo "<option  value='" . $value ['id_theme'] . "'>" . $value ['nom_theme'] . "</option>";
                                            }
                                            ?> 
                                        </select></td>
                                    <td>
                                        <button type="button" class="btn btn-default"
                                                id="create_theme">
                                            <span class="glyphicon glyphicon-plus"></span> Ajouter un
                                            theme
                                        </button>
                                    </td>
                                </tr>
                            </table>


                        </div>

                        <div class="form-group">
                            <label for="code_coupon" class="control-label">Code coupon :</label>
                            <input type="text" class="form-control" id="code_coupon"
                                   name="code_coupon">
                        </div>

                        <div class="form-group">
                            <label for="progression" class="control-label">Progression :</label>
                            <select class="form-control" id="progression_cours"
                                    name="progression_cours">								
                                        <?php
                                        $select = "<option value=''>Progression cours</option>";
                                        foreach ($liste_progression as $key => $value) {
                                            $select .= "<option value='" . $key . "'>" . $value . "</option>";
                                        }
                                        echo $select;
                                        ?>						
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="compte_rendu" class="control-label">Compte-rendu :</label>
                            <textarea class="form-control" id="editor" rows="10"
                                      name="compte_rendu"></textarea>
                            <span class="help-block">Qu'avez-vous fait pendant la sÃ©ance et
                                que conseillez-vous Ã  votre Ã©lÃ¨ve pour continuer sa progression
                                ? (entre 10 et 200 mots) *</span>

                        </div>

                      <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <input type="hidden" class="form-control" id="code_eleve"
                                       name="code_eleve" value="<?php echo $_GET['code_eleve']; ?>">                              
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-4">                             
                                <button class="btn btn-default" type="reset">Annuller</button>
                                <button type="submit" class="btn btn-primary" id="bouton_submit">Enregistrer</button>
                            </div>
                        </div>

                    </fieldset> 
                </form>
            </div>
        </div>
    </div>

</div>
