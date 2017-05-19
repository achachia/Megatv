<!-- Espace Conseiller -->
<meta charset="utf-8">
<title><?php echo $title_page; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Fichier CSS -->
<link rel="stylesheet" href="./../media/css/bootstrap.css"
      media="screen">
<link href="<?= dir_media; ?>/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>  
<link href="./../media/css/style_perso.css" rel="stylesheet">
<!--<link rel="stylesheet"  href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />-->
<link href="../../media/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="./../media/plugin_js/chosen/chosen.css" rel="stylesheet">
<link href="./../media/css/demo.css" rel="stylesheet">
<link href="./../media/css/yamm.css" rel="stylesheet">
<!-- end -->
<!-- Fichier JS -->
<!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script src="<?= dir_media; ?>/js/jquery.js" type="text/javascript"></script>
<script src="./../media/js/bootstrap.min.js"></script>
<script src="./../media/jquery-ui/jquery-ui.min.js"></script>
<!-- script src="./../media/js/innovaeditor.js" type="text/javascript"></script>
<script src="./../media/js/innovamanager.js" type="text/javascript"></script> -->
<
<!--<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js" type="text/javascript"></script>-->
<script src="../../media/js/webfont.js" type="text/javascript"></script>
<script type="text/javascript" src="./../media/plugin_js/bootbox.min.js"></script>
<script type="text/javascript" src="./../media/plugin_js/activity-indicator.js"></script>
<script type="text/javascript" src="./../media/plugin_js/chosen/chosen.jquery.js"></script>
<!--<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css"></script>-->
<script src="../../media/js/run_prettify.js" type="text/javascript"></script>
<!-- start datatable -->
<link href="../../media/datatable/extensions/datatable-bootstrap/css/dataTables.bootstrap.css"  rel="stylesheet" type="text/css" />
<link  href="../../media/datatable/extensions/ColVis/css/dataTables.colVis.css" rel="stylesheet" type="text/css" />
<script src="../../media/datatable/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../media/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="../../media/datatable/extensions/ColVis/js/dataTables.colVis.min.js" type="text/javascript"></script>
<!-- end datatable -->




<!------------  Start CSS et JS de Google maps ----------------->
<style>
    body {
        font-family: 'Droid Sans', 'Helvetica', Arial, sans-serif;
        margin: 5px;
    }

    #map {
        display: block;
        width: 95%;
        height: 350px;
        margin: 0 auto;
        -moz-box-shadow: 0px 5px 20px #ccc;
        -webkit-box-shadow: 0px 5px 20px #ccc;
        box-shadow: 0px 5px 20px #ccc;
    }

    #map.large {
        height: 500px;
    }

    .overlay {
        display: block;
        text-align: center;
        color: #fff;
        font-size: 60px;
        line-height: 80px;
        opacity: 0.8;
        background: #4477aa;
        border: solid 3px #336699;
        border-radius: 4px;
        box-shadow: 2px 2px 10px #333;
        text-shadow: 1px 1px 1px #666;
        padding: 0 4px;
    }

    .overlay_arrow {
        left: 50%;
        margin-left: -16px;
        width: 0;
        height: 0;
        position: absolute;
    }

    .overlay_arrow.above {
        bottom: -15px;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        border-top: 16px solid #336699;
    }

    .overlay_arrow.below {
        top: -15px;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        border-bottom: 16px solid #336699;
    }
    //tableau disponibilite

</style>
<!------------  End CSS et JS de Google maps ----------------->
<script type="text/javascript">
            $(document).ready(function () {

    /********* ***********************/

    /********* start Objet datatable ***********************/
    if (!$.fn.dataTable)
            return;
            /********* end Objet datatable ***********************/
            window.prettyPrint && prettyPrint()
            $(document).on('click', '.yamm .dropdown-menu', function (e) {
    e.stopPropagation()
    })
            var d = new Date();
            if (d.getMonth() + 1 < 10) {
    strDate = d.getFullYear() + "-0" + (d.getMonth() + 1) + "-" + d.getDate();
    }
    else {
    strDate = strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    }


<?php if ($action == 'all_view_commandes_materiel') { ?>

                /******************************************************************/
 dtInstance1 = $('#liste_commandes_materiel').dataTable({
               'bAutoWidth': false,
                "aoColumns": [
                            {sWidth: '5%'},
                            {sWidth: '100px'},
                            {sWidth: '12px'},
                            {sWidth: '30px'},
                            {sWidth: '5px'},
                            //{sWidth: '12px'},
                            {sWidth: null}

                ],
                'paging': true, // Table pagination
                'ordering': true, // Column ordering 
                'info': true, // Bottom left status text


                oLanguage: {
                sSearch: 'Rechercher tous les colonnes:',
                        sLengthMenu: '_MENU_ enregistrements par page',
                        sInfo: 'Affichage de l\'élement _START_ à _END_ sur _TOTAL_ éléments',
                        info: 'Afficher la page _PAGE_ of _PAGES_',
                        zeroRecords: 'rien n\'a été trouvé - sorry',
                        infoEmpty: 'Aucun enregistrement disponible',
                        infoFiltered: '(filtré à partir de _MAX_ nombre total d\'enregistrements)'
                },
                sDom: 'C<"clear">lfrtip',
                colVis: {
                order: "alfa",
                        "buttonText": "Afficher / Masquer les colonnes"
                },
               'order': [[0, 'desc']]
        });
                var inputSearchClass = 'datatable_input_col_search';
                var columnInputs = $('tfoot .' + inputSearchClass);
                // On input keyup trigger filtering
                columnInputs.keyup(function () {
                dtInstance1.fnFilter(this.value, columnInputs.index(this));
                });
                /******************************************************************/
  
<?php } ?>
<?php if ($action == 'add_commande_materiel') { ?>
       jQuery("#choix_fournisseur").chosen();
       $("#date_commande,#date_reception").datepicker({maxDate: strDate});
<?php } ?>
<?php if ($action == 'all_view_commandes_abo') { ?>

                /******************************************************************/
 dtInstance1 = $('#liste_commandes_abo').dataTable({
               'bAutoWidth': false,
                "aoColumns": [
                            {sWidth: '5%'},
                            {sWidth: '100px'},
                            {sWidth: '12px'},
                            {sWidth: '30px'},
                            {sWidth: '5px'},
                            //{sWidth: '12px'},
                            {sWidth: null}

                ],
                'paging': true, // Table pagination
                'ordering': true, // Column ordering 
                'info': true, // Bottom left status text


                oLanguage: {
                sSearch: 'Rechercher tous les colonnes:',
                        sLengthMenu: '_MENU_ enregistrements par page',
                        sInfo: 'Affichage de l\'élement _START_ à _END_ sur _TOTAL_ éléments',
                        info: 'Afficher la page _PAGE_ of _PAGES_',
                        zeroRecords: 'rien n\'a été trouvé - sorry',
                        infoEmpty: 'Aucun enregistrement disponible',
                        infoFiltered: '(filtré à partir de _MAX_ nombre total d\'enregistrements)'
                },
                sDom: 'C<"clear">lfrtip',
                colVis: {
                order: "alfa",
                        "buttonText": "Afficher / Masquer les colonnes"
                },
               'order': [[0, 'desc']]
        });
                var inputSearchClass = 'datatable_input_col_search';
                var columnInputs = $('tfoot .' + inputSearchClass);
                // On input keyup trigger filtering
                columnInputs.keyup(function () {
                dtInstance1.fnFilter(this.value, columnInputs.index(this));
                });
                /******************************************************************/
  
<?php } ?>    

<?php if ($action == 'all_view_clients') { ?>
                                dtInstance1 = $('#liste_clients').dataTable({
                                'paging': true, // Table pagination
                                        'ordering': true, // Column ordering 
                                        'info': true, // Bottom left status text
                                        // Text translation options
                                        // Note the required keywords between underscores (e.g _MENU_)
                                        oLanguage: {
                                        sSearch: 'Rechercher tous les colonnes:',
                                                sLengthMenu: '_MENU_ enregistrements par page',
                                                info: 'Afficher la page _PAGE_ of _PAGES_',
                                                zeroRecords: 'rien n\'a été trouvé - sorry',
                                                infoEmpty: 'Aucun enregistrement disponible',
                                                infoFiltered: '(filtré à partir de _MAX_ nombre total d\'enregistrements)'
                                        },
                                        sDom: 'C<"clear">lfrtip',
                                        colVis: {
                                        order: "alfa",
                                                "buttonText": "Afficher / Masquer les colonnes"
                                        }
                                });
                                        var inputSearchClass = 'datatable_input_col_search';
                                        var columnInputs = $('tfoot .' + inputSearchClass);
                                        // On input keyup trigger filtering
                                        columnInputs.keyup(function () {
                                        dtInstance1.fnFilter(this.value, columnInputs.index(this));
                                        });
<?php } ?>
<?php if ($action == 'view_fiche_client') { ?>
            $("#retour").on('click', function () {
            document.location.href = 'index.php?module=clients&action=all_view_clients';
            });

<?php } ?>
<?php
if ($action == 'add_client') {   ?>

         $("#date_adhesion").datepicker({maxDate: strDate});

<?php } ?>

  });
</script>
<script type="text/javascript">
            var auto_refresh = setInterval(
                    function () {
                    $('#nbre_messages').load('./vues/membre/record_count_message.php').fadeIn("slow");
                    }, 1000000);

</script>

