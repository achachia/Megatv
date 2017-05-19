							<div class="panel panel-info" >
								<div class="panel-heading">
									<h3 id="css_titre">
										<span class=" glyphicon glyphicon-pencil"></span> Ajouter un
										acompte a la facture
									</h3>
								</div>
								<div class="panel-body">
									<table id="table_acompte">
										<tr style='height: 60px;'>
											<td style="width: 50%">Date :</td>
											<td style="width: 50%"><input type="text"
												class="form-control" id="date_acompte" name="date_acompte"></td>
										</tr>
										<tr style='height: 60px;'>
											<td style="width: 50%">Mode de paiement :</td>
											<td style="width: 50%"><select class="form-control"
												id="mod_paiement_acompte" name="mod_paiement_acompte">
													<option value="">Choisir mode de paiement</option>
													<option value='Cheque'>Ch&eacute;que</option>
													<option value='Carte_bancaire'>Carte bancaire</option>
													<option value='Cheque_Emploi_Service_(CESU)'>Ch&eacute;que
														Emploi Service (CESU)</option>
													<option value='Prelevement'>Pr&eacute;lev&egrave;ment</option>
													<option value='virement'>Virement</option>
													<option value='Espece'>Espece</option>
													<option value='Autres'>Autres</option>
											</select></td>
										</tr>
										<tr style='height: 60px;'>
											<td style="width: 50%">Objet facture acompte :</td>
											<td style="width: 50%"><input type="text"
												class="form-control" id="objet_acompte" name="objet_acompte"></td>
										</tr>
										<tr style='height: 60px;'>
											<td style="width: 50%">Designation facture acompte :</td>
											<td style="width: 50%"><textarea type="text"
													class="form-control" id="designation_acompte"
													name="designation_acompte" rows="6"></textarea></td>
										</tr>
										<tr style='height: 60px;'>
											<td style="width: 50%">Valeur :</td>
											<td style="width: 50%"><input type="text"
												class="form-control" id="valeur_acompte"
												name="valeur_acompte" value='0'></td>
										</tr>
									</table>
								</div>

							</div>