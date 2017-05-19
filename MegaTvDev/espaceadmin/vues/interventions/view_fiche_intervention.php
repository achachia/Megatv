
<div class="row">
	<div class="col-md-12 column">	
		<div class="col-md-12 column">
			<div class='row'>
				<div class="page-header">
					<h3>
						<strong>Consultation la fiche intervention N: <?php echo $_GET['reference_intervention'];?></strong>
					</h3>
				</div>
			</div>
			<div class='row'>
				<form class="form-horizontal" id="update_etat_intervention"
					name="update_etat_intervention" method="POST"
					action="./controleurs/interventions/update_etat_intervention.php">
					<ul class="nav nav-pills nav-justified"
						style="margin-bottom: 15px;">
						<li class="active"><a href="#fiche_intervention" data-toggle="tab">FICHE
								INTERVENTION</a></li>
						<li><a href="#fiche_famille" data-toggle="tab">FICHE FAMILLE</a></li>
						<li><a href="#fiche_eleve" data-toggle="tab">FICHE ELEVE</a></li>
				<?php if($_GET['mod_interv']!='annule_sans_interv'){?>		
						<li><a href="#fiche_intervenant" data-toggle="tab">FICHE
								INTERVENANT</a></li>
				<?php } ?>				
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="fiche_intervention">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">
										<strong>FICHE INTERVENTION</strong>
									</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped ">
										<tbody>
											<tr>
												<th>REFERENCE :</th>
												<td><?php echo $infos_intervention['reference'];?></td>
											</tr>
											<tr>
												<th>DATE CREATION :</th>
												<td><?php echo $infos_intervention['date_creation_intervention'];?></td>
											</tr>
											<tr>
												<th>TYPE INTERVENTION :</th>
												<td><?php echo $infos_intervention['type_intervention'];?></td>
											</tr>
											<tr>
												<th>MATIERE :</th>
												<td><?php echo $infos_intervention['matiere'];?></td>
											</tr>
											<tr>
												<th>DATE DEBUT MISSION :</th>
												<td><?php echo $infos_intervention['date_debut_mission'];?></td>
											</tr>
											<?php if(isset($infos_intervention['date_fin_mission'])){?>
											<tr>
												<th>DATE FIN MISSION :</th>
												<td><?php echo $infos_intervention['date_fin_mission'];?></td>
											</tr>
											<?php } ?>
											<tr>
												<th>FREQUENCE :</th>
												<td><?php echo $infos_intervention['frequence'];?></td>
											</tr>
											<tr>
												<th>DUREE :</th>
												<td><?php echo $infos_intervention['duree'];?></td>
											</tr>
											<tr>
												<th>EXIGEANCE DATE 1er COURS :</th>
												<td><p style="color:red;font-size:16px;text-decoration:underline;font-weight:bold;"><?php echo $infos_intervention['exigeance_date_cours'];?></p></td>
											</tr>
											<?php if(isset($infos_intervention['date_heure_premier_cours'])){?>
											<tr>
												<th>DATE/HEURE 1er COURS :</th>
												<td><p style="color:red;font-size:16px;text-decoration:underline;font-weight:bold;"><?php echo $infos_intervention['date_heure_premier_cours'];?></p></td>
											</tr>
									     	<?php } ?>									     	
											<tr>
												<th>EXIGEANCE BILAN 1er COURS :</th>
												<td><p style="color:red;font-size:16px;text-decoration:underline;font-weight:bold;"><?php
												$td = $infos_intervention ['exigeance_bilan_cours'];
												echo $td;
												?></p></td>
											</tr>
									<?php if($infos_intervention ['exigeance_bilan_cours']=='OUI'){?>	
										<tr>
												<th>DISPONIBILITE BILAN :</th>
												<td><p style="color:red;font-size:16px;text-decoration:underline;font-weight:bold;">
										      	<?php
										$bilan = ($infos_intervention ['id_bilan_premier_cours'] != NULL) ? "<button type='button' class='btn btn-primary' id='consultation_bilan' value='" . $infos_intervention ['id_bilan_premier_cours'] . "'><span class='glyphicon glyphicon-eye-open'></span> Consulter le bilan</button>" : "INDISPONIBLE";
										echo $bilan;
										?>
										  </p></td>
											</tr>
									<?php } ?>
										<tr>
												<th>OBSERVATION :</th>
												<td><?php echo $infos_intervention['observation'];?></td>
											</tr>

										</tbody>
									</table>
									<input type="hidden" name="reference_intervention"
										id="reference_intervention"
										value="<?php echo $_GET['reference_intervention']; ?>" />
									<div class="row">
										<div class="col-md-3 offset1">
											<button type="button" class="btn btn-primary" id="retour">
												<span class="glyphicon glyphicon-backward"></span> RETOUR
											</button>
										</div>
				<?php if(isset($etat_intervention_possible) && sizeof($etat_intervention_possible)>0) {?>				
								<div class="col-md-4">
											<select class="form-control" id="changer_etat_intervention"
												name="changer_etat_intervention">												
									<?php
					$tr = "<option value=''>Modifier etat</option>";
					foreach ( $etat_intervention_possible as $key => $value ) {
						$tr .= "<option value='" . $value . "'>" . $value . "</option>";
					}
					echo $tr;
					?>			
							
											</select>
										</div>
				<?php } ?>				
							</div>


								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="fiche_famille">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">
										<strong>FICHE FAMILLE</strong>
									</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4 column"></div>
										<figure>
											<img
												src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png"
												alt="" class="img-circle img-responsive"
												style="width: 100px; height: 100px">
										</figure>
									</div>
									<h5>
										<strong>CIVILITE :</strong>  <?php echo $infos_famille['civilite']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-user"></span> NOM :</strong>
									 <?php echo $infos_famille['identite_famille']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-qrcode"></span> Code
											client :</strong>  <?php echo $infos_famille['code_client']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-tree-conifer"></span>
											Adresse :</strong>
									 <?php echo $infos_famille['adresse']; ?></h5>
									<h5>
										<strong>Code postale :</strong>  <?php echo $infos_famille['code_postale']; ?></h5>
									<h5>
										<strong>Ville :</strong> <?php echo $infos_famille['ville']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-phone-alt"></span>
											Tél Fixe:</strong>
									 <?php echo $infos_famille['tel_fixe']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-earphone"></span>
											Tél Portable :</strong>
									 <?php echo $infos_famille['tel_portable']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-earphone"></span>
											Tél Travail :</strong>
									 <?php echo $infos_famille['tel_travail']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-envelope"></span>
											Email : </strong>
									<?php echo $infos_famille['email']; ?></h5>
								</div>
							</div>
						</div>
						<div class="tab-pane fade " id="fiche_eleve">
							<ul class="nav nav-pills nav-justified"
								style="margin-bottom: 15px;">
								<li class="active"><a href="#infos_eleve" data-toggle="tab">Fiche
										&eacute;l&eacute;ve</a></li>
								<li><a href="#Disponibilite_eleve" data-toggle="tab">Disponibilite
										&eacute;l&eacute;ve</a></li>

							</ul>
							<div id="myTabContent1" class="tab-content">
								<div class="tab-pane fade active in" id="infos_eleve">
									<div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Coordonn&eacute;es
													&eacute;l&eacute;ve</h3>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-hover ">
													<tr>
														<td>Nom :</td>
														<td><strong><?php echo $infos_eleve['nom_eleve']; ?> </strong></td>
													</tr>
													<tr>
														<td>Pr&eacute;nom :</td>
														<td><strong><?php echo $infos_eleve['prenom_eleve']; ?></strong></td>
													</tr>
													<tr>
														<td>Telephone Portable :</td>
														<td><strong><?php echo $infos_eleve['tel_eleve']; ?></strong></td>
													</tr>
													<tr>
														<td>Niveau</td>
														<td><strong><?php echo $infos_eleve['niveau_peda']; ?></strong></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="Disponibilite_eleve">
									<div class="col-lg-12">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Disponibilit&eacute;
													&eacute;l&eacute;ve</h3>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-hover ">
													<tbody>
														<tr id='css_text'>
															<th>Horaire</th>
															<th>lun.</th>
															<th>mar.</th>
															<th>mer.</th>
															<th>jeu.</th>
															<th>ven.</th>
															<th>sam.</th>
															<th>dim.</th>
														</tr>
                                                    <?php foreach ($infos_eleve['diponibilite'] as $key => $infos_eleve) { ?>                       
                                                        <tr
															align="center">
															<TD><?php echo $key; ?></TD>
                                                            <?php
																																																					foreach ( $infos_eleve as $key1 => $infos_eleve1 ) {
																																																						if ($infos_eleve [$key1] == '1') {
																																																							?>
                                                                    <TD><img
																src="./../img/ok.gif" /></TD>
                                                                <?php } else { ?>
                                                                    <TD><img
																src="./../img/non.gif" /></TD> 
                                                                <?php } ?>   

                                                            <?php } ?>                                                      
                                                        </tr>
                                                    <?php } ?>               

                                                </tbody>
												</table>
											</div>
										</div>
									</div>

								</div>

							</div>

						</div>
			<?php if($_GET['mod_interv']!='annule_sans_interv'){?>				
						<div class="tab-pane fade" id="fiche_intervenant">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">
										<strong>FICHE INTERVENANT</strong>
									</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4 column"></div>
										<figure>
											<img
												src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png"
												alt="" class="img-circle img-responsive"
												style="width: 100px; height: 100px">
										</figure>
									</div>
									<h5>
										<strong>CIVILITE :</strong>  <?php echo $infos_intervenant['civilite']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-user"></span> NOM :</strong> <?php echo $infos_intervenant['identite_intervenant']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-qrcode"></span> Code
											intervenant :</strong>  <?php echo $infos_intervenant['code_intervenant']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-tree-conifer"></span>
											Adresse :</strong> <?php echo $infos_intervenant['adresse']; ?></h5>
									<h5>
										<strong>Code postale :</strong>  <?php echo $infos_intervenant['code_postale']; ?></h5>
									<h5>
										<strong>Ville :</strong> <?php echo $infos_intervenant['ville']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-phone-alt"></span>
											Tél Fixe:</strong> <?php echo $infos_intervenant['tel_fixe']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-earphone"></span>
											Tél Portable :</strong> <?php echo $infos_intervenant['tel_portable']; ?></h5>
									<h5>
										<strong><span class="glyphicon glyphicon-envelope"></span>
											Email :</strong>		 <?php echo $infos_intervenant['email']; ?></h5>
								</div>
							</div>
						</div>
				<?php } ?>		
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
