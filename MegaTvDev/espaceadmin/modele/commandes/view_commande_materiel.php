<?php

// modele
function infos_facture($N_facture) {
    global $cxn;
    $infos = array();
    try {
        $sql = "   SELECT facture_famille.N_facture,facture_famille.date_facture,facture_famille.date_excution,facture_famille.designation,facture_famille.objet_facture,facture_famille.total_paye,facture_famille.etat_facture, ";
        $sql .= "   membre_famille.code_famille,membre_famille.nom,membre_famille.prenom,membre_famille.civilite,membre_famille.email,membre_famille.adresse,membre_famille.code_postale,membre_famille.ville,membre_famille.telephone_fixe,membre_famille.telephone_portable,membre_famille.telephone_travail ";
        $sql .= "   FROM facture_famille,membre_famille ";
        $sql .= "   WHERE facture_famille.code_famille=membre_famille.code_famille ";
        $sql .= "   AND  facture_famille.N_facture='" . $N_facture . "' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        // infos facture
        $infos ['reference'] = $enregistrement ['N_facture'];
        $infos ['date_facture'] = $enregistrement ['date_facture'];
        $infos ['date_excution'] = $enregistrement ['date_excution'];
        $infos ['objet_facture'] = html_entity_decode($enregistrement ['objet_facture']);
        $infos ['designation_facture'] = html_entity_decode($enregistrement ['designation']);
        $infos ['total_facture'] = $enregistrement ['total_paye'].'(&euro;)';
        $infos ['etat_facture_encaiss']=$enregistrement ['etat_facture'];
        if( $enregistrement ['etat_facture']=='regl&eacute;'){        	
               $infos ['etat_facture']='<button type="button" class="btn btn-success">'.$enregistrement ['etat_facture'].'</button>';
         }elseif($enregistrement ['etat_facture']=='annule'){ 
               $infos ['etat_facture']='<button type="button" class="btn btn-warning">'.$enregistrement ['etat_facture'].'</button>';
         }elseif($enregistrement ['etat_facture']=='attente'){ 
               $infos ['etat_facture']='<button type="button" class="btn btn-info">'.$enregistrement ['etat_facture'].'</button>';
         }elseif($enregistrement ['etat_facture']=='non_regl&eacute;'){ 
               $infos ['etat_facture']='<button type="button" class="btn btn-danger">'.$enregistrement ['etat_facture'].'</button>';
         }elseif($enregistrement ['etat_facture']=='en_cours_reglement'){ 
               $infos ['etat_facture']='<button type="button" class="btn btn-info">'.$enregistrement ['etat_facture'].'</button>';
         }       
        // infos famille 
        $infos ['identite_famille'] = html_entity_decode($enregistrement ['nom']) . "." . html_entity_decode($enregistrement ['prenom']);
        $infos ['civilite'] = $enregistrement ['civilite'];
        $infos ['code_client'] = $enregistrement ['code_famille'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['tel_fixe'] = $enregistrement ['telephone_fixe'];
        $infos ['tel_portable'] = $enregistrement ['telephone_portable'];
        $infos ['tel_travail'] = $enregistrement ['telephone_travail'];
        $infos ['email'] = $enregistrement ['email'];
        // recuperer Le total regle des cheques encaisse
        try {
        	$select = $cxn->query ( " SELECT SUM(montant) AS total_encaisse_regle  FROM liste_encaissements  WHERE N_facture='" . $N_facture . "' AND  etat='regl&eacute;'  " );
        	$enregistrement = $select->fetch ();
        	if($enregistrement ['total_encaisse_regle']==''){
        		$enregistrement ['total_encaisse_regle']=0;
        	}
        	$infos ['total_regle_facture'] = $enregistrement ['total_encaisse_regle'].'(&euro;)';
        } catch ( Exception $e ) {
        	$etat = FALSE;
        	echo "Une erreur est survenue lors de la récupération des données1";
        }
        // recuperer Le total en restant des cheques encaisse
         $infos['total_rest_facture']= $infos ['total_facture']-$infos ['total_regle_facture'].'(&euro;)';
    
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function liste_etat($N_facture) {
    global $cxn;
    try {
        $tab_valeurs_possible = array();
        $sql = " SELECT etat_facture  FROM facture_famille  WHERE N_facture=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $N_facture;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $etat = $enregistrement ['etat_facture'];
        if ($etat == 'non_regl&eacute;') {
            $tab_etat_possible = [
                'regl&eacute;' => 'regl&eacute;',
                'annule' => 'annule'
            ];
        } elseif ($etat == 'attente') {
            $tab_valeurs_possible = [
                'regl&eacute;' => 'regl&eacute;',
                'non_regl&eacute;' => 'non regl&eacute;',
                'annule' => 'annule',
           		'en_cours_reglement' => 'en cours de reglement'
            ];
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $tab_valeurs_possible;
}

function liste_encaissements_facture($code_facture) {
    global $cxn;
    $liste = array();
    try {
        $sql = "    SELECT liste_encaissements.code_encaissement,liste_encaissements.date_prevu,liste_encaissements.montant,liste_encaissements.etat,liste_encaissements.etat,liste_encaissements.N_cheque ";
        $sql .= "   FROM facture_famille,liste_encaissements ";
        $sql .= "   WHERE facture_famille.N_facture=liste_encaissements.N_facture ";
        $sql .= "   AND  facture_famille.N_facture='" . $code_facture . "' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['N_encaissement'] = $enregistrement ['code_encaissement'];
            $liste[$i]['date_encaissemnt'] = $enregistrement['date_prevu'];
            $liste[$i]['montant_encaissemnt'] = $enregistrement['montant'];
            $liste[$i]['etat_encaissemnt'] = $enregistrement['etat'];
            if ($enregistrement['etat'] == 'non_regl&eacute;') {
                $liste[$i]['changer_etat_encaissement'] = [
                    $enregistrement ['code_encaissement'].'-regl&eacute;' => 'regl&eacute;',
                    $enregistrement ['code_encaissement'].'-annule' => 'annule'
                ];
            } elseif ($enregistrement['etat'] == 'attente') {
                $liste[$i]['changer_etat_encaissement'] = [
                    $enregistrement ['code_encaissement'].'-regl&eacute;' => 'regl&eacute;',
                    $enregistrement ['code_encaissement'].'-non_regl&eacute;' => 'non regl&eacute;',
                    $enregistrement ['code_encaissement'].'-annule' => 'annule'
                ];
            } else { 
                if($enregistrement['etat']=='regl&eacute;'){
                    $liste[$i]['changer_etat_encaissement']='<button type="button" class="btn btn-success">'.$enregistrement['etat'].'</button>';
                }              
                elseif($enregistrement['etat']=='annule'){ 
                     $liste[$i]['changer_etat_encaissement']='<button type="button" class="btn btn-info">'.$enregistrement['etat'].'</button>';
                }            
            }
            $liste[$i]['N_cheque'] = $enregistrement['N_cheque'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    //var_dump($liste);
    return $liste;
}

?>