    <div class="row">
        <div class="col-md-12 column">
            <div class="col-md-9 column"> 
                <div class='row'>
                    <div class="page-header">
                        <h3>Répondre</h3> 
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="well well-sm">
                                    <form class="form-horizontal" name="form_rep_message"  id="form_rep_message"  action="controleurs/membre/traitement_rep_message.php"  method="POST">
                                        <fieldset>
                                            <div id="retour_message"></div> 
                                            <legend class="text-center">Rédiger un message</legend>                                     
                                            <!-- Name input-->
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="name">&Agrave;</label>
                                                <div class="col-md-9">                                                                            
                                                    <input name="distinataire" id="distinataire" type="text" value="<?php echo $infos_message['destinataire']; ?>" class="form-control" disabled>
                                                    <input name="code_distinataire" id="code_distinataire" type="hidden" value="<?php echo $infos_message['code_destinataire']; ?>" >
                                                </div>
                                            </div>
                                            <!-- Email input-->
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="objet_email">Objet</label>
                                                <div class="col-md-9">                                                  
                                                    <input id="objet_message" name="objet_message" type="text"  class="form-control"  value="Re :<?php echo $infos_message['objet_message']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="message">Votre message</label>
                                                <div class="col-md-9">                                               
                                                    <textarea class="form-control" id="message" name="message"  rows="10">                                                                                                   
                                                        <?php echo $infos_message['message']; ?>                                                  
                                                    </textarea>                                                
                                                </div>
                                            </div>
                                            <input name="id_message" id="id_message" type="hidden" value="<?php echo $infos_message['id_message']; ?>" >
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
            </div>
        </div>






