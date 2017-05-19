
<div class="row">
	<div class="col-md-12 column">	
		<div class="col-md-9 column" style="margin-left:3%">
			<div class='row'>
                                        <div class="page-header">
                                                <h3>Creation la fiche de client</h3>
                                        </div>
                                        <form class="form-horizontal" id="set_client" name="set_client" 	method="POST" action="./controleurs/clients/set_client.php">
                                        <?php  if(isset($liste_erreur)){  ?>  
                                          <div class="list-group">
                                                  <a href="#" class="list-group-item active">
                                                    La liste des erreurs : 
                                                  </a>
                                                  <?php
                                                  if(isset($liste_erreur)){
                                                     $message_erreur='';
                                                     foreach ( $liste_erreur as $value ) {
                                                      $message_erreur.= '<a href="#" class="list-group-item">'.$value.'</a>';
                                                      }
                                                      echo $message_erreur;
                                                  }
                                                 
                                                  ?>
                                        
                                        </div>
                                        <?php  } ?>    
                                    	<div class="page-header"></div>
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
						<li class="active"><a href="#etat_civil" data-toggle="tab">Etat
								civil</a></li>
						<li><a href="#gestion" data-toggle="tab">Gestion</a></li>
						<li><a href="#info" data-toggle="tab">Info</a></li>
						<li><a href="#parrainage" data-toggle="tab">Parrainage </a></li>
						<li><a href="#fichier_joints" data-toggle="tab">Fichiers joints </a></li>
					</ul>
					<div id="myTabContent" class="tab-content" style="height: 80%">
						<div class="tab-pane fade active in" id="etat_civil">
							<div class="row">
								<div class="col-lg-2">
									<label for="civilite" class="control-label">Civilité*</label>
									<select class="form-control" id="civilite" name="civilite">
										<option value='Madame'>Mme</option>
										<option value='Monsieur'>M.</option>
										<option value='Mademoiselle'>Mlle</option>										
									</select>
								</div>
								<div class="col-lg-3">
									<label for="nom_client" class="control-label">Nom</label> 
                                                                        <input type="text" class="form-control" id="nom_client" name="nom_client"  value='<?= $liste_valeur_saisi['nom_client'] ?>'>
								</div>
								<div class="col-lg-3">
									<label for="prenom_client" class="control-label">Prénom</label>
									<input type="text" class="form-control" id="prenom_client" name="prenom_client" value='<?= $liste_valeur_saisi['prenom_client'] ?>'>
								</div>						

							</div>
							<div class="row">
								<div class="col-lg-5">
									<label for="adresse" class="control-label">Adresse</label> 
                                                                        <input	type="text" class="form-control" id="adresse" name="adresse" value='<?= $liste_valeur_saisi['adresse'] ?>'>
								</div>							
							</div>
							<div class="row">
								<div class="col-lg-2">
									<label for="cp" class="control-label">Code postale</label> 
                                                                        <input	type="text" class="form-control" id="cp" name="cp" value='<?= $liste_valeur_saisi['cp'] ?>'>
								</div>
								<div class="col-lg-6">
									<label for="ville" class="control-label">Ville</label>
                                                                        <input	type="text" class="form-control" id="ville" name="ville" value='<?= $liste_valeur_saisi['ville'] ?>'>
								</div>
								<div class="col-lg-2">
									<label for="pays" class="control-label">Pays</label>
                                                                                   <select class="form-control" id="pays" name="pays">
                                                                                            <?php
                                                                                            $tr='';
                                                                                            foreach ( $liste_pays as $value ) {
                                                                                                   $tr.="<option  value='" . $value ['id_pays'] . "'";
                                                                                                   if(!empty($liste_valeur_saisi['pays']) && $liste_valeur_saisi['pays']==$value ['id_pays'] ){
                                                                                                    $tr.=" selected ";   
                                                                                                   }
                                                                                                   $tr.=">";
                                                                                                   $tr.=$value ['nom_pays'];
                                                                                                   $tr.="</option>";
                                                                                                
                                                                                            }
                                                                                            echo $tr;
                                                                                            ?>
                                                                                </select>
								</div>
							</div>
							<div class="row">							
								<div class="col-lg-3">
									<label for="tel_portable" class="control-label">Tél Portable</label>
									<input type="text" class="form-control" id="tel_portable" name="tel_portable" value='<?= $liste_valeur_saisi['tel_portable'] ?>'>
								</div>							
							</div>
							<div class="row">							
								<div class="col-lg-7">
									<label for="email" class="control-label">E-mail</label> 
                                                                        <input type="text" class="form-control" id="email" name="email" value='<?= $liste_valeur_saisi['email'] ?>'>
								</div>
							</div>						
						</div>
						<div class="tab-pane fade" id="gestion">
							<div class="row">
								<div class="col-lg-4">
									<label for="agent_commercial" class="control-label">Agent commercial</label>
                                                                        <select class="form-control" 	id="agent_commercial" name="agent_commercial">
                                                                                <?php                                                                                 
                                                                                            $tr='';
                                                                                            foreach ( $liste_agent_commercial as $value ) {
                                                                                                   $tr.="<option  value='" . $value ['code_agent'] . "'";
                                                                                                   if(!empty($liste_valeur_saisi['code_commercial']) && $liste_valeur_saisi['code_commercial']==$value ['code_agent'] ){
                                                                                                    $tr.=" selected ";   
                                                                                                   }
                                                                                                   $tr.=">";
                                                                                                   $tr.=$value ['identite_agent'];
                                                                                                   $tr.="</option>";
                                                                                                
                                                                                            }
                                                                                            echo $tr;
                                                                                ?>                                                                              
                                                                                </select>
								</div>
                                                            	<div class="col-lg-4">
									<label for="devise" class="control-label">La Devise</label>
                                                                        <select class="form-control" 	id="devise" name="devise">
                                                                                <?php                                                                                                                                                      
                                                                                            $tr='';
                                                                                            foreach ( $liste_devise as $value ) {
                                                                                                   $tr.="<option  value='" . $value ['code_devise'] . "'";
                                                                                                   if(!empty($liste_valeur_saisi['code_devise']) && $liste_valeur_saisi['code_devise']==$value ['code_devise'] ){
                                                                                                    $tr.=" selected ";   
                                                                                                   }
                                                                                                   $tr.=">";
                                                                                                   $tr.=$value ['nom_devise'];
                                                                                                   $tr.="</option>";
                                                                                                
                                                                                            }
                                                                                            echo $tr;
                                                                                ?> 
                                                                            
                                                                         </select>
								</div>
								<div class="col-lg-3">
									<label for="date_adhesion" class="control-label">Date d'adhésion</label> 
                                                                        <input type="text" class="form-control" id="date_adhesion" name="date_adhesion" value='<?= $liste_valeur_saisi['date_adhesion'] ?>'>
								</div>
							</div>
						</div>	
						<div class="tab-pane fade" id="info">
							<div class="row">
								<div class="col-lg-8">
									<label for="infos_interne" class="control-label">Informations internes : </label>
									<textarea class="form-control" rows="8" id="infos_interne"	name="infos_interne"><?= $liste_valeur_saisi['infos_interne'] ?></textarea>
								</div>
							</div>							
						</div>
						<div class="tab-pane fade" id="fichier_joints"></div>
						<div class="tab-pane fade" id="parrainage">
							<div class="row">
								<div class="col-lg-8">
									<label for="parrainage" class="control-label">Le Parrain :</label>
									<select class="form-control" id="code_parrain"  name="code_parrain" style="width: 250px;">
										<option value=''>Choisir le parrain</option>
                                                                                     <?php
                                                                                            $tr='';
                                                                                            foreach ( $liste_clients as $value ) {
                                                                                                   $tr.="<option  value='" . $value ['code_client'] . "'";
                                                                                                   if(!empty($liste_valeur_saisi['code_parrain']) && $liste_valeur_saisi['code_parrain']==$value ['code_client'] ){
                                                                                                    $tr.=" selected ";   
                                                                                                   }
                                                                                                   $tr.=">";
                                                                                                   $tr.=$value ['identite_client'];
                                                                                                   $tr.="</option>";
                                                                                                
                                                                                            }
                                                                                            echo $tr;
                                                                                          
                                                                                      ?>
                                                                         </select>
								</div>

							</div>

						</div>
					</div>
					<hr>
					<div class="row offset2">
                                                <input type="hidden" class="form-control" id="code_client" name="code_client" value='<?= $_GET['code_client'] ?>'>
						<button class="btn btn-default" type="reset">Annuller</button>					
						<button id="form-submit" class="btn btn-primary ladda-button"	data-style="expand-left" type="submit">
							<span class="ladda-label">Enregistrer</span>
						</button>
					</div>
				</form>
				

			</div>
		</div>
	</div>
</div>






