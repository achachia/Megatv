<?php
$dns = 'mysql:host=localhost;dbname=megatvfr_vod';
$user = 'megatvfr_admin';   
$password = '7130chachia';
// Constantes a definir .Chemins à utiliser pour accéder aux vues/controleur/fonctions
define('dir_media', 'http://megatv.fr/media');
define ( 'root_web',getcwd());
define ( 'chemin_global', '/global/' );
define ( 'chemin_vue', '/vues/' );
define ( 'chemin_modele', '/modeles/' );
define ( 'chemin_controleur', '/controleurs/' );
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