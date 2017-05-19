<div class="row">
	<div class="col-md-12 column">
		<div class='row'>
			<div id='load'></div>
			<div id='form'>
				<form class="form-horizontal" id="update_fiche_intervenant" name="update_fiche_intervenant" method="POST" action="./controleurs/intervenants/update_fiche_intervenant.php">
					<div id="message"></div>
					<!-- --------------------------------------- -->
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 id="css_titre">
								<span class=" glyphicon glyphicon-pencil"></span> Modification la fiche de [<?php echo $infos_interv['identite_intervenant']; ?>]
                            </h3>
						</div>
						<div class="panel-body">
							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
								<li class="active"><a href="#etat_civil" data-toggle="tab">Etat	civil</a></li>
								<li><a href="#gestion" data-toggle="tab">Gestion</a></li>
								<li><a href="#Competences" data-toggle="tab">Compétences</a></li>
								<li><a href="#zone_intervention" data-toggle="tab">Zone	intervention</a></li>
								<li><a href="#disponibilite_intervenant" data-toggle="tab">Disponibilité</a></li>
								<li><a href="#info" data-toggle="tab">Info</a></li>
								<li><a href="#fichier_joints" data-toggle="tab">Fichiers joints</a></li>

							</ul>
							<div id="myTabContent" class="tab-content">
								<div class="tab-pane fade active in" id="etat_civil">
									<div class="row">
										<div class="col-lg-3">
											<label for="civilite" class="control-label">Civilit&eacute;*</label>
											<select class="form-control" id="civilite" name="civilite">
                                                                                            <?php 
                                                                                            $option='';
                                                                                            foreach ($civilite as $key => $value) {                                                                                                
                                                                                                $option.="<option value='$key'";
                                                                                                if($key==$infos_interv['civilite']){
                                                                                                   $option.='selected';    
                                                                                                }
                                                                                                $option.=">$value</option>";
                                                                                            } 
                                                                                            echo $option; 
                                                                                            ?>										
											</select>
										</div>

										<div class="col-lg-4">
											<label for="nom_intervenant" class="control-label">Nom</label> 
                                                                                        <input type="text" class="form-control" id="nom_intervenant" name="nom_intervenant" value="<?= $infos_interv['nom'] ?>">
										</div>
										<div class="col-lg-4">
											<label for="prenom_intervenant" class="control-label">Pr&eacute;nom</label>
											<input type="text" class="form-control" id="prenom_intervenant" name="prenom_intervenant" value="<?= $infos_interv['prenom'] ?>">
										</div>


									</div>
									<div class="row">
										<div class="col-lg-3">
											<label for="nationalite" class="control-label">Nationalit&eacute;</label>
											<select class="form-control" id="nationalite" 	name="nationalite">
                                                                                                 <?php 
                                                                                                        $option='';
                                                                                                        foreach ($nationalite as $key => $value) {                                                                                                
                                                                                                            $option.="<option value='$key'";
                                                                                                            if($key==$infos_interv['nationalite']){
                                                                                                               $option.='selected';    
                                                                                                            }
                                                                                                            $option.=">$value</option>";
                                                                                                        } 
                                                                                                        echo $option; 
                                                                                                ?>											
											</select>
										</div>
										<div class="col-lg-3">
											<label for="sex" class="control-label">Sex*</label>
                                                                                        <select class="form-control" id="id_sex" name="id_sex">
                                                                                                   <?php 
                                                                                                        $option='';
                                                                                                        foreach ($liste_sex as $key => $value) {                                                                                                
                                                                                                            $option.="<option value='$key'";
                                                                                                            if($key==$infos_interv['id_sex']){
                                                                                                               $option.='selected';    
                                                                                                            }
                                                                                                            $option.=">$value</option>";
                                                                                                        } 
                                                                                                        echo $option; 
                                                                                                ?>
									
									                </select>
										</div>
										<div class="col-lg-3">
											<label for="statut" class="control-label">Statut</label> 
                                                                                        <select class="form-control" id="id_statut" name="id_statut">
								                                        <?php 
                                                                                                        $option='';
                                                                                                        foreach ($liste_statut as $key => $value) {                                                                                                
                                                                                                            $option.="<option value='$key'";
                                                                                                            if($key==$infos_interv['id_statut']){
                                                                                                               $option.='selected';    
                                                                                                            }
                                                                                                            $option.=">$value</option>";
                                                                                                        } 
                                                                                                        echo $option; 
                                                                                                ?>
									               </select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<label for="adresse" class="control-label">Adresse</label> 
                                                                                        <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $infos_interv['adresse'] ?>">
										</div>
										<div class="col-lg-5">
											<label for="adresse_suite" class="control-label">Compl&eacute;ment d'adresse</label> 
                                                                                        <input type="text" class="form-control" id="adresse_suite" name="adresse_suite" value="<?= $infos_interv['adresse_suite'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-2">
											<label for="cp" class="control-label">Code postale</label> 
                                                                                        <input	type="text" class="form-control" id="cp" name="cp" value="<?= $infos_interv['code_postale'] ?>" >
										</div>
										<div class="col-lg-4">
											<label for="ville" class="control-label">Ville</label> 
                                                                                        <input	type="text" class="form-control" id="ville" name="ville" value="<?= $infos_interv['ville'] ?>">
										</div>
										<div class="col-lg-2">
											<label for="pays" class="control-label">Pays</label> 
                                                                                        <input 	type="text" class="form-control" id="pays" name="pays"  value="<?= $infos_interv['pays'] ?>">
										</div>
										<div class="col-lg-3">
											<label for="date_naissance" class="control-label">Date naissance</label> 
                                                                                        <input type="text" class="form-control" id="date_naissance" name="date_naissance" value="<?= $infos_interv['date_naissance'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<label for="tel_domocile" class="control-label">Tél Domicile</label>
											<input type="text" class="form-control" id="tel_domicile" name="tel_domicile" value="<?= $infos_interv['tel_domicile'] ?>">
										</div>
										<div class="col-lg-3">
											<label for="tel_portable" class="control-label">Tél Portable</label>
											<input type="text" class="form-control" id="tel_portable" name="tel_portable" value="<?= $infos_interv['tel_portable'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<label for="fax" class="control-label">Fax</label> 
                                                                                        <input	type="text" class="form-control" id="fax" name="fax" value="<?= $infos_interv['fax'] ?>">
										</div>
										<div class="col-lg-7">
											<label for="email" class="control-label">E-mail</label> 
                                                                                        <input type="text" class="form-control" id="email" name="email" value="<?= $infos_interv['email'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-7">
											<label for="site_web" class="control-label">Site-web</label>
											<input type="text" class="form-control" id="site_web"	name="site_web" value="<?= $infos_interv['site_web'] ?>">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="gestion">
									<div class="row">
										<div class="col-lg-4">
											<label for="date_adhesion" class="control-label">Date d'adhésion</label> 
                                                                                        <input type="text" class="form-control"	id="date_adhesion" name="date_adhesion" value="<?= $infos_interv['date_adhesion'] ?>">
										</div>
										<div class="col-lg-6">
											<label for="n_s_c" class="control-label">N° securité sociale</label> 
                                                                                        <input type="text" class="form-control" id="n_s_c" name="n_s_c" value="<?= $infos_interv['numero_sec_sc'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<label for="code_banque" class="control-label">Code banque</label>
											<input type="text" class="form-control" id="code_banque" name="code_banque" value="<?= $infos_interv['code_banque'] ?>">
										</div>
										<div class="col-lg-5">
											<label for="code_guichet" class="control-label">Code guichet</label>
											<input type="text" class="form-control" id="code_guichet" name="code_guichet" value="<?= $infos_interv['code_guichet'] ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5">
											<label for="n_compte" class="control-label">N° compte</label>
											<input type="text" class="form-control" id="n_compte"	name="n_compte" value="<?= $infos_interv['n_compte'] ?>">
										</div>
										<div class="col-lg-5">
											<label for="cle_rib" class="control-label">Clé rib</label> 
                                                                                        <input 	type="text" class="form-control" id="cle_rib" name="cle_rib" value="<?= $infos_interv['cle_rib'] ?>">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="Competences">
									
								    <div class="row">
                                                                        <div class="col-lg-4">
								           <label for="niveau_peda" class="control-label">Les diplomes :</label><br/><br/>
									   <select class="niveau_etude" style="width:250px;" data-placeholder="Selectionnez les diplomes" id='niveau_etude' name='niveau_etude'>
													   <?php 
													          $option='';
                                                                                                                  foreach ($liste_diplomes as $key => $value) {                                                                                                
                                                                                                                          $option.="<option value='$key'";
                                                                                                                          if($key==$infos_interv['id_niveau_etude']){
                                                                                                                                 $option.='selected';    
                                                                                                                           }
                                                                                                                           $option.=">$value</option>";
                                                                                                                  } 
                                                                                                                 echo $option; 													
													    ?>
									     </select>
                                                                         </div>
                                                                        
								   </div>
                                                                     <hr>
								   <div class="row">
									<div class="col-lg-4">
									    <label for="matiere" class="control-label">La matière:</label>                           
                                                                 	</div>
									<div class="col-lg-4">
									    <label for="matiere" class="control-label">La niveaux:</label>                                                                  
								        </div>
								    </div><br/>
                                                            <div id="liste_matiere">  
                                                                    <?php  $i=1; foreach ($liste_matiere_intervenant as  $id_matiere) {  ?>
                                                                    <div class="row">
                                                                      <div class="col-lg-12">  
									<div class="col-lg-4">
									   <select class="matiere" style="width: 220px;" data-placeholder="Selectionnez une matiere"  id='matiere<?= $i; ?>' name='matiere<?= $i; ?>'>
													                     <?php 
													                           $option='';
                                                                                                                                   foreach ($liste_matiere as $key => $value) {                                                                                                
                                                                                                                                       $option.="<option value='$key'";
                                                                                                                                       if($id_matiere==$key){
                                                                                                                                           $option.='selected';    
                                                                                                                                       }
                                                                                                                                      $option.=">$value</option>";
                                                                                                                                   } 
                                                                                                                                   echo $option; 													
													                     ?>
									   </select>
                                                                            
                                                                            
									</div>
									<div class="col-lg-4">                                                                 
                                                                            <select class="niveau"  multiple="true" data-placeholder="Selectionnez les niveaux" style="width: 400px;" id="niveau<?= $i; ?>" name="niveau<?= $i; ?>[]" >														
										     <?php 
                                                                                     $liste_niveau_matiere_intervenant=liste_niveau_matiere_intervenant($_GET['code_intervenant'],$id_matiere);
													                           $option='';
                                                                                                                                   foreach ($liste_niveau as $key => $value) {                                                                                                
                                                                                                                                       $option.="<option value='$key'";
                                                                                                                                       if(in_array($key, $liste_niveau_matiere_intervenant)){
                                                                                                                                           $option.='selected';    
                                                                                                                                       }
                                                                                                                                      $option.=">$value</option>";
                                                                                                                                   } 
                                                                                                                                   echo $option; 													
										      ?>				
                                                                          
													
									    </select>
								        </div>
                                                                        <div class="col-lg-4" style="color:red;padding-left:100px "> 
                                                                            <button class="remove"><span class="glyphicon glyphicon-remove" id="remove<?= $i; ?>"></span>Supprimer</button>
                                                                        </div>
                                                                       </div> <br/> 
								    </div>                                                                
                                                                    <?php  $i++; }  ?> 
                                                                   </div>   
								   <div class="row">
									<hr>
									<div class="col-lg-2" id='add_button'>
										<button type="button" class="btn btn-primary" 	id="add_matiere">Ajouter une matière</button>
									</div>
								  </div>								
									
								</div>
								<div class="tab-pane fade" id="zone_intervention">
									<h2>Les zones interventions</h2>
									<select class="zone_interv"
										data-placeholder="Selectionnez les zones" multiple="true"
										style="width: 400px;" id='zone_intervention'
										name='zone_intervention[]'>
										<option value=''></option>
                                    <?php
																																				foreach ( $liste_zone as $key => $value ) {
																																					$ligne = '<optgroup label="' . $key . '">';
																																					$ligne .= "<option  value='" . $value ['code_postale'] . "'>" . $value ['nom_commune'] . "</option>";
																																					$ligne .= '</optgroup>';
																																					echo $ligne;
																																				}
																																				?> 
                                </select>
								</div>
								<div class="tab-pane fade" id="disponibilite_intervenant">
									<h3>Les disponibilités</h3>
									<div id="formulaire_dispo"><?php include './vues/intervenants/formulaire_dispo_intervenant.php';?></div>
								</div>
								<div class="tab-pane fade" id="info">
									<div class="row">
										<div class="col-lg-8">
											<label for="infos_interne" class="control-label">Informations
												internes : </label>
											<textarea class="form-control" rows="8" id="infos_interne"
												name="infos_interne"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-8">
											<label for="infos_familles" class="control-label">Information à communiquer aux familles : </label>
											<textarea class="form-control" rows="8" cols="100"	id="infos_familles" name="infos_familles"></textarea>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="fichier_joints"></div>
							</div>
						</div>
						<div class="panel-footer" style="text-align: center">
							<input type="hidden" class="form-control" id="code_intervenant"	name="code_intervenant" value="<?php echo $_GET['code_intervenant']; ?>">
							<button class="btn btn-default" type="reset">Annuller</button>
							<button type="submit" class="btn btn-primary" id="bouton_submit">Enregistrer la fiche</button>
						</div>

					</div>

				</form>
			</div>
		</div>

	</div>
</div>








