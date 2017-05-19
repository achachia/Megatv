<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Mes Bilans de 1er cours</h4></div>
            <div class="panel-body">
                <?php if (isset($mes_bilan_prem_cours) && sizeof($mes_bilan_prem_cours) > 0) { ?>
                    <table id="mes_bilan_prem_cours" class="table table-striped table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Eléve</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tr = '';
                            foreach ($mes_bilan_prem_cours as $value) {
                                $tr .= '<tr>';
                                $tr .= '<td>' . $value ['date_bilan'] . '</td><td>' . $value ['identite_eleve'] . '</td><td><button type="button" class="btn-primary" value="cons_mes_bilan_prem_cours"  id="' . $value ['id_bilan'] . '"><span class="glyphicon glyphicon-eye-open"></span>Consulter</button><a href="index.php?module=compte_rendu&action=edit_bilan_prem_cours&id_bilan=' . $value ['id_bilan'] . '"><button type="button" class="btn-success" value="mod_mes_bilan_premier_cours"  id="' . $value ['id_bilan'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</button></a></td>';
                                $tr .= '</tr>';
                            }
                            echo $tr;
                            ?>
                        </tbody>
                    </table>
                <?php } else { ?> 
                    <h4>Aucun bilan trouvé.</h4>       
                <?php } ?>    
            </div>
        </div>
    </div>

</div>


