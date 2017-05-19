<div class="row">
    <div class="col-md-12 column">
        <div class="col-md-9 column">		
            <div class='row'>
                <div class="page-header">
                    <h3>Gestion-E-coupons </h3>
                </div>
                          
                <table>
                    <tr>
                        <td colspan="2"><h3>Rechercher par :</h3></td> 
                    </tr>
                    <tr>
                        <td colspan="4"><hr></td> 
                    </tr>
                    <tr>
                        <td>
                            <label for="choix_famille" class="control-label">La famille :</label>
                        </td>
                        <td  style="text-align:center">                          
                            <select class="choix_famille"
                                    style="width: 250px;"
                                    data-placeholder="Selectionnez une famille" id="choix_famille"
                                    name="choix_famille">
                                <option value="">Choix famille</option>
                                <?php
                                foreach ($liste_famille as $key => $value) {
                                    $ligne = "<option  value='" . $value ['code_famille'] . "'";
                                    if ($_GET['code_client'] == $value ['code_famille']) {
                                        $ligne .="selected";
                                    }
                                    $ligne .=">" . $value ['identite_famille'] . "</option>";
                                    echo $ligne;
                                }
                                ?>                                 
                            </select> 
                        </td>
                        <td>
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
               <table class="table table-striped table-bordered" cellspacing="0" width="100%"   id="rapport_client" <?php    if (!isset($_GET['code_client'])) {?>style="display: none"    <?php  } ?>>
                    <thead>
                        <tr>
                            <th>Famille</th>
                            <th>Nbre-Coupon-valide</th>
                            <th>Nbre-Coupon-attente</th>
                            <th>Nbre-Coupon-annule</th>
                        </tr>
                    </thead>
                    <tbody>                        
                         <tr>                                                                  
                           <td id="identite_client"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['identite_client']; } ?></td>
                           <td id="nbre_coupon_valide"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['nbre_coupon_valide']; } ?></td>
                           <td id="nbre_coupon_attente"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['nbre_coupon_attente']; } ?></td>
                           <td id="nbre_coupon_annule"><?php    if (isset($_GET['code_client'])) { echo $rapport_client['nbre_coupon_annule']; } ?></td>
                         </tr>                 
                    </tbody>
                </table>              
                <hr>
                <h3>Liste E-coupons </h3>
                <hr>
                <table id="rapport_e_coupons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Code-coupon</th>
                            <th>Statut-coupon</th>                           
                            <th>N-Facture</th>
                            <th>Nom-client</th>
                             <th>Code-client</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody id="liste_e_coupon">
                        <?php                  
                            $tr = '';
                            if (sizeof($rapport_e_coupons['rapport_e_coupons']) > 0) {
                                foreach ($rapport_e_coupons['rapport_e_coupons'] as $value) {
                                    $tr .= '<tr>';
                                    $tr .= '<td>' . $value ['code_coupon'] . '</td><td>' . $value ['statut_coupon'] . '</td><td>' . $value ['N_facture'] . '</td><td>' . $value ['nom_client'] . '</td><td>' . $value ['code_client'] . '</td>';
                                    $tr .= '<td>';
                                    $tr .= '<div class="btn-group">';
                                    $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                    $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                    $tr .= '<ul class="dropdown-menu">';
                                    $tr .= '<li><a href="#"><button type="button" class="btn-primary" >Modifier etat-coupon</button></a></li>';
                                    $tr .= '<li><a href="#"><button type="button" class="btn-primary" >Consulter Modele-coupon</button></a></li>';
                                    $tr .= '</ul>';
                                    $tr .= '</div>';
                                    $tr .= '</td>';                                    
                                    $tr .= '</tr>';
                                }
                            } else {
                                $tr .= '<tr>';
                                $tr .= '<td colspan="4" style="text-align:center">Aucun coupon trouve!!!.</td>';
                                $tr .= '</tr>';
                            }
                            echo $tr;
                  
                        ?>
                    </tbody>
                </table>                
            </div>		
        </div>
    </div>
</div>





