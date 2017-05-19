
<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class='row'>
				<div class="page-header">
					<h3>Creation une fiche intervenant</h3>
				</div>
				<form class="form-horizontal" id="set_intervenant"
					name="set_intervenant" method="POST"
					action="./controleurs/intervenants/set_intervenant.php">
					<div id="message"></div>
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
						<li class="active"><a href="#etat_civil" data-toggle="tab">Etat
								civil</a></li>
						<li><a href="#gestion" data-toggle="tab">Gestion</a></li>
						<li><a href="#Competences" data-toggle="tab">Compétences</a></li>
						<li><a href="#zone_intervention" data-toggle="tab">Zone
								intervention</a></li>
						<li><a href="#disponibilite_intervenant" data-toggle="tab">Disponibilité</a></li>
						<li><a href="#info" data-toggle="tab">Info</a></li>
						<li><a href="#fichier_joints" data-toggle="tab">Fichiers joints </a></li>

					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="etat_civil">
							<div class="row">
								<div class="col-lg-3">
									<label for="civilite" class="control-label">Civilit&eacute;*</label>
									<select class="form-control" id="civilite" name="civilite">
										<option value=''>Choisir civilit&eacute;</option>
										<option value='Mme'>Mme</option>
										<option value='M.'>M.</option>
										<option value='Mlle'>Mlle</option>
									</select>
								</div>

								<div class="col-lg-4">
									<label for="nom_client" class="control-label">Nom</label> <input
										type="text" class="form-control" id="nom_intervenant"
										name="nom_intervenant">
								</div>
								<div class="col-lg-4">
									<label for="prenom_client" class="control-label">Pr&eacute;nom</label>
									<input type="text" class="form-control" id="prenom_intervenant"
										name="prenom_intervenant">
								</div>


							</div>
							<div class="row">
								<div class="col-lg-3">
									<label for="nationalite" class="control-label">Nationalit&eacute;</label>
									<select class="form-control" id="nationalite"
										name="nationalite">
										<option value=''>Choisir nationalit&eacute;</option>
										<option value='francaise'>Française</option>
										<option value='etrangere'>Etrangere</option>
										<option value='non_defini'>non_defini</option>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="sex" class="control-label">Sex*</label> <select
										class="form-control" id="sex" name="sex">
										<?php
										
										$tr = '<option value="">Choix Sex</option>';
										foreach ( $liste_sex as $key => $value ) {
											$tr .= '<option value="' . $key . '">' . $value . '<option>';
										}
										echo $tr;
										?>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="statut" class="control-label">Statut</label> <select
										class="form-control" id="statut" name="statut">
									<?php
									
									$tr = '<option value="">Choix Statut</option>';
									foreach ( $liste_statut as $key => $value ) {
										$tr .= '<option value="' . $key . '">' . $value . '<option>';
									}
									echo $tr;
									?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-5">
									<label for="adresse" class="control-label">Adresse</label> <input
										type="text" class="form-control" id="adresse" name="adresse">
								</div>
								<div class="col-lg-5">
									<label for="adresse_suite" class="control-label">Compl&eacute;ment
										d'adresse</label> <input type="text" class="form-control"
										id="adresse_suite" name="adresse_suite">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2">
									<label for="cp" class="control-label">Code postale</label> <input
										type="text" class="form-control" id="cp" name="cp">
								</div>
								<div class="col-lg-4">
									<label for="ville" class="control-label">Ville</label> <input
										type="text" class="form-control" id="ville" name="ville">
								</div>
								<div class="col-lg-2">
									<label for="pays" class="control-label">Pays</label> <input
										type="text" class="form-control" id="pays" name="pays"
										value='France'>
								</div>
								<div class="col-lg-3">
									<label for="date_naissance" class="control-label">Date
										naissance</label> <input type="text" class="form-control"
										id="date_naissance" name="date_naissance">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<label for="tel_domocile" class="control-label">Tél Domicile</label>
									<input type="text" class="form-control" id="tel_domicile"
										name="tel_domicile">
								</div>
								<div class="col-lg-3">
									<label for="tel_portable" class="control-label">Tél Portable</label>
									<input type="text" class="form-control" id="tel_portable"
										name="tel_portable">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<label for="fax" class="control-label">Fax</label> <input
										type="text" class="form-control" id="fax" name="fax">
								</div>
								<div class="col-lg-7">
									<label for="email" class="control-label">E-mail</label> <input
										type="text" class="form-control" id="email" name="email">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-7">
									<label for="site_web" class="control-label">Site-web</label> <input
										type="text" class="form-control" id="site_web" name="site_web">
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="gestion">
							<div class="row">
								<div class="col-lg-3">
									<label for="date_adhesion" class="control-label">Date
										d'adhésion</label> <input type="text" class="form-control"
										id="date_adhesion" name="date_adhesion">
								</div>
								<div class="col-lg-5">
									<label for="n_s_c" class="control-label">N° securité sociale</label>
									<input type="text" class="form-control" id="n_s_c" name="n_s_c">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<label for="code_banque" class="control-label">Code banque</label>
									<input type="text" class="form-control" id="code_banque"
										name="code_banque">
								</div>
								<div class="col-lg-4">
									<label for="code_guichet" class="control-label">Code guichet</label>
									<input type="text" class="form-control" id="code_guichet"
										name="code_guichet">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<label for="n_compte" class="control-label">N° compte</label>
									<input type="text" class="form-control" id="n_compte"
										name="n_compte">
								</div>
								<div class="col-lg-4">
									<label for="cle_rib" class="control-label">Clé rib</label> <input
										type="text" class="form-control" id="cle_rib" name="cle_rib">
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="Competences">
							<div class="row">
								<div class="col-lg-8 offset1">
									<div class="row">
										<div class="col-lg-12" id='diplomes'>
											<h3>Les diplomes :</h3>
											<select class="niveau_etude" style="width: 250px;"
												data-placeholder="Selectionnez les diplomes"
												id='niveau_etude' name='niveau_etude'>
												<option value=''></option>
												<option value='Bac+2'>Bac+2</option>
												<option value='Bac+3'>Bac+3</option>
												<option value='Bac+4'>Bac+4</option>
												<option value='Bac+5'>Bac+5</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="row" id='matiere'>
											<div class="row">
												<div class="row">
													<div class="col-lg-4">
														<h3>La matière:</h3>
													</div>
													<div class="col-lg-4 offset1">
														<h3>Les niveaux:</h3>
													</div>
												</div>
												<div class="col-lg-4">
													<select class="matiere" style="width: 220px;"
														data-placeholder="Selectionnez une matiere" id='matiere1'
														name='matiere1'>
													<?php
													
													$tr = '<option value="">Choix matiere</option>';
													foreach ( $liste_matiere as $key => $value ) {
														$tr .= '<option value="' . $key . '">' . $value . '<option>';
													}
													echo $tr;
													?>
													</select>
												</div>
												<div class="col-lg-4 offset1">
													<select class="niveau" multiple="true" data-placeholder="Selectionnez les niveaux"
														style="width: 400px;" id='niveau1' name='niveau1[]'>														
														<?php
														
														$tr = '<option value=""></option>';
														foreach ( $liste_niveau as $key => $value ) {
															$tr .= '<option value="' . $key . '">' . $value . '<option>';
														}
														echo $tr;
														?>
													
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<hr>
											<div class="col-lg-2" id='add_button'>
												<button type="button" class="btn btn-primary"
													id="add_matiere">Ajouter une matière</button>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="zone_intervention">
							<h2>Les zones interventions</h2>
							<select class="zone_interv" data-placeholder="Selectionnez les zones" multiple="true"
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
									<label for="infos_familles" class="control-label">Information
										à communiquer aux familles : </label>
									<textarea class="form-control" rows="8" cols="100"
										id="infos_familles" name="infos_familles"></textarea>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="fichier_joints"></div>
					</div>
					<hr>
					<div class="row offset2">
						<button class="btn btn-default" type="reset">Annuller</button>
						<button type="submit" class="btn btn-primary" id="bouton_submit">Enregistrer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>






