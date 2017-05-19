<?php

require 'modele.php';

function infos_intervenant($code_intervenant) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT civilite,nom,prenom,date_naissance,tel_fixe,tel_portable,email,fax,adresse,adresse_suite,site_web,CP,ville,pays,numero_sec_sc,banque,cle_rib,n_compte,guichet FROM intervenants WHERE code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['civilité'] = $enregistrement['civilite'];
        $infos['nom'] = $enregistrement['nom'];
        $infos['prenom'] = $enregistrement['prenom'];
        $infos['date_naissance'] = $enregistrement['date_naissance'];
        $infos['tel_fixe'] = $enregistrement['tel_fixe'];
        $infos['tel_portable'] = $enregistrement['tel_portable'];
        $infos['fax'] = $enregistrement['fax'];
        $infos['email'] = $enregistrement['email'];
        $infos['site_web'] = $enregistrement['site_web'];
        $infos['adresse'] = $enregistrement['adresse'];
        $infos['adresse_suite'] = $enregistrement['adresse_suite'];
        $infos['code_postale'] = $enregistrement['CP'];
        $infos['ville'] = $enregistrement['ville'];
        $infos['pays'] = $enregistrement['pays'];
        $infos['numero_sec_sc'] = $enregistrement['numero_sec_sc'];
        $infos['banque'] = $enregistrement['banque'];
        $infos['cle_rib'] = $enregistrement['cle_rib'];
        $infos['guichet'] = $enregistrement['guichet'];
        $infos['n_compte'] = $enregistrement['n_compte'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function liste_plannig_intervenant($code_intervenant) {
    global $cxn;
    try {
        $sql = " SELECT * FROM dispo_hebdo_intervenant WHERE code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {

            while ($enregistrement = $select->fetch()) {
                $periode = $enregistrement['periode'];
                $diponibilite[$periode]['lundi'] = $enregistrement['lundi'];
                $diponibilite[$periode]['mardi'] = $enregistrement['mardi'];
                $diponibilite[$periode]['mercredi'] = $enregistrement['mercredi'];
                $diponibilite[$periode]['jeudi'] = $enregistrement['jeudi'];
                $diponibilite[$periode]['vendredi'] = $enregistrement['vendredi'];
                $diponibilite[$periode]['samedi'] = $enregistrement['samedi'];
                $diponibilite[$periode]['dimanche'] = $enregistrement['dimanche'];
            }
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $diponibilite;
}

function infos_famille_contact($code_intervenant) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT DISTINCT membre_famille.nom AS nom,membre_famille.prenom AS prenom,membre_famille.code_famille  AS code FROM eleve_intervenant,membre_famille,eleve_famille WHERE eleve_famille.code_eleve=eleve_intervenant.code_eleve  AND  eleve_famille.code_famille=membre_famille.code_famille  AND  eleve_intervenant.code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos[$i]['famille'] = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
            $infos[$i]['code_famille'] = $enregistrement['code'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function infos_conseiller_contact($code_intervenant) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT nom,prenom,conseiller_peda.code_conseiller  AS code FROM eleve_intervenant,conseiller_peda WHERE conseiller_peda.code_conseiller=eleve_intervenant.code_conseiller AND    code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['conseiller_peda'] = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
        $infos['code_conseiller'] = $enregistrement['code'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function nombre_messages_non_lus($code_user) {
    global $cxn;
    try {
        $sql = " SELECT id_message FROM message_recus WHERE etat='0' AND destinataire='" . $code_user . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $nombre_message = $nb;
        } else {
            $nombre_message = 0;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $nombre_message;
}

function generer_token() {
    global $cxn;
    $token = uniqid(md5(rand()), true);
    $agent = TRUE;
    while ($agent) {
        $sql = "SELECT token FROM message_recus  WHERE token='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = uniqid(md5(rand()), true);
        } else {
            $agent = FALSE;
        }
    }
    return $token;
}

function verification_id_message($id_message) {
    global $cxn;
    $sql = "SELECT id_message FROM message_recus  WHERE id_message='" . $id_message . "' ";
    $select = $cxn->query($sql);
    $nb = $select->rowCount();
    return $nb;
}

function recuperation_suivi($id_message) {
    global $cxn;
    try {
        // requete prepare
        $sql = " SELECT suivi_reponse FROM message_recus  WHERE id_message=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $id_message;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $suivi = $enregistrement['suivi_reponse'];
        if ($suivi == '') {
            $suivi_id = $id_message;
        } else {
            $suivi_id.=$suivi . "-" . $id_message;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $suivi_id;
}

function recuperation_id_message_post($token) {
    global $cxn;
    try {
        // requete prepare
        $sql = " SELECT id_message FROM message_recus  WHERE token=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $token;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $id_message = $enregistrement['id_message'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $id_message;
}

function suivi_reponse($id_message) {
    $nb = verification_id_message($id_message);
    if ($nb > 0) {
        $suivi_id = recuperation_suivi($id_message);
    }
    return $suivi_id;
}

function post_msg_famille($post){
    $etat = TRUE;
    //contenu vide
    
    return $etat;
}

function post_msg_conseiller($post){
    $etat = TRUE;
    //contenu vide
    
    return $etat;
}

function update_profil($post){
    $etat = TRUE;
    //contenu vide
    
    return $etat;
}



?>

