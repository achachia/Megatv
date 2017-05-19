<?php

if (isset($_SESSION['membre']['code_intervenant'])) {
    $_SESSION['membre']['code_intervenant'] = '';
    session_destroy();
} else {
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname(dirname($_SERVER['PHP_SELF']))), '/\\') . "/login.php?message_deconnection=deconnection_intervenant";  
    header("Location: $lien");
    exit();
}
?>



