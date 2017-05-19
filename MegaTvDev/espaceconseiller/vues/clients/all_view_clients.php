<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">Liste les clients</div>
            <div class="panel-body">
                <table id="liste_clients" class="table table-striped table-bordered" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>Date d'adh&eacute;sion</th>
                            <th>Nom</th>
                            <th>Pr&eacute;nom</th>
                            <th>Conseiller attach&eacute;</th>
                            <th>Consulter/Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($liste_clients)) {

                            $tr = '';
                            foreach ($liste_clients as $value) {
                                $tr .= '<tr>';
                                     $tr .= '<td>' . $value ['Date_adhesion'] . '</td>';
                                     $tr .= '<td>' . $value ['nom_famille'] . '</td>';
                                     $tr .= '<td>' . $value ['prenom_famille'] . '</td>';
                                     $tr .= '<td>' . $value ['conseiller_attache'] . '</td>';
                                     $tr .= '<td>';
                                        $tr .= '<div class="btn-group">';
                                            $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                            $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                            $tr .= '<ul class="dropdown-menu">';
                                                $tr .= '<li><a href="index.php?module=clients&action=view_fiche_client&code_client=' . $value ['code_client'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-eye-open"></span>Consulter la fiche</button></a></li>';
                                                $tr .= '<li><a href="index.php?module=clients&action=edit_fiche_client&code_client=' . $value ['code_client'] . '"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la fiche</button></a></li>';
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
                                <input type="text" name="filter_rendering_engine" placeholder="Filtre Date" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_browser" placeholder="Filtre Nom" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_platform" placeholder="Filtre Prenom" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_engine_version" placeholder="Filtre Conseiller" class="form-control input-sm datatable_input_col_search">
                            </th>                              
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</div>
