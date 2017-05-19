<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_conseiller'] );
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_famille = liste_famille ( $_SESSION ['code_conseiller'] );
$model_coupon = model_coupon ();
$infos_facture=array();
$mod_paiements=array(
    "Cheque" => "Ch&eacute;que",
    "Carte_bancaire" => "Carte bancaire",
    "Cheque_Emploi_Service_(CESU)" => "Ch&eacute;que Emploi Service (CESU)",
    "Prelevement" => "Pr&eacute;lev&egrave;ment",
    "virement" => "Virement",
    "Espece" => "Espece",
    "Autres" => "Autres",
);
if(!empty($_GET['N_facture'])){		
	$infos_facture=infos_facture($_GET['N_facture']);
	//var_dump($infos_facture);
}
$prix_heure_HT=(!empty($_GET['N_facture']))? $infos_facture['prix_heure_HT'] : '0';
$Total_HT=(!empty($_GET['N_facture']))? $infos_facture['Total_HT'] : '0';
$nb_heure=(!empty($_GET['N_facture']))? $infos_facture['nb_heure'] : '0';
$objet_facture=(!empty($_GET['N_facture']))? $infos_facture['objet_facture'] : '';
$designation_facture=(!empty($_GET['N_facture']))? $infos_facture['designation_facture'] : '';
$designation_facture=(!empty($_GET['N_facture']))? $infos_facture['designation_facture'] : '';
$date_facture=(!empty($_GET['N_facture']))? $infos_facture['date_facture'] : '';
$date_execution=(!empty($_GET['N_facture']))? $infos_facture['date_execution'] : '';
$type_remise=(!empty($_GET['N_facture']))? $infos_facture['type_remise'] : '';
$valeur_remise=(!empty($_GET['N_facture']))? $infos_facture['valeur_remise'] : '0';
$application_remise=array(
    "0" => "Non appliqu&eacute;",
    "1" => "Appliqu&eacute;"
    );
if(!empty($_GET['N_facture'])){		
	$action_form='./controleurs/facturation/update_facture.php';
        $title_button='Modifier la facture';
        $title_form='Modification la facture N°'.$_GET['N_facture'];
}else{
        $action_form='./controleurs/facturation/set_facture.php';
        $title_button='Enregistrer la facture';
        $title_form='Creation une nouvelle facture';
}


include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>