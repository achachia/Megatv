<?php

 $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php?message_deconnection=deconnection_intervenant";  
    header("Location: $lien");

