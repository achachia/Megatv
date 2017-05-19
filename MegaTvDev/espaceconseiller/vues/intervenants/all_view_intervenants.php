<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">Liste les intervenants</div>
            <div class="panel-body">
              				<table id="liste_intervenants" class="table table-striped table-bordered" cellspacing="0"
					width="100%">
					<thead>
						<tr>
							<th>Code intervenant</th>
							<th>Date adhesion</th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Consulter/Modifier</th>
						</tr>
					</thead>
					<tbody>
                            <?php
                                if (isset ( $liste_intervenants )) {
                                        $tr = '';
                                        foreach ( $liste_intervenants as $value ) {                                            

                                                 $tr .= '<tr>';
                                                         $tr .= '<td>' . $value ['code_intervenant'] . '</td>';
                                                         $tr .= '<td>' . $value ['Date_adhesion'] . '</td>';
                                                         $tr .= '<td>' . $value ['nom_intervenant'] . '</td>';
                                                         $tr .= '<td>' . $value ['prenom_intervenant'] . '</td>';
                                                         $tr .= '<td>';
                                                            $tr .= '<div class="btn-group">';
                                                                $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                                                $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                                                $tr .= '<ul class="dropdown-menu">';
                                                                    $tr .= '<li><a href="index.php?module=intervenants&action=view_fiche_intervenant&code_intervenant=' . $value ['code_intervenant'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter la fiche</button></a></li>';
                                                                    $tr .= '<li><a href="index.php?module=intervenants&action=edit_fiche_intervenant&code_intervenant=' . $value ['code_intervenant'] . '"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la fiche</button></a></li>';
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
                            <th>
                                <input type="text" name="filter_rendering_engine" placeholder="Filtre Code" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_rendering_engine" placeholder="Filtre Date" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_browser" placeholder="Filtre Nom" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_platform" placeholder="Filtre Prenom" class="form-control input-sm datatable_input_col_search">
                            </th>                                                  
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</div>




