<?php

//modele
function liste_fichiers() {
    global $cxn;
    $liste = array();
    try {
        
        $sql = " SELECT FichierVod.id_fichier,FichierVod.titre_originale,DATE_FORMAT(FichierVod.date_upload,'%d-%m-%Y' ) AS date_upload ,CONCAT(FichierVod.taille_fichier,' Go') AS taille_fichier,
            
                 SectionVod.nom_section,CompteVod.user AS nom_compte,SourcesVod.nom_source

                 FROM  FichierVod,SectionVod,CompteVod,SourcesVod 

                 WHERE  FichierVod.section_fichier=SectionVod.id_section

                 AND    FichierVod.compte_source=CompteVod.id_compte

                 AND    CompteVod.source=SourcesVod .id_source  ";
        
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['id_fichier'] = $enregistrement['id_fichier'];
            $liste[$i]['date_upload'] = $enregistrement['date_upload'];
            $liste[$i]['taille_fichier'] = $enregistrement['taille_fichier'];
            $liste[$i]['nom_section'] = $enregistrement['nom_section'];
            $liste[$i]['nom_compte'] = $enregistrement['nom_compte'];
            $liste[$i]['nom_source'] = $enregistrement['nom_source'];
            $liste[$i]['titre_originale'] = html_entity_decode($enregistrement['titre_originale']);           
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>
