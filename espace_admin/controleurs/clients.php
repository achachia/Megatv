<?php

if ($action == 'all_view_clients') {
    $liste_clients=array();
    //$liste_clients = liste_clients($_SESSION ['user_commercial'] ['code_user']);
} elseif ($action == 'view_fiche_eleve') {
    $infos_eleve = infos_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
} elseif ($action == 'view_bilan_prestation_eleve') {
    $bilan_prestation_eleve = bilan_prestation_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
    $identite_eleve = identite_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
    
}
?>


