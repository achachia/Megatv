<?php
$dns = 'mysql:host=localhost;dbname=megatvfr_iptv';
$user = 'megatvfr_abdel';
$password = '7130chachia';
try {
    $cxn = new PDO($dns, $user, $password, $options);
} catch (Exception $e) {
    echo "Connection à Mysql imposible : " . $e->getMessage();
    die();
}
$links=array();
$sql = " SELECT id_link   FROM  LinkTv   ";
$resultat = $cxn->prepare($sql);
$resultat->execute();
while ($enregistrement = $resultat->fetch()) {
    $links[]=$enregistrement['id_link'];
}
//var_dump( $links);
foreach ($links as $value) {
    $sql1 = " UPDATE LinkTv SET id_chaine=:param1  WHERE  id_link=:param2";
    $resultat1 = $cxn->prepare($sql1);
    $resultat1->bindParam(':param1', $value);
    $resultat1->bindParam(':param2', $value);
    $resultat1->execute();
}

?>


