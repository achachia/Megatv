<?php

function getobjetcxn() {


    $dns = 'mysql:host=localhost;dbname=megatv_ip';

    $user = 'achachia';

    $password = '7130chachia';

    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {

        $cxn = new PDO($dns, $user, $password, $options);
    } catch (Exception $e) {

        echo "Connection à Mysql imposible : " . $e->getMessage();

        die();
    }

    return $cxn;
}

function ListeChainesIptv() {

    $liste = array();

    $cxn = getobjetcxn();

    /*     * ************************************************ */

    try {

        $sql = " SELECT ChainesTv.id,ChainesTv.active,ChainesTv.nom  AS nom_chaine,ChainesTv.Nom_m3u,ChainesTv.categorie  AS id_categorie,CategorieTv.nom  AS groupe_chaine  FROM  ChainesTv,CategorieTv   WHERE ChainesTv.categorie=CategorieTv.id_categorie  ";


        $resultat = $cxn->prepare($sql);

        $resultat->execute();

        $i = 0;

        $dir = "/volume1/web/Megatv/MegatvProcedural/gestion-admin/gestion-vod/images/IconChaineTv";

        $root_web = "http://megatv.ovh/gestion-admin/gestion-vod/images/IconChaineTv/";

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

            $filename = $dir . '/' . $enregistrement['nom_chaine'] . '.png';


            if (file_exists($filename)) {

                $liste[$i]['icone_chaine'] = $root_web . $enregistrement['nom_chaine'] . '.png';
                
            } else {

                $liste[$i]['icone_chaine'] = $root_web . 'logo_chaine.png';
            }


          

            $i++;
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }



    return $liste;
}

function liste_categorie_tv() {

    $cxn = getobjetcxn();

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