<!-- START Main section-->
<section>
    <!-- START Page content-->
    <section class="main-content">
            <section class="main-content">
        <div class="row">
            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-info text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">FILMS</h4>
                                <p class="mb0 text-muted"><?= $nbr_films; ?> films</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_films; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-danger text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">CARTOON</h4>
                                <p class="mb0 text-muted"><?= $nbr_cartoon; ?> films</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_cartoon; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>

            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-success text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">SERIE TV</h4>
                                <p class="mb0 text-muted"><?= $nbr_serie_tv; ?> serie</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_serie_tv; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>


        </div>
        <div class="row">
            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="row row-table row-flush">
                        <div class="col-xs-4 bg-info text-center"  style="min-height: 120px;">
                            <em class="fa fa-film fa-2x"  style="padding-top: 40px;"></em>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel-body text-center">
                                <h4 class="mt0">DOCUMENTAIRE FR</h4>
                                <p class="mb0 text-muted"><?= $nb_doc_fr; ?> documentaires</p>

                            </div>
                        </div>
                        <div class="col-xs-2 bg-info text-center"  style="min-height: 120px;padding-top: 20px">
                            <h4 class="mt0">DATA</h4>
                            <p class="mb0 text-muted"><?= $data_doc_fr; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>

        </div>    

    </section>
         
             <?php 
            
              require dirname(__FILE__) . chemin_controleur . $module . "/" . $action . ".php";   ?>

        <!-- END panel-->
    </section>
    <!-- END Page content-->
</section>
<!-- END Main section-->

