<?phpsession_start();session_regenerate_id();$drapeau = TRUE;if (!isset($_GET['module']) && !isset($_GET['action'])) {    $module = 'home';    $action = 'home';} else {    $module = $_GET['module'];    $action = $_GET['action'];}if (!isset($_SESSION ['code_admin'])) {    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php";    $drapeau = FALSE;    } else {    if ($action == 'deconnection') {        $_SESSION ['code_admin'] = '';        session_destroy();        $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php?message_deconnection=deconnection_intervenant";        $drapeau = FALSE;    }}if (!$drapeau) {    header("Location: $lien");    exit();}/*  fichier config */ include './connection/config.php';/*  fichier fonctions */ include './../librairie/fonctions.php';$nbr_films = getNbr_films();$nbr_cartoon = getNbr_cartoon();$nbr_serie_tv = getNbr_serie_tv();$data_films = getDataFilms();$data_cartoon = getDataCartoon();$data_serie_tv = getDataSerieTv();?><!DOCTYPE html><!--[if lt IE 7]> <html class="ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]--><!--[if IE 7]>    <html class="ie ie7 lt-ie9 lt-ie8"        lang="en"> <![endif]--><!--[if IE 8]>    <html class="ie ie8 lt-ie9"               lang="en"> <![endif]--><!--[if IE 9]>    <html class="ie ie9"                      lang="en"> <![endif]--><!--[if !IE]><!--><html lang="fr" class="no-ie">     <!--<![endif]--><?php /* Header */ include './templates/header.php'; ?>    <body>         <!-- START Main wrapper-->        <section class="wrapper">    <?php /* Section Nav */ include './templates/nav.php'; ?><?php /* Section Side bar-left */ include './templates/sidebar_left.php'; ?><?php /* Section contenu */ include './section_contenu.php'; ?><?php /* Section Side bar-right */    //include './templates/sidebar_right.php';   ?>        </section>        <!-- END Main wrapper-->        <!-- START Scripts-->        <!-- Main vendor Scripts-->        <!-- Plugins-->        <script src="<?= Host; ?>/gestion-admin/vendor/chosen/chosen.jquery.min.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/slider/js/bootstrap-slider.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/filestyle/bootstrap-filestyle.min.js"></script>        <!-- Animo-->        <script src="<?= Host; ?>/gestion-admin/vendor/animo/animo.min.js"></script>        <!-- Sparklines-->        <script src="<?= Host; ?>/gestion-admin/vendor/sparklines/jquery.sparkline.min.js"></script><!--        <!-- Slimscroll-->        <script src="<?= Host; ?>/gestion-admin/vendor/slimscroll/jquery.slimscroll.min.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/datatable/media/js/jquery.dataTables.min.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrapPagination.js"></script>        <script src="<?= Host; ?>/gestion-admin/vendor/datatable/extensions/ColVis/js/dataTables.colVis.min.js"></script>        <!-- App Main-->        <script src="<?= Host; ?>/gestion-admin/app/js/app.js"></script>        <!-- END Scripts-->    </body></html>