<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

define('MAILGUN_URL', 'https://api.mailgun.net/v3/sandbox705225c13c8b44d5966230f5d3c95cff.mailgun.org');
define('MAILGUN_KEY', 'key-3dd3ca73d4eabc6e663d5746ca88c759');

function sendmailbymailgun ($to, $toname, $mailfromnane, $mailfrom, $subject, $html, $text, $tag, $replyto) {
    $array_data = array(
        'from' => $mailfromnane . '<' . $mailfrom . '>',
        'to' => $toname . '<' . $to . '>',
        'subject' => $subject,
        'html' => $html,
        'text' => $text,
        'o:tracking' => 'yes',
        'o:tracking-clicks' => 'yes',
        'o:tracking-opens' => 'yes',
        'o:tag' => $tag,
        'h:Reply-To' => $replyto
    );
    $session = curl_init(MAILGUN_URL . '/messages');
    curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($session, CURLOPT_USERPWD, 'api:' . MAILGUN_KEY);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);
    $results = json_decode($response, true);
    return $results;
}

sendmailbymailgun('achachia2003@yahoo.fr','abdel','test@yopmail.com','test@yopmail.com','test_email','<p>test</p>','test','toto','achachia2003@yahoo.fr');

$etat = TRUE;

$email = $_POST['email'];

$id_device = $_POST['id_device'];

$platforme = $_POST['platforme'];

$periode_test = $_POST['periode_test'];

$date_created = date("Y-m-d H:i:s");

$id_demande = $_POST['id_demande'];

function random($car) {

    $string = "";

    $chaine = "123456789";

    srand((double) microtime() * 1000000);

    for ($i = 0; $i < $car; $i++) {

        $string .= $chaine[rand() % strlen($chaine)];
    }

    return $string;
}

function random2($car) {

    $string = "";

    $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    srand((double) microtime() * 1000000);

    for ($i = 0; $i < $car; $i ++) {

        $string .= $chaine [rand() % strlen($chaine)];
    }

    return $string;
}

$code_test = random(6);

$code_token = random2(20);

if (!empty($_POST['id_demande'])) {


    try {

        $sql = " INSERT INTO  CodesMegaTv  (code_activation,token_device,id_device,plate_form,date_created,type_code,staut_code,Type_periode)  VALUES ('" . $code_test . "','" . $code_token . "','" . $id_device . "','" . $platforme . "','" . $date_created . "','1','4','" . $periode_test . "') ";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();
    } catch (Exception $e) {

        echo $e->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    if ($etat) {

        try {

            $sql = " UPDATE  DemandesCodesActivation   SET  statut_demande='4'   WHERE  id_demande='" . $id_demande . "' ";

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

    $url = $url_espace_admin . "/index.php?module=Utilisateurs&action=all_demandes_code&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=Utilisateurs&action=all_demandes_code&message=echec";
}

header("Location:  $url ");
exit();
?>

