<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_admin'] );
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_fournisseurs=  liste_fournisseurs();
$liste_modes_envoi=  liste_modes_envoi();
$infos_commande=array();
$etat_commande=array(
    "attente" => "En attente",
    "en-cours" => "En cours",
    "livre" => "Livre",
    "non_livre" => "Non livre" 
);
$mod_paiements=array(
    "paypal" => "Paypal",
    "Cheque" => "Ch&eacute;que",
    "Carte_bancaire" => "Carte bancaire",
    "virement" => "Virement",
    "Espece" => "Espece",
    "Autres" => "Autres",
);
if(!empty($_GET['code_commande'])){		
	$infos_commande=infos_commande($_GET['code_commande']);
	//var_dump($infos_facture);
}
/*************************************************/
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
/*************************************************/
if(!empty($_GET['code_commande'])){		
	$action_form='./controleurs/commandes/set_commande_materiel.php';
        $title_button='Modifier la commande';
        $title_form='Modification la commande N°'.$_GET['code_commande'];
}else{
        $action_form='./controleurs/commandes/set_commande_materiel.php';
        $title_button='Enregistrer la commande';
        $title_form='Creation une nouvelle commande';
}

include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>