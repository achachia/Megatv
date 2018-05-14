<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $dns = 'mysql:host=localhost;dbname=megatv_ip';
    $user = 'root';
    $password = '';
    $host = 'http://localhost/MegacoursProcedural';
} else {


}


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

$theme = $_GET['theme'];

try {
    
    $sql = "   SELECT lien_iptv  FROM Liste_iptv_youtube   WHERE  theme='" . $theme . "' ";


    $resultat = $cxn->query($sql);
    $nb = $resultat->rowCount();
    if ($nb > 0) {
        $enregistrement = $resultat->fetch();
        $lien = $enregistrement['lien_iptv'];  
    } else {

        $lien = 'Aucun lien trouvé';
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">     
        <title>Mega-Tv</title>   

        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script><![endif]-->
    </head>
    <body>


        <h2  style="text-align: center">LIEN DE TELECHARGEMENTS</h2>

        <p style="text-align: center"><?= $lien ?></p>




    </body>

</html>    
