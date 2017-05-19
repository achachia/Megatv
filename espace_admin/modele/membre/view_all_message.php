<?php

// modele
if (!isset($_SESSION['membre']['code_intervenant'])) {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/\\') . "/index.php";
    header("Location: $lien");
    exit();
}
if (isset($module) && isset($action) && is_file(dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . '/' . $action . '.php')) {

    function mes_messages_recus($code_user) {
        global $cxn;
        $liste = array();
// Récupération des données
        try {
// requete prepare
            $sql = "SELECT DATE_FORMAT(message_recus.date_envoi,'%Y-%m-%d' ) AS date_message,DATE_FORMAT(message_recus.date_envoi,'%k:%i' ) AS heure_message,id_message,expediteur,etat ";
            $sql.=" FROM message_recus WHERE  destinataire=:param  ORDER BY message_recus.date_envoi DESC";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $param);
            $param = $code_user;
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $liste[$i]['id_message'] = $enregistrement['id_message'];
                $liste[$i]['date_message'] = $enregistrement['date_message'];
                $heure_array = explode(':', $enregistrement['heure_message']);
                if ($heure_array[0] < 10) {
                    $liste[$i]['heure_message'] = "0" . $heure_array[0] . ':' . $heure_array[1];
                } else {
                    $liste[$i]['heure_message'] = $enregistrement['heure_message'];
                }
                $liste[$i]['expediteur'] = identite($enregistrement['expediteur']);
                $liste[$i]['etat_message'] = $enregistrement['etat'];
                $i++;
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $liste;
    }

    function mes_messages_envoye($code_user) {
        global $cxn;
        $liste = array();
// Récupération des données
        try {
// requete prepare
            $sql = "SELECT DATE_FORMAT(message_envoye.date,'%Y-%m-%d' ) AS date_message,DATE_FORMAT(message_envoye.date,'%k:%i' ) AS heure_message,id_message,destinataire ";
            $sql.=" FROM message_envoye WHERE  expediteur=:param  ORDER BY message_envoye.date DESC";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $param);
            $param = $code_user;
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $liste[$i]['id_message'] = $enregistrement['id_message'];
                $liste[$i]['date_message'] = $enregistrement['date_message'];
                $heure_array = explode(':', $enregistrement['heure_message']);
                if ($heure_array[0] < 10) {
                    $liste[$i]['heure_message'] = "0" . $heure_array[0] . ':' . $heure_array[1];
                } else {
                    $liste[$i]['heure_message'] = $enregistrement['heure_message'];
                }
                $liste[$i]['destinataire'] = identite($enregistrement['destinataire']);

                $i++;
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        return $liste;
    }

    function identite($code) {
        global $cxn;
        $sql = " SELECT nom,prenom FROM ";
        if (strpos($code, 'CF') !== FALSE) {
            $sql.=" membre_famille  WHERE code_famille=:param";
        } elseif (strpos($code, 'CP') !== FALSE) {
            $sql.=" conseiller_peda  WHERE code_conseiller=:param ";
        }
        elseif (strpos($code, 'CI') !== FALSE) {
            $sql.=" intervenants  WHERE code_intervenant=:param ";
        }
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $identite = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
        return $identite;
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

} else {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname($_SERVER['PHP_SELF']))), '/\\') . "/index.php";
    header("Location: $lien");
}
?>


