<?php

require 'modele.php';

function infos_client($code_user) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT nom,prenom,email,tel_portable FROM ClientsAbonnement WHERE code_user=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['nom'] = $enregistrement['nom'];
        $infos['prenom'] = $enregistrement['prenom'];
        $infos['email'] = $enregistrement['email'];
        $infos['tel_portable'] = $enregistrement['tel_portable'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function check_message_contact($post) {

    global $cxn;
    $etat = TRUE;
    $objet = array();
    $date_message = date("Y-m-d H:i:s");
    $objet_message = $post['objet'];
    $message = $post['message'];
    $code_user = $post['code_user'];
    $token = generer_token_MessagesClientsEnvoye();
    $code_message = generer_code_MessagesClientsEnvoye();

    if (!isset($objet_message) || empty($objet_message)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de objet message est vide';
    }
    if (!isset($message) || empty($message)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de message est vide';
    }
    /************ enregistrement le message dans la table MessagesClientsEnvoye *************************/
    if ($etat) {
        try {
            $stmt = $cxn->prepare(" INSERT INTO MessagesClientsEnvoye (code_user,objet,message,date_envoi,token,code_message) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_user);
            $stmt->bindParam(':param2', $objet_message);
            $stmt->bindParam(':param3', $message);
            $stmt->bindParam(':param4', $date_message);
            $stmt->bindParam(':param5', $token);
            $stmt->bindParam(':param6', $code_message);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }
     /************ enregistrement le message dans la table MessagesAdminRecus *************************/
        if ($etat) {
            $code_suivi=$code_message;
            $token_recu = generer_token_MessagesAdminRecus();
            $code_message_recu = generer_code_MessagesAdminRecus();
        try {
            $stmt = $cxn->prepare(" INSERT INTO MessagesAdminRecus (code_user,objet,message,date_envoi,token,code_message,code_suivi) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)");
            $stmt->bindParam(':param1', $code_user);
            $stmt->bindParam(':param2', $objet_message);
            $stmt->bindParam(':param3', $message);
            $stmt->bindParam(':param4', $date_message);
            $stmt->bindParam(':param5', $token_recu);
            $stmt->bindParam(':param6', $code_message_recu);
            $stmt->bindParam(':param7', $code_suivi);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }
    /********************************************************************************/
    $objet['etat'] = $etat;
    if (!$etat) {
        $objet['erreur'] = $message_erreur;
    } else {
        /*         * **************** Alerte par mail *********************** */

        $subject = 'Alerte un nouveau message contact /espace client';
        $message = '<html>'
                . '<head>'
                . '<title>' . $subject . '</title>'
                . '</head>'
                        . '<body>'
                                . '<table BORDER CELLPADDING=10 CELLSPACING=10>'
                                                . '<tr>'
                                                . '<td>Code message :  </td><td> ' . $code_message . '</td>'
                                                . '</tr>'
                                                . '<tr>'
                                                . '<td> Objet: </td><td> ' . $objet_message . '</td>'
                                                . '</tr>'
                                                . '<tr>'
                                                . '<td> Message: </td><td> ' . $message . '</td>'
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
         $code_alerte=generer_code_alerte(random(6));
         $genre_user='Client';
         $genre_alerte='Contact';
         $objet_alerte='nouveau message contact';        
         
        try {
            $stmt = $cxn->prepare(" INSERT INTO historiqueAlertesAdmin(code_alerte,genre_user,genre_alerte,objet,date_alerte,code_operation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_alerte);
            $stmt->bindParam(':param2', $genre_user);
            $stmt->bindParam(':param3', $genre_alerte);
            $stmt->bindParam(':param4', $objet_alerte);
            $stmt->bindParam(':param5', $date_message); 
            $stmt->bindParam(':param6', $code_message); 
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }

        /*         * ******************************************************************************************** */
    }

    return $objet;
}

function my_messages_envoye($code_user) {

    global $cxn;
    $liste = array();

    try {
        $sql = "SELECT code_message,DATE_FORMAT(date_envoi,'%d-%m-%Y' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,objet ";
        $sql.=" FROM MessagesClientsEnvoye WHERE  code_user=:param  ORDER BY date_envoi DESC";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_message'] = $enregistrement['code_message'];
            $liste[$i]['objet_message'] = $enregistrement['objet'];
            $liste[$i]['date_message'] = $enregistrement['date_message'];
            $liste[$i]['heure_message'] = $enregistrement['heure_message'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function my_messages_recus($code_user) {
    global $cxn;
    $liste = array();
    try {

        $sql = "SELECT DATE_FORMAT(date_envoi,'%d-%m-%Y' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,code_message,objet,token,etat_vue ";
        $sql.=" FROM MessagesClientsRecus WHERE  code_user=:param  ORDER BY date_envoi DESC";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_message'] = $enregistrement['code_message'];
            $liste[$i]['token'] = $enregistrement['token'];
            $liste[$i]['date_message'] = $enregistrement['date_message'];
            $liste[$i]['heure_message'] = $enregistrement['heure_message'];
            $liste[$i]['objet_message'] = $enregistrement['objet'];
            $liste[$i]['etat_vue'] = $enregistrement['etat_vue'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function infos_message_envoye($code_user, $code_message) {
    global $cxn;
    $code_message = htmlentities(addslashes(trim($code_message)), ENT_QUOTES);
    $sql = "SELECT DATE_FORMAT(date_envoi,'%d-%m-%Y' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,message AS core_message,objet ";
    $sql.=" FROM MessagesClientsEnvoye WHERE  code_message=:param1 AND code_user=:param2";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $code_message);
    $resultat->bindParam(':param2', $code_user);
    $resultat->execute();
    $enregistrement = $resultat->fetch();

    $objet['message'] = array(
        'date_message' => $enregistrement['date_message'],
        'heure_message' => $enregistrement['heure_message'],
        'objet_message' => $enregistrement['objet'],
        'core_message' => $enregistrement['core_message']
    );

    return $objet;
}

function infos_message_recu($code_user, $code_message) {
    global $cxn;
    $code_message = htmlentities(addslashes(trim($code_message)), ENT_QUOTES);
    $date_consultation = date("Y-m-d H:i:s");
    /*     * **************  extraire les informations de message ************************* */
    $sql = "SELECT DATE_FORMAT(date_envoi,'%d-%m-%Y' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,message AS core_message,objet,etat_vue ";
    $sql.=" FROM MessagesClientsRecus WHERE  code_message=:param1 AND code_user=:param2";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $code_message);
    $resultat->bindParam(':param2', $code_user);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $etat_vue = $enregistrement['etat_vue'];

    $objet['message'] = array(
        'date_message' => $enregistrement['date_message'],
        'heure_message' => $enregistrement['heure_message'],
        'objet_message' => $enregistrement['objet'],
        'core_message' => $enregistrement['core_message']
    );
    /*     * **************  Mise a jour la consultation de message ************************* */
    if ($etat_vue == '0') {
        $sql = "UPDATE  MessagesClientsRecus  SET  etat_vue='1',date_consultation=:param1 WHERE  code_message=:param2 AND code_user=:param3 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $date_consultation);
        $resultat->bindParam(':param2', $code_message);
        $resultat->bindParam(':param3', $code_user);
        $resultat->execute();
    }


    /*     * **************  ************************* */

    return $objet;
}

function detail_message_recu($code_user, $token) {

    global $cxn;
    $token = htmlentities(addslashes(trim($token)), ENT_QUOTES);
    $date_consultation = date("Y-m-d H:i:s");
    $infos = array();
    $sql = "SELECT DATE_FORMAT(date_envoi,'%d-%m-%Y' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,message AS core_message,objet,etat_vue ";
    $sql.=" FROM MessagesClientsRecus WHERE  token=:param1 AND code_user=:param2";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $token);
    $resultat->bindParam(':param2', $code_user);
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $etat_vue = $enregistrement['etat_vue'];
    $infos = array(
        'date_message' => $enregistrement['date_message'],
        'heure_message' => $enregistrement['heure_message'],
        'objet_message' => $enregistrement['objet'],
        'core_message' => $enregistrement['core_message']
    );
    /*     * **************  Mise a jour la consultation de message ************************* */
    if ($etat_vue == '0') {
        $sql = "UPDATE  MessagesClientsRecus  SET  etat_vue='1',date_consultation=:param1 WHERE  token=:param2 AND code_user=:param3 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $date_consultation);
        $resultat->bindParam(':param2', $token);
        $resultat->bindParam(':param3', $code_user);
        $resultat->execute();
    }


    /*     * **************  ************************* */

    return $infos;
}

function check_rep_message($post) {

    global $cxn;
    $etat = TRUE;
    $objet = array();
    $date_message = date("Y-m-d H:i:s");
    $objet_message = $post['objet'];
    $message = $post['message'];
    $code_user = $post['code_user'];
    $token = generer_token_MessagesClientsEnvoye();
    $code_message = generer_code_MessagesClientsEnvoye();

    if (!isset($objet_message) || empty($objet_message)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de objet message est vide';
    }

    if (!isset($message) || empty($message)) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de message est vide';
    }

    if ($etat) {
        try {
            $stmt = $cxn->prepare(" INSERT INTO MessagesClientsEnvoye (code_user,objet,message,date_envoi,token,code_message) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_user);
            $stmt->bindParam(':param2', $objet_message);
            $stmt->bindParam(':param3', $message);
            $stmt->bindParam(':param4', $date_message);
            $stmt->bindParam(':param5', $token);
            $stmt->bindParam(':param6', $code_message);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }

    $objet['etat'] = $etat;

    if (!$etat) {
        $objet['erreur'] = $message_erreur;
    }else{
              /*         * **************** Alerte par mail *********************** */

        $subject = 'Alerte un nouveau message contact /espace client';
        $message = '<html>'
                . '<head>'
                . '<title>' . $subject . '</title>'
                . '</head>'
                        . '<body>'
                                . '<table BORDER CELLPADDING=10 CELLSPACING=10>'
                                                . '<tr>'
                                                . '<td>Code message :  </td><td> ' . $code_message . '</td>'
                                                . '</tr>'
                                                . '<tr>'
                                                . '<td> Objet: </td><td> ' . $objet_message . '</td>'
                                                . '</tr>'
                                                . '<tr>'
                                                . '<td> Message: </td><td> ' . $message . '</td>'
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
         $code_alerte=generer_code_alerte(random(6));
         $genre_user='Client';
         $genre_alerte='Contact';
         $objet_alerte='nouveau message contact';        
         
        try {
            $stmt = $cxn->prepare(" INSERT INTO historiqueAlertesAdmin(code_alerte,genre_user,genre_alerte,objet,date_alerte,code_operation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_alerte);
            $stmt->bindParam(':param2', $genre_user);
            $stmt->bindParam(':param3', $genre_alerte);
            $stmt->bindParam(':param4', $objet_alerte);
            $stmt->bindParam(':param5', $date_message); 
            $stmt->bindParam(':param6', $code_message); 
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }

        /*         * ******************************************************************************************** */
    }

    return $objet;
}
?>

