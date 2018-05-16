<?php
// parametres de connection



if ($_SERVER['SERVER_NAME'] == 'localhost') {

    $dns = 'mysql:host=localhost;dbname=megatv_vod';

    $user = 'root';

    $password = '';

    $host = 'http://localhost/MegaTV-Backend';

    $root_projet = 'C:\wamp64\www\MegaTV-Backend';

    //$environnement='DEBUG';

    $environnement = 'PRODUCTION';
} else {

}

$url_espace_client = $host . '/espace_client';

$url_espace_admin = $host . '/gestion-admin';

// Constantes a definir .Chemins à utiliser pour accéder aux vues/controleur/fonctions

define('dir_media', '');

define('root_web', getcwd());

define('chemin_global', '/global/');

define('chemin_vue', '/vues/');

define('chemin_modele', '/modeles/');

define('chemin_controleur', '/controleurs/');

define('Directory_web', 'gestion-admin');

define('Host', $host);

define('Separator', DIRECTORY_SEPARATOR);


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
