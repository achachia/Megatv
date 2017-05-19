<div class="row">
    <div class="col-md-12 column">
        <div class="col-md-3 column">
            <?php include dirname(__FILE__) . side_bare_gauche; ?>
        </div>
        <div class="col-md-9 column">		
            <div class='row'>
                <div class="page-header">
                    <h3>REGISTRE RECETTES</h3>
                </div>
                        
                <table>
                    <tr>
                        <td colspan="2"><h3>Rechercher par :</h3></td> 
                    </tr>
                    <tr>
                        <td colspan="4"><hr></td> 
                    </tr>
                    <tr>
                        <td width="40%">
                            <label for="choix_periode" class="control-label">La periode :</label>
                        </td>
                        <td>
                            <select name="month" id="month" class="form-control" >
                                <option value="">Choix periode</option>
                                <option value="tomonth">Mois en cours : <?php echo $array_mois[$tomonth]; ?></option>
                                <option value="last">Mois dernier : <?php echo $array_mois[$lastmonth]; ?></option>                              
                                <option value="month3">3 derniers mois</option>
                                <option value="month6">6 derniers mois</option>
                                <option value="toyear">Année en cours : <?php echo $toyear; ?></option>
                                <option value="lastyear">Année dernière : <?php echo $toyear - 1; ?> </option>
                                <option value="perso">Période personnalisée</option>
                            </select>  
                        </td>
                    </tr>
                    <tr id="hr" style="display: none;">
                        <td colspan="4"><hr></td> 
                    </tr>
                    <tr id="choix_periode" style="display: none;">
                        <td>
                            <label for="from"> Du :</label>
                        </td>
                        <td>
                            <input type="text" id="from" name="from"> 
                        </td>
                        <td>
                            <label for="to">au :</label>
                        </td>
                        <td>
                            <input type="text" id="to" name="to">
                        </td>                               
                    </tr>
                </table>
                <hr>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Famille</th>
                            <th>Nbre-H-restant</th>
                        </tr>
                    </thead>
                    <tbody id="rapport_client">
                        <?php if (isset($_GET['code_client'])) { ?>  
                            <tr>                      
                                <td><?php echo $rapport_client['identite_client']; ?></td>
                                <td><?php echo $rapport_client['Nbre_H_restant']; ?></td>  
                            </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <hr>
                <table id="rapport_H_factures" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date-Facture</th>
                            <th>N-Facture</th>
                            <th>Nbre-H-vendues</th>
                            <th>Nbre-H-effectues</th>
                            <th>Nbre-H-restant</th>
                        </tr>
                    </thead>
                    <tbody id="rapport_heures">
                        <?php
                        if (isset($_GET['code_client'])) {
                            $tr = '';
                            if (isset($rapport_heures)) {
                                foreach ($rapport_heures as $value) {
                                    $tr .= '<tr>';
                                    $tr .= '<td>' . $value ['date_facture'] . '</td><td>' . $value ['N_facture'] . '</td><td>' . $value ['nbre_h_vendue'] . '</td><td>' . $value ['nbre_h_effec'] . '</td><td>' . $value ['nbre_h_restant'] . '</td>';
                                    $tr .= '</tr>';
                                }
                                echo $tr;
                            }
                        }
                        ?> 

                    </tbody>
                </table>
            </div>		
        </div>
    </div>





