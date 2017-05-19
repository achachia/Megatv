
<div class="row">
	<div class="col-md-12 column">	
		<div class="col-md-9 column">
		<div class="page-header">
					<a href="#" id="liste_interv_traitement_ss_intervenant" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions en traitement[sans intervenant].</h3></a>
				</div>
				<div id="effect1"   class='row' >
				<table id="liste_interventions_traitement_ss_intervenant" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><h4>Reference</h4></th>
							<th><h4>Date</h4></th>
							<th><h4>Famille</h4></th>
							<th><h4>Eleve</h4></th>						
							<th><h4>Delai-affect</h4></th>
							<th><h4>Consulter/Modifier</h4></th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_traitement_ss_intervenant )) {
																													$tr = '';
																													foreach ( $liste_interventions_traitement_ss_intervenant as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																													
																														$tr .= '<td>' . $value ['delai_attente'] .'</td>';
																														$tr .= '<td>';
																														$tr .= '<div class="btn-group">';
																														$tr .= '<button type="button" class="btn btn-success"> Action </button>';
																														$tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
																														$tr .= '<ul class="dropdown-menu">';
																														$tr .= '<li><a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '&mod_interv=annule_sans_interv"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a></a></li>';
																														$tr .= '<li><a href="index.php?module=interventions&action=edit_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '&mod_interv=annule_sans_interv"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a></a></li>';
																														$tr .= '</ul>';
																														$tr .= '</div>';
																														$tr .= '</td>';
																														$tr .= '</tr>';
																													}
																													echo $tr;
																												}
																												?>
                        </tbody>
				</table>
			</div>				
				<div class="page-header">
					<a href="#" id="liste_interv_traitement_avec_intervenant" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions en traitement[avec intervenant].</h3></a>
				</div>
				<div id="effect2"   class='row' >
				<table id="liste_interventions_traitement_avec_intervenant" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><h4>Reference</h4></th>
							<th><h4>Date</h4></th>
							<th><h4>Famille</h4></th>
							<th><h4>Eleve</h4></th>						
							<th><h4>Delai-affect</h4></th>
							<th><h4>Consulter/Modifier</h4></th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_traitement_avec_intervenant )) {
																													$tr = '';
																													foreach ( $liste_interventions_traitement_avec_intervenant as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																													
																														$tr .= '<td>' . $value ['delai_attente'] . '</td>';
																														$tr .= '<td>';
																														$tr .= '<div class="btn-group">';
																														$tr .= '<button type="button" class="btn btn-success"> Action </button>';
																														$tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
																														$tr .= '<ul class="dropdown-menu">';
																														$tr .= '<li><a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . ' "><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a></a></li>';
																														$tr .= '<li><a href="index.php?module=interventions&action=edit_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a></a></li>';
																														$tr .= '</ul>';
																														$tr .= '</div>';
																														$tr .= '</td>';
																														$tr .= '</tr>';
																													}
																													echo $tr;
																												}
																												?>
                        </tbody>
				</table>
			</div>			
				<div class="page-header">
					<a href="#" id="liste_interv_confirme" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions  confirme.</h3></a>
				</div>
				<div id="effect3"   class='row'>
				<table id="liste_interventions_confirme" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Reference</th>
							<th>Date intervention</th>
							<th>Famille</th>
							<th>Eleve</th>						
							<th>Consulter/Modifier</th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_confirme )) {
																													$tr = '';
																													foreach ( $liste_interventions_confirme as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																													
																														$tr .= '<td>';
																														$tr .= '<div class="btn-group">';
																														$tr .= '<button type="button" class="btn btn-success"> Action </button>';
																														$tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
																														$tr .= '<ul class="dropdown-menu">';
																														$tr .= '<li><a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a></a></li>';
																														$tr .= '<li><a href="index.php?module=interventions&action=edit_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span> Modifier</button></a></a></li>';
																														$tr .= '</ul>';
																														$tr .= '</div>';
																														$tr .= '</td>';
																														$tr .= '</tr>';
																													}
																													echo $tr;
																												}
																												?>
                        </tbody>
				</table>
			</div>
			
				<div class="page-header">
					<a href="#" id="liste_interv_termine" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions termine.</h3></a>
				</div>
				<div id="effect4"   class='row'>
				<table id="liste_interventions_termine" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Reference</th>
							<th>Date intervention</th>
							<th>Famille</th>
							<th>Eleve</th>							
							<th>Consulter/Modifier</th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_termine )) {
																													$tr = '';
																													foreach ( $liste_interventions_termine as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																												
																														$tr .= '<td>';
																														$tr .= '<a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a>';
																														$tr .= '</td>';
																														$tr .= '</tr>';
																													}
																													echo $tr;
																												}
																												?>
                        </tbody>
				</table>
			</div>
		
				<div class="page-header">
					<a href="#" id="liste_interv_annule_sans_choix_intervenant" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions annule[ Sans choix intervenant ].</h3></a>
				</div>
				<div id="effect5"   class='row'>
				<table id="liste_interventions_annule_sans_choix_intervenant" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Reference</th>
							<th>Date intervention</th>
							<th>Famille</th>
							<th>Eleve</th>														
							<th>Consulter/Modifier</th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_annule_sans_choix_intervenant )) {
																													$tr = '';
																													foreach ( $liste_interventions_annule_sans_choix_intervenant as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																																																											
																														$tr .= '<td>';
																														$tr .= '<a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '&mod_interv=annule_sans_interv"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a>';
																														$tr .= '</td>';
																														$tr .= '</tr>';
																													}
																													echo $tr;
																												}
																												?>
                        </tbody>
				</table>
			</div>
					<div class="page-header">
					<a href="#" id="liste_interv_annule_avec_choix_intervenant" ><h3><span class="glyphicon glyphicon-th-list" ></span> Liste des interventions annule[ Avec choix intervenant ].</h3></a>
				</div>
				<div id="effect6"   class='row'>
				<table id="liste_interventions_annule_avec_choix_intervenant" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Reference</th>
							<th>Date intervention</th>
							<th>Famille</th>
							<th>Eleve</th>														
							<th>Consulter/Modifier</th>
						</tr>
					</thead>
					<tbody>
                            <?php
																												if (isset ( $liste_interventions_annule_avec_choix_intervenant )) {
																													$tr = '';
																													foreach ( $liste_interventions_annule_avec_choix_intervenant as $value ) {
																														$tr .= '<tr>';
																														$tr .= '<td>' . $value ['reference_intervention'] . '</td>';
																														$tr .= '<td>' . $value ['date_creation'] . '</td>';
																														$tr .= '<td>' . $value ['identite_famille'] . '</td>';
																														$tr .= '<td>' . $value ['identite_eleve'] . '</td>';																																																											
																														$tr .= '<td>';
																														$tr .= '<a href="index.php?module=interventions&action=view_fiche_intervention&reference_intervention=' . $value ['reference_intervention'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span> Consulter</button></a>';
																														$tr .= '</td>';
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
</div>





