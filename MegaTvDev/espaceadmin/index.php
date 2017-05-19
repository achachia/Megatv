<?php
ini_set('date.timezone', 'Europe/Paris');
// echo date('Y-m-d H:i:s A');
require_once dirname(__FILE__) . '/global/initialisation.php';
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