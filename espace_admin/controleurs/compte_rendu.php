<?php

//controleur secondaire

if ($action == 'all_view_compte_rendu') {    
    $mes_compte_rendu = mes_compte_rendu($_SESSION ['membre'] ['code_intervenant']);     
    $autres_compte_rendu = autres_compte_rendu($_SESSION ['membre'] ['code_intervenant']);
} elseif ($action == 'view_compte_rendu') {
    $objet  = detail_compte_rendu($_POST);  
    header('Content-type: application/json');
    echo json_encode($objet);
} elseif ($action == 'create_compte_rendu') {
    
    $liste_theme = liste_theme($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
    $liste_progression = liste_progression();
    $list_alerte_date_premier_cours = list_alerte_date_premier_cours($_SESSION ['membre'] ['code_intervenant']);
    $list_alerte_bilan_premier_cours = list_alerte_bilan_premier_cours($_SESSION ['membre'] ['code_intervenant']);
    $list_alerte_bilan_trimestrielle = list_alerte_bilan_trimestrielle($_SESSION ['membre'] ['code_intervenant']);
    if (sizeof($list_alerte_date_premier_cours) <= 0 && sizeof($list_alerte_bilan_premier_cours) <= 0 && sizeof($list_alerte_bilan_trimestrielle) <= 0) {
           $identite_eleve = identite_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
    } else {
        $lien = "http://" . $_SERVER ['HTTP_HOST'] . rtrim($_SERVER ['PHP_SELF'], '/\\');
        $lien = substr($lien, 0, - 9);
        $lien = $lien . "index.php";
        header("Location: $lien");
    }
} elseif ($action == 'edit_compte_rendu') {
    $infos_compte_rendu = infos_compte_rendu($_GET ['id_compte_rendu'], $_SESSION ['membre'] ['code_intervenant']);
} elseif ($action == 'update_compte_rendu') {
    $reponse = update_compte_rendu($_POST);
    $objet['message'] = array('reponse' => $reponse);
    header('Content-type: application/json');
    echo json_encode($objet);
} elseif ($action == 'check_compte_rendu') {
    $reponse = check_compte_rendu($_POST);
    $objet['message'] = array('reponse' => $reponse);    
    header('Content-type: application/json');
    echo json_encode($objet);
} elseif ($action == 'all_view_bilan_prem_cours') {
    $mes_bilan_prem_cours = mes_bilan_prem_cours($_SESSION ['membre'] ['code_intervenant']);
}

?>