<?php
?>
<div class="row">
	<div class="col-md-12 column">	
		<div class="col-md-9 column" style="margin-left:3%">
			<div class='row'>
				<div class="page-header">
					<h3>Creation la fiche de client</h3>
				</div>
				<form class="form-horizontal" id="set_client" name="set_client"
					method="POST" action="./controleurs/clients/set_client.php">
					<div id="message"></div>
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
										<option value='Mme'>Mme</option>
										<option value='M.'>M.</option>
										<option value='Mlle'>Mlle</option>
										<option value='M.et Mme'>M.et Mme</option>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="nom_client" class="control-label">Nom</label> <input
										type="text" class="form-control" id="nom_client"
										name="nom_client">
								</div>
								<div class="col-lg-3">
									<label for="prenom_client" class="control-label">Prénom</label>
									<input type="text" class="form-control" id="prenom_client"
										name="prenom_client">
								</div>
								<div class="col-lg-2">
									<label for="statut" class="control-label">Statut</label> <select
										class="form-control" id="statut" name="statut">
										<option value='client'>Client</option>
										<option value='prospect'>Prospect</option>
									</select>
								</div>

							</div>
							<div class="row">
								<div class="col-lg-5">
									<label for="adresse" class="control-label">Adresse</label> <input
										type="text" class="form-control" id="adresse" name="adresse">
								</div>
								<div class="col-lg-5">
									<label for="adresse_suite" class="control-label">Complément
										d'adresse</label> <input type="text" class="form-control"
										id="adresse_suite" name="adresse_suite">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-2">
									<label for="cp" class="control-label">Code postale</label> <input
										type="text" class="form-control" id="cp" name="cp">
								</div>
								<div class="col-lg-6">
									<label for="ville" class="control-label">Ville</label> <input
										type="text" class="form-control" id="ville" name="ville">
								</div>
								<div class="col-lg-2">
									<label for="pays" class="control-label">Pays</label> <input
										type="text" class="form-control" id="pays" name="pays"
										value='France'>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<label for="tel_domocile" class="control-label">Tél Domicile</label>
									<input type="text" class="form-control" id="tel_domicile"
										name="tel_domicile" >
								</div>
								<div class="col-lg-3">
									<label for="tel_portable" class="control-label">Tél Portable</label>
									<input type="text" class="form-control" id="tel_portable"
										name="tel_portable">
								</div>
								<div class="col-lg-3">
									<label for="tel_travail" class="control-label">Tél Travail</label>
									<input type="text" class="form-control" id="tel_travail"
										name="tel_travail">
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
								<div class="col-lg-4">
									<label for="conseiller_peda" class="control-label">Conseiller
										pédagogique</label> <select class="form-control"
										id="conseiller_peda" name="conseiller_peda">
<?php
foreach ( $liste_conseiller as $value ) {
	echo "<option  value='" . $value ['code_conseiller'] . "'>" . $value ['identite_conseiller'] . "</option>";
}

?>
</select>
								</div>
								<div class="col-lg-3">
									<label for="date_adhesion" class="control-label">Date
										d'adhésion</label> <input type="text" class="form-control"
										id="date_adhesion" name="date_adhesion">
								</div>
							</div>
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
									<label for="infos_intervenants" class="control-label">Information
										à communiquer aux intervenants : </label>
									<textarea class="form-control" rows="8" cols="100"
										id="infos_intervenants" name="infos_intervenants"></textarea>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="fichier_joints"></div>
						<div class="tab-pane fade" id="parrainage">
							<div class="row">
								<div class="col-lg-8">
									<label for="parrainage" class="control-label">Le Parrain :</label>
									<select class="form-control" id="liste_clients"
										name="liste_clients" style="width: 250px;">
										<option value=''>Choisir le parrain</option>
                 <?php
																	foreach ( $liste_clients as $value ) {
																		echo "<option  value='" . $value ['code_parrain'] . "'>" . $value ['identite_parrain'] . "</option>";
																	}
																	?>
                 </select>
								</div>

							</div>

						</div>
					</div>
					<hr>
					<div class="row offset2">
						<button class="btn btn-default" type="reset">Annuller</button>
						<!--  	<button type="submit" class="btn btn-primary" id="bouton_submit">Enregistrer</button> -->
						<button id="form-submit" class="btn btn-primary ladda-button"
							data-style="expand-left" type="submit">
							<span class="ladda-label">Enregistrer</span>
						</button>
					</div>
				</form>
				<!--  <a href="#" id="form-submit" class="btn btn-primary btn-lg ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">Submit form</span></a> -->

			</div>
		</div>
	</div>
</div>






