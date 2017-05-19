<?php
function liste_famille($code_conseiller) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,membre_famille.code_famille AS code_famille  FROM membre_famille,famille_conseiller  WHERE membre_famille.code_famille=famille_conseiller.code_famille AND famille_conseiller.code_conseiller=:param  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_conseiller;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_famille'] = $enregistrement['code_famille'];
            $liste[$i]['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}
?>
