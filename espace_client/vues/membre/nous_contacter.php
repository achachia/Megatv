


<div class="row"  style="margin-left:30px">

    <form class="form-horizontal"  id="form_contact"   method="POST" action='nous-contacter.html'  role="form">
        <div class="col-md-7">
            <h2 style="color:blue;font-size:27px">NOUS CONTACTER</h2>
            <div class="sepreater"></div> <br><br>      
            <div class="form-group">
                <input class="form-control input-lg" name="objet"  type="text"   placeholder="Objet de votre message" tabindex="1" >
            </div>
            <div class="form-group">
                <textarea class="form-control input-lg" rows="3" id="message" name="message" placeholder="Votre message" tabindex="4"></textarea>
               <!-- <span class="help-block">Le message ne peut pas dépasser 1000 caractéres.</span>-->
            </div>

            <input  name="code_user"  type="hidden"  value="<?= $_SESSION ['client'] ['code_user']; ?>" >

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <button type="button"  class="btn btn-danger btn-block btn-lg" id="resetBtn">Annuler</button>
                </div>
                <div class="col-xs-12 col-md-6">
                    <button type="submit" class="btn btn-primary btn-block btn-lg"   name="signup" value="envoyer">Envoyer</button>
                </div>
            </div>


        </div>
    </form>   
</div>
