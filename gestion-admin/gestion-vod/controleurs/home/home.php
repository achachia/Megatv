<?php
require './../librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>

