<?php

session_start();
session_regenerate_id();

require_once './../connection/config.php';
require_once './modele/modele.php';
ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

if (isset($_POST["nom"])) {

    $etat = TRUE;
    $objet = array();
    $date_inscription = date("Y-m-d H:i:s");
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel_portable'];
    $password = $_POST['password'];


    if (!isset($nom) || empty($nom)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ NOM est vide';
    }
    if (!isset($prenom) || empty($prenom)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ PRENOM est vide';
    }
    if (!isset($email) || empty($email)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ EMAIL est vide';
    }
    if (!isset($tel) || empty($tel)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ TELEPHONE PORTABLE est vide';
    }
    if (!isset($password) || empty($password)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ MOT DE PASSE est vide';
    }
    if (!empty($email)) {
        if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
            $etat = FALSE;
            $message_erreur [] = 'Le format de EMAIL est invalide';
        }
    }
    if ($tel != '') {
        $tel = ereg_replace("[^0-9]", "", $tel); // formater le format de tel 01-52-54-52 => 01525452
        if (!preg_match('/^0[1-9][0-9]{8}$/', $tel)) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'Le format de NUMERO TELEPHONE est invalide ';
        }
    }
    if ($etat) {
        try {
            $select = $cxn->query(" SELECT code_user FROM ClientsAbonnement WHERE email='" . $email . "'   ");
            $nb = $select->rowCount();
            if ($nb > 0) {
                $etat = FALSE;
                $objet ['message_erreur'] [] = 'Le EMAIL existe deja ';
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    }


    if ($etat) {
        $password = md5($password);
        try {
            $stmt = $cxn->prepare(" INSERT INTO ClientsAbonnement (nom,prenom,tel_portable,email,mot_passe,date_created) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $nom);
            $stmt->bindParam(':param2', $prenom);
            $stmt->bindParam(':param3', $tel);
            $stmt->bindParam(':param4', $email);
            $stmt->bindParam(':param5', $password);
            $stmt->bindParam(':param6', $date_inscription);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }
    /*     * ******************************************* */
    if ($etat) {
        try {
            $select = $cxn->query(" SELECT id_client FROM ClientsAbonnement WHERE email='" . $email . "'   ");
            $enregistrement = $select->fetch();
            $id_client = $enregistrement['id_client'];
        } catch (Exception $e) {
            $etat = FALSE;
            echo "Une erreur est survenue lors de la récupération des données";
        }
    }
    /*     * ******************************************* */
    if ($etat) {
        $code_user = 'CU' . $id_client;
        try {
            $stmt = $cxn->prepare(" UPDATE ClientsAbonnement SET  code_user=:param1  WHERE email=:param2 ");
            $stmt->bindParam(':param1', $code_user);
            $stmt->bindParam(':param2', $email);
            $stmt->execute();
            $_SESSION ['client'] = array();
            $_SESSION ['client'] ['code_user'] = $code_user;
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }


    /*     * ******************************************* */



    $objet['etat'] = $etat;

    if (!$etat) {
        $objet['erreur'] = $message_erreur;
        $objet['message'] = array('reponse' => $objet['etat'], 'message_erreur' => $objet['erreur']);
    } else {
        $objet['lien_redirection'] = 'index.html';
        $objet['message'] = array('reponse' => $objet['etat'], 'lien_redirection' => $objet['lien_redirection']);
        

        /*         * **************** Alerte par mail *********************** */

        $subject = 'Alerte une nouvelle inscription';
        $message = '<html>'
                . '<head>'
                . '<title>' . $subject . '</title>'
                . '</head>'
                . '<body>'
                . '<table BORDER CELLPADDING=10 CELLSPACING=0>'
                . '<tr>'
                . '<td>Code client :  </td><td> ' . $code_user . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td> Objet: </td><td>Une nouvelle inscription</td>'
                . '</tr>                                            

                                    </table>
                            </body>
                  </html>';

        $to = 'achachia2003@yahoo.fr';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        if (!mail($to, $subject, $message, $headers)) {
            //$etat = FALSE;
        }
        /*         * ************************ intertion l'alerte dans la base de donnne ***************************** */
        $code_alerte = generer_code_alerte(random(6));
        $genre_user ='NouveauClient';
        $genre_alerte = 'Inscription';
        $objet_alerte = 'une nouvelle inscription';

        try {
            $stmt = $cxn->prepare(" INSERT INTO historiqueAlertesAdmin(code_alerte,genre_user,genre_alerte,objet,date_alerte,code_operation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_alerte);
            $stmt->bindParam(':param2', $genre_user);
            $stmt->bindParam(':param3', $genre_alerte);
            $stmt->bindParam(':param4', $objet_alerte);
            $stmt->bindParam(':param5', $date_inscription);
            $stmt->bindParam(':param6', $code_user);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }

        /*         * ******************************************************************************************** */
    }


    header('Content-type: application/json');
    echo json_encode($objet);
}
?>

