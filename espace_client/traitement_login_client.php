<?php
session_start ();
session_regenerate_id ();
require_once './../connection/config.php';
ini_set('date.timezone', 'Europe/Paris');

$ip = $_SERVER['REMOTE_ADDR'];

$navigateur = $_SERVER['HTTP_USER_AGENT'];

$date_connection = date("Y-m-d  H:i:s");

$etat = TRUE;
if (isset ( $_POST ['identification'] )) {
	if (empty ( $_POST ["email"] ) || ! preg_match ( "$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $_POST ["email"] )) {
		$etat = FALSE;
	}
	if (empty ( $_POST ["password"] )) {
		$etat = FALSE;
	}
	if ($etat) {
		$email = htmlentities ( addslashes ( trim ( $_POST ['email'] ) ), ENT_QUOTES );
		$password = htmlentities ( addslashes ( trim ( $_POST ['password'] ) ), ENT_QUOTES );
		$password = md5 ( $password );
		try {		
			$select = $cxn->query ( " SELECT code_user FROM ClientsAbonnement WHERE email='" . $email . "'  AND  mot_passe='" . $password . "' " );
			$nb = $select->rowCount ();
			if ($nb <= 0) {
				$etat = FALSE;
			} else {
				$enregistrement = $select->fetch ();
				$_SESSION ['client'] = array ();
				$_SESSION ['client'] ['code_user'] = $enregistrement ['code_user'];
                            
			}
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
	}
	if ($etat) {
                /***************** historique de connection ****************/
                    try {
                            $sql = " INSERT INTO  HistoriqueConnectionClientSite (ip,date_connection,navigateur,code_user) VALUES (:param1,:param2,:param3,:param4) ";
                            $resultat = $cxn->prepare($sql);
                            $resultat->bindParam(':param2', $date_connection);
                            $resultat->bindParam(':param1', $ip);
                            $resultat->bindParam(':param4', $_SESSION ['client'] ['code_user']);
                            $resultat->bindParam(':param3', $navigateur);
                            $resultat->execute();
                        } catch (Exception $e) {
                            echo "Une erreur est survenue lors de la récupération des données2";
                        }
            
            
            
            
                /**************************************************/
		header ( "Location:  index.html" );
	} else {
		header ( "Location:  login.php?message_erreur=erreur" );
	}
	exit ();
}
?>

