<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">La fiche descriptive de client</div>
					<div class="panel-body">
						<div id="message"></div>
						<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							<li class="active"><a href="#etat_civil" data-toggle="tab">ETAT
									CIVIL</a></li>
							<li><a href="#adresse" data-toggle="tab">ADRESSE</a></li>
							<li><a href="#contact" data-toggle="tab">CONTACT</a></li>
							<li><a href="#infos_interne" data-toggle="tab">INFOS INTERNE</a></li>
							<li><a href="#infos_intervenant" data-toggle="tab">INFOS
									INTERVENANTS</a></li>
							<li><a href="#parainnage" data-toggle="tab">PARAINNAGE</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade active in" id="etat_civil">
								<table class="table table-striped table-hover ">
									<tbody>
										<tr>
											<td><strong>STATUT :</strong></td>
											<td><?php echo $infos_client['statut'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>DATE INSCRIPTION :</strong></td>
											<td><?php echo $infos_client['date_adhesion'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>CIVILITE :</strong></td>
											<td><?php echo $infos_client['civilite'] ?></td>
											<td><strong>CODE CLIENT :</strong></td>
											<td><?php echo $infos_client['code_famille'] ?></td>
										</tr>
										<tr>
											<td><strong>NOM :</strong></td>
											<td><?php echo $infos_client['nom_famille'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>PRENOM :</strong></td>
											<td><?php echo $infos_client['prenom_famille'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>

									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="adresse">
								<table class="table table-striped table-hover ">
									<tbody>

										<tr>
											<td><strong>ADRESSE :</strong></td>
											<td><?php echo $infos_client['adresse'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>ADRESSE SUITE :</strong></td>
											<td><?php echo $infos_client['adresse_suite'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>CODE POSTALE :</strong></td>
											<td><?php echo $infos_client['code_postale'] ?></td>
											<td><strong>VILLE :</strong></td>
											<td><?php echo $infos_client['ville'] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="contact">
								<table class="table table-striped table-hover ">
									<tbody>

										<tr>
											<td><strong>EMAIL :</strong></td>
											<td><?php echo $infos_client['email'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>SITE WEB :</strong></td>
											<td><?php echo $infos_client['site_web'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>TEL MAISON :</strong></td>
											<td><?php echo $infos_client['tel_maison'] ?></td>
											<td><strong>TEL PORTABLE :</strong></td>
											<td><?php echo $infos_client['tel_portable'] ?></td>
										</tr>
										<tr>
											<td><strong>FAX :</strong></td>
											<td><?php echo $infos_client['fax'] ?></td>
											<td><strong>TEL TRAVAIL :</strong></td>
											<td><?php echo $infos_client['tel_travail'] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="infos_interne">
								<table class="table table-striped table-hover ">
									<tbody>
										<tr>
											<td><strong>CONSEILLER ATTACHE :</strong></td>
											<td><?php echo $infos_client['conseiller_attache'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>INFOS INTERNE :</strong></td>
											<td><?php echo $infos_client['infos_interne'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="infos_intervenant">
								<table class="table table-striped table-hover ">
									<tbody>
										<tr>
											<td><strong>INFOS INTERVENANTS :</strong></td>
											<td><?php echo $infos_client['infos_intervenants'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="parainnage">
								<table class="table table-striped table-hover ">
									<tbody>
										<tr>
											<td><strong>LE PARRAIN :</strong></td>
											<td><?php echo $infos_client['identite_parrain'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<button type="button" class="btn-primary" id='send_nv_email'
							value='<?php echo $_GET['code_client']; ?>'>
							<span class="glyphicon glyphicon-send"></span> Envoyer un nouveau
							mot de passe
						</button>
					</div>
				</div>

			</div>
			<!-- ------------------------------- -->
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">La liste des beneficiaires</div>
					<div class="panel-body">
						<table id="liste_benef" class="table table-striped table-bordered"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Date d'adh&eacute;sion</th>
									<th>Nom.Pr&eacute;nom</th>
									<th>Consulter/Modifier</th>
								</tr>
							</thead>
							<tbody>
                        <?php
																								if (isset ( $liste_benef )) {
																									
																									$tr = '';
																									foreach ( $liste_benef as $value ) {
																										$tr .= '<tr>';
																										$tr .= '<td>' . $value ['date_adhesion'] . '</td><td>' . $value ['identite_benef'] . '</td><td><a href="index.php?module=beneficiaires&action=view_fiche_beneficiaire&code_beneficiaire=' . $value ['code_benef'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter</button></a><a href="index.php?module=beneficiaires&action=edit_fiche_beneficiaire&code_beneficiaire=' . $value ['code_benef'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier</button></a></td>';
																										$tr .= '</tr>';
																									}
																									echo $tr;
																								}
																								?>
                    </tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- ----------------------------------------- -->
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">La liste des filleules</div>
					<div class="panel-body">
						<table id="liste_filleules"
							class="table table-striped table-bordered" cellspacing="0"
							width="100%">
							<thead>
								<tr>
									<th>Date d'adh&eacute;sion</th>
									<th>Nom.Pr&eacute;nom</th>
									<th>Consulter/Modifier</th>
								</tr>
							</thead>
							<tbody>
                        <?php
																								if (isset ( $liste_filleules )) {
																									
																									$tr = '';
																									foreach ( $liste_filleules as $value ) {
																										$tr .= '<tr>';
																										$tr .= '<td>' . $value ['date_adhesion'] . '</td><td>' . $value ['nom_filleule'] . '.' . $value ['prenom_filleule'] . '</td><td><a href="index.php?module=filleules&action=view_fiche_filleule&id_filleule=' . $value ['id_filleule'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter</button></a><a href="index.php?module=filleules&action=edit_fiche_filleule&id_benef=' . $value ['id_filleule'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier</button></a></td>';
																										$tr .= '</tr>';
																									}
																									echo $tr;
																								}
																								?>
                    </tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- -------------------------------- -->
			<div class="row"  style="text-align: center">
				<button type="button" class="btn btn-primary" id="retour">
					<span class="glyphicon glyphicon-backward"></span> RETOUR
				</button>
			</div>
		</div>
		<div class="col-md-3 column">
            <?php include dirname(__FILE__) .'/side_bare_clients.php'; ?>
        </div>
	</div>
</div>
