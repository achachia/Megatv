<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><strong> LA LISTE DES PRESTATIONS 	[<?php echo $identite_eleve; ?> ]</strong></h4></div>
            <div class="panel-body">
                <?php if (isset($bilan_prestation_eleve) && sizeof($bilan_prestation_eleve) > 0) { ?> 

                    <table id="liste_prestation_eleve" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Date Cours</th>
                                <th>Code coupon</th>				
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tr = '';
                            foreach ($bilan_prestation_eleve as $value) {
                                $tr .= '<tr>';
                                $tr .= '<td>' . $value ['date_cours_effectute'] . '</td>';
                                $tr .= '<td>' . $value ['E_code'] . '</td>';
                                $tr .= '</tr>';
                            }
                            echo $tr;
                            ?>
                        </tbody>
                    </table>    

    <?php } else {     echo "<h4>aucune prestation trouv&eacute;.</h4>"; } ?>
            </div>
        </div>
    </div>

</div>
