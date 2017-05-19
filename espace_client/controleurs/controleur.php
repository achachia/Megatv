<?php

// controleur principal
/* * ****************************************************** */
if (empty($module) && empty($action)) {

    $module = 'home';
    $action = 'home';
}
if ($route) {

    require $root_dir . chemin_modele . $module . '.php';

    require $root_dir . chemin_controleur . $module . '.php';
}


/* * *************************************************************** */

if (sizeof($_POST) <= 0) {
   

    $infos_page = infos_page($module, $action);
    $badge = nombre_messages_non_lus($_SESSION ['client'] ['code_user']);
    require root_web . '/../librairie/Smarty/Smarty.class.php';
    $smarty = new Smarty;
    //var_dump($smarty);
    // $smarty->force_compile = true; 
    //$smarty->debugging = true;
    $smarty->cache_dir = $root_dir . '/cache/';
    //$smarty->caching = true; 
    $smarty->cache_lifetime = 120;
    $smarty->template_dir = '/vues/';

    ob_start();

    if (!$route) {     
        include $root_dir . chemin_vue . 'erreur_404.php';
    } else {
        if (!empty($module) && !empty($action)) {
            
            include $root_dir . chemin_vue . $module . '/' . $action . '.php';
        }
        if (empty($module) && empty($action)) {         

            include $root_dir . chemin_vue . 'home/home.php';
        }
    }

    $contenu = ob_get_clean();

    ob_start();
    $head = include root_web . "/vues/head.php";
    $head = ob_get_clean();
    // include root_web . "/vues/template.php";  
    //$breadcrumb = '<li><a href="#">Accueil</a> <span  class="arrow"></span></li>';
    //$breadcrumb .= '<li><a href="#">toto</a> <span  class="arrow"></span></li>';

    $breadcrumb = $infos_page['breadcrumb'];

    $smarty->assign('breadcrumb', $breadcrumb);
    $smarty->assign('dir_media', dir_media);
    $smarty->assign('module', $module);
    $smarty->assign('action', $action);
    $smarty->assign('badge', $badge);
    $smarty->assign('url_absolu', $url_absolu);
    $smarty->assign('head', $head);
    $smarty->assign('contenu', $contenu);

    $smarty->display($root_dir . '/vues/template.tpl');
}
?>