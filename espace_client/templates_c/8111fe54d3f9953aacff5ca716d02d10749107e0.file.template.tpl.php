<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-09-18 13:02:41
         compiled from "/home/megacour/public_html/iptv/espace_client/vues/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131842413755fbef517f5b15-81846403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8111fe54d3f9953aacff5ca716d02d10749107e0' => 
    array (
      0 => '/home/megacour/public_html/iptv/espace_client/vues/template.tpl',
      1 => 1442573664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131842413755fbef517f5b15-81846403',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'head' => 0,
    'contenu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55fbef51963644_04073651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fbef51963644_04073651')) {function content_55fbef51963644_04073651($_smarty_tpl) {?><!DOCTYPE html>
<html lang="fr">
    <head>
       <?php echo $_smarty_tpl->tpl_vars['head']->value;?>

    </head>    
    <body> 
        <p>&nbsp;</p>
        <div id="page" class="container">

            <header id="header" class="row"  style="height: 200px;background: url(./../media/images/nos_chaines_tv.png)"></header>

            <!-- inclusion le fichier nav -->
            <nav id="menu" class="navbar navbar-default" role="navigation">
                <?php echo $_smarty_tpl->getSubTemplate ("vues/nav_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </nav>    
            <ul class="breadcrumb">
                <?php echo $_smarty_tpl->getSubTemplate ("vues/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </ul>
           
            <div id="contenu">
                 <?php echo $_smarty_tpl->tpl_vars['contenu']->value;?>
                
            </div>

            <div class="clearfix">&nbsp;</div>
            <footer id="footer" class="row">
               <?php echo $_smarty_tpl->getSubTemplate ("vues/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </footer>
        </div>  
        <p>&nbsp;</p>
       <!-- <?php echo '<script'; ?>
 type="text/javascript">
            var auto_refresh = setInterval(
                    function () {
                        $('#nbre_messages').load('./vues/membre/record_count_message.php').fadeIn("slow");
                    }, 1000000);

        <?php echo '</script'; ?>
>-->
    </body>
</html>

<?php }} ?>
