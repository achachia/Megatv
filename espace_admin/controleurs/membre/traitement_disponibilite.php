<?php
session_start();
session_regenerate_id();
require_once './../../../global/config.php';
$sql_array = array();
$jour_array = ['lundi' => '1', 'mardi' => '2', 'mercredi' => '3', 'jeudi' => '4', 'vendredi' => '5', 'samedi' => '6', 'dimanche' => '7'];
$periode_array = ['periode1' => 'matin', 'periode2' => '13h-14h', 'periode3' => '14h-15h', 'periode4' => '15h-16h', 'periode5' => '16h-17h', 'periode6' => '17h-18h', 'periode7' => '18h-19h','periode8' => '19h-20h'];
try {
    // On envois la requète
    $sql = " SELECT id_dispo FROM dispo_hebdo_intervenant WHERE code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
    $select = $cxn->query($sql);

    // On indique que nous utiliserons les résultats en tant qu'objet
} catch (Exception $e) {
    echo "Une erreur est survenue lors de la récupération des données";
}
$nb = $select->rowCount();

if ($nb <= 0) {
    foreach ($periode_array as $key => $value) {
        $req2 = "";
        $req1 = "INSERT  INTO dispo_hebdo_intervenant   ";
        $req1.="(periode,";
        $req2.="('" . $periode_array[$key] . "', ";
        if (isset($_POST[$key])) {
            foreach ($jour_array as $value) {
                if (in_array($value, $_POST[$key])) {
                    $jour = array_search($value, $jour_array);
                    $req1.=$jour . ",";
                    $req2.="'1',";
                } else {
                    $jour = array_search($value, $jour_array);
                    $req1.=$jour . ",";
                    $req2.="'0',";
                }
            }
        } else {
            foreach ($jour_array as $value) {
                $jour = array_search($value, $jour_array);
                $req1.=$jour . ",";
                $req2.="'0',";
            }
        }
        $req1.="code_intervenant)";
        $req2.=" :param )";
        $sql = $req1 . " VALUE " . $req2;
        $sql_array[] = $sql;
    }
}
if ($nb > 0) {
    foreach ($periode_array as $key => $value) {
        $req1 = "UPDATE dispo_hebdo_intervenant  SET ";
        $req2 = '';
        if (isset($_POST[$key])) {
            foreach ($jour_array as $value) {
                if (in_array($value, $_POST[$key])) {
                    $jour = array_search($value, $jour_array);
                    $req2.=$jour . "='1',";
                } else {
                    $jour = array_search($value, $jour_array);
                    $req2.=$jour . "='0',";
                }
            }
        } else {
            foreach ($jour_array as $value) {
                $jour = array_search($value, $jour_array);
                $req2.=$jour . "='0',";
            }
        }
        $req2=substr($req2,0,-1);
        $sql = $req1 . $req2 . " WHERE code_intervenant=:param   AND   periode='" . $periode_array[$key] . "' ";
        $sql_array[] = $sql;
    }
}
foreach ($sql_array as $value) {
    try {
        $stmt = $cxn->prepare($value);
        $stmt->bindParam(':param', $code_intervenant);
        $code_intervenant = $_SESSION['membre']['code_intervenant'];
        $stmt->execute();
        $reponse = 'oui';
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
        $reponse = 'non';
    }
}
/*foreach ($sql_array as $value) {
  echo $value . "<br/>";
  }*/ 
$objet['message'] = array('reponse' => $reponse);
header('Content-type: application/json');
echo json_encode($objet);

?>

