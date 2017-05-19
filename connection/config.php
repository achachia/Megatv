<?php
$dns = 'mysql:host=localhost;dbname=megatvfr_iptv';
$user = 'megatvfr_abdel';
$password = '7130chachia';
define ( 'chemin_vue', '/vues/' );
define ( 'chemin_modele', '/modele/' );
define ( 'chemin_controleur', '/controleurs/' );
define('dir_media', 'http://megatv.fr/media');
define('dir_vues', '/vues/');
define('dir_modele', '/modele/');
define('dir_controleur', '/controleurs/');
define ( 'root_web',getcwd());
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