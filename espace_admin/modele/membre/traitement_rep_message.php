<?php
if (!isset($_SESSION['membre']['code_intervenant'])) {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/\\') . "/index.php";
    header("Location: $lien");
    exit();
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
?>
