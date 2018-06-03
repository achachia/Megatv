<div class="row">

    <div class="col-lg-12">

        <?php if (isset($_GET['message']) && $_GET['message'] == 'echec') { ?>

            <div class="alert alert-warning alert-dismissible  show" role="alert">
                <strong>Votre opération a été échoué.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php } ?>
        <?php if (isset($_GET['message']) && $_GET['message'] == 'success') { ?>
            <div class="alert alert-success alert-dismissible  show" role="alert">
                <strong>Votre opération a été enregistré avec succées</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

    </div>
</div>
<div class="row">					

    <div class="btn-group btn-group-justified" role="group">


        <div class="btn-group" role="group">

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_add_serveur">

                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

                Un nouveau serveur

            </button>  

        </div>


    </div>				

</div>


<!---------------------------------------------------------->
<?php if (isset($liste_serveurs_vod) && sizeof($liste_serveurs_vod) > 0) { ?>

    <div class="row"  style="margin-top:20px">

        <div class="col-lg-12">


            <div class="panel panel-primary">

                <div class="panel-heading">LISTES DES SERVEURS VOD</div>

                <div class="panel-body">


                    <table  id="liste_radio_web" name="liste_radio_web" class="table table-striped table-hover">

                        <thead>

                            <tr>  
                                <th style="text-align:center">LOGO</th> 

                                <th style="text-align:center">NOM SERVEUR</th> 

                                <th>URL</th> 

                                <th>Emplacement</th> 

                                <th class="sort-numeric">ACTIVATION</th>                      

                                <th class="sort-alpha">ACTION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $tr = '';
                            $j = 0;

                            foreach ($liste_serveurs_vod as $value) {

                                $tr .= '<tr>';

                                $tr .= '<td  style="text-align:center"><img src="' . $value ['logo_serveur'] . '" class="img-rounded"  width="100" height="100"></td>';

                                $tr .= '<td style="padding-top:2%;text-align:center">' . $value ['nom_serveur'] . '</td>';

                                $tr .= '<td style="padding-top:2%">' . $value ['url_serveur'] . '</td>';

                                $tr .= '<td style="padding-top:2%">' . $value ['emplacement_serveur'] . '</td>';

                                $tr .= '<td style="padding-top:2%">' . $value ['statut_serveur'] . '</td>';


                                $tr .= '<td><button  style="margin:5px"  data-toggle="modal" data-target="#myModal_edit_' . $j . '"  class="btn btn-primary btn-lg"  > Editer </button>';


                                $tr .= '</tr>';

                                $j++;
                            }

                            echo $tr;
                            ?>



                        </tbody>



                    </table>
                    <!----------------------   consultation fiche ----------------------------->


                </div>

            </div>

        </div>

    </div>
<?php } ?>

<div id="myModal_add_serveur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_add_pays" name="form_add_pays" method="POST" action="./controleurs/Serveurs/set_serveur_vod.php">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color:blue">Enregistrer un nouveau serveur</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="nom" style="color:blue;font-size:16px">NOM SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="nom_serveur"  name="nom_serveur"  placeholder="Entrer le nom de serveur">

                        </div>
                    </div> 
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="url" style="color:blue;font-size:16px">URL SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="url_serveur"  name="url_serveur"  placeholder="Entrer le url de serveur">

                        </div>
                    </div> 
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="logo" style="color:blue;font-size:16px">URL SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="logo_serveur"  name="logo_serveur"  placeholder="Entrer le logo de serveur">

                        </div>
                    </div> 
                    <div class="form-group"  style="padding-top:1%">
                        <label class="control-label col-lg-3 col-md-3 col-sm-4" for="url" style="color:blue;font-size:16px">EMPLACEMENT SERVEUR: <span style="color:red">(<i class="fa fa-asterisk" aria-hidden="true"></i>)</span></label>
                        <div class="col-sm-8">

                            <input type="text" class="form-control" id="emplacement_serveur"  name="emplacement_serveur"  placeholder="Entrer emplacement de serveur">

                        </div>
                    </div>  


                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Fermer</button>                
                    <button type="submit" class="btn btn-primary" name="add_serveur"  value="add_serveur">Enregistrer le nouveau serveur</button>
                </div>
            </form>
        </div>
    </div>
</div>









