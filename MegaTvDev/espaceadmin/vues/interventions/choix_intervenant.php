
<div class="row">
    <div class="col-md-12 column">
        <div class="col-md-9 column">
            <div class='row'>
                <div class="page-header">
                    <a class="btn btn-primary btn-lg">Choix un intervenant</a>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">FICHE INTERVENTION</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="nav nav-pills nav-justified"
                            style="margin-bottom: 15px;">
                            <li class="active"><a href="#fiche_intervention"
                                                  data-toggle="tab">FICHE INTERVENTION</a></li>
                            <li><a href="#fiche_famille" data-toggle="tab">FICHE FAMILLE</a></li>
                            <li><a href="#fiche_eleve" data-toggle="tab">FICHE ELEVE</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="fiche_intervention">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <strong>FICHE INTERVENTION</strong>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped ">
                                            <tbody>
                                                <tr>
                                                    <th>REFERENCE INTERVENTION :</th>
                                                    <td><?php echo $infos_utile_intervention['reference']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>TYPE INTERVENTION :</th>
                                                    <td><?php echo $infos_utile_intervention['type_intervention']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>MATIERE :</th>
                                                    <td><?php echo $infos_utile_intervention['matiere']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>DATE DEBUT MISSION :</th>
                                                    <td><?php echo $infos_utile_intervention['date_debut_mission']; ?></td>
                                                </tr>
                                                <?php if (isset($infos_intervention['date_fin_mission'])) { ?>
                                                    <tr>
                                                        <th>DATE FIN MISSION :</th>
                                                        <td><?php echo $infos_utile_intervention['date_fin_mission']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>FREQUENCE :</th>
                                                    <td><?php echo $infos_utile_intervention['frequence']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>DUREE :</th>
                                                    <td><?php echo $infos_utile_intervention['duree']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>OBSERVATION :</th>
                                                    <td><?php echo $infos_utile_intervention['observation']; ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fiche_famille">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <strong>FICHE FAMILLE</strong>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4 column"></div>
                                            <figure>
                                                <img
                                                    src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png"
                                                    alt="" class="img-circle img-responsive"
                                                    style="width: 100px; height: 100px">
                                            </figure>
                                        </div>
                                        <h5>
                                            <strong>CIVILITE :</strong>  <?php echo $infos_famille['civilite']; ?></h5>
                                        <h5>
                                            <strong><span class="glyphicon glyphicon-user"></span> NOM :</strong>
                                            <?php echo $infos_famille['identite_famille']; ?></h5>
                                        <h5>
                                            <strong><span class="glyphicon glyphicon-tree-conifer"></span>
                                                Adresse :</strong>
                                            <?php echo $infos_famille['adresse']; ?></h5>
                                        <h5>
                                            <strong>Code postale :</strong>  <?php echo $infos_famille['code_postale']; ?></h5>
                                        <h5>
                                            <strong>Ville :</strong> <?php echo $infos_famille['ville']; ?></h5>
                                        <h5>
                                            <strong><span class="glyphicon glyphicon-phone-alt"></span>
                                                Tél Fixe:</strong>
                                            <?php echo $infos_famille['tel_fixe']; ?></h5>
                                        <h5>
                                            <strong><span class="glyphicon glyphicon-earphone"></span>
                                                Tél Portable :</strong>
                                            <?php echo $infos_famille['tel_portable']; ?></h5>
                                        <h5>
                                            <strong><span class="glyphicon glyphicon-earphone"></span>
                                                Tél Travail :</strong>
                                            <?php echo $infos_famille['tel_travail']; ?></h5>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="fiche_eleve">
                                <ul class="nav nav-pills nav-justified"
                                    style="margin-bottom: 15px;">
                                    <li class="active"><a href="#infos_eleve" data-toggle="tab">Fiche
                                            &eacute;l&eacute;ve</a></li>
                                    <li><a href="#Disponibilite_eleve" data-toggle="tab">Disponibilite
                                            &eacute;l&eacute;ve</a></li>

                                </ul>
                                <div id="myTabContent1" class="tab-content">
                                    <div class="tab-pane fade active in" id="infos_eleve">
                                        <div class="col-lg-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Coordonn&eacute;es
                                                        &eacute;l&eacute;ve</h3>
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
                                                    <h3 class="panel-title">Disponibilit&eacute;
                                                        &eacute;l&eacute;ve</h3>
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
                                                                                    src="./../img/ok.gif" /></TD>
                                                                            <?php } else { ?>
                                                                            <TD><img
                                                                                    src="./../img/non.gif" /></TD> 
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

                        </div>

                    </div>
                </div>



                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Liste des disponibilites/intervenant</h3>
                    </div>
                    <div class="panel-body">
                        <table id="liste_intervenant"
                               class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th>Nom intervenant</th>
                                    <th>Code intervenant</th>
                                    <th>Disponibilite %</th>
                                    <th>Distance</th>
                                    <th>Contact</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($liste_disponibilite)) {
                                    $tr = '';
                                    foreach ($liste_disponibilite as $value) {
                                        $tr .= '<tr>';
                                        $tr .= '<td>' . $value ['identite_intervenant'] . '</td>';
                                        $tr .= '<td>' . $value ['code_intervenant'] . '</td>';
                                        $tr .= '<td><span class="badge">' . $value ['pourcentage_dispo'] . ' %</span></td>';
                                        $tr .= '<td><span class="badge">' . $value ['intervenant_distance'] . ' Km</span></td>';
                                        $tr .= '<td><button type="button" class="btn-primary" name="view_fiche_intervenant"   id="' . $value ['code_intervenant'] . '"><span class="glyphicon glyphicon-eye-open"></span>Consulter</button></td>';
                                        $tr .= '</tr>';
                                    }
                                    echo $tr;
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row"  style="display:none" id="bloc_infos">
                            <div class="panel panel-default">
                                <div class="panel-heading">LA FICHE INTERVENANT</div>
                                <div id="fiche_detaille_intervenant" class="panel-body"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="EmplacementDeMaCarte"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Carte Google Maps</h3>
                    </div>
                    <div class="panel-body">
                        	<style type="text/css">
			html {
				height: 100%
			}
			body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 100%
			}
		</style>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
			function initialisation(){
				var centreCarte = new google.maps.LatLng(<?php  echo $infos_intervention['interv_latitude']; ?>, <?php  echo $infos_intervention['interv_longitude']; ?>);
				var optionsCarte = {
					zoom: 8,
					center: centreCarte,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var maCarte = new google.maps.Map(document.getElementById("map"), optionsCarte);
				var optionsMarqueur = {
					position: maCarte.getCenter(),
					map: maCarte
				};
				var marqueur = new google.maps.Marker(optionsMarqueur);
			 }
			 google.maps.event.addDomListener(window, 'load', initialisation);
		</script>
                        <div id="map"></div> 
                    </div>
                </div>



                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">SELECTION INTERVENANT</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Le formulaire le choix de intervenant -->
                        <form class="form-horizontal" id="choix_intervenant"   name="choix_intervenant" method="POST"    action="./controleurs/interventions/validation_intervenant.php">
                            <div id="message"></div>
                            <table>
                                <tr>
                                    <td style="width: 30%">
                                        <label for="date_affectation"   class="control-label">Date affectation:</label></td>
                                    <td>
                                        <input type="text" class="form-control"  id="date_affectation" name="date_affectation"></td>
                                </tr>
                                  <tr style="height: 30px">
                                  </tr>
                                <tr>
                                    <td style="width: 30%">
                                        <label for="choix_intervenant"  class="control-label">Choisir un intervenant:</label></td>
                                    <td style="width: 40%">
                                        <select class="liste_intervenants"  style="width: 250px;"   data-placeholder="Selectionnez un intervenant"   id="liste_intervenants" name="liste_intervenants">
                                            <option value="">Liste-intervenants</option>
                                            <?php
                                            foreach ($liste_intervenants as $key => $value) {
                                                $ligne = "<option  value='" . $value ['code_intervenant'] . "'>" . $value ['identite_intervenant'] . "</option>";
                                                echo $ligne;
                                            }
                                            ?>                                 
                                        </select>
                                    </td>
                                    <td style="width: 30%">
                                        <a><span class="glyphicon glyphicon-search"></span>Recherche avancée.</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" class="form-control" id="ref_mission"
                           name="ref_intervention"
                           value='<?php echo $_GET['reference_intervention']; ?>'>
                </div>
                <hr />
                <div class="row offset1">
                    <button class="btn btn-default" type="reset">Annuller</button>
                    <button type="submit" class="btn btn-primary"
                            id="valider_intervenant" name="valider_intervenant"
                            value="valider_intervenant">Valider l'intervenant</button>
                </div>
              

            </div>
        </div>
    </div>
</div>









