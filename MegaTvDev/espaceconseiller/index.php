<?php
ini_set('date.timezone', 'Europe/Paris');
// echo date('Y-m-d H:i:s A');
require_once dirname(__FILE__) . '/global/initialisation.php';
// http://learn.jquery.com/performance/append-outside-loop/
// ALTER TABLE `eleve_intervenant` ADD CONSTRAINT `fk_eleve_intervenant_code_eleve` FOREIGN KEY ( `code_eleve` ) REFERENCES `megacour_debug`.`eleve_famille` (
// `code_eleve`
// ) ON DELETE RESTRICT ON UPDATE RESTRICT ;
// ALTER TABLE `eleve_intervenant` ADD CONSTRAINT `fk_eleve_intervenant_code_intervenant` FOREIGN KEY ( `code_intervenant` ) REFERENCES `megacour_debug`.`intervenants` (
// `code_intervenant`
// ) ON DELETE RESTRICT ON UPDATE RESTRICT ;
// ALTER TABLE `eleve_intervenant` DROP FOREIGN KEY `eleve_intervenant_ibfk_1` ;
// ALTER TABLE `eleve_intervenant` ADD CONSTRAINT `fk_eleve_intervenant_reference` FOREIGN KEY ( `reference` ) REFERENCES `megacour_debug`.`interventions` (
// `reference`
// ) ON DELETE RESTRICT ON UPDATE RESTRICT ;
// http://www.bootstrapcdn.com
// http://angular-ui.github.io/bootstrap/






$BTS = array(
    'Aménagements paysagers' => 'BTSA Aménagements paysagers',
    'Analyses Agricoles,Biologiques et Biotechnologiques' => 'BTSA Analyses Agricoles,Biologiques et Biotechnologiques',
    'Conduite des systèmes d\'exploitation' => 'BTSA Analyse et conduite des systèmes d\'exploitation',
    'Gestion et protection de la Nature' => 'BTSA Gestion et protection de la Nature',
    'Production horticole' => 'BTSA Production horticole',
    'Technico-commercial Spécialisé Produit Alimentaire et Boisson' => 'BTSA Technico-commercial Spécialisé Produit Alimentaire et Boisson',
    'Gestion et Maîtrise de l\'Eau (GEMEAU)' => 'BTSA Gestion et Maîtrise de l\'Eau (GEMEAU)',
    'Gestion Forestière' => 'BTSA Gestion Forestière',
);



?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.png" />
        <?php include dirname(__FILE__) . chemin_global . 'header.php'; ?>
    </head>
    <body>
        <?php //include dirname(__FILE__) .'/modele.php';   ?>
        <div class="container">

            <div class="row"> 

                <?php include dirname(__FILE__) . chemin_global . 'menu_header.php'; ?>
            </div>

            <div class="row clearfix" style="padding-top: 8%;padding-left: 5%">
                <?php
                include dirname(__FILE__) . chemin_global . 'breadcrumb.php';
                require dirname(__FILE__) . chemin_controleur . $module . "/" . $action . ".php";
                ?>
            </div>
            <footer>
                <div class="row clearfix" style="padding-left: 30px">
                    <?php include dirname(__FILE__) . chemin_global . 'menu_footer.php'; ?>
                </div>
            </footer>
        </div>
    </body>
</html>