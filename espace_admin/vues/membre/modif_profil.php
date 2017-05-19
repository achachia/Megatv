
<div class="row">
	<div class="col-md-12 column">		
		<div class="col-md-9 column">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-12">
						<h2>Modification profil</h2>
					</div>
				</div>
			</div>
	<form name="update_profil" id="update_profil" method="POST" 	action="controleurs/membre/update_profil.php">
				<fieldset>
					<legend>Coordonn&eacute;es</legend>
					<div class="form-group">
						<div class="row">
							<label for="nom" class="col-lg-2 control-label">Nom</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="nom_intervenant"
									name="nom_intervenant"
									value="<?php echo $infos_intervenant['nom']; ?>" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="prenom" class="col-lg-2 control-label">Prénom</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="prenom_intervenant"
									name="prenom_intervenant"
									value="<?php echo $infos_intervenant['prenom']; ?>" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label for="tel1" class="col-lg-3 control-label">Téléphone</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="tel_fixe"
										name='tel_fixe'
										value="<?php echo $infos_intervenant['tel_fixe']; ?>"
										maxlength="30">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="tel2" class="col-lg-2 control-label">Portable</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="tel_port"
										name='tel_port'
										value="<?php echo $infos_intervenant['tel_portable']; ?>"
										maxlength="30">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label for="fax" class="col-lg-2 control-label">Fax</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="fax" name='fax'
										value="<?php echo $infos_intervenant['fax']; ?>"
										maxlength="30">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="email" class="col-lg-2 control-label">Email</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="email" name="email"
									value="<?php echo $infos_intervenant['email']; ?>" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="url" class="col-lg-2 control-label">Site web</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="url" name="url"
									value="<?php echo $infos_intervenant['site_web']; ?>">
							</div>
						</div>
					</div>
					<legend>Adresse</legend>
					<div class="form-group">
						<div class="row">
							<label for="adresse" class="col-lg-2 control-label">Adresse</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="adresse"
									nme="adresse"
									value="<?php echo $infos_intervenant['adresse']; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="adresse1" class="col-lg-2 control-label">Adresse
								(complement)</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="adresse_suite"
									name="adresse_suite"
									value="<?php echo $infos_intervenant['adresse_suite']; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="cp" class="col-lg-2 control-label">Code postale</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="cp" name="cp"
									value="<?php echo $infos_intervenant['code_postale']; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="ville" class="col-lg-2 control-label">Ville</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="ville" name="ville"
									value="<?php echo $infos_intervenant['ville']; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="pays" class="col-lg-2 control-label">Pays</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" id="pays" name="pays"
									value="<?php echo $infos_intervenant['pays']; ?>" disabled>
							</div>
						</div>
					</div>
					<legend>Mes Coordonnées bancaires</legend>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label for="tel1" class="col-lg-3 control-label">Code banque</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="code_banque"
										name="code_banque"
										value="<?php echo $infos_intervenant['banque']; ?>"
										maxlength="30">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="tel2" class="col-lg-2 control-label">Code guichet</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="code_guichet"
										name="code_guichet"
										value="<?php echo $infos_intervenant['guichet']; ?>"
										maxlength="30">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label for="tel1" class="col-lg-4 control-label">N° Compte</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="n_compte"
										name="n_compte"
										value="<?php echo $infos_intervenant['n_compte']; ?>"
										maxlength="30">
								</div>
							</div>
							<div class="col-lg-6">
								<label for="tel2" class="col-lg-3 control-label">Clé RIB</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="cle_rib"
										name="cle_rib"
										value="<?php echo $infos_intervenant['cle_rib']; ?>"
										maxlength="30">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button class="btn btn-default">Annuller</button>
							<button type="submit" class="btn btn-primary">Mettre &agrave;
								jour</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
