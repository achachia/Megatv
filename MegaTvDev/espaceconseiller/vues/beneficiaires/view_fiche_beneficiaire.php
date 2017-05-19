<div class="row">
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">La fiche descriptive [<?php echo $infos_benef['identite_beneficiaire']; ?>]</div>
            <div class="panel-body">
                <div id="message"></div>
                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                    <li class="active"><a href="#etat_civil" data-toggle="tab">ETAT CIVIL</a></li>
                    <li><a href="#adresse" data-toggle="tab">ADRESSE</a></li>
                    <li><a href="#contact" data-toggle="tab">CONTACT</a></li>
                    <li><a href="#infos_interne" data-toggle="tab">INFOS</a></li>
                    <li><a href="#infos_peda" data-toggle="tab">FICHE PEDAGOGIQUE       </a></li>
                    <li><a href="#disponibilite" data-toggle="tab">DISPONIBILITE</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="etat_civil">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>NOM :</strong></td>
                                    <td><?php echo $infos_benef['nom_beneficiaire'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>PRENOM :</strong></td>
                                    <td><?php echo $infos_benef['prenom_beneficiaire'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>DATE NAISSANCE :</strong></td>
                                    <td><?php echo $infos_benef['date_naissance'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>DATE INSCRIPTION :</strong></td>
                                    <td><?php echo $infos_benef['date_inscription'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>                                  
                                    <td><strong>CODE BENEFICIAIRE :</strong></td>
                                    <td><?php echo $infos_benef['code_beneficiaire'] ?></td>
                                </tr>
                        

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="adresse">
                        <table class="table table-striped table-hover ">
                            <tbody>

                                <tr>
                                    <td><strong>ADRESSE :</strong></td>
                                    <td><?php echo $infos_benef['adresse_benef'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                             <?php if(!is_null($infos_benef['adresse_suite_benef'])){ ?>   
                                <tr>
                                    <td><strong>ADRESSE SUITE :</strong></td>
                                     <td><?php echo $infos_benef['adresse_suite_benef'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                             <?php } ?>    
                                <tr>
                                    <td><strong>CODE POSTALE :</strong></td>
                                    <td><?php echo $infos_benef['code_post_benef'] ?></td>
                                    <td><strong>VILLE :</strong></td>
                                     <td><?php echo $infos_benef['ville_benef'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>PAYS :</strong></td>
                                    <td><?php echo $infos_benef['pays_benef'] ?></td>                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>EMAIL :</strong></td>
                                    <td><?php echo $infos_benef['email'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>SITE WEB :</strong></td>
                                    <td><?php echo $infos_benef['site_web'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>TEL MAISON :</strong></td>
                                    <td><?php echo $infos_benef['tel_fixe'] ?></td>
                                    <td><strong>TEL PORTABLE :</strong></td>
                                    <td><?php echo $infos_benef['tel_portable'] ?></td>
                                </tr>                         
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="infos_interne">
                        <table class="table table-striped table-hover ">
                            <tbody>
                                <tr>
                                    <td><strong>CONSEILLER ATTACHE :</strong></td>
                                    <td><?php echo $infos_benef['identite_conseiller'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>INFOS INTERNE :</strong></td>
                                    <td><?php echo $infos_benef['infos_interne'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                           <tr>
                                    <td><strong>INFOS INTERVENANTS :</strong></td>
                                    <td><?php echo $infos_benef['infos_intervenant'] ?></td>
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
                                    <td><strong>NIVEAU :</strong></td>
                                    <td><?php echo $infos_benef['niveau_beneficiaire'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>OPTION PEDAGOGIQUE :</strong></td>
                                    <td><?php echo $infos_benef['option_peda_beneficiaire'] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="disponibilite">
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
                                                    <?php foreach ($infos_benef['diponibilite'] as $key => $infos_eleve) { ?>                       
                                                        <tr
															align="center">
															<TD><?php echo $key; ?></TD>
                                                            <?php
																																																					foreach ( $infos_eleve as $key1 => $infos_eleve1 ) {
																																																						if ($infos_eleve [$key1] == '1') {
																																																							?>
                                                                    <TD><img
																src="./../media/images/ok.gif" /></TD>
                                                                <?php } else { ?>
                                                                    <TD><img
																src="./../media/images/non.gif" /></TD> 
                                                                <?php } ?>   

                                                            <?php } ?>                                                      
                                                        </tr>
                                                    <?php } ?>               

                                                </tbody>
												</table>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</div>
<div class='row' style="text-align: center">
    <button type="button" class="btn btn-primary" id="retour">
        <span class="glyphicon glyphicon-backward"></span> RETOUR
    </button>
</div>
<!-------------------------------------------------->