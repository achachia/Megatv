<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">LISTES DES CARTOONS</div>
            <div class="panel-body">

                <table  id="liste_films" name="liste_films" class="table table-striped table-hover">
                    <thead>
                        <tr>                
                            <th>NOM</th>
                            <th>DATE UPLOAD</th>
                            <th>SECTION</th>              
                            <th class="sort-alpha">SOURCE</th>
                            <th class="sort-alpha">COMPTE</th>
                            <th class="sort-numeric">TAILLE</th>
                            <th class="sort-alpha">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($liste_fichiers)) {
                            $tr = '';
                            foreach ($liste_fichiers as $value) {
                                $tr .= '<tr>';                           
                                $tr .= '<td>' . $value ['titre_originale'] . '</td>';
                                $tr .= '<td>' . $value ['date_upload'] . '</td>';
                                $tr .= '<td>' . $value ['nom_section'] . '</td>';
                                          $tr .= '<td>' . $value ['nom_source'] . '</td>';
                                $tr .= '<td>' . $value ['nom_compte'] . '</td>';
                                $tr .= '<td>' . $value ['taille_fichier'] . '</td>';                      
                                $tr .= '<td>';
                                $tr .= '<div class="btn-group">';
                                $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                $tr .= '<ul class="dropdown-menu">';                                      
                                        $tr .= '<li><a href="index.php?module=Films&action=add_facture&mode=modifier&N_facture=' . $value ['id_fichier'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la fiche</button></a></li>';
                                        $tr .= '<li><a href="#"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Generer le fichier nfo</button></a></li>';
                                        $tr .= '<li><a href="#"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Generer le fichier strm</button></a></li>';                                     
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
                                <input type="text" name="filter_browser" placeholder="Filter NOM" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_platform" placeholder="Filter DATE UPLOAD" class="form-control input-sm datatable_input_col_search">
                            </th>
                            <th>
                                <input type="text" name="filter_engine_version" placeholder="Filter SECTION" class="form-control input-sm datatable_input_col_search">
                            </th>
                               <th>
                                <input type="text" name="filter_engine_version" placeholder="Filter SECTION" class="form-control input-sm datatable_input_col_search">
                            </th>
                               <th>
                                <input type="text" name="filter_engine_version" placeholder="Filter SECTION" class="form-control input-sm datatable_input_col_search">
                            </th>
                      


                        </tr>               
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>

