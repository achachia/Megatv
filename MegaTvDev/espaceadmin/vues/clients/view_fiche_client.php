<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">La fiche descriptive de client</div>
					<div class="panel-body">
						<div id="message"></div>
						<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							<li class="active"><a href="#etat_civil" data-toggle="tab">ETAT	CIVIL</a></li>
							<li><a href="#adresse" data-toggle="tab">ADRESSE</a></li>
							<li><a href="#contact" data-toggle="tab">CONTACT</a></li>
							<li><a href="#infos_interne" data-toggle="tab">INFOS INTERNE</a></li>							
							<li><a href="#parainnage" data-toggle="tab">PARAINNAGE</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade active in" id="etat_civil">
								<table class="table table-striped table-hover ">
									<tbody>									
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
											<td><?php echo $infos_client['code_client'] ?></td>
										</tr>
										<tr>
											<td><strong>NOM :</strong></td>
											<td><?php echo $infos_client['nom_client'] ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><strong>PRENOM :</strong></td>
											<td><?php echo $infos_client['prenom_client'] ?></td>
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
											<td><strong>VILLE :</strong></td>
											<td><?php echo $infos_client['ville'] ?></td>
										</tr>
									
										<tr>
											<td><strong>CODE POSTALE :</strong></td>
											<td><?php echo $infos_client['code_postale'] ?></td>
											<td><strong>Pays :</strong></td>
											<td><?php echo $infos_client['pays'] ?></td>
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
											<td><strong>TEL PORTABLE :</strong></td>
											<td><?php echo $infos_client['tel_portable'] ?></td>
										</tr>								
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="infos_interne">
								<table class="table table-striped table-hover ">
									<tbody>
										<tr>
											<td><strong>Agent commercial attache :</strong></td>
											<td><?php echo $infos_client['agent_attache'] ?></td>
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
	
	</div>
</div>
