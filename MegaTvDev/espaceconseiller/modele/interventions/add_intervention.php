<?php

//modele
function liste_famille($code_conseiller) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,membre_famille.code_famille AS code_famille  FROM membre_famille,famille_conseiller  WHERE membre_famille.code_famille=famille_conseiller.code_famille AND famille_conseiller.code_conseiller=:param  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_conseiller;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_famille'] = $enregistrement['code_famille'];
            $liste[$i]['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_duree() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT   id_model,nom FROM model_coupon ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_duree'] = $enregistrement['id_model'];
            $liste[$i]['duree'] = html_entity_decode($enregistrement['nom']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}
function liste_matiere() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT  id,nom FROM  liste_matiere ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$key=$enregistrement ['id'];
			$value=$enregistrement ['nom'];
			$liste [$key] = $value;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_sex() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT  id_sex,nom_sex FROM  liste_sex ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$key=$enregistrement ['id_sex'];
			$value=$enregistrement ['nom_sex'];
			$liste [$key] = $value;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_statut() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT  id_statut,nom_statut FROM  liste_statut_intervenant ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$key=$enregistrement ['id_statut'];
			$value=$enregistrement ['nom_statut'];
			$liste [$key] = $value;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>
