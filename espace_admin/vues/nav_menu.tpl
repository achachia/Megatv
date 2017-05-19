<div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span> <span
                class="icon-bar"></span> <span class="icon-bar"></span> <span
                class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse">

        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="index.php" class="dropdown-toggle">
                    <i class="fa fa-home fa-fw"></i> ACCUEIL
                </a>
            </li>
            <!--     <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" > <span class="glyphicon glyphicon-edit"></span> Comptes-rendus<span class="caret"></span></a>	
                     <ul class="dropdown-menu" role="menu">
                         <li><a href="index.php?module=compte_rendu&action=all_view_compte_rendu"  ><span class="glyphicon glyphicon-th-list"></span> Liste compte-rendus</a></li>
                         <li><a href="index.php?module=compte_rendu&action=all_view_bilan_prem_cours"  ><span class="glyphicon glyphicon-th-list"></span> Les bilans de 1er cours</a></li>
                     </ul>
                 </li>-->
            <li class="dropdown">
                <a
                    href="index.php?module=clients&action=all_view_clients"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Mes clients
                </a>
            </li>
            <li class="dropdown">
                <a
                    href="index.php?module=clients&action=all_view_clients"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Les abonnements
                </a>
            </li>
            <li class="dropdown">
                <a
                    href="index.php?module=clients&action=all_view_clients"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Nous contacter
                </a>
            </li>
            <!--      <li class="dropdown">
                      <a href="test.php" class="dropdown-toggle">
                          <i class="fa fa-home fa-fw"></i> Test upload
                      </a>
                  </li>-->
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <!----------------------------------------------->

{*        <li class="dropdown dropdown-list">
                <a href="#" data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle">
                    <em class="fa fa-envelope"></em>
                    <div class="label label-danger">300</div>
                </a>
                <!-- START Dropdown menu-->
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">You have 5 new messages</li>
                    <li>
                        <div class="scroll-viewport">
                            <!-- START list group-->
                            <div class="list-group scroll-content">
                                <!-- START list group item-->
                                <a href="#" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img style="width: 48px; height: 48px;" src="./../media/images/test_image.jpg" alt="Image" class="media-object img-rounded">
                                        </div>
                                        <div class="media-body clearfix">
                                            <small class="pull-right">2h</small>
                                            <strong class="media-heading text-primary">
                                                <div class="point point-success point-lg"></div>Sheila Carter</strong>
                                            <p class="mb-sm">
                                                <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                                <!-- START list group item-->
                                <a href="#" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img style="width: 48px; height: 48px;" src="app/img/user/04.jpg" alt="Image" class="media-object img-rounded">
                                        </div>
                                        <div class="media-body clearfix">
                                            <small class="pull-right">3h</small>
                                            <strong class="media-heading text-primary">
                                                <div class="point point-success point-lg"></div>
                                                Rich Reynolds</strong>
                                            <p class="mb-sm">
                                                <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                                <!-- START list group item-->
                                <a href="#" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img style="width: 48px; height: 48px;" src="app/img/user/03.jpg" alt="Image" class="media-object img-rounded">
                                        </div>
                                        <div class="media-body clearfix">
                                            <small class="pull-right">4h</small>
                                            <strong class="media-heading text-primary">
                                                <div class="point point-danger point-lg"></div>
                                                Beverley Pierce</strong>
                                            <p class="mb-sm">
                                                <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                                <!-- START list group item-->
                                <a href="#" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img style="width: 48px; height: 48px;" src="app/img/user/05.jpg" alt="Image" class="media-object img-rounded">
                                        </div>
                                        <div class="media-body clearfix">
                                            <small class="pull-right">4h</small>
                                            <strong class="media-heading text-primary">
                                                <div class="point point-danger point-lg"></div>Perry Cole</strong>
                                            <p class="mb-sm">
                                                <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                                <!-- START list group item-->
                                <a href="#" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img style="width: 48px; height: 48px;" src="app/img/user/06.jpg" alt="Image" class="media-object img-rounded">
                                        </div>
                                        <div class="media-body clearfix">
                                            <small class="pull-right">4h</small>
                                            <strong class="media-heading text-primary">
                                                <div class="point point-danger point-lg"></div>Carolyn Carpenter</strong>
                                            <p class="mb-sm">
                                                <small>Cras sit amet nibh libero, in gravida nulla. Nulla...</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                            </div>
                            <!-- END list group-->
                        </div>
                    </li>
                    <!-- START dropdown footer-->
                    <li class="p">
                        <a href="#" class="text-center">
                            <small class="text-primary">READ ALL</small>
                        </a>
                    </li>
                    <!-- END dropdown footer-->
                </ul>
                <!-- END Dropdown menu-->
            </li>
            <!------------------------------------------------------------>
            <!-- START Alert menu-->
            <li class="dropdown dropdown-list">
                <a href="#" data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle">
                    <em class="fa fa-bell"></em>
                    <div class="label label-info">120</div>
                </a>
                <!-- START Dropdown menu-->
                <ul class="dropdown-menu">
                    <li>
                        <!-- START list group-->
                        <div class="list-group">
                            <!-- list item-->
                            <a href="#" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left">
                                        <em class="fa fa-envelope-o fa-2x text-success"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading">Unread messages</div>
                                        <p class="m0">
                                            <small>You have 10 unread messages</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- list item-->
                            <a href="#" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left">
                                        <em class="fa fa-cog fa-2x"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading">New settings</div>
                                        <p class="m0">
                                            <small>There are new settings available</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- list item-->
                            <a href="#" class="list-group-item">
                                <div class="media">
                                    <div class="pull-left">
                                        <em class="fa fa-fire fa-2x"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading">Updates</div>
                                        <p class="m0">
                                            <small>There are
                                                <span class="text-primary">2</span>new updates available</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- last list item -->
                            <a href="#" class="list-group-item">
                                <small>Unread notifications</small>
                                <span class="badge">14</span>
                            </a>
                        </div>
                        <!-- END list group-->
                    </li>
                </ul>
                <!-- END Dropdown menu-->
            </li>*}




            <!------------------------------------------------------>
       <!--     <li class="dropdown">
                <a href="#"    data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle"> 
                    <span class="glyphicon glyphicon-user"></span>
                    MON COMPTE <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation" class="dropdown-header"><h4>MON COMPTE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="index.php?module=membre&action=mon_compte"><span
                                class="glyphicon glyphicon-cog"></span> MON PROFIL</a></li>
                    <li><a href="index.php?module=membre&action=modif_profil"><span
                                class="glyphicon glyphicon-edit"></span> Modifier mon profil</a></li>          
                    <li role="presentation" class="dropdown-header"><h4>MA
                            MESSAGERIE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#"><span class="glyphicon glyphicon-envelope"></span>
                            Mes messages recus <span class="badge" id='nbre_messages'><?php
                                if (isset($badge)) {
                                echo $badge;
                                }
                                ?></span></a>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-envelope"></span>
                            Mes messages envoyes</a></li>              
                </ul>
            </li>-->

            <li class="dropdown">
                <a   href="index.php?module=membre&action=deconnection"    class="dropdown-toggle">
                    <span class="glyphicon glyphicon-off"></span>DECONNECTION
                </a>
            </li>
        </ul>

    </div>
</div>


