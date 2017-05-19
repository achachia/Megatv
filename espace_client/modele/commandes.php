<?php

require 'modele.php';

function infos_client($code_client) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT nom,prenom,email FROM ClientsAbonnement WHERE code_user=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_client;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['nom'] = $enregistrement['nom'];
        $infos['prenom'] = $enregistrement['prenom'];
        $infos['email'] = $enregistrement['email'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données1";
    }
    return $infos;
}

function infos_abonnement($code_abo) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT  ref,description,img,prix_unit FROM  InfosAbonnements  WHERE code_abo=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_abo;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['ref'] = $enregistrement['ref'];
        $infos['description'] = $enregistrement['description'];
        $infos['img'] = $enregistrement['img'];
        $infos['prix_unit'] = $enregistrement['prix_unit'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données2";
    }
    return $infos;
}

function generer_code_commande($chaine) {
    global $cxn;
    $agent = TRUE;
    while ($agent) {
        try {
            $select = $cxn->query("SELECT id_commande FROM CommandesClients  WHERE code_commande='" . $chaine . "' ");
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données3";
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

function generer_token_commande($chaine) {
    global $cxn;
    $agent = TRUE;
    while ($agent) {
        try {
            $select = $cxn->query("SELECT id_commande FROM CommandesClients  WHERE token='" . $chaine . "' ");
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
            $objet ['message_debug'] [] = 'la requette N°6  SELECT ommandes_clients  dans la table e_coupon  a echoué';
        }
        $nb = $select->rowCount();
        if ($nb > 0) {
            $chaine = random(10);
        } else {
            $agent = FALSE;
        }
    }
    return $chaine;
}


function check_commande($post) {
    global $cxn;
    $etat = TRUE;
    $objet = array();
    $date_commande = date("Y-m-d H:i:s"); 
    $methode_paiement = $post['choix_paiement'];
    $id_abo = $post['id_abo'];
    //$objet ['message_debug'] [] = $post['id_abo'];  
    $prix_unit = $post['prix_unit'];
    $prix_total = $post['prix_total'];
    $quantite = $post['quantite'];
    $code_user = $post['code_user'];
    if (!empty($post['message_commande'])) {
        $message = $post['message_commande'];
    } else {
        $message = NULL;
    }


    if (!isset($post['quantite']) || empty($post['quantite'])) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de quantite est vide';
    }
    if (!isset($post['prix_total']) || empty($post['prix_total'])) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de total de la commande est vide';
    }

    if (!isset($post['choix_paiement']) || empty($post['choix_paiement'])) {
        $etat = FALSE;
        $message_erreur [] = 'Le champ de choix de paiement est vide';
    } else {
        $liste_paiement = array(
            "method_NETELLER",
            "method_PAYPAL",
        );
        if (!in_array($post['choix_paiement'], $liste_paiement)) {
            $etat = FALSE;
            $message_erreur [] = 'Le choix de paiement ne correspond pas au choix propose';
        }
    }

    if ($etat) {


        try {
            $sql = " SELECT prix_unit FROM InfosAbonnements WHERE code_abo='" . $id_abo . "' ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $etat = FALSE;
                $message_erreur[] = "L'abonnement ne correspond pas au abonnements proposes";
            } else {
                $enregistrement = $select->fetch();
                if ($enregistrement['prix_unit'] != $post['prix_unit']) {

                    $etat = FALSE;
                    $message_erreur [] = "Le prix d'abonnement ne correspond pas au abonnement propose";
                } else {

                    $prix_total = $enregistrement['prix_unit'] * $post['quantite'];
                    if ($prix_total != $post['prix_total']) {

                        $etat = FALSE;
                        $message_erreur [] = "Le prix total de la commande est invalide";
                    }
                }
            }
        } catch (Exception $e) {

            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es1';
        }
    }

    if ($etat) {
        $code_commande = generer_code_commande(random(8));
        $token = generer_token_commande(random(30));
        try {
            $stmt = $cxn->prepare(" INSERT INTO CommandesClients (code_commande,date_commande,code_user,methode_paiement,code_abon,quantite,total_prix,message,token) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9)");
            $stmt->bindParam(':param1', $code_commande);
            $stmt->bindParam(':param2', $date_commande);
            $stmt->bindParam(':param3', $code_user);
            $stmt->bindParam(':param4', $methode_paiement);
            $stmt->bindParam(':param5', $id_abo);
            $stmt->bindParam(':param6', $quantite);
            $stmt->bindParam(':param7', $prix_total);
            $stmt->bindParam(':param8', $message);
            $stmt->bindParam(':param9', $token);
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }
    $objet['etat'] = $etat;

    if (!$etat) {
        $objet['erreur'] = $message_erreur;
    } else {
        /*         * **************** Alerte par mail *********************** */

        $subject = 'Alerte une nouvelle commande';
        $message = '<html>'
                . '<head>'
                . '<title>' . $subject . '</title>'
                . '</head>'
                . '<body>'
                . '<table BORDER CELLPADDING=10 CELLSPACING=10>'
                . '<tr>'
                . '<td>Commande N° :  </td><td> ' . $code_commande . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td> METHODE DE PAIEMENT: </td><td> ' . $methode_paiement . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td> MONTANT  : </td>'
                . '<td> ' . $prix_total . '</td>'
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
         $genre_alerte='NouvelCommande';
         $objet_alerte='Nouvelle commande abonnement';        
         
        try {
            $stmt = $cxn->prepare(" INSERT INTO historiqueAlertesAdmin(code_alerte,genre_user,genre_alerte,objet,date_alerte,code_operation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)");
            $stmt->bindParam(':param1', $code_alerte);
            $stmt->bindParam(':param2', $genre_user);
            $stmt->bindParam(':param3', $genre_alerte);
            $stmt->bindParam(':param4', $objet_alerte);
            $stmt->bindParam(':param5', $date_commande); 
            $stmt->bindParam(':param6', $code_commande); 
            $stmt->execute();
        } catch (Exception $e) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }

        /*         * ******************************************************************************************** */
        $objet['lien_redirection'] = 'http://megatv.fr/espace_client/' . $token . '/confirmation-commande.html';
    }

    return $objet;
}

function check_infos_commande($token) {

    global $cxn;
    $infos_commande = array();

    $sql = " SELECT code_commande,total_prix,methode_paiement FROM CommandesClients WHERE token='" . $token . "' ";
    $select = $cxn->query($sql);
    $enregistrement = $select->fetch();
    $infos_commande['code_commande'] = $enregistrement['code_commande'];
    $infos_commande['total_prix'] = $enregistrement['total_prix'];
    if ($enregistrement['methode_paiement'] == 'method_NETELLER') {
        $infos_commande['methode_paiement'] = 'NETELLER';
    } elseif ($enregistrement['methode_paiement'] == 'method_PAYPAL') {
        $infos_commande['methode_paiement'] = 'PAYPAL';
    }

    return $infos_commande;
}

function liste_commandes($code_user) {

    global $cxn;
    $liste = array();

    try {
        $sql = " SELECT  code_commande,DATE_FORMAT(date_commande,'%d-%m-%Y' ) AS date_commande_effectute,etat_commande FROM CommandesClients   WHERE  code_user=:param  ORDER BY id_commande DESC";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_user);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_commande'] = $enregistrement['code_commande'];
            $liste[$i]['date_commande'] = $enregistrement['date_commande_effectute'];
            $liste[$i]['etat'] = $enregistrement['etat_commande'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

?>    