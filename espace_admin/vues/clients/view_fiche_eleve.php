<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><strong> LA FICHE DESCRIPTIVE 	<?php echo $infos_eleve['nom_eleve'] . '.' . $infos_eleve['prenom_eleve']; ?> </strong></h4></div>
            <div class="panel-body">

                <?php if (sizeof($infos_eleve) > 0) { ?>    
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#Fiche_famille" data-toggle="tab">Fiche
                                famille</a></li>
                        <li><a href="#Fiche_eleve" data-toggle="tab">Fiche &eacute;l&eacute;ve</a></li>
                        <li><a href="#Disponibilite_eleve" data-toggle="tab">Disponibilite
                                &eacute;l&eacute;ve</a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="Fiche_famille">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Coordonn&eacute;es famille</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover ">
                                            <tr>
                                                <td>Nom :</td>
                                                <td><strong><?php echo $infos_eleve['nom_famille']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Prenom :</td>
                                                <td><strong><?php echo $infos_eleve['prenom_famille']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Fixe :</td>
                                                <td><strong><?php echo $infos_eleve['tel_fixe_famille']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Portable :</td>
                                                <td><strong><?php echo $infos_eleve['tel_portable_famille']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Travail :</td>
                                                <td><strong><?php echo $infos_eleve['tel_travail_famille']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Adresse</td>
                                                <td><strong><?php echo $infos_eleve['adresse']; ?></strong></td>
                                            </tr>
                                            <?php if ($infos_eleve['adresse_suite'] != '') { ?>			
                                                <tr>
                                                    <td>Adresse suite</td>
                                                    <td><strong><?php echo $infos_eleve['adresse_suite']; ?></strong></td>
                                                </tr>
                                            <?php } ?>			
                                            <tr>
                                                <td>Code postale</td>
                                                <td><strong><?php echo $infos_eleve['code_postale']; ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Fiche_eleve">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Coordonn&eacute;es &eacute;l&eacute;ve</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover ">
                                            <tr>
                                                <td>Nom :</td>
                                                <td><strong><?php echo $infos_eleve['nom_eleve']; ?> </strong></td>
                                            </tr>
                                            <tr>
                                                <td>Pr&eacute;nom :</td>
                                                <td><strong><?php echo $infos_eleve['prenom_eleve']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Portable :</td>
                                                <td><strong><?php echo $infos_eleve['tel_eleve']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Niveau</td>
                                                <td><strong><?php echo $infos_eleve['niveau_peda']; ?></strong></td>
                                            </tr>							
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Disponibilite_eleve">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Disponibilit&eacute; &eacute;l&eacute;ve</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover ">
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
                                                <?php foreach ($infos_eleve['diponibilite'] as $key => $infos_eleve) { ?>                       
                                                    <tr
                                                        align="center">
                                                        <TD><?php echo $key; ?></TD>
                                                        <?php
                                                        foreach ($infos_eleve as $key1 => $infos_eleve1) {
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
                    <?php
                } else {
                    echo "<h4>aucun &eacute;l&egrave;ve trouv&eacute;.</h4>";
                }
                ?> 

            </div>
        </div>
    </div>

</div>


