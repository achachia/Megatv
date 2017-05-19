<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $infos_page['title_page']; ?></title> 
<meta name="keywords" content="<?= $infos_page['keywords']; ?>">
<meta name="description" content="<?= $infos_page['description']; ?>">
<link href="<?= dir_media; ?>/css/boostrap.min.css?c=943916400" rel="stylesheet" type="text/css"/>
<link href="<?= dir_media; ?>/fontawesome/css/font-awesome.css"   rel="stylesheet">
<link href="<?= dir_media; ?>/css/mega_cours.css?c=943916400"  rel="stylesheet">
<!--<link href="<?= dir_media; ?>/css/style.css"  rel="stylesheet">-->
<link href="../librairie/jQuery-File-Upload-master/css/style.css" rel="stylesheet" type="text/css"/>
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link href="../librairie/jQuery-File-Upload-master/css/jquery.fileupload.css" rel="stylesheet" type="text/css"/>

<script src="<?= dir_media; ?>/js/jquery.js?c=943916400"></script>
<script src="<?= dir_media; ?>/js/bootstrap.min.js?c=943916400"></script>

<script src="<?= dir_media; ?>/plugin_js/bootbox.min.js" type="text/javascript"></script>
<script src="<?= dir_media; ?>/plugin_js/activity-indicator.js" type="text/javascript"></script>
<script src="<?= dir_media; ?>/plugin_js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= dir_media; ?>/js/app.js"></script>

<link href="<?= dir_media; ?>/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?= dir_media; ?>/jquery-ui/jquery-ui.min.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../librairie/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../librairie/jQuery-File-Upload-master/js/jquery.iframe-transport.js" type="text/javascript"></script>
<!-- The basic File Upload plugin -->
<script src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload.js" type="text/javascript"></script>

<!--<link rel="stylesheet" href="<?= dir_media; ?>/boostrapValidator/vendor/formvalidation/css/formValidation.min.css"/> 
<script type="text/javascript" src="<?= dir_media; ?>/boostrapValidator/vendor/formvalidation/js/formValidation.min.js"></script>
<script type="text/javascript" src="<?= dir_media; ?>/boostrapValidator/vendor/formvalidation/js/framework/bootstrap.min.js"></script>-->

<!--<link href="<?= dir_media; ?>/boostrapValidator/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="//oss.maxcdn.com/momentjs/2.8.2/moment.min.js"></script>
<script src="<?= dir_media; ?>/boostrapValidator/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="<?= dir_media; ?>/css/bootstrap-select.min.css" />
<script src="<?= dir_media; ?>/plugin_js/bootstrap-select.min.js"></script>-->

<!--<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script

<link rel="stylesheet" href="<?= dir_media; ?>/plugin_js/animo/animate+animo.css" />
<script src="<?= dir_media; ?>/plugin_js/animo/animo.min.js"></script>



<!--<script src="<?= dir_media; ?>/live_editor/scripts/innovaeditor.js"></script>
<script src="<?= dir_media; ?>/live_editor/scripts/innovamanager.js"></script>-->

<link href="<?= dir_media; ?>/datatable/extensions/datatable-bootstrap/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="<?= dir_media; ?>/datatable/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= dir_media; ?>/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

<script type="text/javascript">
    $(document).ready(function () {

        /********* start Objet datatable ***********************/
        if (!$.fn.dataTable)
            return;
        /********* end Objet datatable ***********************/
<?php if ($action == 'nous_contacter') { ?>

            $('#form_contact').on('submit', function (e) {
                e.preventDefault();
                var $this = $(this),
                        object_erreur = [],
                        data = {};
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val(),
                            drapeau = true;
                    if (value == '') {
                        drapeau = false;
                        chaine = 'le champ  est obligatoire';

                    }

                    if (!drapeau) {
                        if (!$this.next("#text_erreur").length) {
                            $this.next("#text_erreur").empty();
                            $this.after("<span id='text_erreur' style='color:red'>" + chaine + "</span>");
                        }
                        object_erreur.push(chaine);
                    } else {
                        $this.next("#text_erreur").remove();
                        $this.prev("#erreur").remove();
                    }

                });
                if (object_erreur.length <= 0) {

                    $this.find('[name]').each(function (index, value) {
                        var $that = $(this),
                                name = $that.attr('name'),
                                value = $that.val();
                        data[name] = value;
                    });
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: data,
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $this[0].reset();
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-ok'></span> Message de confirmation ",
                                    message: 'Votre message a &eacute;t&eacute; envoy&eacute; avec succ&eacute;s',
                                });


                            }
                            else {
                                objet_erreur = objet_message.message_erreur;
                                balise = "<ul>";
                                $.each(objet_erreur, function (index, field) {
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
                                message: "Veuillez contacter le webmaster du site",
                            });
                        }

                    });
                } else {
                    $('html,body').animate({scrollTop: $("#text_erreur").parent().offset().top}, "slow");
                }
                return false;
            });



<?php } ?>
<?php if ($action == 'all_view_commandes') { ?>

            $('#mes_commandes').dataTable();
<?php } ?>

<?php if ($action == 'add_commande') { ?>

            $('#quantite').on('keyup', function () {
                var quantite = $(this).val();
                if (quantite != '' && (parseFloat(quantite) == parseInt(quantite)) && !isNaN(quantite)) {
                    $("#prix_total").val(quantite * $("#prix_unit").val());
                }
            });

            $('#add_commande').on('submit', function (e) {
                e.preventDefault();
                var $this = $(this),
                        object_erreur = [],
                        data = {};
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val(),
                            drapeau = true;
                    if (name != 'message_commande' && name != 'code_user' && name != 'id_abo') {
                        
                        if (value == '') {
                            drapeau = false;
                            chaine = 'le champ  est obligatoire';

                        } else {
                            if (name == 'quantite') {

                                if ((parseFloat(value) != parseInt(value)) || isNaN(value)) {
                                    drapeau = false;
                                    chaine = 'le champ  doit etre un entier';
                                }
                            }
                        }
                    }

                    if (!drapeau) {
                        if (!$this.next("#text_erreur").length) {
                            $this.next("#text_erreur").empty();
                            $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                            $this.after("<span id='text_erreur' style='color:red'>" + chaine + "</span>");
                        }
                        object_erreur.push(chaine);
                    } else {
                        $this.next("#text_erreur").remove();
                        $this.prev("#erreur").remove();
                    }

                });
                if (object_erreur.length <= 0) {

                    $this.find('[name]').each(function (index, value) {
                        var $that = $(this),
                                name = $that.attr('name'),
                                value = $that.val();
                        data[name] = value;
                    });
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: data,
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                window.location.href = objet_message.lien_redirection;
                            }
                            else {
                                objet_erreur = objet_message.message_erreur;
                                balise = "<ul>";
                                $.each(objet_erreur, function (index, field) {
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
                                message: "Veuillez contacter le webmaster du site",
                            });
                        }

                    });
                } else {               
                    $('html,body').animate({scrollTop: $("#erreur").offset().top}, "slow");
                }
                return false;
            });
<?php } ?>
<?php if ($action == 'my_messages_recus') { ?>      
       $('#mes_messages_recus').dataTable(); 
       function popup_message_recu(data) {
                objet_message = data.message;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_message.date_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Heure</th><td>' + objet_message.heure_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Message</th><td>' + objet_message.objet_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Message</th><td>' + objet_message.core_message + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }

            $("button[value='cons_message_recu']").on('click', function () {              
                var code_message = $(this).attr('id');
                $.ajax({
                    url: "http://megatv.fr/espace_client/consulter-message-recu.html",
                    type: "POST",
                    data: {mod: "consultation_message_recu", code_message: code_message},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        if (typeof data.message != "undefined") {
                            var popup = popup_message_recu(data);
                            bootbox.alert(popup);
                        }
                    }
                });
            });
<?php } ?>
<?php if ($action == 'my_messages_envoye') { ?>
            $('#mes_messages_envoye').dataTable();
            function popup_message_envoye(data) {
                objet_message = data.message;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_message.date_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Heure</th><td>' + objet_message.heure_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Objet</th><td>' + objet_message.objet_message + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Message</th><td>' + objet_message.core_message + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }

            $("button[value='cons_message_envoye']").on('click', function () {
                var code_message = $(this).attr('id');
                $.ajax({
                    url: "http://megatv.fr/espace_client/consulter-message-envoye.html",
                    type: "POST",
                    data: {mod: "consultation_message_envoye", code_message: code_message},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        if (typeof data.message != "undefined") {
                            var popup = popup_message_envoye(data);
                            bootbox.alert(popup);
                        }
                    }
                });
            });

<?php } ?>
<?php if ($action == 'rep_message_recu') { ?>
 
 $('#form_rep_message').on('submit', function (e) {
            
                e.preventDefault();
                var     $this = $(this),
                        object_erreur = [],
                        data = {};
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val(),
                            drapeau = true;
                    if (value == '') {
                        drapeau = false;
                        chaine = 'le champ  est obligatoire';

                    }

                    if (!drapeau) {
                        if (!$this.next("#text_erreur").length) {
                            $this.next("#text_erreur").empty();
                            $this.after("<span id='text_erreur' style='color:red'>" + chaine + "</span>");
                        }
                        object_erreur.push(chaine);
                    } else {
                        $this.next("#text_erreur").remove();
                        $this.prev("#erreur").remove();
                    }

                });
                if (object_erreur.length <= 0) {

                    $this.find('[name]').each(function (index, value) {
                        var    $that = $(this),
                                name = $that.attr('name'),
                                value = $that.val();
                                data[name] = value;
                    });
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: data,
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            if (objet_message.reponse) {
                                $this[0].reset();
                                bootbox.alert({
                                    title: "<span class='glyphicon glyphicon-ok'></span> Message de confirmation ",
                                    message: 'Votre message a &eacute;t&eacute; envoy&eacute; avec succ&eacute;s',
                                });


                            }
                            else {
                                objet_erreur = objet_message.message_erreur;
                                balise = "<ul>";
                                $.each(objet_erreur, function (index, field) {
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
                                message: "Veuillez contacter le webmaster du site",
                            });
                        }

                    });
                } else {
                    $('html,body').animate({scrollTop: $("#text_erreur").parent().offset().top}, "slow");
                }
                return false;
            });



<?php } ?>

    });</script>


