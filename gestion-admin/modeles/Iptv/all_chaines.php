<?php

function ListeChainesIptv() {

    $liste = array();

    global $cxn;

    /*     * ************************************************ */

    try {

        $sql = " SELECT ChainesTv.id,ChainesTv.active,ChainesTv.nom  AS nom_chaine,ChainesTv.Nom_m3u,ChainesTv.categorie  AS id_categorie,CategorieTv.nom  AS groupe_chaine,ChainesTv.logo  FROM  ChainesTv,CategorieTv   WHERE ChainesTv.categorie=CategorieTv.id_categorie  ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        $dir = "/volume1/web/Megatv/MegatvProcedural/gestion-admin/images/IconChaineTv";

        $root_web = "http://megatv.ovh/gestion-admin/images/IconChaineTv/"; 

        while ($enregistrement = $resultat->fetch()) {

            $liste[$i]['id_chaine'] = $enregistrement['id'];

            /*             * ***********  Recuperation link TV *********************** */
            try {

                $sql = " SELECT link AS link_chaine FROM LinkTv   WHERE id_chaine=:param  ";


                $resultat1 = $cxn->prepare($sql);

                $resultat1->bindParam(':param', $enregistrement['id']);

                $resultat1->execute();

                $enregistrement1 = $resultat1->fetch();

                $liste[$i]['link_chaine'] = $enregistrement1['link_chaine'];
            } catch (Exception $e) {

                echo $e->getMessage();
            }



            /*             * ********************************************************* */

            $liste[$i]['nom'] = $enregistrement['nom_chaine'];

            $liste[$i]['Nom_m3u'] = $enregistrement['Nom_m3u'];

            $liste[$i]['groupe'] = $enregistrement['groupe_chaine'];

            $liste[$i]['id_categorie'] = $enregistrement['id_categorie'];

            $liste[$i]['option_actif'] = $enregistrement['active'];

            $liste[$i]['logo'] = $enregistrement['logo'];

            $filename = $dir . '/' . $enregistrement['nom_chaine'] . '.png';

            $liste[$i]['icone_chaine'] = $root_web . $enregistrement['logo'];
            
            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}

function liste_categorie_tv() {

    global $cxn;

    $sql = " SELECT  id_categorie,nom AS nom_bouquet FROM  CategorieTv  ";


    $resultat = $cxn->prepare($sql);

    $resultat->execute();

    $i = 0;

    while ($enregistrement = $resultat->fetch()) {

        $liste[$i]['id_categorie'] = $enregistrement['id_categorie'];

        $liste[$i]['nom_bouquet'] = $enregistrement['nom_bouquet'];


        $i++;
    }


    return $liste;
}

//function updateNomM3u($id, $nom) {
//
//    $cxn = getobjetcxn();
//
//    $sql = " UPDATE ChainesTv   SET Nom_m3u=:param1 WHERE id=:param2  ";
//
//
//    $resultat = $cxn->prepare($sql);
//
//    $resultat->bindParam(':param1', $nom);
//
//    $resultat->bindParam(':param2', $id);
//
//    $resultat->execute();
//}
?>