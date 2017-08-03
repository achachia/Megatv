<?php

session_start();
session_regenerate_id();
error_reporting(E_ALL);
ini_set("display_errors", 1);

//ini_set('date.timezone', 'Europe/Paris');
$ip = $_SERVER['REMOTE_ADDR'];
$navigateur = $_SERVER['HTTP_USER_AGENT'];
$date_connection = date("Y-m-d  H:i:s");
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
            if ($_SERVER['SERVER_NAME'] == 'localhost') {

                $dns = 'mysql:host=localhost;dbname=megatv_ip';

                $user = 'root';

                $pass = '';
            } else {

                $dns = 'mysql:host=localhost;dbname=megatv_ip';

                $user = 'achachia';

                $pass = '7130chachia';
            }
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $cxn = new PDO($dns, $user, $pass, $options);
            $sql = " SELECT code_user FROM UserAdmin WHERE email='" . $email . "'  AND  mot_passe='" . $password . "' ";

            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                //   echo '3';
                $etat = FALSE;
            } else {
                // echo '4';
                $enregistrement = $select->fetch();
                $_SESSION ['code_admin'] = $enregistrement ['code_user'];
            }
        } catch (Exception $e) {
            //  echo $e->getMessage(); 
            $etat = FALSE;
        }
    }
    

    if ($etat) {
       header("Location:  http://megatv.ovh/gestion-admin/gestion-vod/index.php");
    } else {
       header("Location:  login.php?message_erreur=erreur");
    }
    exit();
}
?>

