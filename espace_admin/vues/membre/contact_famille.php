<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">Contactez une famille</div>
            <div class="panel-body">
                <div id='load'></div>
                <div id='form'>
                    <form class="form-horizontal" name="form_famille"  id="form_famille"  action="index.php?module=membre&action=contact_famille"  method="POST">
                        <div id='message'></div>
                        <fieldset>                                     
                                                          
                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="name">&Agrave; :</label>
                                <div class="col-md-9">                                               
                                    <span id="erreur"></span>                                      
                                    <select class="form-control" id="code_distinataire" name="code_distinataire">
                                        <option value=''>Choisissez une famille</option>
                                        <?php
                                        foreach ($infos_distinataire as $value) {
                                            echo "<option  value='" . $value['code_famille'] . "'>" . $value['famille'] . "</option>";
                                        }
                                        ?> 
                                    </select>
                                    <span id="text_erreur"></span>
                                </div>
                            </div>

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



