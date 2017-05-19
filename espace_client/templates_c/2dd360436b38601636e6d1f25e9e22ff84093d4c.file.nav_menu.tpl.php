<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-10-06 08:52:14
         compiled from "vues/nav_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56652082556082f088022d0-24329050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dd360436b38601636e6d1f25e9e22ff84093d4c' => 
    array (
      0 => 'vues/nav_menu.tpl',
      1 => 1444114330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56652082556082f088022d0-24329050',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56082f0880f7d5_65064513',
  'variables' => 
  array (
    'url_absolu' => 0,
    'badge' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56082f0880f7d5_65064513')) {function content_56082f0880f7d5_65064513($_smarty_tpl) {?><div class="container-fluid">
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
                <a href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
index.html" class="dropdown-toggle">
                    <i class="fa fa-home"></i> ACCUEIL
                </a>
            </li>
            <li class="dropdown">
                <a
                    href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
commandes.html"
                    class="dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> Mes commandes
                </a>
            </li> 
            <li class="dropdown">
                <a
                    href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
contact.html"
                    class="dropdown-toggle"><i class="fa fa-pencil-square-o"></i> Nous contacter
                </a>
            </li> 
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
                    <li role="presentation" class="dropdown-header"><h4 style="color:blue">MON COMPTE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
profil.html"><span
                                class="glyphicon glyphicon-cog"></span> MON PROFIL</a></li>
                   <!-- <li><a href="index.php?module=membre&action=modif_profil"><span
                   class="glyphicon glyphicon-edit"></span> Modifier mon profil</a></li>--> <br>         
                    <li role="presentation" class="dropdown-header"><h4 style="color:blue">MA
                            MESSAGERIE</h4></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
messages-recus.html"><span class="glyphicon glyphicon-envelope"></span>
                            Mes messages re&ccedil;us <span class="badge" id='nbre_messages'><?php echo $_smarty_tpl->tpl_vars['badge']->value;?>
</span></a>
                    </li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
messages-envoyes.html"><span class="glyphicon glyphicon-send"></span> Mes messages envoy&eacute;s</a></li>

                </ul>
            </li>

            <li class="dropdown">
                <a   href="<?php echo $_smarty_tpl->tpl_vars['url_absolu']->value;?>
deconnection.html"    class="dropdown-toggle">
                    <span class="glyphicon glyphicon-off"></span>D&Eacute;CONNECTION
                </a>
            </li>
        </ul>

    </div>
</div>


<?php }} ?>
