<!-- START aside--><aside class="aside">    <!-- START Sidebar (left)-->    <nav class="sidebar">        <ul class="nav">            <!-- START user info-->            <li>                <div data-toggle="collapse-next" class="item user-block has-submenu">                    <!-- User picture-->                    <div class="user-block-picture">                        <img src="<?= $url_espace_admin; ?>/app/img/user/02.jpg" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle"  style="margin-left:50px">                        <!-- Status when collapsed-->                        <div class="user-block-status">                            <div class="point point-success point-lg"></div>                        </div>                    </div>                    <!-- Name and Role-->                    <div class="user-block-info"  style="margin-left:15px">                        <span class="user-block-name item-text">CHACHIA ABDELILAH</span>                        <span class="user-block-role"  style="margin-left:15px">Developpeur PHP</span>                    </div>                </div>                <!-- START User links collapse-->                <ul class="nav collapse">                    <li><a href="#">Profile</a>                    </li>                    <li><a href="#">Settings</a>                    </li>                    <li><a href="#">Notifications<div class="label label-danger pull-right">120</div></a>                    </li>                    <li><a href="#">Messages<div class="label label-success pull-right">300</div></a>                    </li>                    <li class="divider"></li>                    <li><a href="index.php?module=Membre&action=deconnection">Deconnection</a>                    </li>                </ul>                <!-- END User links collapse-->            </li>            <!-- END user info-->            <!-- START Menu-->            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=Iptv&action=all_chaines" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                     <em class="fa fa-dashboard"></em>                                    <span class="item-text">IPTV</span>                </a>                <ul class="nav collapse ">                    <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=Iptv&action=all_chaines" title="Default" data-toggle="" class="no-submenu">                            <span class="item-text">LA LISTE DES CHAINES</span>                           </a>                    </li>                </ul>            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=RadioWeb&action=all_radio" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                     <em class="fa fa-dashboard"></em>                                    <span class="item-text">RADIO WEB</span>                </a>                <ul class="nav collapse ">                    <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=RadioWeb&action=all_radio" title="Default" data-toggle="" class="no-submenu">                            <span class="item-text">LA LISTE DES RADIO</span>                           </a>                    </li>                </ul>            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=Films&action=all_films" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                     <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nbr_films; ?></div>                    <span class="item-text">FILMS</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                    <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=Films&action=all_films" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES FILMS</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=Cartoon&action=all_cartoon" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                    <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nbr_cartoon; ?></div>                    <span class="item-text">CARTOON</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                 <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=Cartoon&action=all_cartoon" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES CARTOON</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=SerieTv&action=all_serie_tv" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                    <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nbr_serie_tv; ?></div>                    <span class="item-text">SERIE TV</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=SerieTv&action=all_serie_tv" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES SERIES TV</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=DocumentaireFr&action=all_serie_tv" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                    <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nb_doc_fr; ?></div>                    <span class="item-text">Documentaire TV</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=DocumentaireFr&action=all_documentaire" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES DOCUMENTAIRE TV</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=FilmsArabic&action=all_films_arabic" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                    <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nb_doc_fr; ?></div>                    <span class="item-text">FILMS ARABIC</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=FilmsArabic&action=all_films_arabic" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES FILMS ARABIC</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <li>                <a href="<?= $url_espace_admin; ?>/index.php?module=FilmsHindo&action=all_films_hindo" title="Dashboard" data-toggle="collapse-next" class="has-submenu">                    <em class="fa fa-dashboard"></em>                    <div class="label label-primary pull-right"><?= $nb_doc_fr; ?></div>                    <span class="item-text">FILMS HINDO</span>                </a>                <!-- START SubMenu item-->                <ul class="nav collapse ">                                <li>                        <a href="<?= $url_espace_admin; ?>/index.php?module=FilmsHindo&action=all_films_hindo" title="No Sidebar" data-toggle="" class="no-submenu">                            <span class="item-text">LISTE DES FILMS HINDO</span>                        </a>                    </li>                </ul>                <!-- END SubMenu item-->            </li>            <!-- END Menu-->        </ul>    </nav>    <!-- END Sidebar (left)--></aside><!-- End aside-->