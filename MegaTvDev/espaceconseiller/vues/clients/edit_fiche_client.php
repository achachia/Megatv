<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class='row' id='formulaire'>
				<form class="form-horizontal" id="modifier_fiche_client"
					name="modifier_fiche_client" method="POST"
					action="./controleurs/clients/update_fiche_client.php">
					<div id='load'></div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 id="css_titre">
								<span class=" glyphicon glyphicon-pencil"></span> Modification la fiche de [<?php echo $infos_client['nom_client']; ?>]
							</h3>
						</div>
						<div class="panel-body">
							<div id="message"></div>
							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
								<li class="active"><a href="#etat_civil" data-toggle="tab">Etat
										civil</a></li>
								<li><a href="#gestion" data-toggle="tab">Gestion</a></li>
								<li><a href="#info" data-toggle="tab">Info</a></li>
								<li><a href="#parrainage" data-toggle="tab">Parrainage </a></li>
								<li><a href="#fichier_joints" data-toggle="tab">Fichiers joints
								</a></li>
							</ul>
							<div id="myTabContent" class="tab-content" style="height: 80%">
								<div class="tab-pane fade active in" id="etat_civil">
									<div class="row">
										<div class="col-lg-2">
											<label for="civilite" class="control-label">Civilité*</label>
											<input type="text" class="form-control" id="civilite"
												name='civilite'
												value="<?php echo $infos_client['civilite']; ?>" disabled>
										</div>
										<div class="col-lg-3">
											<label for="nom_client" class="control-label">Nom</label> <input
												type="text" class="form-control" id="nom_client"
												name="nom_client"
												value="<?php echo $infos_client['nom_client']; ?>" disabled>
										</div>
										<div class="col-lg-3">
											<label for="prenom_client" class="control-label">Prénom</label>
											<input type="text" class="form-control" id="prenom_client"
												name="prenom_client"
												value="<?php echo $infos_client['prenom_client']; ?>"
												disabled>
										</div>
										<div class="col-lg-2">
											<label for="statut" class="control-label">Statut</label> <select
												class="form-control" id="statut" name="statut">
										<?php
										$statut = array (
												'Client' => 'client',
												'Prospect' => 'prospect' 
										);
										$option = '';
										foreach ( $statut as $key => $value ) {
											$option .= "<option value='" . $value . "' ";
											if ($value == $infos_client ['statut'])
												$option .= "selected";
											$option .= ">" . $key . "</option>";
										}
										echo $option;
										?>									
									</select>
										</div>

									</div>
									<div class="row">
										<div class="col-lg-5">
											<label for="adresse" class="control-label">Adresse</label> <input
												type="text" class="form-control" id="adresse" name="adresse"
												value="<?php echo $infos_client['adresse']; ?>">
										</div>
										<div class="col-lg-5">
											<label for="adresse_suite" class="control-label">Complément
												d'adresse</label> <input type="text" class="form-control"
												id="adresse_suite" name="adresse_suite"
												value="<?php echo $infos_client['adresse_suite']; ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-2">
											<label for="cp" class="control-label">Code postale</label> <input
												type="text" class="form-control" id="cp" name="cp"
												value="<?php echo $infos_client['code_postale']; ?>">
										</div>
										<div class="col-lg-6">
											<label for="ville" class="control-label">Ville</label> <input
												type="text" class="form-control" id="ville" name="ville"
												value="<?php echo $infos_client['ville']; ?>">
										</div>
										<div class="col-lg-2">
											<label for="pays" class="control-label">Pays</label> <input
												type="text" class="form-control" id="pays" name="pays"
												value='France' disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<label for="tel_domocile" class="control-label">Tél Domicile</label>
											<input type="text" class="form-control" id="tel_domicile"
												name="tel_domicile"
												value="<?php echo $infos_client['tel_fixe']; ?>">
										</div>
										<div class="col-lg-3">
											<label for="tel_portable" class="control-label">Tél Portable</label>
											<input type="text" class="form-control" id="tel_portable"
												name="tel_portable"
												value="<?php echo $infos_client['tel_portable']; ?>">
										</div>
										<div class="col-lg-3">
											<label for="tel_travail" class="control-label">Tél Travail</label>
											<input type="text" class="form-control" id="tel_travail"
												name="tel_travail"
												value="<?php echo $infos_client['tel_travail']; ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<label for="fax" class="control-label">Fax</label> <input
												type="text" class="form-control" id="fax" name="fax"
												value="<?php echo $infos_client['fax']; ?>">
										</div>
										<div class="col-lg-7">
											<label for="email" class="control-label">E-mail</label> <input
												type="text" class="form-control" id="email" name="email"
												value="<?php echo $infos_client['email']; ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-7">
											<label for="site_web" class="control-label">Site-web</label>
											<input type="text" class="form-control" id="site_web"
												name="site_web"
												value="<?php echo $infos_client['site_web']; ?>">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="gestion">
									<div class="row">
										<div class="col-lg-4">
											<label for="conseiller_peda" class="control-label">Conseiller
												pédagogique</label> <input type="text" class="form-control"
												id="conseiller_peda" name='conseiller_peda'
												value="<?php echo $infos_client['conseiller_attache']; ?>"
												disabled>
										</div>
										<div class="col-lg-3">
											<label for="date_adhesion" class="control-label">Date
												d'adhésion</label> <input type="text" class="form-control"
												id="date_adhesion" name="date_adhesion"
												value="<?php echo $infos_client['date_adhesion']; ?>"
												disabled>
										</div>
									</div>
                                                                    <hr>
                                                                    	<div class="row">
										<div class="col-lg-6">
											<label for="numero_compte" class="control-label">Numero-compte bancaire
											</label>
                                                                                        <input type="text" class="form-control"
												id="numero_compte" name='numero_compte'
												value="<?php echo $infos_client['N_compte_banc']; ?>"
												>
										</div>										
									</div>
								</div>
								<div class="tab-pane fade" id="info">
									<div class="row">
										<div class="col-lg-8">
											<label for="infos_interne" class="control-label">Informations
												internes : </label>
											<textarea class="form-control" rows="8" id="infos_interne"
												name="infos_interne"><?php echo $infos_client['infos_interne']; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-8">
											<label for="infos_intervenants" class="control-label">Information
												à communiquer aux intervenants : </label>
											<textarea class="form-control" rows="8" cols="100"
												id="infos_intervenants" name="infos_intervenants"><?php echo $infos_client['infos_intervenants']; ?></textarea>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="fichier_joints"></div>
								<div class="tab-pane fade" id="parrainage">
									<div class="row">
										<div class="col-lg-4">
											<label for="parrainage" class="control-label">Le Parrain :</label>
											<input type="text" class="form-control" id="identite_parrain"
												name="identite_parrain"
												value="<?php echo $infos_client['identite_parrain']; ?>"
												disabled>
										</div>
									</div>

								</div>
							</div>

						</div>
						<div class="panel-footer" style="text-align: center">
							<input type="hidden" class="form-control" id="code_client"
								name="code_client" value="<?php echo $_GET['code_client']; ?>">
							      <button type="button" class="btn btn-primary" id="retour">
                                                                     <span class="glyphicon glyphicon-backward"></span> RETOUR
                                                              </button>
                                                        <button class="btn btn-default" type="reset">Annuller</button>
							<button type="submit" class="btn btn-primary"
								id="edit_fiche_client" name="edit_fiche_client"
								value="edit_fiche_client">Modifier la fiche
                                                        </button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>






