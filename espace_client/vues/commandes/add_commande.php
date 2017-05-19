
<div class="row" style="margin-left:30px">
    <div class="row" style="margin-left:30px">
        <h2 style="color:#7CFC00;font-size:27px">Commande</h2>
        <h4 class="text-left" style="color:#7CFC00">Remplissez les champs suivants pour confirmer votre commande </h4><br><br> 
    </div>   

    <div class="col-lg-12">

        <form class="form-horizontal" id="add_commande" method="POST"    action="ajouter-commande.html">
            <div id="message"></div>
            <fieldset>    
                <div class="col-lg-4" style="border-radius: 10px;box-shadow: 2px 2px 2px #87CEFA">
                    <h4 class="text-left" style="color:blue">
                        <i class="fa fa-user fa-2x"></i>
                        Mon profil
                    </h4>
                    <div class="sepreater"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="prenom" class="control-label">Prénom:</label>
                            <input type="text" class="form-control" id="prenom"   name="prenom" value="<?= $infos_client['prenom']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nom" class="control-label">Nom de famille:</label>
                            <input type="text" class="form-control" id="nom"   name="nom" value="<?= $infos_client['nom']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="email" class="control-label">E-mail: </label>
                            <input type="text" class="form-control" id="email"   name="email" value="<?= $infos_client['email']; ?>" disabled>
                        </div>
                    </div>
                    <br>
                    <?php if (isset($objet_commande)) { ?>     
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-left" style="color:blue">                          
                                    Adresse de livraison
                                </h4>
                                <div class="sepreater"></div>
                            </div>    

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit"  >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="prix_unit" class="control-label">Prix unitaire :</label>
                                <input type="text" class="form-control" id="prix_unit"   name="prix_unit">
                            </div>
                        </div>
                    <?php } ?>
                    <br><br>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-7" style="border-radius: 10px;box-shadow: 2px 2px 2px #87CEFA;">
                    <h4 class="text-left" style="color:blue">
                        <i class="fa fa-credit-card fa-2x"></i>
                        &#10; Mode de paiement&#10;
                    </h4>
                    <div class="sepreater"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="choix_paiement" class="control-label">M&Eacute;THODE DE PAIEMENT :</label>
                            <select class="form-control" id="choix_paiement"     name="choix_paiement">
                                <option value="">Choisir votre m&eacute;thode de paiement</option>
                             <!--   <option value="method_NETELLER">Transfert d'argent par NETELLER</option>-->
                                <option value="method_PAYPAL">Transfert d'argent par PAYPAL</option>
                                <option value="method_WESTERN_UNION">Transfert d'argent par WESTERN UNION</option>
                            </select>
                        </div>
                    </div><br><br>
                    <h4 class="text-left" style="color:blue">
                        <i class="fa fa-check fa-2x"></i>
                        &#10; R&#233;capitulatif de la commande&#10;
                    </h4>
                    <div class="sepreater"></div>

                    <div class="row">
                        <div class="col-lg-11">
                            <h3>Description :</h3>
                            <div class="col-md-2 col-xs-3">                           
                                <img class="img-thumbnail" alt="<?= $infos_abonnement['description']; ?>" src="http://mega-cours.fr/iptv/theme/images/<?= $infos_abonnement['img']; ?>">
                            </div>
                            <div class="col-md-7 col-xs-9"  class="text-left">
                                <p style="color:#000000">
                                    <?= $infos_abonnement['description']; ?><br> 
                                    <span>&#10; Ref.&#160;<?= $infos_abonnement['ref']; ?>&#10; </span>
                                </p>  
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <label for="prix_unit" class="control-label">Prix unitaire :</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">&euro;</span>
                                <input type="text" class="form-control"  aria-describedby="basic-addon1" id="prix_unit" name="prix_unit"  value="<?= $infos_abonnement['prix_unit']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <label for="quantite" class="control-label">Quantite :</label>
                            <input type="text" class="form-control" id="quantite"   name="quantite" value="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <label for="total" class="control-label">Total :</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">&euro;</span>
                                <input type="text" class="form-control"  aria-describedby="basic-addon1" id="prix_total" name="prix_total"  value="<?= $infos_abonnement['prix_unit']; ?>" disabled>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-9">
                            <p  class="text-left">Si vous souhaitez ajouter un commentaire à propos de votre commande,<br> veuillez le mentionner ci-dessous.:</p>
                            <textarea class="form-control" id="message_commande" rows="8"    name="message_commande"></textarea>
                        </div>
                    </div>       
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <input type="hidden" class="form-control" id="code_user"  name="code_user" value="<?= $_SESSION ['client'] ['code_user']; ?>">                              
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <input type="hidden" class="form-control" id="id_abo"
                                   name="id_abo" value="<?= $id_abo; ?>">                              
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-4">                             
                            <button class="btn btn-default" type="reset" style="font-size:20px">Annuler</button>
                            <button type="submit" class="btn btn-primary" id="bouton_submit" style="font-size:20px">Commander</button>
                        </div>
                    </div>

                </div>
            </fieldset> 
        </form>

    </div>
</div>

