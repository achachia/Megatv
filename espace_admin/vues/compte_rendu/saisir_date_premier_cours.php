<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Saisir la date de 1er cours (la famille <?php echo $_GET['identite_famille']; ?>). </h3></div>
            <div class="panel-body">
                <form class="form-horizontal" id="set_date_premier_cours" name="set_date_premier_cours"  method="POST"      action="controleurs/action_membre/set_date_premier_cours.php">
                    <div id="message"></div>                   
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date 1er cours</label>
                            <input type="text" class="form-control" id="date_cours"   name="date_cours">
                       
                            
                        </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="heure_cours" class=" control-label">Heure 1er cours</label>
                            <input type="text" class="form-control" id="datetime_picker"
                                   name="datetime_picker">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <input type="hidden" class="form-control" id="reference_intervention"
                                       name="reference_intervention"   value="<?php echo $_GET["reference_mission"]; ?>">
                                <button class="btn btn-default" type="reset">Annuller</button>
                                <button type="submit" class="btn btn-primary"
                                        id="bouton_submit">Enregistrer</button>
                            </div>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

























