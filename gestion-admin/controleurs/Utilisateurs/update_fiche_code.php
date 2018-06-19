<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');


$etat = TRUE;

$code_activation = $_POST['code_activation'];

$code_iptv = $_POST['code_iptv'];

$date_end = $_POST['date_end'];

$periode_code = $_POST['periode_code'];

$date_created = date("Y-m-d H:i:s");




if (!empty($_POST['code_activation'])) {


    if ($etat) {

        try {

            $sql = " UPDATE  CodesMegaTv  SET  date_end='" . $date_end . "',code_iptv='" . $code_iptv . "',Type_periode='" . $periode_code . "'   WHERE   code_activation='" . $code_activation . "' ";

            $stmt = $cxn->prepare($sql);

            $stmt->execute();
        } catch (Exception $e1) {

            echo $e1->getMessage();

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }
    }
}
if ($etat) {

    $url = $url_espace_admin . "/index.php?module=Utilisateurs&action=all_code_enregistre&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=Utilisateurs&action=all_code_enregistre&message=echec";
}

header("Location:  $url ");
exit();
?>



