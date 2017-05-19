<head>
    <!-- Meta-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>MEGA-TV[BOUQUET]</title>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/app/css/bootstrap.css">
    <!-- Vendor CSS-->
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/animo/animate+animo.css">
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/csspinner/csspinner.min.css">
        <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/jqueryui/css/no-theme/jquery-ui.css">
    <!-- Data Table styles-->
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/datatable/extensions/datatable-bootstrap/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/vendor/datatable/extensions/ColVis/css/dataTables.colVis.css">
    <!-- END Page Custom CSS-->
    <!-- App CSS-->
    <link rel="stylesheet" href="http://megatv.fr/gestion-admin/app/css/app.css">
    <!-- Modernizr JS Script-->
    <script src="http://megatv.fr/gestion-admin/vendor/modernizr/modernizr.js" type="application/javascript"></script>
    <!-- FastClick for mobiles-->
    <script src="http://megatv.fr/gestion-admin/vendor/fastclick/fastclick.js" type="application/javascript"></script>
    <script src="http://megatv.fr/gestion-admin/vendor/jquery/jquery.min.js"></script>
    <script src="http://megatv.fr/gestion-admin/vendor/jqueryui/js/jquery-ui.min.js"></script>
    <script src="http://megatv.fr/gestion-admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://megatv.fr/media/plugin_js/bootbox.min.js"></script>
    <script type="text/javascript">
 $(document).ready(function () {
<?php if ($action == 'all_chaines_Tv') { ?>
              $('#liste_films tbody').on('click', 'button[name="delete_film"]', function () {
               
                      var id_film = $(this).attr('id');
                     
                                                        $.ajax({
                                                        url: "controleurs/Films/delete_film.php",
                                                                type: "POST",
                                                                data: {id_film: id_film},
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (data) {
                                                                                      objet_message = data.message;
                                                                                      objet_message.reponse = Boolean(objet_message.reponse);
                                                                                      if (objet_message.reponse) {
                                                                                            bootbox.dialog({   
                                                                                                    message: "Le Film a &eacute;t&eacute;  supprimer de la base avec succ&eacute;es",
                                                                                                    title: "<span class='glyphicon glyphicon glyphicon-ok'></span>Message de confirmation ",
                                                                                                    buttons: {
                                                                                                            success: {
                                                                                                                    label: "OK",
                                                                                                                     className: "btn-success",
                                                                                                                      callback: function () {
                                                                                                                           window.location.reload(true);
                                                                                                                      }
                                                                                                            }
                                                                                                    }
                                                                                             });
                                                                                       }else {
                                                                                              objet_message = data.message_erreur;
                                                                                              balise = "<ul>";
                                                                                              $.each(objet_message, function (index, field) {
                                                                                                    balise += "<li>" + field + "</li>";
                                                                                              });
                                                                                              balise += "</ul>";
                                                                                               bootbox.alert({
                                                                                                    title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                                                                            message: balise,
                                                                                                });
                                                                                             }
                                                                          
                                                                    
                                                                },
                                                                error: function (jqXHR, error, errorThrown) {
                                                                    bootbox.alert({
                                                                            title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                            message: "Il ya une erreur interne dans le traitement dans votre demande.Contacter l'adminstrateur de site",
                                                                    });
                                                                }
                                                        });
                 });
        
<?php } ?>        
<?php if ($action == 'add_film') { ?>
                               $(function() {
                                    $("#date_upload").datepicker({                                              
                                                changeMonth: true,
                                                changeYear: true,
                                                altField: "#datepicker",
                                                closeText: 'Fermer',
                                                prevText: 'Précédent',
                                                nextText: 'Suivant',
                                                currentText: 'Aujourd\'hui',
                                                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                                monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                                                dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                                                dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                                                dayNamesMin: ['D', 'L', 'Ma', 'Me', 'J', 'V', 'S'],
                                                weekHeader: 'Sem.',
                                                dateFormat: 'yy-mm-dd'
                                         });
                                  });
                                  /****************************************************/
                $("#select_source").on('change', function () {
                    //initialisation();
                    var code_source = $(this).val(),
                            balise = '';
                    /**************** Debut Appel la requette Ajax pour charger la liste des comptes********************/
                    $.ajax({
                        url: 'controleurs/liste_comptes.php',
                        type: 'POST',
                        data: {code_source: code_source},
                        dataType: 'json',
                        cache: false,
                        success: function (reponse) {
                            objet_json = reponse.liste;
                            balise += '<option value="">Choisir un compte</option>';
                            $.each(objet_json, function (index, field) {
                                balise += '<option value="' + field.code_compte + '">' + field.nom_compte + '</option>';
                            });
                            $("#select_compte").html('').append(balise);
                        }
                    });
                });
                /*************** envoyer le formulaire ****************/

                $('#add_film').on('submit', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: $this.serialize(),
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                var balise_html = '';
                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span> Le fichier  à été bien enregistré et crée dans le serveur.</div>";
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-warning-sign'></span> Message de confirmation ",
                                    message: balise_html});
                            }
                            else {
                                //console.log('erreur');
                                objet_message_erreur = data.message_erreur;
                                balise = "<ul>";
                                $.each(objet_message_erreur, function (index, field) {
                                    balise += "<li>" + field + "</li>";
                                });
                                balise += "</ul>";
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                    message: balise});
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {
                            bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                message: "Il ya une erreur interne dans le traitement de script",
                            });
                        }

                    });
                    return false;
                });
<?php } ?>
<?php if ($action == 'add_cartoon') { ?>
                               $(function() {
                                    $("#date_upload").datepicker({                                              
                                                changeMonth: true,
                                                changeYear: true,
                                                altField: "#datepicker",
                                                closeText: 'Fermer',
                                                prevText: 'Précédent',
                                                nextText: 'Suivant',
                                                currentText: 'Aujourd\'hui',
                                                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                                monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                                                dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                                                dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                                                dayNamesMin: ['D', 'L', 'Ma', 'Me', 'J', 'V', 'S'],
                                                weekHeader: 'Sem.',
                                                dateFormat: 'yy-mm-dd'
                                         });
                                  });
                                  /****************************************************/
                $("#select_source").on('change', function () {
                    //initialisation();
                    var code_source = $(this).val(),
                            balise = '';
                    /**************** Debut Appel la requette Ajax pour charger la liste des comptes********************/
                    $.ajax({
                        url: 'controleurs/liste_comptes.php',
                        type: 'POST',
                        data: {code_source: code_source},
                        dataType: 'json',
                        cache: false,
                        success: function (reponse) {
                            objet_json = reponse.liste;
                            balise += '<option value="">Choisir un compte</option>';
                            $.each(objet_json, function (index, field) {
                                balise += '<option value="' + field.code_compte + '">' + field.nom_compte + '</option>';
                            });
                            $("#select_compte").html('').append(balise);
                        }
                    });
                });
                /*************** envoyer le formulaire ****************/

                $('#add_cartoon').on('submit', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: $this.serialize(),
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                var balise_html = '';
                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span> Le fichier  à été bien enregistré et crée dans le serveur.</div>";
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-warning-sign'></span> Message de confirmation ",
                                    message: balise_html});
                            }
                            else {
                                //console.log('erreur');
                                objet_message_erreur = data.message_erreur;
                                balise = "<ul>";
                                $.each(objet_message_erreur, function (index, field) {
                                    balise += "<li>" + field + "</li>";
                                });
                                balise += "</ul>";
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                    message: balise});
                            }

                        },
                        error: function (jqXHR, error, errorThrown) {
                            bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                message: "Il ya une erreur interne dans le traitement de script",
                            });
                        }

                    });
                    return false;
                });
<?php } ?>
});
</script>




</head>

