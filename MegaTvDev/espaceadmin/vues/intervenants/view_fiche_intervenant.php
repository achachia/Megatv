<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">La fiche descriptive [<?= $infos_interv['identite_intervenant']; ?>]</div>
            <div class="panel-body">
                <div id="message"></div>
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    <li class="active"><a href="#etat_civil" data-toggle="tab">ETAT CIVIL</a></li>
                    <li><a href="#adresse" data-toggle="tab">ADRESSE</a></li>
                    <li><a href="#contact" data-toggle="tab">CONTACT</a></li>
                    <li><a href="#infos_interne" data-toggle="tab">INFOS</a></li>
                    <li><a href="#infos_peda" data-toggle="tab">FICHE PEDAGOGIQUE </a></li>
                    <li><a href="#infos_banc" data-toggle="tab">DONNEES BANCAIRES </a></li>
                    <li><a href="#disponibilite" data-toggle="tab">DISPONIBILITE</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="etat_civil">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>CIVILITE :</strong></td>
                                    <td><?= $infos_interv['civilite'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>SEX :</strong></td>
                                    <td><?= $infos_interv['sex'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>NATIONALITE :</strong></td>
                                    <td><?= $infos_interv['nationalite'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>NOM :</strong></td>
                                    <td><?= $infos_interv['nom'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>PRENOM :</strong></td>
                                    <td><?= $infos_interv['prenom'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>DATE NAISSANCE :</strong></td>
                                    <td><?= $infos_interv['date_naissance'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>DATE ADHESION :</strong></td>
                                    <td><?= $infos_interv['date_adhesion'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>CODE INTERVENANT:</strong></td>
                                    <td><?= $infos_interv['code_intervenant'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>NUMERO SECURITE SOCIALE :</strong></td>
                                    <td><?= $infos_interv['numero_sec_sc'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="adresse">
                        <table class="table table-striped table-hover ">
                            <tbody>

                                <tr>
                                    <td><strong>ADRESSE :</strong></td>
                                    <td><?php echo $infos_interv['adresse'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php if (!is_null($infos_interv['adresse_suite'])) { ?>   
                                    <tr>
                                        <td><strong>ADRESSE SUITE :</strong></td>
                                        <td><?php echo $infos_interv['adresse_suite'] ?></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php } ?>    
                                <tr>
                                    <td><strong>CODE POSTALE :</strong></td>
                                    <td><?php echo $infos_interv['code_postale'] ?></td>
                                    <td><strong>VILLE :</strong></td>
                                    <td><?php echo $infos_interv['ville'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>PAYS :</strong></td>
                                    <td><?php echo $infos_interv['pays'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>EMAIL :</strong></td>
                                    <td><?php echo $infos_interv['email'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>SITE WEB :</strong></td>
                                    <td><?php echo $infos_interv['site_web'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>FAX :</strong></td>
                                    <td><?php echo $infos_interv['fax'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>TEL MAISON :</strong></td>
                                    <td><?php echo $infos_interv['tel_fixe'] ?></td>
                                    <td><strong>TEL PORTABLE :</strong></td>
                                    <td><?php echo $infos_interv['tel_portable'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="infos_interne">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>INFOS INTERNE :</strong></td>
                                    <td><?php echo $infos_interv['infos_interne'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>INFOS FAMILLE :</strong></td>
                                    <td><?php echo $infos_interv['infos_famille'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="infos_peda">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>NIVEAU ETUDE :</strong></td>
                                    <td><?php echo $infos_interv['diplome'] . ' [' . $infos_interv['niveau_etude'] . ']' ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>STATUT PEDAGOGIQUE :</strong></td>
                                    <td><?php echo $infos_interv['statut_peda'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="infos_banc">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>CODE BANQUE :</strong></td>
                                    <td><?php echo $infos_interv['code_banque'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>CODE GUICHET :</strong></td>
                                    <td><?php echo $infos_interv['code_guichet'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                   <tr>
                                    <td><strong>NUMERO COMPTE :</strong></td>
                                    <td><?php echo $infos_interv['n_compte'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                   <tr>
                                    <td><strong>CLE RIB :</strong></td>
                                    <td><?php echo $infos_interv['cle_rib'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="disponibilite">
                        <?php if (!is_null($infos_interv ['diponibilite'])) { ?>
                            <table class="table table-striped table-hover  table-bordered">
                                <tbody>
                                    <tr id='css_text'>
                                        <th>Horaire</th>
                                        <th>lun.</th>
                                        <th>mar.</th>
                                        <th>mer.</th>
                                        <th>jeu.</th>
                                        <th>ven.</th>
                                        <th>sam.</th>
                                        <th>dim.</th>
                                    </tr>
                                    <?php
                                    foreach ($infos_interv ['diponibilite'] as $key => $infos_intervenant) {
                                        ?>                       
                                        <tr
                                            align="center">
                                            <TD><?php echo $key; ?></TD>
                                            <?php
                                            foreach ($infos_intervenant as $key1 => $infos_intervenant1) {
                                                if ($infos_intervenant [$key1] == '1') {
                                                    ?>
                                                    <TD><img
                                                            src="./../img/ok.gif" /></TD>
                                                    <?php } else { ?>
                                                    <TD><img
                                                            src="./../img/non.gif" /></TD> 
                                                    <?php } ?>   

                                            <?php } ?>                                                      
                                        </tr>
                                    <?php }
                                } else {
                                    ?>  
                                <h2>La fiche des disponibilite est indisponible!!!</h2>
<?php } ?>             

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------->
<?php
$toto='';

 foreach ($liste_matiere as $key => $value) {
      $toto.= $key."[";
       $size=sizeof($value);
      for ($i = 0; $i < $size; $i++) {
          $toto.=$value[$i]."-";
      }     
      $toto.= "]/".$size;     
 }
 echo $toto;

?>
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">Les matieres a intervenir </div>
               <div class="panel-body">
                   <table class="table table-bordered">
                      <tr>
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">La Matiere</th>
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Les Niveaux</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Nbre Missions</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Total des Missions/par matiere</th> 
                      </tr>   
                     <?php 
                            $tr=''; 
                            foreach ($liste_matiere as $key => $value) {   
                                 $size=sizeof($value);
                                 if($size>1){
                         
                                            $tr.="<tr>
                                                  <td rowspan='". $size."'  style='text-align:center;padding:5%;color:#0000FF;'>$key</td>
                                                   <td  style='text-align:center;padding:0.1%'>".$value['0']."</td>
                                                   <td  style='text-align:center;padding:0.1%'>nbre1</td>
                                                   <td  rowspan='".$size."' style='text-align:center;padding:5%'>nbre125</td>
                                               </tr>";
                                          
                                         for ($i = 1; $i < $size; $i++) {    
                                               $tr.="<tr>";
                                               $tr.="<td style='text-align:center;padding:0.1%'>".$value[$i]."</td>
                                                   <td  style='text-align:center;padding:0.1%'>nbre2</td>";
                                                $tr.="</tr>";
                                 
                                         } 
                                       
                                  } else{
                                         $tr.="<tr>
                                                     <td  style='text-align:center;padding:2%;color:#0000FF;'>$key</td>                                                  
                                                     <td  style='text-align:center;padding:2%'>".$value['0']."</td>
                                                     <td  style='text-align:center;padding:2%'>nbre1</td>
                                                     <td  style='text-align:center;padding:2%'>nbre125</td>
                                                </tr>";
                                          
                                               
                                        }                       
                            }
                            echo $tr; ?>
                       
                       
                       
                       <!-------------------------------------------------------------------->
                     
                  
                <!--       <tr>
                           <td rowspan="3"  style="text-align:center;padding:5%;color:#0000FF;">test</td>
                           <td  style="text-align:center;padding:0.1%">valeur1</td>
                           <td  style="text-align:center;padding:0.1%">nbre1</td>
                           <td  rowspan="3" style="text-align:center;padding:5%" >nbre125</td>
                       </tr>
                      
                       <tr>
                           <td style="text-align:center;padding:0.1%">valeur2</td>
                            <td  style="text-align:center;padding:0.1%">nbre2</td>
                       </tr>
                        <tr>
                           <td style="text-align:center;padding:0.1%">valeur3</td>
                           <td  style="text-align:center;padding:0.1%">nbre3</td>
                       </tr>-->                   
              
                   </table>
               </div>
        </div>
    </div>
</div>

<!--------------------------------------------------------->
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">Les Niveaux a intervenir </div>
               <div class="panel-body">
                   <table class="table table-bordered">
                       <tr>
                           <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Niveau</th>
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Les Matieres</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Nbre Missions</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Total des Missions/par niveau</th> 
                       </tr>
                       
                       <tr>
                           <td rowspan="3"  style="text-align:center;padding:5%;color:#0000FF;">test1</td>
                           <td  style="text-align:center;padding:0.1%">valeur1</td>
                           <td  style="text-align:center;padding:0.1%">nbre1</td>
                            <td  rowspan="3" style="text-align:center;padding:5%" >nbre125</td>
                       </tr>
                       <tr>
                           <td style="text-align:center;padding:0.1%">valeur2</td>
                            <td  style="text-align:center;padding:0.1%">nbre2</td>
                       </tr>
                        <tr>
                           <td style="text-align:center;padding:0.1%">valeur3</td>
                           <td  style="text-align:center;padding:0.1%">nbre3</td>
                       </tr>
                      <!---------------------------------------->
                       <tr>
                           <td   style="text-align:center;padding:5%;color:#0000FF;">test</td>
                           <td  style="text-align:center;padding:0.1%">valeur1</td>
                           <td  style="text-align:center;padding:0.1%">nbre1</td>
                           <td   style="text-align:center;padding:5%" >nbre125</td>
                       </tr>
                     
                   </table>
               </div>
        </div>
    </div>
</div>
<!-------------------------------------------------->
<!--------------------------------------------------------->
<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">Les zones d'intervention </div>
               <div class="panel-body">
                   <table class="table table-bordered">
                       <tr>
                           <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Zone intervenant</th>
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Les zones</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Les codes postales</th> 
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Distance</th>
                            <th style="text-align: center;color:#FFFFFF;background-color:blueviolet;font-size:15px">Le Total des Missions/par zone</th> 
                       </tr>
                       
                       <tr>
                           <td rowspan="3"  style="text-align:center;padding:10%;color:#0000FF;">test</td>
                           <td  style="text-align:center;padding:0.1%">valeur1</td>
                           <td  style="text-align:center;padding:0.1%">nbre1</td>
                            <td  style="text-align:center;padding:0.1%" >nbre125</td>
                            <td  style="text-align:center;padding:0.1%" >nbre125</td>
                       </tr>
                       <tr>
                           <td style="text-align:center;padding:0.1%">valeur2</td>
                            <td  style="text-align:center;padding:0.1%">nbre2</td>
                             <td  style="text-align:center;padding:0.1%" >nbre125</td>
                             <td  style="text-align:center;padding:0.1%" >nbre125</td>
                       </tr>
                        <tr>
                           <td style="text-align:center;padding:0.1%">valeur3</td>
                           <td  style="text-align:center;padding:0.1%">nbre3</td>
                           <td  style="text-align:center;padding:0.1%" >nbre125</td>
                           <td  style="text-align:center;padding:0.1%" >nbre125</td>
                       </tr>                     
                     
                   </table>
               </div>
        </div>
    </div>
</div>
<!-------------------------------------------------->
<div class='row' style="text-align: center">
    <button type="button" class="btn btn-primary" id="retour">
        <span class="glyphicon glyphicon-backward"></span> RETOUR
    </button>
</div>
