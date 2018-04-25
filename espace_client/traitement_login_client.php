<?php

session_start();
session_regenerate_id();
require_once './../connection/config.php';
ini_set('date.timezone', 'Europe/Paris');

$ip = $_SERVER['REMOTE_ADDR'];

$navigateur = $_SERVER['HTTP_USER_AGENT'];

$date_connection = date("Y-m-d  H:i:s");

$rule_admin = FALSE;

$etat = TRUE;

if (isset($_POST ['identification'])) {
    if (empty($_POST ["email"]) || !preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $_POST ["email"])) {
        $etat = FALSE;
    }
    if (empty($_POST ["password"])) {
        $etat = FALSE;
    }
    if ($etat) {
        $email = htmlentities(addslashes(trim($_POST ['email'])), ENT_QUOTES);
        $password = htmlentities(addslashes(trim($_POST ['password'])), ENT_QUOTES);
        $password = md5($password);
        try {
            $select = $cxn->query(" SELECT code_user FROM ClientsAbonnement WHERE email='" . $email . "'  AND  mot_passe='" . $password . "' ");
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $etat = FALSE;
            } else {
                $enregistrement = $select->fetch();
                $_SESSION ['client'] = array();
                $_SESSION ['client'] ['code_user'] = $enregistrement ['code_user'];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        /*         * ************************ Identification admin ******************************************* */

        try {
            $sql=" SELECT code_user FROM  UserAdmin WHERE email='" . $email . "'  AND  mot_passe='" . $password . "' ";
      
            $select = $cxn->query($sql);
            
            $nb = $select->rowCount();
     
            if ($nb > 0) {
                $etat = TRUE;
                $enregistrement = $select->fetch();
                $_SESSION ['user_admin'] = array();
                $_SESSION ['user_admin'] ['code_user'] = $enregistrement ['code_user'];

                $rule_admin = TRUE;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if ($etat) {

        if (!$rule_admin) {
            echo "3";
            /*             * *************** historique de connection *************** */
            try {
                $sql = " INSERT INTO  HistoriqueConnectionClientSite (ip,date_connection,navigateur,code_user) VALUES (:param1,:param2,:param3,:param4) ";
                $resultat = $cxn->prepare($sql);
                $resultat->bindParam(':param2', $date_connection);
                $resultat->bindParam(':param1', $ip);
                $resultat->bindParam(':param4', $_SESSION ['client'] ['code_user']);
                $resultat->bindParam(':param3', $navigateur);
                $resultat->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            /*             * *********************************************** */
        
            $url=$host . '/espace_client/index.php';
            
        } else {

            $url = $host . '/gestion-admin/index.php';

         
        }
    } else {

      $url=$host . '/espace_client/login.php?message_erreur=erreur';
    }
    
       //echo $url;
    
       header("Location:  $url");
       
      exit();
}
?>

