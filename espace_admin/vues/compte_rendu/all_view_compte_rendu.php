<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Mes comptes-rendus</h4></div>
            <div class="panel-body">
               <?php if (isset($mes_compte_rendu) && sizeof($mes_compte_rendu) > 0) { ?>   
                <table id="mes_compte_rendu" class="table table-striped table-bordered" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Eléve</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php              
                            $tr = '';
                            foreach ($mes_compte_rendu as $value) {
                                $tr .= '<tr>';
                                $tr .= '<td>' . $value ['date_cours'] . '</td><td>' . $value ['heure_cours'] . '</td><td>' . $value ['eleve'] . '</td><td><button type="button" class="btn-primary" value="cons_mes_compte_rendu"  id="' . $value ['id_compte_rendu'] . '"><span class="glyphicon glyphicon-eye-open"></span>Consulter</button><a href="index.php?module=compte_rendu&action=edit_compte_rendu&id_compte_rendu=' . $value ['id_compte_rendu'] . '"><button type="button" class="btn-success" value="mod_mes_compte_rendu"  id="' . $value ['id_compte_rendu'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</button></a></td>';
                                $tr .= '</tr>';
                            }
                            echo $tr;                  
                        ?>
                    </tbody>
                </table>
                <?php } else { ?> 
                    <h4>Aucun compte-rendu trouvé.</h4>       
                <?php } ?> 
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Les compte-rendus des autres formateurs</h4></div>
            <div class="panel-body">
           <?php if (isset($autres_compte_rendu) && sizeof($autres_compte_rendu) > 0) { ?>   
                <table id="autres_compte_rendu" class="table table-striped table-bordered" cellspacing="0"
                       width="100%" >
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Eleve</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tr = '';                     
                        foreach ($autres_compte_rendu as $value) {
                            $tr .= '<tr><td>' . $value ['date_cours'] . '</td><td>' . $value ['heure_cours'] . '</td><td>' . $value ['eleve'] . '</td><td><button type="button" class="btn-primary" value="cons_autre_compte_rendu"  id="' . $value ['id_compte_rendu'] . '"><span class="glyphicon glyphicon-eye-open"></span>Consulter</button></td></tr>';
                         }
                        echo $tr;                       
                        ?>
                    </tbody>
                </table>
             <?php } else { ?> 
                    <h4>Aucun compte-rendu trouvé.</h4>       
             <?php } ?>  
            </div>
        </div>
    </div>
</div>




