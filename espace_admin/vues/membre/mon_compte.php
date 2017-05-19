         
            <div class="col-md-9 column"> 
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Mes données personnelles</h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover ">            
                    <legend>Coordonn&eacute;es</legend>            
                    <tr>
                        <td>Civilité</td>
                        <td><strong><?php echo $infos_intervenant['civilité']; ?></strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><strong><?php echo $infos_intervenant['nom']; ?></strong></td>
                        <td>Prénom</td>
                        <td><strong><?php echo $infos_intervenant['prenom']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Téléphone</td>
                        <td><strong><?php echo $infos_intervenant['tel_fixe']; ?></strong></td>
                        <td>Portable</td>
                        <td><strong><?php echo $infos_intervenant['tel_portable']; ?></strong></td>                         
                    </tr>
                    <tr>                        
                        <td>Fax</td>
                        <td colspan="3"><strong><?php echo $infos_intervenant['fax']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><strong><?php echo $infos_intervenant['email']; ?></strong></td>
                        <td>Site web</td><td><strong><?php echo $infos_intervenant['site_web']; ?></strong></td> 
                         
                    </tr>
                    <tr>
                       <td>Sécurité sociale</td>
                        <td><strong><?php echo $infos_intervenant['numero_sec_sc']; ?></strong></td>  
                    </tr>
                </table> 
                <table class="table table-striped table-hover ">
                    <legend>Adresse</legend>
                    <tr>
                        <td>Adresse</td>
                        <td colspan="3"><strong><?php echo $infos_intervenant['adresse']; ?></strong></td>
                    </tr> 
                    <tr>
                        <td>Adresse (suite)</td>
                        <td colspan="3"><strong><?php echo $infos_intervenant['adresse_suite']; ?></strong></td>
                    </tr>  
                    <tr>
                        <td>Code postal</td>
                        <td><strong><?php echo $infos_intervenant['code_postale']; ?></strong></td>
                        <td>Ville</td>
                        <td align="left"><strong><?php echo $infos_intervenant['ville']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Pays</td>
                        <td colspan="3"><strong><?php echo $infos_intervenant['pays']; ?></strong></td>
                    </tr>
                </table>
                           <table class="table table-striped table-hover ">
                    <legend>Mes Coordonnées bancaires</legend>
                    <tr>
                        <td>Banque</td>
                        <td><strong><?php echo $infos_intervenant['banque']; ?></strong></td>
                         <td>Guichet</td>
                        <td><strong><?php echo $infos_intervenant['guichet']; ?></strong></td>
                    </tr>                   
                    <tr>
                        <td>N° Compte</td>
                        <td><strong><?php echo $infos_intervenant['n_compte']; ?></strong></td>
                        <td>Clé RIB</td>
                        <td align="left"><strong><?php echo $infos_intervenant['cle_rib']; ?></strong></td>
                    </tr>                   
                </table>
            </div>
     
  



