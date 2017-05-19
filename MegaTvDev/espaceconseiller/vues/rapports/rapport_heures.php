<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-3 column">
            <?php include dirname(__FILE__) . side_bare_gauche; ?>
        </div>
		<div class="col-md-9 column">
			<div class='row'>
				<div class="page-header">
					<h3>Gestion-Heures</h3>
				</div>
				<table>
					<tr>
						<td colspan="2"><h3>Rechercher par :</h3></td>
					</tr>
					<tr>
						<td colspan="4"><hr></td>
					</tr>
					<tr>
						<td style="width: 15%; text-align: center"><label
							for="choix_famille" class="control-label">La famille :</label></td>
						<td style="text-align: center"><select class="choix_famille"
							style="width: 250px;" data-placeholder="Selectionnez une famille"
							id="choix_famille" name="choix_famille">
								<option value="">Choix famille</option>
                                <?php
																																foreach ( $liste_famille as $key => $value ) {
																																	$ligne = "<option  value='" . $value ['code_famille'] . "'";
																																	if ($_GET ['code_client'] == $value ['code_famille']) {
																																		$ligne .= "selected";
																																	}
																																	$ligne .= ">" . $value ['identite_famille'] . "</option>";
																																	echo $ligne;
																																}
																																?>                                 
                            </select></td>
						<td style="width: 30%; text-align: center"><label
							for="choix_periode" class="control-label">La periode :</label></td>
						<td><select name="month" id="month" class="form-control">
								<option value="">Choix periode</option>
								<option value="tomonth">Mois en cours : <?php echo $array_mois[$tomonth]; ?></option>
								<option value="last">Mois dernier : <?php echo $array_mois[$lastmonth]; ?></option>
								<option value="month3">3 derniers mois</option>
								<option value="month6">6 derniers mois</option>
								<option value="toyear">Année en cours : <?php echo $toyear; ?></option>
								<option value="lastyear">Année dernière : <?php echo $toyear - 1; ?> </option>
								<option value="perso">Période personnalisée</option>
						</select></td>
					</tr>
					<tr id="hr" style="display: none;">
						<td colspan="4"><hr></td>
					</tr>
					<tr id="choix_periode" style="display: none;">
						<td><label for="from"> Du :</label></td>
						<td><input type="text" id="from" name="from"></td>
						<td><label for="to">au :</label></td>
						<td><input type="text" id="to" name="to"></td>
					</tr>
				</table>

				<table class="table table-striped table-bordered" cellspacing="0"
					width="100%" id="rapport_client"
					<?php    if (!isset($_GET['code_client'])) {?>
					style="display: none" <?php  } ?>>
					<thead>
						<tr>
							<th>Famille</th>
							<th>Nbre-H-restant</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td id="identite_client"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['identite_client']; } ?></td>
							<td id="Nbre_H_restant"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['Nbre_H_restant']; } ?></td>
						</tr>
					</tbody>
				</table>
				<hr>
				<table id="rapport_H_factures"
					class="table table-striped table-bordered" cellspacing="0"
					width="100%">
					<thead>
						<tr>
							<th>Date-Facture</th>
							<th>N-Facture</th>
							<th>Nbre-H-vendues</th>
							<th>Nbre-H-effectues</th>
							<th>Nbre-H-restant</th>
						</tr>
					</thead>
					<tbody id="rapport_heures">
                        <?php
																								if (isset ( $rapport_heures )) {
																									$tr = '';
																									foreach ( $rapport_heures ['rapport_heures'] as $value ) {
																										$tr .= '<tr>';
																										$tr .= '<td>' . $value ['date_facture'] . '</td><td>' . $value ['N_facture'] . '</td><td>' . $value ['nbre_h_vendue'] . '</td><td>' . $value ['nbre_h_effec'] . '</td><td>' . $value ['nbre_h_restant'] . '</td>';
																										$tr .= '</tr>';
																									}
																									echo $tr;
																								}
																								?> 

                    </tbody>
				</table>
				<hr>
				<table class="table table-striped table-bordered" cellspacing="0"
					width="100%">
					<caption>
						<h2>Statistiques</h2>
					</caption>
					<tbody id="rapport_heures">
						<tr>
							<td>Total Nbre-H-vendues</td>
							<td><?php echo $rapport_heures['nbre_h_vendue']; ?></td>
						</tr>
						<tr>
							<td>Total Nbre-H-effectues</td>
							<td><?php echo $rapport_heures['nbre_h_effec']; ?></td>
						</tr>
						<tr>
							<td>Total Nbre-H-restant</td>
							<td><?php echo $rapport_heures['nbre_h_restant']; ?></td>
						</tr>
					</tbody>
				</table>
				<hr>
				<table class="table table-striped table-bordered" cellspacing="0"
					width="100%">
					<caption>
						<h2>Statistiques en detail</h2>
					</caption>
					<tbody id="rapport_etat_heures">
						<tr>
							<td>Total Nbre-H-valide[facture valide]</td>
							<td><?php echo $rapport_heures['nbre_h_restant_valide']; ?></td>
						</tr>
						<tr>
							<td>Total Nbre-H-attente[facture en attente]</td>
							<td><?php echo $rapport_heures['nbre_h_restant_attente']; ?></td>
						</tr>
						<tr>
							<td>Total Nbre-H-annule[facture annule]</td>
							<td><?php echo $rapport_heures['nbre_h_restant_annule']; ?></td>
						</tr>
						<tr>
							<td>Total Nbre-H-non regle[facture non regle]</td>
							<td><?php echo $rapport_heures['nbre_h_restant_non_regle']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- ----------------------------------------------- -->
<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Date-Facture</th>
			<th>N-Facture</th>
			<th>Nbre-H-vendues</th>
			<th>Nbre-H-effectues</th>
			<th>Nbre-H-restant</th>
		</tr>
	</thead>

</table>

