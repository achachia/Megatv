<?php

/* * ************* Verification une date ************** */

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
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

function liste_SectionVod($id_categorie) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT id_section,nom_section FROM SectionVod  WHERE id_categorie=:param  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam ( ':param', $id_categorie );
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
