<style>

    label{
        color:blue;
        font-size:18px;
    }
</style>    

<div class="col-md-12 column"> 
    <div class='row' style="margin-left:30px">


        <div class="row">
            <form class="form-horizontal" name="form_rep_message"  id="form_rep_message"   action="index.php?module=membre&action=check_rep_message"  method="POST">
                <fieldset>   
                   
                    <div class="col-md-5"style="border-radius: 10px;box-shadow: 2px 2px 2px #87CEFA">                 
                        <h2 style="color:blue;font-size:27px">Rédiger un message</h2>
                        <div class="sepreater"></div> <br><br>      
                        <div class="form-group">
                            <label class="css_label">Objet de message :</label>
                            <input class="form-control input-lg" name="objet" id="objet"  type="text"    value="Re: <?php echo $infos_message_recu['objet_message'] ?>" tabindex="1" >
                        </div>
                        <div class="form-group">
                            <label>Le message :</label>
                            <textarea class="form-control input-lg" rows="12" id="message" name="message" placeholder="Votre message" tabindex="2"></textarea>               
                        </div>
                         <input  name="code_user"  type="hidden"  value="<?= $_SESSION ['client'] ['code_user']; ?>" >
                         <input  name="token_message"  type="hidden"  value="<?= $_GET["token_message"]; ?>" >
                         
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <button type="button"  class="btn btn-danger btn-block btn-lg" id="resetBtn">Annuler</button>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"   name="signup" value="envoyer">Envoyer</button>
                            </div>
                        </div><br>

                    </div>
                    <div class="col-md-1"></div>
                    <!----------------------------------------------------------------->
                    <div class="col-md-5" style="border-radius: 10px;box-shadow: 2px 2px 2px #87CEFA;">
                        <h2 style="color:red;font-size:27px">Votre message recu</h2>
                        <div class="sepreater"></div> <br><br> 
                        <div class="form-group">
                            <label>Date de message :</label>
                            <input class="form-control input-lg"  type="text" name="date_message_recu"  value="<?php echo $infos_message_recu['date_message'] ?>" disabled >
                        </div>
                        <div class="form-group">
                            <label>Heure de message :</label>
                            <input class="form-control input-lg"  type="text"  name="heure_message_recu" value="<?php echo $infos_message_recu['heure_message'] ?>" disabled >
                        </div>
                        <div class="form-group">
                            <label>Objet de message :</label>
                            <input class="form-control input-lg"  type="text" name="objet_message_recu"  value="<?php echo $infos_message_recu['objet_message'] ?>" disabled >
                        </div>
                        <div class="form-group">
                            <label>Le message :</label>
                            <textarea class="form-control input-lg" rows="3"  name="core_message_recu"  disabled><?php echo $infos_message_recu['core_message'] ?></textarea>                        
                        </div> 
                    </div>
                </fieldset>
            </form>
        </div>


    </div>
</div>







