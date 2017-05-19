<div class="row">
    <div class="col-lg-11">
        <div class="panel panel-default">
            <div class="panel-heading">Liste les beneficiaires</div>
            <div class="panel-body">
                               <table id="liste_beneficiaires" class="table table-striped table-bordered" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>Code-eleve</th>
                            <th>Nom-eleve</th>
                            <th>Date-inscription</th>
                            <th>Nom-famille</th>
                            <th>Code-famille</th>
                            <th>Consulter/Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($liste_beneficiaires)) {

                            $tr = '';
                            foreach ($liste_beneficiaires as $value) {
                                $tr .= '<tr>';
                                $tr .= '<td>' . $value ['code_beneficiaire'] . '</td>';
                                $tr .='<td>' . $value ['nom_beneficiaire'] . '</td>';
                                $tr .='<td>' . $value ['date_inscription'] . '</td>';
                                $tr .='<td>' . $value ['nom_famille'] . '</td>';
                                $tr .='<td>' . $value ['code_famille'] . '</td>';
                              	$tr .= '<td>';
                                $tr .= '<div class="btn-group">';
                                $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                $tr .= '<ul class="dropdown-menu">';
                                $tr .= '<li><a href="index.php?module=beneficiaires&action=view_fiche_beneficiaire&code_beneficiaire=' . $value ['code_beneficiaire'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter la fiche</button></a></li>';
                                $tr .= '<li><a href="index.php?module=beneficiaires&action=edit_fiche_beneficiaire&code_beneficiaire=' . $value ['code_beneficiaire'] . '"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la fiche</button></a></li>';
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
                                <input type="text" name="filter_browser" placeholder="Filtre Nom" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_platform" placeholder="Filtre Date" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_browser" placeholder="Filtre Nom" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_rendering_engine" placeholder="Filtre Code" class="form-control input-sm datatable_input_col_search">
                            </th>                             
                        </tr>
                    </tfoot> 
                </table> 
                
            </div>
        </div>
    </div>
</div>
