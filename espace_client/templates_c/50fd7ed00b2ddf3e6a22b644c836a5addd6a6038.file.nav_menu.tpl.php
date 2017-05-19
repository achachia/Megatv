<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-09-23 09:05:10
         compiled from "vues/nav_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175475965755fbef51965cb8-97757836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50fd7ed00b2ddf3e6a22b644c836a5addd6a6038' => 
    array (
      0 => 'vues/nav_menu.tpl',
      1 => 1442991851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175475965755fbef51965cb8-97757836',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55fbef5196bcd0_13170767',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fbef5196bcd0_13170767')) {function content_55fbef5196bcd0_13170767($_smarty_tpl) {?><div class="container-fluid">
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
                    href="index.php?module=commandes&action=all_view_commandes"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Mes commandes
                </a>
            </li>
         <!--   <li class="dropdown">
                <a
                    href="index.php?module=clients&action=all_view_clients"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Mes abonnements
                </a>
            </li>-->
            <li class="dropdown">
                <a
                    href="index.php?module=membre&action=nous_contacter"
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






            <!------------------------------------------------------>
       <li class="dropdown">
                <a href="#"    data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle"> 
                    <span class="glyphicon glyphicon-user"></span>
                    MON COMPTE <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation" class="dropdown-header"><h4>MON COMPTE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="index.php?module=membre&action=mon_compte"><span
                                class="glyphicon glyphicon-cog"></span> MON PROFIL</a></li>
                   <!-- <li><a href="index.php?module=membre&action=modif_profil"><span
                                class="glyphicon glyphicon-edit"></span> Modifier mon profil</a></li>-->          
                    <li role="presentation" class="dropdown-header"><h4>MA
                            MESSAGERIE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="#"><span class="glyphicon glyphicon-envelope"></span>
                            Mes messages recus <span class="badge" id='nbre_messages'><?php echo '<?php'; ?>

                                if (isset($badge)) {
                                echo $badge;
                                }
                                <?php echo '?>'; ?>
</span></a>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-send"></span>
                            Mes messages envoyes</a></li>              
                </ul>
            </li>

            <li class="dropdown">
                <a   href="index.php?module=membre&action=deconnection"    class="dropdown-toggle">
                    <span class="glyphicon glyphicon-off"></span>DECONNECTION
                </a>
            </li>
        </ul>

    </div>
</div>


<?php }} ?>
