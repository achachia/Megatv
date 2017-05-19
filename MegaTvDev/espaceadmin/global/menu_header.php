<div class="navbar yamm navbar-default navbar-fixed-top">

    <div class="navbar-header">
        <button type="button" data-toggle="collapse"
                data-target="#navbar-collapse-1" class="navbar-toggle">
            <span class="icon-bar"></span><span class="icon-bar"></span><span
                class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">MEGATV</a>
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
                            </div>
                        </div>
                    </li>
                </ul></li>
            <!-- **************************** -->
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle">COMMANDES<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Content container to add padding -->
                        <div class="yamm-content">
                            <div class="row" style="width:400px ">                         
                                <ul class="col-sm-2 list-unstyled"  style="width:300px ">
                                    <li>
                                        <p>
                                            <strong>COMMANDES MATERIELS</strong>
                                        </p>
                                    </li>                        
                                       <li><a href='index.php?module=commandes&action=all_view_commandes_materiel'> <span class="glyphicon glyphicon-chevron-right"> </span>  Liste des commandes</a></li>
                                       <li><a href='index.php?module=commandes&action=add_commande_materiel'> <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une nouvelle commande</a></li>
                                </ul>
                                <ul class="col-sm-2 list-unstyled" style="width:400px ">
                                    <li>
                                        <p>
                                            <strong>COMMANDES ABONNEMENTS</strong>
                                        </p>
                                    </li>
                                       <li><a href='index.php?module=commandes&action=all_view_commandes_abo'> <span class="glyphicon glyphicon-chevron-right"> </span>  Liste des commandes</a></li>
                                       <li><a href='index.php?module=commandes&action=add_commande_abo'> <span class="glyphicon glyphicon-chevron-right"> </span>  Cr&eacute;er une nouvelle commande</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
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

            <!-- ******************************************** -->
            <!--<li><a href="./modele.php"> Template</a></li>-->				
            <li><a href="./controleurs/membre/deconnection.php"><span	class="glyphicon glyphicon-off"></span> DECONNECTION</a></li>
        </ul>
    </div>
</div>























