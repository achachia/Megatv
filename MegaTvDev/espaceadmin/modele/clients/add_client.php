<?php

// modele
function liste_agent_commercial() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT  code_user AS code_agent,CONCAT(nom,'.',prenom) AS identite_agent FROM CommercialeMateriel   ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['code_agent'] = $enregistrement ['code_agent'];
			$liste [$i] ['identite_agent'] = html_entity_decode ( $enregistrement ['identite_agent'] );
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_clients() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  code_client,CONCAT(nom,'.',prenom) AS identite_client FROM ClientsMateriel ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['code_client'] = $enregistrement['code_client'];
            $liste[$i]['identite_client'] = html_entity_decode($enregistrement['identite_client']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_pays() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  id_pays,nom FROM ListePays ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['id_pays'] = $enregistrement['id_pays'];
            $liste[$i]['nom_pays'] = html_entity_decode($enregistrement['nom']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_devise() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  code_devise,nom_devise FROM ListeDevise ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['code_devise'] = $enregistrement['code_devise'];
            $liste[$i]['nom_devise'] = html_entity_decode($enregistrement['nom_devise']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}
function infos_client($code_client) {
	global $cxn;
	$infos = array ();
	try {
		$sql = " SELECT  ClientsMateriel.code_client,ClientsMateriel.civilite,ClientsMateriel.date_adhesion,ClientsMateriel.nom,ClientsMateriel.prenom,ClientsMateriel.adresse,ClientsMateriel.code_postale,ClientsMateriel.ville,ClientsMateriel.tel,ClientsMateriel.email,ClientsMateriel.pays,ClientsMateriel.suivi_commercial,ClientsMateriel.devise,ClientsMateriel.code_parrain  FROM ClientsMateriel  WHERE  code_client=:param  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_client );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['code_client'] = $enregistrement ['code_client'];
                $infos ['civilite'] = $enregistrement ['civilite'];
                $infos ['date_adhesion'] = $enregistrement ['date_adhesion'];
		$infos ['nom_client'] = html_entity_decode ( $enregistrement ['nom'] );
		$infos ['prenom_client'] = html_entity_decode ( $enregistrement ['prenom'] );
		$infos ['adresse'] = html_entity_decode ( $enregistrement ['adresse'] );
		$infos ['cp'] = html_entity_decode ( $enregistrement ['code_postale'] );
		$infos ['ville'] = html_entity_decode ( $enregistrement ['ville'] );
                $infos ['pays'] = $enregistrement ['pays'];
		$infos ['tel_portable'] = $enregistrement ['tel'];	
		$infos ['email'] = $enregistrement ['email'];
                $infos ['code_commercial'] = $enregistrement ['suivi_commercial'];
                $infos ['code_devise'] = $enregistrement ['devise'];
                $infos ['code_parrain'] = $enregistrement ['code_parrain'];
		
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}

?>
