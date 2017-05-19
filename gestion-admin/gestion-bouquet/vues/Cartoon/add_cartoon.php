<h3>AJOUTER UN FILM</h3>

<!-- START row-->
<div class="row">
    <div class="col-sm-8">
        <!-- START panel-->
        <div class="panel panel-default">               
            <div class="panel-body">              
                <form role="form" id="add_cartoon"  name="add_cartoon" action="./controleurs/Cartoon/set_cartoon_film.php" method="POST">  
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SELECTION SOURCE</label>
                            <select name="select_source" id="select_source" class="form-control m-b">

                                <?php
                                $tr = '<option value="">Select-source</option>';
                                foreach ($liste_sources as $value) {
                                    $tr.="<option value='" . $value['id_source'] . "'>" . $value['nom_source'] . "</option>";
                                }
                                echo $tr;
                                ?>                        
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SELECTION COMPTE</label>
                            <select name="select_compte"  id="select_compte" class="form-control m-b">
                                <option value=''></option>                 
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SELECTION SECTION</label>
                            <select name="section_film"  id="section_film" class="form-control m-b">
                                <?php
                                $tr = '<option value="">Select-section</option>';
                                foreach ($liste_SectionVod as $value) {
                                    $tr.="<option value='" . $value['id_section'] . "'>" . $value['nom_section'] . "</option>";
                                }
                                echo $tr;
                                ?>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TITRE ORIGINALE DE FILM</label>
                            <input id="titre" name="titre" type="text" placeholder="Titre de film" class="form-control">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">NOM FICHIER</label>
                            <input id="nom_fichier" name="nom_fichier" type="text" placeholder="Nom fichier" class="form-control">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">TAILLE FICHIER</label>
                            <input id="taille_fichier" name="taille_fichier" type="text" placeholder="Taille fichier" class="form-control">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">DATE UPLOAD</label>
                            <input id="date_upload" name="date_upload" type="text" placeholder="Date upload" class="form-control">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">

                                <div  class="checkbox c-checkbox">
                                    GENERER LE FICHIER STRM : 
                                </div>
                            </label>
                            <label class="col-sm-1 control-label">

                                <div  class="checkbox c-checkbox">
                                    <input name="on_strm" id="on_strm" type="checkbox" checked=""  value="1">
                                    <span class="fa fa-check"></span>
                                </div>
                            </label>

                        </div>
                    </fieldset>            

                    <fieldset>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-default">ENREGISTRER</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- END panel-->
    </div>

</div>



