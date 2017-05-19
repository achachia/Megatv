<?php

function nombre_messages_non_lus($code_user) {
    global $cxn;
    try {
        $sql = " SELECT id_message FROM MessagesClientsRecus WHERE etat_vue='0' AND code_user='" . $code_user . "' ";
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


function generer_code_MessagesClientsEnvoye() {
    global $cxn; 
    $token = random(6);
    $drapeau = TRUE;
    while ($drapeau) {
        $sql = "SELECT code_message FROM MessagesClientsEnvoye  WHERE code_message='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = random(6);
        } else {
            $drapeau = FALSE;
        }
    }
    return $token;
}
function generer_token_MessagesClientsEnvoye() {
    global $cxn;
    $token = uniqid(md5(rand()), true);  
    $drapeau = TRUE;
    while ($drapeau) {
        $sql = "SELECT token FROM MessagesClientsEnvoye  WHERE token='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = uniqid(md5(rand()), true); 
        } else {
            $drapeau = FALSE;
        }
    }
    return $token;
}
function generer_code_MessagesAdminRecus() {
    global $cxn;
    $token = random(6);
    $drapeau = TRUE;
    while ($drapeau) {
        $sql = "SELECT code_message FROM MessagesAdminRecus  WHERE code_message='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = random(6);
        } else {
            $drapeau = FALSE;
        }
    }
    return $token;
}
function generer_token_MessagesAdminRecus() {
    global $cxn;
    $token = uniqid(md5(rand()), true);  
    $drapeau = TRUE;
    while ($drapeau) {
        $sql = "SELECT token FROM MessagesAdminRecus  WHERE token='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = uniqid(md5(rand()), true); 
        } else {
            $drapeau = FALSE;
        }
    }
    return $token;
}

function generer_code_alerte($chaine) {
    global $cxn;
    $agent = TRUE;
    while ($agent) {
        try {
            $select = $cxn->query(" SELECT id_alerte FROM historiqueAlertesAdmin  WHERE code_alerte='" . $chaine . "' ");
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
            $objet ['message_debug'] [] = 'la requette N°6  SELECT ommandes_clients  dans la table e_coupon  a echoué';
        }
        $nb = $select->rowCount();
        if ($nb > 0) {
            $chaine = random(6);
        } else {
            $agent = FALSE;
        }
    }
    return $chaine;
}

function random($car) {
	$string = '';
	$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	srand ( ( double ) microtime () * 1000000 );
	for($i = 0; $i < $car; $i ++) {
		$string .= $chaine [rand () % strlen ( $chaine )];
	}
	return $string;
}

function infos_page($module,$action) {
  
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT title_page,breadcrumb,keywords,description FROM InfoPageWeb WHERE module=:param1 AND action=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $module);
        $resultat->bindParam(':param2', $action);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['title_page'] = $enregistrement['title_page'];
        $infos['keywords'] = $enregistrement['keywords'];
        $infos['description'] = $enregistrement['description'];
        $infos['breadcrumb'] = $enregistrement['breadcrumb'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    } 
    return $infos;
}


