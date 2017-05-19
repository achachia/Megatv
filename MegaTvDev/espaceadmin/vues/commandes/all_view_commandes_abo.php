
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">LISTES DES COMMANDES IPTV</div>
			<div class="panel-body">
				<div class="row">					
						<div class="btn-group btn-group-justified" role="group"	aria-label="...">
							<div class="btn-group" role="group">
								<a href="index.php?module=facturation&action=add_facture">
									<button type="button" class="btn btn-primary"	>
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										Une nouvelle commande iptv
									</button>
								</a>
							</div>						
						</div>				
				</div>
				<hr>
				<div class="row">
					<table id="liste_commandes_abo"
						class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
                                                               <th>Date commande</th>
								<th>Code-commande</th>								
								<th>Fournisseur</th>
                                                                <th>Quantite</th>
								<th>Type-abo</th>
								<th>Action</th>								
							</tr>
						</thead>
						<tbody>

                            <?php
                                            if (isset ( $liste_commandes )) {

                                                    $tr = '';
                                                    foreach ( $liste_commandes as $value ) {
                                                            $tr .= '<tr>';
                                                             $tr .= '<td>' . $value ['date_commande'] . '</td>';
                                                            $tr .= '<td>' . $value ['code_commande'] . '</td>';                                                           
                                                            $tr .= '<td>' . $value ['fournisseur'] . '</td>'; 
                                                            $tr .= '<td>' . $value ['quantite'] . '</td>';  
                                                            $tr .= '<td>' . $value ['type_abo'] . '</td>';
                                                            $tr .= '<td>';
                                                            $tr .= '<div class="btn-group">';
                                                            $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                                            $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                                            $tr .= '<ul class="dropdown-menu">';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=view_fiche_facture&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter la commande</button></a></li>';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=add_facture&mode=modifier&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la commande</button></a></li>';
                                                            $tr .= '<li><a href="index.php?module=facturation&action=add_facture&mode=dupliquer&N_facture=' . $value ['N_facture'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Dupliquer la commande</button></a></li>';
                                                            $tr .= '</ul>';
                                                            $tr .= '</div>';
                                                            $tr .= '</td>';                                                          
                                                            $tr .= '</tr>';
                                                    }
                                                    echo $tr;
                                            }
					?>																								
                        </tbody>
						<tfoot>
							<tr>
								
								<th><input type="text" name="filter_browser"
									placeholder="Filtre Date"
									class="form-control input-sm datatable_input_col_search"></th>
                                                                <th><input type="text" name="filter_rendering_engine"
									placeholder="Filtre Code"
									class="form-control input-sm datatable_input_col_search"></th>
								<th><input type="text" name="filter_platform"
									placeholder="Filtre Fournisseur"
									class="form-control input-sm datatable_input_col_search"></th>							
								<th><input type="text" name="filter_engine_version"
									placeholder="Filtre Type-abo"
									class="form-control input-sm datatable_input_col_search"></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



