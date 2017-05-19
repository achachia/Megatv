<div class="row">
    <div class="col-md-12 column">     
        <div class="col-md-9 column">
            <div class='row'>
                <div class="page-header">
                    <h3>R&eacute;capitulatif de la facture</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 column">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-header">
                                    <h3>Facture N&ordm; <?php echo $_GET['N_facture']; ?></h3>
                                </div>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="30%" height="22" align="left"><b>Date facture</b></td>
                                        <td width="25%" align="left"><?php echo $infos_facture['date_facture']; ?></td>
                                    </tr>
                                    <tr>
                                        <td height="22" align="left"><b>Statut</b></td>
                                        <td align="left"><?php echo $infos_facture['etat_facture']; ?></td>
                                        <td align="left">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="22" align="left"><b>Mode de paiement</b></td>
                                        <td align="left"><?php echo $infos_facture['mode_paiement']; ?></td>
                                        <td align="left">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><b>Objet</b></td>
                                        <td colspan="3"><?php echo $infos_facture['objet_facture']; ?></td>
                                    </tr>
                                </table>
                                <br/>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <thead style="background-color: #318CE7">
                                        <tr height="30">
                                            <td height="22" width="409" align="center"><b>D&eacute;signation</b></td>
                                            <td height="22" width="71" align="left"><b>Qt&eacute;</b></td>
                                            <td height="22" width="71" align="left"><b>PU HT</b></td>
                                            <?php if (!empty($infos_facture['remise'])) { ?>   
                                                <td height="22" width="69"
                                                    align="left"><b>Remise</b></td>
                                                <?php } ?>  
                                            <td height="22" width="93"
                                                align="left"><b>Total HT</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr height="40">
                                            <td align="center"><?php echo $infos_facture['designation_facture']; ?></td>
                                            <td><?php echo $infos_facture['Qte']; ?></td>
                                            <td><?php echo $infos_facture['PU_HT']; ?></td>
                                            <?php if (!empty($infos_facture['remise'])) { ?>        
                                                <td><?php echo $infos_facture['remise']; ?></td>
                                            <?php } ?>       
                                            <td><?php echo $infos_facture['total_paye']; ?>&euro;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                       style="border-top: 1px solid #9aa29c">
                                           <?php if (!empty($infos_facture['remise'])) { ?> 
                                        <tr>
                                            <td width="5%">&nbsp;</td>
                                            <td height="22" width="45%">&nbsp;</td>
                                            <td width="10%">&nbsp;</td>
                                            <td width="10%">&nbsp;</td>
                                            <td align="left" width="17%" style="border-top: 0px">Remise</td>
                                            <td align="center" width="13%" style="border-top: 0px"><?php echo $infos_facture['remise']; ?>&euro;</td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (!empty($infos_facture['TauxTVA'])) { ?>
                                    <tr>
                                        <td height="22"><a name="ancres"></a></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="80" align="left"   style="border-top: 1px solid #9aa29c; color: #2c5810"><b>TOTAL TVA (<?= $infos_facture['TauxTVA'];?> %)     :</b></td>
                                        <td width="80" align="center"   style="border-top: 1px solid #9aa29c; color: #2c5810"><b><?php echo $infos_facture['MontantTva']; ?>&euro;</b></td>
                                    </tr>
                                     <?php } ?> 
                                    <tr>
                                        <td height="22"><a name="ancres"></a></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td width="80" align="left"
                                            style="border-top: 1px solid #9aa29c; color: #2c5810"><b>TOTAL
                                                HT</b></td>
                                        <td width="80" align="center"
                                            style="border-top: 1px solid #9aa29c; color: #2c5810"><b><?php echo $infos_facture['total_paye']; ?>&euro;</b></td>
                                    </tr>
                                    <?php if (!empty($infos_facture['total_acompte'])) { ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td height="22">&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td align="left" style="border-top: 1px solid #9aa29c">Acompte</td>
                                            <td align="center" style="border-top: 1px solid #9aa29c"><?php echo $infos_facture['total_acompte']; ?>&euro;</td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (!empty($infos_facture['TauxTVA'])) { ?>    
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td height="22">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left" bgcolor="#dee9ce"  style="width: 20%; border-top: 1px solid #9aa29c; color: #2c5810"><b>NET &Agrave; PAYER (TTC)</b></td>
                                        <td align="center" bgcolor="#dee9ce"   style="border-top: 1px solid #9aa29c; color: #2c5810"><strong><?php echo $infos_facture['TotalTva'] - $infos_facture['total_acompte']; ?>&euro;</strong></td>
                                    </tr>
                                     <?php }else{ ?>
                                     <tr>
                                        <td>&nbsp;</td>
                                        <td height="22">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left" bgcolor="#dee9ce"  style="width: 20%; border-top: 1px solid #9aa29c; color: #2c5810"><b>NET &Agrave; PAYER</b></td>
                                        <td align="center" bgcolor="#dee9ce"   style="border-top: 1px solid #9aa29c; color: #2c5810"><strong><?php echo $infos_facture['total_paye'] - $infos_facture['total_acompte']; ?>&euro;</strong></td>
                                    </tr>
                                      <?php } ?>
                                </table>
                            </div>
                        </div>						
                        <?php if (!empty($infos_facture['total_acompte'])) { ?> 
                            <div class="page-header">
                                <h3>Acompte N&ordm; <?php echo $infos_facture['numero_acompte']; ?> </h3>
                            </div>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <thead style="background-color: #318CE7">
                                    <tr height="30">
                                        <td height="22" width="20%" align="center"><b>Numero</b></td>
                                        <td height="22" width="20%" align="left"><b>Date</b></td>
                                        <td height="22" width="35%" align="left"><b>Montant</b></td>
                                        <td height="22" width="35%" align="left"><b>Action</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr height="40">
                                        <td align="center"><?php echo $infos_facture['numero_acompte']; ?></td>
                                        <td><?php echo $infos_facture['date_acompte']; ?></td>
                                        <td><?php echo $infos_facture['total_acompte']; ?>&euro;</td>
                                        <td><a
                                                href='index.php?module=acompte&action=view_acompte&N_acompte=<?php echo $infos_facture['numero_acompte']; ?>'><button
                                                    type='button' class='btn-primary'>
                                                    <span class='glyphicon glyphicon-eye-open'></span>Consulter
                                                </button></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>      



                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="page-header">
                    <h3>G&eacute;n&eacute;rer [ Facture/Coupon ]</h3>
                </div>
                <div class="row">  
                    <div class="col-md-3 col-md-offset-1">
                        <a href="./../librairie/Html2pdf/generer_pdf/facture.php?mode=save&N_facture=<?php echo $_GET['N_facture']; ?>&code_famille=<?php echo $_GET['code_famille']; ?>" target="_blank">
                            <button type="button" class="btn btn-primary">Sauvegarder la facture</button>
                        </a>
                    </div>
                    <!--<div class="col-md-3 col-md-offset-1">
                        <a href="./../pdf/generer_pdf/facture.php?mode=show&N_facture=<?php //echo $_GET['N_facture']; ?>&code_famille=<?php //echo $_GET['code_famille']; ?>" target="_blank">
                            <button type="button" class="btn btn-primary">Visualiser la facture</button>
                        </a>
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <a href="./../pdf/generer_pdf/facture.php?mode=print&N_facture=<?php //echo $_GET['N_facture']; ?>&code_famille=<?php //echo $_GET['code_famille']; ?>" target="_blank">
                            <button type="button" class="btn btn-primary">Imprimer la facture</button>
                        </a>
                    </div>-->
                    <div class="col-md-3 col-md-offset-1">
                        <a	href="./../librairie/Html2pdf/generer_pdf/liste_coupon.php?mode=save&N_facture=<?php echo $_GET['N_facture']; ?>&code_famille=<?php echo $_GET['code_famille']; ?>&nb_cours=<?php echo $_GET['nb_cours']; ?>"	target="_blank">
                            <button type="button" class="btn btn-primary">G&eacute;n&eacute;rer	les coupons</button>
                        </a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









