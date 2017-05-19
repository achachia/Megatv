<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 id="css_titre">
						<span class=" glyphicon glyphicon-pencil"></span> Creation d'une
						fiche d'intervention
					</h3>
				</div>
				<div class="panel-body">

					<div id='load'></div>
					<div id='form' >
						<form class="form-horizontal" id="set_intervention"
							name="set_intervention" method="POST"
							action="./controleurs/interventions/set_intervention.php">
							<div id="message"></div>
							<table id='table_form'>
								<tr style='height: 20px;'>
									<td style='width: 40%'><label for="choix_famille"
										class="control-label">Choisir le client :</label></td>
									<td><select class="choix_famille" style="width: 100%;"
										data-placeholder="Selectionnez une famille" id="choix_famille"
										name="choix_famille">
											<option value="">Choisir le client</option>
                                    <?php
																																				foreach ( $liste_famille as $key => $value ) {
																																					$ligne = "<option  value='" . $value ['code_famille'] . "'>" . $value ['identite_famille'] . "</option>";
																																					echo $ligne;
																																				}
																																				?>                                 
                                </select></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="choix_eleve" class="control-label">Choisir
											votre &eacute;l&eacute;ve :</label></td>
									<td id='liste_eleve'>
									<select class="choix_eleve" style="width: 100%;"
										data-placeholder="Selectionnez un eleve" id="choix_eleve"
										name="choix_eleve">
											<option value="">Choisir le b&eacute;n&eacute;ficiaire</option>
									</select>
									</td>
								</tr>
								<tr style='height: 60px;'>
									<td style="width: 5%"><label for="type_intervention"
										class="control-label">Type intervention :</label></td>
									<td><select class="form-control" id="type_intervention"
										name="type_intervention">
											<option value=''>Type intervention</option>
											<option value='regulier'>R&eacute;gulier</option>
											<option value='ponctuelle'>Ponctuelle</option>
									</select></td>
								</tr style='height:60px;'>
								<tr style='height: 60px;'>
									<td><label for="debut_mission" class="control-label">D&eacute;but
											mission:</label></td>
									<td><input type="text" class="form-control span4 " id="debut_mission"
										name="debut_mission" ></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="choix_sex" class="control-label">Choix Sex :</label></td>
									<td><select class="form-control" id='choix_sex'
										name='choix_sex'>
																	<?php
																	
																	$tr = '<option value="">Choix sex intervenant</option>';
																	foreach ( $liste_sex as $key => $value ) {
																		$tr .= '<option value="' . $key . '">' . $value . '</option>';
																	}
																	echo $tr;
																	?>
							</select></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="statut" class="control-label">Statut :</label></td>
									<td><select class="form-control" id='choix_statut'
										name='choix_statut'>
																	<?php
																	
																	$tr = '<option value="">Choix statut intervenant</option>';
																	foreach ( $liste_statut as $key => $value ) {
																		$tr .= '<option value="' . $key . '">' . $value . '</option>';
																	}
																	echo $tr;
																	?>									
															
							</select></td>
								</tr>
								<tr id="fin_interv"></tr>
								<tr style='height: 60px;'>
									<td style="width: 5%"><label for="matiere"
										class="control-label">La mati&eacute;re:</label></td>
									<td><select class="matiere"
										data-placeholder="Selectionnez une matiere" id='matiere'
										name='matiere' style="width: 100%;">
									<?php
									
									$tr = '<option value="">Choix la mati&eacute;re</option>';
									foreach ( $liste_matiere as $key => $value ) {
										$tr .= '<option value="' . $key . '">' . $value . '</option>';
									}
									echo $tr;
									?>
							</select></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="frequence" class="control-label">La fr&eacute;quence:</label></td>
									<td><select class="form-control" id='frequence'
										name='frequence'>
											<option value=''>Choisir la fr&eacute;quence</option>
											<option value='1 fois/sem'>1 fois/sem</option>
											<option value='2 fois/sem'>2 fois/sem</option>
											<option value='3 fois/sem'>3 fois/sem</option>
											<option value='4 fois/sem'>4 fois/sem</option>
											<option value='5 fois/sem'>5 fois/sem</option>
											<option value='6 fois/sem'>6 fois/sem</option>
											<option value='Tous les 15jours'>Tous les 15jours</option>
											<option value='Occasionnellement'>Occasionnellement</option>
									</select></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="duree" class="control-label">La dur&eacute;e:</label></td>
									<td><select class="form-control" id='duree' name='duree'>
											<option value=''>Choisir la dur&eacute;e</option>
                                    <?php
																																				foreach ( $liste_duree as $key => $value ) {
																																					$ligne = "<option  value='" . $value ['id_duree'] . "'>" . $value ['duree'] . "</option>";
																																					echo $ligne;
																																				}
																																				?>  
                                </select></td>
								</tr>
								<tr style='height: 60px;'>
									<td><label for="observation" class="control-label">Observation
											li&eacute;e &aacute;�l'intervention : </label></td>
									<td><textarea class="form-control" rows="8" cols="100"
											id="infos_intervention" name="infos_intervention"></textarea></td>
								</tr>
								<tr style='height: 60px;'>
									<td COLSPAN="2"><label for="option_date_1_cours"
										class="control-label">Exiger &aacute; l'intervenant la date de
											1er cours :&nbsp; </label> <input type="checkbox"
										name="option_date_1_cours" checked value="1"></td>
								</tr>
							</table>
							<div class="row"></div>
					
					</div>

				</div>
				<div class="panel-footer" style="text-align: center">
					<button class="btn btn-default" type="reset">Annuller</button>
					<button type="submit" class="btn btn-primary" id="set_sans_choix"
						name="set_sans_choix" value="set_sans_choix">Enregistrer sans
						intervenant</button>
					<button type="submit" class="btn btn-primary" id="choix_interv"
						name="choix_interv" value="choix_interv">Choisir un intervenant</button>
				</div>
			</div>
			</form>

		</div>
	</div>
</div>







