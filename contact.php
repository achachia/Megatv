<?php
$toto='';
require_once 'connection/config.php';
require_once 'espace_client/modele/modele.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;
$objet = array();

$userName = $_REQUEST['cf_name'];
$userEmail = $_REQUEST['cf_email'];
$objetMessage = $_REQUEST['cf_objet'];
$userMsg = $_REQUEST['cf_message'];
$code_message=generer_code_MessagesClientsEnvoye();
$token=generer_token_MessagesClientsEnvoye();

if (empty($userName) || empty($userEmail) || empty($userMsg) || empty($objetMessage)) {
    $etat = FALSE;
    $objet ['message_erreur'] [] = 'Le champ est obligatoire';
}
if (!empty($userEmail)) {
    if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $userEmail)) {
        $etat = FALSE;
    }
}

if ($etat) {
    $date_saisi = date("Y-m-d H:i:s");
    try {
        $stmt = $cxn->prepare("INSERT INTO MessagesContact (userName,userEmail,userMsg,date_saisi,objetMessage,code_message,token) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)");
        $stmt->bindParam(':param1', $userName);
        $stmt->bindParam(':param2', $userEmail);
        $stmt->bindParam(':param3', $userMsg);
        $stmt->bindParam(':param4', $date_saisi);
        $stmt->bindParam(':param5', $objetMessage);
        $stmt->bindParam(':param6', $code_message);
        $stmt->bindParam(':param7', $token);
        $stmt->execute();
    } catch (Exception $e) {
        //echo "Une erreur est survenue lors de la rÃ©cupÃ©ration des donnÃ©es";
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'erreur_insertion de donnees2';
    }
}
/* * **************** Envoi par mail *********************** */

$subject = $objetMessage;
$message = '<html>'
        . '<head>'
        . '<title>' . $objetMessage . '</title>'
        . '</head>'
        . '<body>'
        . '<table>'
        . '<tr>'
        . '<td>Email :  </td><td> ' . $userEmail . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td>NOM : </td><td> ' . $userName . '</td>'
        . '</tr>'
        . '<tr><td>OBJET : </td>'
        . '<td> ' . $objetMessage . '</td>'
        . '</tr>'
        . '</tr>'
        . '<tr><td>MESSAGE : </td>'
        . '<td> ' . $userMsg . '</td>
                                                                  </tr>
                                              </table>
                                     </body>
                                  </html>';
//$message = "Email id :  ".$userEmail. "\r\nPhone No : ".$userPhone."\r\nName : ".$userName."\r\nSays : ".$userMsg;
//$to = $email_conseiller;
$to = 'toto@yopmail.com';
$headers = "From: " . strip_tags($userEmail) . "\r\n";
$headers .= "Reply-To: " . strip_tags($userEmail) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
if (!mail($to, $subject, $message, $headers)) {
    $etat = FALSE;
}



$objet ['message'] = array(
    'reponse' => $etat
);
header('Content-type: application/json');
echo json_encode($objet);
?>

