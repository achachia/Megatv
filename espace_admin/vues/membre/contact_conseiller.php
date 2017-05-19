<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">Contactez-nous</div>
            <div class="panel-body">
                <div id='load'></div>
                <div id='form'>
                    <form class="form-horizontal" name="form_conseiller"  id="form_conseiller"  action="controleurs/membre/traitement_contact_conseiller.php" method="POST">
                        <div id='message'></div>
                        <fieldset>       

                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="objet_email">Votre objet :</label>
                                <div class="col-md-9">
                                    <span id="erreur"></span>
                                    <input id="objet_message" name="objet_message" type="text" placeholder="Objet-message" class="form-control">
                                    <span id="text_erreur"></span>
                                </div>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="message">Votre message :</label>
                                <div class="col-md-9">
                                    <span id="erreur"></span>
                                    <textarea class="form-control" id="message" name="message" placeholder="S'il vous plaît redigez votre message ici..." rows="10"></textarea>
                                    <span id="text_erreur"></span>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-default"  type="reset" >Annuller</button>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>
                        </fieldset>
                    </form> 
                </div>   
            </div>
        </div>
    </div>
</div>
