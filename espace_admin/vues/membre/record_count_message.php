<?php

session_start();
session_regenerate_id();
require_once './../../../global/config.php';

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

$badge = nombre_messages_non_lus($_SESSION['membre']['code_intervenant']);
echo $badge;
?>
