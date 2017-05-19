<?php
// parametres de connection
$dns = 'mysql:host=localhost;dbname=megatvfr_dev';
$user = 'megatvfr_abdel';
$password = '7130chachia';
/***********************************espaceconseiller**************************************/
// Constantes a definir .Chemins à utiliser pour accéder aux vues/controleur/fonctions
define ( 'root_web',getcwd());
define ( 'chemin_global', '/global/' );
define ( 'chemin_vue', '/vues/' );
define ( 'chemin_modele', '/modele/' );
define ( 'chemin_controleur', '/controleurs/' );
define ( 'side_bare_gauche', '/side_bare_gauche.php' );
define ( 'side_bare_messagerie', '/side_bare_messagerie.php' );
define ( 'initialisation', 'initialisation.php' );

/***********************************espaceprof ***************************************/
// Constantes a definir .Chemins à utiliser pour accéder aux vues/controleur/fonctions
//define('dir_media', 'http://' . $_SERVER['SERVER_NAME'] . '/debug_test/media1');
define('dir_media', 'http://megatv.fr/MegaTvDev/media');
define('url_absolu_admin', 'http://megatv.fr/MegaTvDev/espaceadmin/');
define('dir_vues', '/vues/');
define('dir_modele', '/modele/');
define('dir_controleur', '/controleurs/');
/**************************************************************************/
define ( 'root_web',getcwd());


/**************************************************************************/


// Options de connection
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try {
    $cxn = new PDO($dns, $user, $password, $options);
} catch (Exception $e) {
    echo "Connection à Mysql imposible : " . $e->getMessage();
    die();
}
?>