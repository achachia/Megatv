
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Liste les factures</div>
			<div class="panel-body">
				<div class="row">					
						<div class="btn-group btn-group-justified" role="group"
							aria-label="...">
							<div class="btn-group" role="group">
								<a href="index.php?module=facturation&action=add_facture">
									<button type="button" class="btn btn-primary"	>
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										Une nouvelle facture
									</button>
								</a>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-primary"
									id="all_imprim_facture">
									<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
									Imprimer les factures selctionnées
								</button>
							</div>
						</div>				
				</div>
				<hr>
				<div class="row">
					<table id="liste_factures"
						class="table table-striped table-bordered" cellspacing="0"
						width="100%">
						<thead>
							<tr>
                                                               <th>Date facture</th>
								<th>N-facture</th>								
								<th>Client</th>
								<th>Etat-facture</th>
								<th>Total-facture</th>
								<th>Action</th>
								<th><span>Cocher tout</span> <input type='checkbox'
									id='cocheTout' /></th>
							</tr>
						</thead>
						<tbody>

                            <?php
                                            if (isset ( $liste_factures )) {

                                                    $tr = '';
                                                    foreach ( $liste_factures as $value ) {
                                                            $tr .= '<tr>';
                                                             $tr .= '<td>' . $value ['date_facture'] . '</td>';
                                                            $tr .= '<td>' . $value ['N_facture'] . '</td>';                                                           
                                                            $tr .= '<td>' . $value ['identite_famille'] . '</td>';
                                                            $tr .= '<td>' . $value ['etat_facture'] . '</td>';
                                                            $tr .= '<td>' . $value ['total_paye'] . '</td>';
                                                            $tr .= '<td>';
                                                            $tr .= '<div class="btn-group">';
                                                            $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                                            $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                                            $tr .= '<ul class="dropdown-menu">';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=view_fiche_facture&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter la facture</button></a></li>';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=add_facture&mode=modifier&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la facture</button></a></li>';
                                                            $tr .= '<li><a href="./../librairie/Html2pdf/generer_pdf/facture.php?N_facture=' . $value ['N_facture'] . '&code_famille=' . $value ['code_famille'] . '"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Sauvegarder la facture</button></a></li>';
                                                            $tr .= '<li><a href="./../librairie/Html2pdf/generer_pdf/liste_coupon.php?N_facture=' . $value ['N_facture'] . '&code_famille=' . $value ['code_famille'] . '"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Sauvegarder les coupons</button></a></li>';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=add_facture&mode=dupliquer&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Dupliquer la facture</button></a></li>';
                                                            $tr .= '</ul>';
                                                            $tr .= '</div>';
                                                            $tr .= '</td>';
                                                            $tr .= '<td><input type="checkbox" id="' . $value ['N_facture'] . '"  name="' . $value ['N_facture'] . '"  value="' . $value ['code_famille'] . '_' . $value ['N_facture'] . '" /></td>';
                                                            $tr .= '</tr>';
                                                    }
                                                    echo $tr;
                                            }
					?>																								
                        </tbody>
						<tfoot>
							<tr>
								<th><input type="text" name="filter_rendering_engine"
									placeholder="Filtre Numero"
									class="form-control input-sm datatable_input_col_search"></th>
								<th><input type="text" name="filter_browser"
									placeholder="Filtre Date"
									class="form-control input-sm datatable_input_col_search"></th>
								<th><input type="text" name="filter_platform"
									placeholder="Filtre Nom-Prenom"
									class="form-control input-sm datatable_input_col_search"></th>
								<th><input type="text" name="filter_engine_version"
									placeholder="Filtre Etat"
									class="form-control input-sm datatable_input_col_search"></th>
								<th><input type="text" name="filter_engine_version"
									placeholder="Filtre Total"
									class="form-control input-sm datatable_input_col_search"></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



