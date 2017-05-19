<?php

//$badge = nombre_messages_non_lus ( $_SESSION ['membre'] ['code_intervenant'] );
if ($action == 'mon_compte' || $action == 'modif_profil') {
    $infos_intervenant = infos_intervenant($_SESSION ['membre'] ['code_intervenant']);
    if (isset($_POST['email']) && !empty($_POST["email"])) {
        $reponse = update_profil($_POST);
        $objet['message'] = array('reponse' => $reponse);
        header('Content-type: application/json');
        echo json_encode($objet);
    }
} elseif ($action == 'disponibilite') {
    $liste_plannig_intervenant = liste_plannig_intervenant($_SESSION ['membre'] ['code_intervenant']);
} elseif ($action == 'view_bilan_prestation_eleve') {
    $bilan_prestation_eleve = bilan_prestation_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
    $infos_eleve = infos_eleve($_SESSION ['membre'] ['code_intervenant'], $_GET['code_eleve']);
} elseif ($action == 'contact_famille') {
    $infos_distinataire = infos_famille_contact($_SESSION ['membre'] ['code_intervenant']);
    if (isset($_POST['code_distinataire']) && !empty($_POST["code_distinataire"])) {
        $reponse = post_msg_famille($_POST);
        $objet['message'] = array('reponse' => $reponse);
        header('Content-type: application/json');
        echo json_encode($objet);
    }
} elseif ($action == 'contact_conseiller') {
    $infos_distinataire = infos_conseiller_contact($_SESSION['membre']['code_intervenant']);
      if (isset($_POST['code_distinataire']) && !empty($_POST["code_distinataire"])) {
        $reponse = post_msg_conseiller($_POST);
        $objet['message'] = array('reponse' => $reponse);
        header('Content-type: application/json');
        echo json_encode($objet);
    }
}
?>

