<div class="navbar yamm navbar-default navbar-fixed-top">

    <div class="navbar-header">
        <button type="button" data-toggle="collapse"
                data-target="#navbar-collapse-1" class="navbar-toggle">
            <span class="icon-bar"></span><span class="icon-bar"></span><span
                class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">MEGACOURS</a>
    </div>
    <div id="navbar-collapse-1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <!-- Classic list -->
            <li><a href="index.php"><span	class="glyphicon glyphicon-home"></span> ACCUEIL</a></li>
            <!-- ----Menu ClIENTS -->
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle"><span class="glyphicon glyphicon-user"></span>CLIENTS<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Content container to add padding -->
                        <div class="yamm-content">
                            <div class="row">
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>CLIENTS</strong>
                                        </p>
                                    </li>
                                    <li>
                                        <a href='index.php?module=clients&action=all_view_clients'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span> Liste des clients</a></li>
                                    <li><a href='index.php?module=clients&action=add_client'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une fiche client</a></li>
                                </ul>
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>B&Eacute;N&Eacute;FICIAIRES</strong>
                                        </p>
                                    </li>
                                    <li><a href='index.php?module=beneficiaires&action=all_view_beneficiaires'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Liste des beneficiaires</a></li>
                                    <li><a href='index.php?module=beneficiaires&action=add_beneficiaire'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une fiche beneficiaire</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul></li>
            <!-- **************************** -->
            <!-- ----Menu INTERVENANTS -->
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle"><span class="glyphicon glyphicon-user"></span>INTERVENANTS<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Content container to add padding -->
                        <div class="yamm-content">
                            <div class="row">
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>INTERVENANTS</strong>
                                        </p>
                                    </li>
                                    <li><a
                                            href='index.php?module=intervenants&action=all_view_intervenants'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Liste intervenants</a></li>
                                    <li><a
                                            href='index.php?module=intervenants&action=add_intervenant'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une fiche intervenant</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul></li>
            <!-- **************************** -->
            <!-- ----Menu INTERVENTIONS -->
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle">INTERVENTIONS<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Content container to add padding -->
                        <div class="yamm-content">
                            <div class="row">
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>INTERVENTIONS</strong>
                                        </p>
                                    </li>
                                    <li>
                                    <a
                                            href='index.php?module=interventions&action=all_view_interventions'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Liste interventions</a>
                                    </li>
                                    <li>
                                    <a
                                            href='index.php?module=interventions&action=add_intervention'>
                                            <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une fiche intervention</a>
                                    </li>
                                </ul>
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>LES RAPPORTS</strong>
                                        </p>
                                    </li>
                                     <li>
                                     <a href='index.php?module=rapports&action=rapport_heures'><span class="glyphicon glyphicon-chevron-right"> </span> Rapport Heures</a>
                                     </li>
                                    <li>
                                        <a href='index.php?module=rapports&action=rapport_e_coupon'> <span class="glyphicon glyphicon-chevron-right"> </span> Rapports E-coupons</a>
                                    </li>  
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul></li>
            <!-- ******************************************** -->
            <!-- ----Menu FACTURATION -->
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle">FACTURATION<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Content container to add padding -->
                        <div class="yamm-content">
                            <div class="row">                         
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>LES FACTURES</strong>
                                        </p>
                                    </li>
                                    <li><a href='index.php?module=facturation&action=add_facture'> <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une facture</a></li>
                                    <li><a href='index.php?module=facturation&action=all_view_factures'> <span class="glyphicon glyphicon-chevron-right"> </span>  Liste des factures</a></li>
                                </ul>
                                <ul class="col-sm-2 list-unstyled">
                                    <li>
                                        <p>
                                            <strong>LES ACOMPTES</strong>
                                        </p>
                                    </li>
                                    <li><a href='index.php?module=acomptes&action=add_acompte'> <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er un acompte</a></li>
                                    <li><a href='index.php?module=acomptes&action=all_view_acompte'> <span class="glyphicon glyphicon-chevron-right"> </span>  Liste des acomptes</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- ******************************************** -->
            <!--<li><a href="./modele.php"> Template</a></li>-->				
            <li><a href="./controleurs/membre/deconnection.php"><span	class="glyphicon glyphicon-off"></span> DECONNECTION</a></li>
        </ul>
    </div>
</div>























