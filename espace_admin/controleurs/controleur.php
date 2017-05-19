<?php

// controleur principal
  
          
if (empty($module) && empty($action)) {

 
    require $root_dir . chemin_modele . 'home.php';

    require $root_dir . chemin_controleur . 'home.php';
}

elseif (!empty($module) && !empty($action)) {
   
    if ($route) {
        
        require $root_dir . chemin_modele . $module . '.php';  
        
        require $root_dir . chemin_controleur . $module . '.php';
        
      
        
    }
}


/* * *************************************************************** */

if (sizeof($_POST) <= 0) {
    
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
    $head=include root_web . "/vues/head.php";
    $head = ob_get_clean(); 
    // include root_web . "/vues/template.php";  
  
    $breadcrumb = '<li><a href="#">Accueil</a> <span  class="arrow"> </span></li>';
    $smarty->assign('breadcrumb', $breadcrumb);
    $smarty->assign('dir_media', dir_media);
    $smarty->assign('module', $module);
    $smarty->assign('action', $action);
    $smarty->assign('head', $head);
    $smarty->assign('contenu', $contenu);
    
    if ($module = 'clients' && $action = 'all_view_clients') {
        $smarty->assign('liste_clients', $liste_clients);
    }
    if ($module = 'eleves' && $action = 'view_bilan_prestation_eleve') {
        $smarty->assign('bilan_prestation_eleve', $bilan_prestation_eleve);
    }
    if ($module = 'compte_rendu' && $action = 'all_view_bilan_prem_cours') {
        $smarty->assign('mes_bilan_prem_cours', $mes_bilan_prem_cours);
    }
    $smarty->display($root_dir . '/vues/template.tpl');
}
?>