
    <form class="form-horizontal"  id="form_contact"   method="POST" action='vues/membres/ajax_php.php'  role="form">
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-dismissable alert-info" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong id='validation'></strong>
                </div>
            </div>
        </div>      
        <div class="row">
            <div class="col-md-8">
                <div class="well bs-component">
                    <legend>Nous contacter</legend>
                    <div class="form-group">
                        <input class="form-control input-lg" name="nom"  type="text"   placeholder="NOM" tabindex="1" >
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Adresse email "
                               tabindex="2">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" name="objet"  type="text"   placeholder="Objet de votre message" tabindex="3" >
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-lg" rows="3" id="message" name="message" placeholder="Votre message" tabindex="4"></textarea>
                        <span class="help-block">Le message ne peut pas dépasser 1000 caractéres.</span>
                    </div>



                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <button type="button"class="btn btn-danger btn-block btn-lg" id="resetBtn">Annuler</button>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <button type="submit" class="btn btn-primary btn-block btn-lg"   name="signup" value="Sign
                                    up">Enregistrer</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
