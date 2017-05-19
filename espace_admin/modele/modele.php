<?php



function infos_page($action) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT title_page,breadcrumb FROM infos_page WHERE action=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $action;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['title_page'] = $enregistrement['title_page'];
        $infos['breadcrumb'] = $enregistrement['breadcrumb'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function infos_agence() {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT marque,tel_fixe,tel_portable,adresse,code_postale,ville,pays,email FROM agences WHERE id_agence='1'  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['marque'] = $enregistrement ['marque'];
        $infos ['tel_fixe'] = $enregistrement ['tel_fixe'];
        $infos ['tel_portable'] = $enregistrement ['tel_portable'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['email'] = $enregistrement ['email'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}
