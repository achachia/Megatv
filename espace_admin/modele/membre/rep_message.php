<?php

// modele
if (!isset($_SESSION['membre']['code_intervenant'])) {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/\\') . "/index.php";
    header("Location: $lien");
    exit();
}
if (isset($module) && isset($action) && is_file(dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . '/' . $action . '.php')) {

    function infos_message($id_message, $code_user) {
        global $cxn;
        $sql = "SELECT DATE_FORMAT(date_envoi,'%Y-%m-%d' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,message,expediteur,objet ";
        $sql.=" FROM message_recus WHERE  id_message=:param1 AND destinataire=:param2";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $id_message;
        $param2 = $code_user;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $destinataire = identite($enregistrement['expediteur']);
        $exped = identite($code_user);
        $message = "\n\n" . "..........................................................................................." . "\n";
        $message.="En date de : " . formater_date_texte($enregistrement['date_message']) . "," . $enregistrement['heure_message'] . "\n";
        $message.=$destinataire . " a écrit :" . "\n";
        $message.="Objet : " . $enregistrement['objet'] . "\n";
        $message.= $enregistrement['message'];
        $infos = array(
            'id_message' => $id_message,
            'code_destinataire' => $enregistrement['expediteur'],
            'destinataire' => $destinataire,
            'objet_message' => $enregistrement['objet'],
            'message' => $message
        );
        return $infos;
    }

    function identite($code) {
        global $cxn;
        $sql = " SELECT nom,prenom FROM ";
        if (strpos($code, 'CF') !== FALSE) {
            $sql.=" membre_famille  WHERE code_famille=:param";
        } elseif (strpos($code, 'CP') !== FALSE) {
            $sql.=" conseiller_peda  WHERE code_conseiller=:param ";
        } elseif (strpos($code, 'CI') !== FALSE) {
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

    function formater_date_texte($date) {
// tableau des jours de la semaine
        $joursem = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
        // tableau des jours de la semaine
        $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
            "septembre", "octobre", "novembre", "décembre");
// extraction des jour, mois, an de la date
        $list = explode('-', $date);
        $annee = $list[0];
        $mois = $list[1];
        $jour = $list[2];
// calcul du timestamp
        $timestamp = mktime(0, 0, 0, $mois, $jour, $annee);
// affichage du jour de la semaine
        $nom_jour = $joursem[date("w", $timestamp)];
        $nom_mois = $mois_fr[date("n", $timestamp)];
        $string = $nom_jour . " " . $jour . " " . $nom_mois . " " . $annee . "";
        /*   if (setlocale(LC_TIME, 'fr_FR') == '') {
          setlocale (LC_TIME, 'fr_FR','fra');  //correction problème pour windows
          $format_jour = '%#d';
          } else {
          $format_jour = '%e';
          }
          $string = strftime("%A $format_jour %B %Y", strtotime($date));
          // affiche : vendredi 18 avril 2008
          //  echo strftime("%a $format_jour %b %Y", strtotime('2008-04-18'));
          // affiche : ven. 18 avr. 2008 */
        return $string;
    }

    function mise_a_jour_message_lu($id_message, $code_user) {
        global $cxn;
        try {
            $sql = " SELECT etat FROM message_recus WHERE id_message=:param1  AND destinataire=:param2   ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $param1);
            $resultat->bindParam(':param2', $param2);
            $param1 = $id_message;
            $param2 = $code_user;
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $etat = $enregistrement['etat'];
            // On indique que nous utiliserons les résultats en tant qu'objet
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        if ($etat == '0') {
            $date = date("Y-m-d H:i:s");
            $sql = " UPDATE message_recus  SET etat='1',date_consultation=:param1 WHERE id_message=:param2 AND destinataire=:param3  ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param1', $param1);
            $resultat->bindParam(':param2', $param2);
            $resultat->bindParam(':param3', $param3);
            $param1 = $date;
            $param2 = $id_message;
            $param3 = $code_user;
            $resultat->execute();
        }
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

} else {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname($_SERVER['PHP_SELF']))), '/\\') . "/index.php";
    header("Location: $lien");
}
?>



