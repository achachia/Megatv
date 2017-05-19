<?php
require_once './../../../connection/config.php';
if (isset($_POST['code_intervenant'])) {
        $code_intervenant=$_POST['code_intervenant'];
        $sql  = "  SELECT intervenants.civilite,CONCAT(intervenants.nom, '.',intervenants.prenom) AS identite_intervenant ";
        $sql .= "  ,intervenants.tel_fixe,intervenants.tel_portable,intervenants.email,liste_statut_intervenant.nom_statut  ";
        $sql .= " FROM intervenants,liste_statut_intervenant ";
        $sql .= " WHERE intervenants.statut=liste_statut_intervenant.id_statut ";   
        $sql .= " AND code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_intervenant);
        $resultat->execute();
        $enregistrement = $resultat->fetch(); 
        $infos ['civilite'] = html_entity_decode($enregistrement ['civilite']);
        $infos ['identite_intervenant'] = html_entity_decode($enregistrement ['identite_intervenant']);       
        $infos['email'] = ($enregistrement['email'] != NULL) ? html_entity_decode($enregistrement['email']) : '-------------------------------';
        $infos['tel_portable'] = ($enregistrement['tel_portable'] != NULL) ? html_entity_decode($enregistrement['tel_portable']) : '-------------------------------';
        $infos['tel_fixe'] = ($enregistrement['tel_fixe'] != NULL) ? html_entity_decode($enregistrement['tel_fixe']) : '-------------------------------';
        $infos['statut_peda'] = ($enregistrement['nom_statut'] != NULL) ? html_entity_decode($enregistrement['nom_statut']) : '-------------------------------';

}
$objet['fiche_intervenant'] = $infos;
header('Content-type: application/json');
echo json_encode($objet);
?>

