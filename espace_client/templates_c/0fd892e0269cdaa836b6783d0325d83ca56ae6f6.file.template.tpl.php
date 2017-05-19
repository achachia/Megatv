<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-10-01 17:54:19
         compiled from "/home/megatvfr/public_html/espace_client/vues/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53403213456082f080e7707-63051011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fd892e0269cdaa836b6783d0325d83ca56ae6f6' => 
    array (
      0 => '/home/megatvfr/public_html/espace_client/vues/template.tpl',
      1 => 1443714854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53403213456082f080e7707-63051011',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56082f086f6826_54596561',
  'variables' => 
  array (
    'head' => 0,
    'contenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56082f086f6826_54596561')) {function content_56082f086f6826_54596561($_smarty_tpl) {?><!DOCTYPE html>
<html lang="fr">
    <head>
       <?php echo $_smarty_tpl->tpl_vars['head']->value;?>

    </head>    
    <body> 
        <p>&nbsp;</p>
        <div id="page" class="container">

            <header id="header" class="row"  style="height: 200px;background: url(http://megatv.fr/media/images/nos_chaines_tv.png)"></header>

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
