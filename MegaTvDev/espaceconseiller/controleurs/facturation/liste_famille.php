<?php
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$objet=array();
if (isset($_POST ['code_famille'])) {
    // liste des beneficiaires
    $liste = array();
    $sql = " SELECT code_eleve,nom,prenom  FROM eleve_famille  WHERE code_famille=:param ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = unhtmlentities($_POST ['code_famille']);
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $liste [$i] ['code_eleve'] = $enregistrement ['code_eleve'];
        $liste [$i] ['identite_eleve'] = html_entity_decode($enregistrement ['nom']) . "." . html_entity_decode($enregistrement ['prenom']);
        $i ++;
    }
    $objet ['liste_eleve'] = $liste;
}

if (isset($_POST ['code_eleve'])) {
    $code_eleve = unhtmlentities($_POST ['code_eleve']);
    $sql = " SELECT  prix_heure_normale.PU_HT  

             FROM  eleve_famille,liste_organisme_niveau,liste_niveau_option,prix_heure_normale 

             WHERE eleve_famille.niveau_peda=liste_niveau_option.id_option

             AND liste_niveau_option.id_organisme=liste_organisme_niveau.id_liste

             AND liste_organisme_niveau.prix_HT=prix_heure_normale.id_prix

             AND eleve_famille.code_eleve=:param";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = $code_eleve;
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $objet ['prix_heure'] = $enregistrement ['PU_HT'];
}

header('Content-type: application/json');
echo json_encode($objet);
?>