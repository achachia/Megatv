<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">LISTES DES CHAINES TV</div>
            <div class="panel-body">
                <?php
//                var_dump($liste_fichiers);
//                       $sql = " SELECT FichierVod.id_fichier,FichierVod.titre_originale,DATE_FORMAT(FichierVod.date_upload,'%d-%m-%Y' ) AS date_upload ,CONCAT(FichierVod.taille_fichier,' Go') AS taille_fichier,
//            
//                 SectionVod.nom_section,CompteVod.user AS nom_compte,SourcesVod.nom_source
//
//                 FROM  FichierVod,SectionVod,CompteVod,SourcesVod,CategorieVod 
//
//                 WHERE  FichierVod.section_fichier=SectionVod.id_section
//
//                 AND    FichierVod.compte_source=CompteVod.id_compte
//
//                 AND    CompteVod.source=SourcesVod .id_source
//                 
//                 AND    SectionVod.id_categorie=CategorieVod .id_categorie
//                 
//                 AND    CategorieVod.id_categorie='".$id_categorie."' " ;
//                       
//                       echo $sql;
                
                
                
                ?>
                <table  id="liste_chaines_Tv" name="liste_chaines_Tv" class="table table-striped table-hover">
                    <thead>
                        <tr>                
                            <th>NOM CHAINE TV</th>
<!--                            <th>DATE UPLOAD</th>
                            <th>SECTION</th>              
                            <th class="sort-alpha">SOURCE</th>
                            <th class="sort-alpha">COMPTE</th>
                            <th class="sort-numeric">TAILLE</th>-->
                            <th class="sort-alpha">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($liste_chaines_Tv)) {
                            $tr = '';
                            foreach ($liste_chaines_Tv as $value) {
                                $tr .= '<tr>';                           
                                $tr .= '<td>' . $value ['nom_chaine'] . '</td>';
//                                $tr .= '<td>' . $value ['date_upload'] . '</td>';
//                                $tr .= '<td>' . $value ['nom_section'] . '</td>';
//                                          $tr .= '<td>' . $value ['nom_source'] . '</td>';
//                                $tr .= '<td>' . $value ['nom_compte'] . '</td>';
//                                $tr .= '<td>' . $value ['taille_fichier'] . '</td>';                      
                                $tr .= '<td>';
                                $tr .= '<div class="btn-group">';
                                $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                $tr .= '<ul class="dropdown-menu">';                                      
                                        $tr .= '<li><a href="index.php?module=Films&action=add_film&mode=modifier&id_film=' . $value ['id_chaine'] . '" target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Modifier la fiche</button></a></li>';
                                        $tr .= '<li><a href="#"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Generer le fichier nfo</button></a></li>';
                                        $tr .= '<li><a href="#"  target="_blank"><button type="button" class="btn-primary" ><span class="glyphicon glyphicon-pencil"></span>Generer le fichier strm</button></a></li>'; 
                                        $tr .= '<li><button type="button" class="btn-primary" name="delete_film"   id="' . $value ['id_chaine'] . '"><span class="glyphicon glyphicon-eye-open"></span>Supprimer</button></li>';
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
<!--                            <th>
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
                      -->


                        </tr>               
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>

