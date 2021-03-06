<?php

// check validite fichier json a distance 


function NbChainesIptvActive() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dns = 'mysql:host=localhost;dbname=megatv_ip';

        $user = 'root';

        $password = '';
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



    try {

        $sql = " SELECT id  FROM  ChainesTv  WHERE  active='1' ";

        $select = $cxn->query($sql);

        $nb = $select->rowCount();
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $nb;
}

function NbChainesRadioWeb() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dns = 'mysql:host=localhost;dbname=megatv_vod';

        $user = 'root';

        $password = '';
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

    try {

        $sql = " SELECT id_radio  FROM  ListeRadioWeb  WHERE  activation='1' ";

        $select = $cxn->query($sql);

        $nb = $select->rowCount();
    } catch (Exception $e) {

        echo $e->getMessage();
    }

    return $nb;
}

function parseHeaders($lien) {

    file_get_contents($lien);

    $head = array();

    foreach ($http_response_header as $k => $v) {
        $t = explode(':', $v, 2);
        if (isset($t[1]))
            $head[trim($t[0])] = trim($t[1]);
        else {
            $head[] = $v;
            if (preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out))
                $head['reponse_code'] = intval($out[1]);
        }
    }
    return $head;
}

function getMessageStatut($header) {


    $code = $header['reponse_code'];

    if ($code == 200) {

        $messageStatut = 'Valide';
    } else {

        $messageStatut = 'Error';
    }

    return $messageStatut;
}

/* * ************* Verification une date ************** */

function validateDate($date, $format = 'Y-m-d H:i:s') {

    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) == $date;
}

function liste_SectionVod($id_categorie) {

    global $cxn;

    $liste = array();

    try {

        // requete prepare

        $sql = " SELECT id_section,nom_section FROM SectionVod  WHERE id_categorie=:param  ";

        $resultat = $cxn->prepare($sql);

        $resultat->bindParam(':param', $id_categorie);

        $resultat->execute();

        $i = 0;

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_section'] = $enregistrement['id_section'];

            $liste[$i]['nom_section'] = html_entity_decode($enregistrement['nom_section']);

            $i++;
        }
    } catch (Exception $e) {

        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $liste;
}

function creerFichier($fichierChemin, $fichierNom, $fichierExtension, $fichierContenu, $droit = "") {

    //$fichierCheminComplet = $_SERVER["DOCUMENT_ROOT"] . $fichierChemin . "/" . $fichierNom;

    $fichierCheminComplet = $_SERVER["DOCUMENT_ROOT"] . $fichierChemin . "/" . $fichierNom;

    //echo $fichierCheminComplet;

    if ($fichierExtension != "") {

        $fichierCheminComplet = $fichierCheminComplet . "." . $fichierExtension;

        //$t_infoCreation['infos']=$fichierCheminComplet;
    }



// création du fichier sur le serveur

    $leFichier = fopen($fichierCheminComplet, "wb");

    fwrite($leFichier, $fichierContenu);

    fclose($leFichier);



// la permission

    if ($droit == "") {

        $droit = "0777";
    }



// on vérifie que le fichier a bien été créé

    $t_infoCreation['fichierCreer'] = false;

    if (file_exists($fichierCheminComplet) == true) {

        $t_infoCreation['fichierCreer'] = true;
    }



// on applique les permission au fichier créé

    $retour = chmod($fichierCheminComplet, intval($droit, 8));

    $t_infoCreation['permissionAppliquer'] = $retour;



    return $t_infoCreation;
}

function getNbr_films() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-HD";
    } else {

        $dir = "/volume1/web/media/Films-HD";
    }

    $dh = opendir($dir);

    $nbr = 0;

    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $nbr++;
        }
    }

    return $nbr;
}

function getNbr_FilmsHindo() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-Hindo";
    } else {

        $dir = "/volume1/web/media/Films-Hindo";
    }

    $dh = opendir($dir);

    $nbr = 0;

    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $nbr++;
        }
    }

    return $nbr;
}

function getNbr_FilmsArabic() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-Arabic";
    } else {

        $dir = "/volume1/web/media/Films-arabic";
    }

    $dh = opendir($dir);

    $nbr = 0;

    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $nbr++;
        }
    }

    return $nbr;
}

function getNbr_DocFr() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\DocumentaireFr";
    } else {

        $dir = "/volume1/web/media/DocumentaireFr";
    }

    $dh = opendir($dir);

    $nbr = 0;

    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $nbr++;
        }
    }

    return $nbr;
}

function getNbr_cartoon() {

    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Cartoon";
    } else {

        $dir = "/volume1/web/media/Cartoon";
    }

    $dh = opendir($dir);

    $nbr = 0;

    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $nbr++;
        }
    }

    return $nbr;
}

function getNbr_serie_tv() {


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Serie-Tv";
    } else {

        $dir = "/volume1/web/media/Serie-Tv";
    }

    $cdir = scandir($dir);

    $nbr = 0;

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                $nbr++;
            }
        }
    }

    return $nbr;
}

function FileSizeConvert($bytes) {

    $bytes = floatval($bytes);

    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "BY",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {

        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }

    return $result;
}

function getDataFilms() {

    $data = 0;


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-HD";
    } else {

        $dir = "/volume1/web/media/Films-HD";
    }

    $dh = opendir($dir);



    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $data = $data + filesize($dir . '/' . $filename);
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }



    return $data_formate;
}

function getDataFilmsHindo() {

    $data = 0;


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-Hindo";
    } else {

        $dir = "/volume1/web/media/Films-Hindo";
    }

    $dh = opendir($dir);



    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $data = $data + filesize($dir . '/' . $filename);
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }



    return $data_formate;
}

function getDataFilmsArabic() {

    $data = 0;


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Films-Arabic";
    } else {

        $dir = "/volume1/web/media/Films-arabic";
    }

    $dh = opendir($dir);



    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $data = $data + filesize($dir . '/' . $filename);
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }



    return $data_formate;
}

function getDataCartoon() {

    $data = 0;


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Cartoon";
    } else {

        $dir = "/volume1/web/media/Cartoon";
    }

    $dh = opendir($dir);


    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $data = $data + filesize($dir . '/' . $filename);
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }

    return $data_formate;
}

function getDataDocTvFr() {

    $data = 0;


    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\DocumentaireFr";
    } else {

        $dir = "/volume1/web/media/DocumentaireFr";
    }

    $dh = opendir($dir);



    while (false !== ($filename = readdir($dh))) {


        if ($filename != '.' && $filename != '..') {

            $data = $data + filesize($dir . '/' . $filename);
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }



    return $data_formate;
}

function dirToArray($dir) {

    $result = array();

    $cdir = scandir($dir);

    foreach ($cdir as $key => $value) {

        if (!in_array($value, array(".", ".."))) {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            } else {

                $result[] = $value;
            }
        }
    }

    return $result;
}

function getDataSerieTv() {

    $data = 0;



    if ($_SERVER['SERVER_NAME'] == 'localhost') {

        $dir = "C:\wamp64\www\MegatvProcedural\Media-Vod\Serie-Tv";
    } else {

        $dir = "/volume1/web/media/Serie-Tv";
    }

    $result = dirToArray($dir);

    $j = 1;


    foreach ($result as $serie => $value) {



        foreach ($value as $saison => $value1) {



            foreach ($value1 as $num_episode => $nom_episode) {

                $filename = $dir . '/' . $serie . '/' . $saison . '/' . $nom_episode;

                $info = new SplFileInfo($filename);

                $data = $data + filesize($filename);
            }
        }
    }

    if ($data == 0) {

        $data_formate = '0 Go';
    } else {

        $data_formate = FileSizeConvert($data);
    }

    return $data_formate;
}

/* Test

  $date = '2015-04-01';

  if (!validateDate($date, 'Y-m-d')) {

  echo 'non valide';

  }else{

  echo 'valide';

  } */

/* * *************  chaine de caractere ************** */



// function unhtmlentities($string) {
//     $string = trim($string);
//     $string = (!get_magic_quotes_gpc()) ? addslashes($string) : $string;
//     $string = htmlentities($string, ENT_QUOTES);
//     return $string;
// }

/* * *************  ************** */
?>

