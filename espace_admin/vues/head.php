<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $infos_page['title_page']; ?></title> 
<meta name="keywords" content="">
<meta name="description" content="">
<link href="<?= dir_media; ?>/css/boostrap.min.css?c=943916400" rel="stylesheet" type="text/css"/>
<link href="<?= dir_media; ?>/fontawesome/css/font-awesome.min.css?c=943916400"   rel="stylesheet">
<link href="<?= dir_media; ?>/css/mega_cours.css?c=943916400"  rel="stylesheet">
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
<script src="<?= dir_media; ?>/datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= dir_media; ?>/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>


<?php if ($action == 'view_calendrier') { ?>
    <link href="<?= dir_media; ?>/fullcalendar/css/fullcalendar.css" rel='stylesheet' />
    <link href="<?= dir_media; ?>/fullcalendar/css/fullcalendar.print.css" rel='stylesheet' media='print' />
    <script src="<?= dir_media; ?>/fullcalendar/js/moment.min.js"></script>
    <script src="<?= dir_media; ?>/fullcalendar/js/jquery-ui.custom.min.js"></script>
    <script src="<?= dir_media; ?>/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="<?= dir_media; ?>/fullcalendar/js/lang-all.js"></script>
<?php } ?>
<?php if ($action == 'create_compte_rendu' || $action == 'edit_compte_rendu' || $action == 'saisir_bilan_premier_cours' || $action == 'saisir_date_premier_cours') { ?>
       <script src='<?= dir_media; ?>/jquery-ui/jquery-ui-timepicker-addon.js'></script>
      <script src='<?= dir_media; ?>/jquery-ui/jquery-ui-sliderAccess.js'></script>
<?php } ?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<style type="text/css">
    #create_compte_rendu .form-control-feedback {
        top: 0;
        right: -15px;
    }
    #create_compte_rendu .selectContainer .form-control-feedback {   
        right: -15px;
     }
</style>
<script type="text/javascript">
    $(document).ready(function () {
   
        /********* start Objet datatable ***********************/
        if (!$.fn.dataTable)
            return;
        /********* end Objet datatable ***********************/
<?php if ($action == 'create_compte_rendu') { ?>
            //$("#datetime_picker").timepicker();
            //            $('#compte_rendu').liveEdit({
            //                height: 350,
            //                css: ['bootstrap/css/bootstrap.min.css', 'bootstrap/bootstrap_extend.css'] /* Apply bootstrap css into the editing area */,
            //                groups: [
            //                    ["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat"]],
            //                    ["group2", "", ["Bullets", "Numbering", "Indent", "Outdent"]],
            //                    ["group3", "", ["Paragraph", "FontSize", /*"FontDialog", "TextDialog"*/]],
            //                    /* ["group4", "", ["LinkDialog", "ImageDialog", "TableDialog", "Emoticons", "Snippets"]],*/
            //                    ["group5", "", ["Undo", "Redo"/*, "FullScreen", "SourceDialog"*/]]
            //                ] /* Toolbar configuration */
            //            });
            //
            //            $('#compte_rendu').data('liveEdit').startedit();
            /**************************************************************/
 //           $('#datePicker').datetimepicker();
//            tinymce.init({
//                selector: 'textarea',
//                setup: function (editor) {
//                    editor.on('keyup', function (e) {
//                        // Revalidate the hobbies field
//                        $('#create_compte_rendu').formValidation('revalidateField', 'compte_rendu');
//                    });
//                }
//            });

// $('#create_compte_rendu')
//            .find('[name="progression_cours"]')
//            .selectpicker()
//            .change(function(e) {              
//                       $('#create_compte_rendu').formValidation('revalidateField', 'progression_cours');
//            }).end()
//            .formValidation({
//                        framework: 'bootstrap',                  
//                        icon: {
//                            valid: 'glyphicon glyphicon-ok',
//                            invalid: 'glyphicon glyphicon-remove',
//                            validating: 'glyphicon glyphicon-refresh'
//                        },
//                        fields: {
//                            date_cours: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The date of birth is required'
//                                    },
//                                    date: {
//                                        format: 'MM/DD/YYYY h:m A',
//                                        message: 'The date of birth is not valid'
//                                    }
//                                }
//                            },
//                            code_coupon: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The code coupon is required'
//                                    },
//                                    stringLength: {
//                                        min: 10,
//                                        max: 10,
//                                        message: 'The username must be more than 6 and less than 30 characters long'
//                                    },
//                                    regexp: {
//                                        regexp: /^[A-Z0-9]+$/,
//                                        message: 'The username can only consist of alphabetical, number, dot and underscore'
//                                    }
//
//                                }
//                            },
//                            progression_cours: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The country is required and can\'t be empty'
//                                    }
//                                }
//                            },
//                            compte_rendu: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The country is required and can\'t be empty'
//                                    }
//                                }
//                            }
//                        }
//                    });
//                    .on('success.form.fv', function (e) {
//                        // Prevent form submission
//                        e.preventDefault();
//
//                        var $form = $(e.target),
//                                fv = $form.data('formValidation');
//
//                        // Use Ajax to submit form data
//                        $.ajax({
//                            url: $form.attr('action'),
//                            type: 'POST',
//                            data: $form.serialize(),
//                            success: function (result) {
//                                // ... Process the result ...
//                            }
//                        });
//                    });
//            $('#datePicker').on('dp.change dp.show', function (e) {
//                $('#create_compte_rendu').formValidation('revalidateField', 'date_cours');
//            });

//               $('#editor').jqxEditor({
//            height: 400,
//                    width: 450,
//                    tools:
//                    "bold italic underline | font size | left center right | outdent indent",
//                    createCommand: function (name) {
//                    switch (name) {
//                    case
//                            "font":
//                            return {
//                            init: function (widget) {
//                            widget.jqxDropDownList({
//                            source: [{ label:
//                                    'Arial', value: 'Arial, Helvetica, sans-serif' },
//                            { label:
//                                    'Comic Sans MS', value: '"Comic Sans MS", cursive, sans-serif' },
//                            { label:
//                                    'Courier New', value: '"Courier New", Courier, monospace' },
//                            { label:
//                                    'Georgia', value: "Georgia,serif" }]
//                            });
//                            }
//                            }
//                    case
//                            "size":
//                            return {
//                            init: function (widget) {
//                            widget.jqxDropDownList({
//                            source: [
//                            { label:
//                                    "8pt", value: "xx-small" },
//                            { label:
//                                    "12pt", value: "small" },
//                            { label:
//                                    "18pt", value: "large" },
//                            { label:
//                                    "36pt", value: "xx-large" }
//                            ]
//                            });
//                            }
//                            }
//                    }
//                    }
//            });
//      
//                    /**********************************************************/
//
//                    //http://www.dotnetbull.com/2013/04/jquery-scroll-to-top-bottom-and.html  
            var d = new Date();
            if (d.getMonth() + 1 < 10) {
                strDate = d.getFullYear() + "-0" + (d.getMonth() + 1) + "-" + d.getDate();
            }
            else {
                strDate = strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
             }
            $("#date_cours").datepicker({maxDate: strDate});
            $("#datetime_picker").timepicker();
//                    /////////////// debut ////////////////////////////             
//                    $('#create_theme').on('click', function () {
//            var form_add_them = '<form class="form-horizontal" id="form_add_theme" name="form_add_theme" method="POST" action="controleurs/compte_rendu/add_theme.php"> ';
//                    form_add_them += '<div id="message"></div>';
//                    form_add_them += '<div class="form-group"><label for="nom" class="control-label">NOM DE THEME</label><input type="text" class="form-control" id="nom_theme" name="nom_theme"></div> ';
//                    form_add_them += '	<input type="hidden" class="form-control" id="code_eleve" name="code_eleve" value="<?php echo $_GET['code_eleve']; ?>">';
//                    form_add_them += '</form>';
//                    bootbox.dialog({
//                    message: form_add_them,
//                           title: "Creation un theme",
//                           buttons: {
//                               success: {
//                                   label: "Enregistrer",
//                                   className: "btn-success",
//                                   callback: function () {
//                                       var data = {};
//                                       $("#form_add_theme").find('[name]').each(function (index, value) {
//                                           var $this = $(this),
//                                                   name = $this.attr('name'),
//                                                   value = $this.val();
//                                           data[name] = value;
//                                       });
//                                       $.ajax({
//                                           url: $("#form_add_theme").attr('action'),
//                                           type: $("#form_add_theme").attr('method'),
//                                           data: data,
//                                           dataType: 'json',
//                                           cache: false,
//                                           success: function (data) {
//                                               objet_message = data.message;
//                                               objet_message.reponse = Boolean(objet_message.reponse);
//                                               if (objet_message.reponse) {
//                                                   bootbox.alert("Votre  theme a &eacute;t&eacute; bien enregistr&eacute;", function () {
//                                                       var data = {};
//                                                       data['code_eleve'] = '<?php echo $_GET['code_eleve']; ?>';
//                                                       $.ajax({
//                                                           url: 'controleurs/compte_rendu/liste_theme_interv.php',
//                                                           type: 'POST',
//                                                           data: data,
//                                                           dataType: 'json',
//                                                           cache: false,
//                                                           success: function (data) {
//                                                               objet_liste_theme = data.liste_theme;
//                                                               balise = "<option></option>";
//                                                               $.each(objet_liste_theme, function (index, field) {
//                                                                   balise += "<option name='" + field.id_theme + "' id='" + field.id_theme + "'>" + field.nom_theme + "</option>";
//                                                               });
//                                                               $("#theme_cours").html(balise);
//                                                               //alert(balise);
//                                                           }
//                                                       });
//                                                   });
//                                               }
//                                               else {
//                                                   objet_message = data.message_erreur;
//                                                   balise = "<ul>";
//                                                   $.each(objet_message, function (index, field) {
//                                                       balise += "<li>" + field + "</li>";
//                                                   });
//                                                   balise += "</ul>";
//                                                   bootbox.alert({
//                                                       title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
//                                                       message: balise,
//                                                   });
//                                               }
//
//                                           },
//                                           error: function (jqXHR, error, errorThrown) {
//                                               bootbox.alert({
//                                                   title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
//                                                   message: "Il ya une erreur interne dans le traitement interne",
//                                               });
//                                           }
//                                       });
//                                   }
//                               }
//                           }
//                       });
//                   });
//                   //////////////fin//////////////
//                   //  debut
//                   $('#date_cours').change(function () {
//                       var $this = $(this),
//                               $date_cours = $this.val();
//                       if ($date_cours != '' && isDate($date_cours) && $date_cours <= strDate) {
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if (!$this.prev("#glyphicon-ok").length) {
//                               $this.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                           }
//                       }
//                       else {
//                           if ($this.prev("#glyphicon-ok").length) {
//                               $this.prev("#glyphicon-ok").remove();
//                           }
//                           if (!isDate($date_cours)) {
//                               message = "Le format de date de cours est incorrecte";
//                           }
//                           else if ($date_cours > strDate) {
//                               message = "Le format de date ne doit pas etre superieur a la date d'aujourdui";
//                           }
//                           if ($this.prev("#glyphicon-ok").length) {
//                               $this.prev("#glyphicon-ok").remove();
//                           }
//                           if (!$this.next("#text_erreur").length && !$this.prev("#erreur").length) {
//                               $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
//                               $this.after("<span id='text_erreur' style='color:red'>" + message + "</span>");
//                           }
//                       }
//                   });
//                   $('#date_cours').keyup(function () {
//                       var $this = $(this),
//                               $date_cours = $this.val();
//                       if ($date_cours != '' && isDate($date_cours) && $date_cours <= strDate) {
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if (!$this.prev("#glyphicon-ok").length) {
//                               $this.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                           }
//                       }
//                       else {
//                           if ($this.prev("#glyphicon-ok").length) {
//                               $this.prev("#glyphicon-ok").remove();
//                           }
//                           if (!isDate($date_cours)) {
//                               message = "Le format de date de cours est incorrecte";
//                           }
//                           else if ($date_cours > strDate) {
//                               message = "Le format de date ne doit pas etre superieur a la date d'aujourdui";
//                           }
//                           if ($this.prev("#glyphicon-ok").length) {
//                               $this.prev("#glyphicon-ok").remove();
//                           }
//                           if (!$this.next("#text_erreur").length && !$this.prev("#erreur").length) {
//                               $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
//                               $this.after("<span id='text_erreur' style='color:red'>" + message + "</span>");
//                           }
//                       }
//                   });
//                   $('#date_cours').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });
//                   // fin
//                   //  debut
//                   $('#datetime_picker').change(function () {
//                       var $this = $(this),
//                               $datetime_picker = $this.val();
//                       if ($datetime_picker != '') {
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if (!$this.prev("#glyphicon-ok").length) {
//                               $this.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                           }
//                       }
//                   });
//                   $('#datetime_picker').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });
//                   // fin
//                   //  debut
//                   $('#code_coupon').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });
//                   $('#code_coupon').keyup(function () {
//                       var $that = $(this),
//                               control = true,
//                               $code_coupon = $that.val();
//                       if ($code_coupon.length > 10) {
//                           control = false;
//                           message = "Le code coupon ne doit pas depasser 10 caract�res!!!";
//                       }
//                       if (!$code_coupon.match(/^[A-Z0-9]+$/) && $code_coupon.length != 0) {
//                           control = false;
//                           message = "Le code coupon ne doit contenir que des lettres en majuscules et des chiffres !!!";
//                       }
//                       if (!control) {
//                           if (!$that.next("#text_erreur").length && !$that.prev("#erreur").length) {
//                               $that.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
//                               $that.after("<span id='text_erreur' style='color:red'>" + message + "</span>");
//                           }
//
//                       }
//                       else {
//                           $that.prev("#erreur").remove();
//                           $that.next("#text_erreur").remove();
//                       }
//                       if (control && $code_coupon.length == 10) {
//
//                           $.ajax({
//                               url: 'controleurs/compte_rendu/check_code_coupon.php', // le nom du fichier indiqu� dans le formulaire
//                               type: 'POST', // la m�thode indiqu�e dans le formulaire (get ou post)
//                               data: {identifiant_coupon: $code_coupon}, // je s�rialise les donn�es (voir plus loin), ici les $_POST                         dataType: 'json',
//                               cache: false,
//                               success: function (data) {
//                                   objet_message = data.message;
//                                   objet_message.reponse = Boolean(objet_message.reponse);
//                                   if (objet_message.reponse) {
//                                       if ($that.next("#text_erreur").length && $that.prev("#erreur").length) {
//                                           $that.prev("#erreur").remove();
//                                           $that.next("#text_erreur").remove();
//                                       }
//                                       if (!$that.prev("#glyphicon-ok").length) {
//                                           $that.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                                       }
//
//                                   }
//                                   else {
//                                       if ($that.prev("#glyphicon-ok").length) {
//                                           $that.prev("#glyphicon-ok").remove();
//                                       }
//                                       if (!$that.next("#text_erreur").length && !$that.prev("#erreur").length) {
//                                           $that.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
//                                           $that.after("<span id='text_erreur' style='color:red'>Le code n'est pas valide</span>");
//                                       }
//                                   }
//                               }
//                           });
//                       }
//                   });
//                   // fin
//                   //  debut
//                   $('#progression_cours').change(function () {
//                       var $this = $(this),
//                               $progression_cours = $this.val();
//                       if ($progression_cours != '') {
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if (!$this.prev("#glyphicon-ok").length) {
//                               $this.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                           }
//                       }
//                   });
//                   $('#progression_cours').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });
//                   // fin
//                   //  debut
//                   $('#theme_cours').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });
//                   //fin
       /********************** compte rendu ***************/
//                   $('#compte_rendu').change(function () {
//                       var $this = $(this),
//                               $compte_rendu = $this.val();
//                       if ($compte_rendu != '') {
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if (!$this.prev("#glyphicon-ok").length) {
//                               $this.before("<span id='glyphicon-ok' class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
//                           }
//                       }
//                   });
//                   $('#compte_rendu').focus(function () {
//                       var $this = $(this);
//                       if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                           $this.prev("#erreur").remove();
//                           $this.next("#text_erreur").remove();
//                       }
//                       if ($this.prev("#glyphicon-ok").length) {
//                           $this.prev("#glyphicon-ok").remove();
//                       }
//                   });

        /**************************** envoi le formulaire ************************/
     $('#create_compte_rendu').on('submit', function () {
                       var     control = true,
                               $this = $(this),
                               data = {};
                       /*****************************/
                       $this.find('[name]').each(function (index, value) {
                           var    $this = $(this),
                                   name = $this.attr('name'),
                                   value = $this.val();
                           if (value == '') {
                               control = false; 
                               $this.prev("span").remove();
                               $this.next("span").remove();
                               $this.parent().remove("form-group");
                               $this.parent().addClass("form-group has-error has-feedback");
                               $this.before("<span  class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                               $this.after("<span  style='color:red'> Le champ  est obligatoire</span>");
                           }
                           else{
                                   //console.log($this.attr('name'));
                                   if(name != 'code_eleve'){
                                      $this.prev("span").remove();
                                      $this.next("span").remove();
                                      $this.parent().remove("form-group");
                                      $this.before("<span  class='glyphicon glyphicon-ok form-control-feedback pull-right'></span>");
                                   }
                                   
                              }
                            /******* controle code_coupon *************/  
                           if (name == 'code_coupon' && value != '') {
                               var     message = '',
                                       control1 = true;
                               if (value.length != 10) {
                                   control1 = false;
                                   message = "Le code coupon  doit contenir 10 caract�res!!!";
                               }
                               if (!value.match(/^[A-Z0-9]+$/) && value.length != 0) {
                                   control1 = false;
                                   message = "Le code coupon ne doit contenir que des lettres en majuscules et des chiffres !!!";
                               }
                               if (!control1) {
                                      control = control1;
                                      $this.prev("span").remove();
                                      $this.next("span").remove();
                                      $this.parent().remove("form-group");
                                      $this.parent().addClass("form-group has-error has-feedback");
                                      $this.before("<span  class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                                      $this.after("<span  style='color:red'>"+message+"</span>");
                               }
                           }
                           /******** controle date cours *************/
                           if (name == 'date_cours' && value != '') {
                               var message = '';
                               if (!isDate(value)) {
                                      control = false;
                                      message = "Le format de date cours est incorrecte !!!";
                                      $this.prev("span").remove();
                                      $this.next("span").remove();
                                      $this.parent().remove("form-group");
                                      $this.parent().addClass("form-group has-error has-feedback");
                                      $this.before("<span  class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                                      $this.after("<span  style='color:red'>"+message+"</span>");
                               }
                           }

                       });
                       /***************** remplissage le tableau des valeurs *********************/
                       if (control) {
                           $this.find('[name]').each(function (index, value) {
                               var    $this = $(this),
                                       name = $this.attr('name'),
                                       value = $this.val();
                                       data[name] = value;
                           });
                       }
                       /*********************Envoi requette Ajax *****************/
                       if (control) {
                           $.ajax({
                               url: $this.attr('action'),
                               type: $this.attr('method'),
                               data: data,
                               dataType: 'json',
                               cache: false,
                               beforeSend: function () {
                                   // $('#bouton_submit').html("<img src='./../img/ajax-loader_1.gif' />");
                               },
                               success: function (data) {
                                   $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                   objet_message = data.message;
                                   objet_message.reponse = Boolean(objet_message.reponse);
                                   var balise_html = '';
                                   if (objet_message.reponse) {
                                       balise_html += '<div class="alert alert-dismissable alert-success">';
                                       balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                       balise_html += '<strong><span class="glyphicon glyphicon glyphicon-ok"></span> Le compte rendu a &eacute;t&eacute; bien enregistr&eacute;</strong>';
                                       balise_html += '</div>';
                                   }
                                   else {
                                       balise_html += '<div class="alert alert-dismissable alert-danger">';
                                       balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                       balise_html += '<strong><span class="glyphicon glyphicon-warning-sign"></span> Le compte rendu est incomplet</strong>';
                                       balise_html += '</div>';
                                   }
                                   // $('#bouton_submit').html('').text("Enregistrer");
                                      $("#message").html('').append(balise_html).fadeOut(8000, function () {
                                       $(this).html('');
                                       if (objet_message.reponse) {
                                           //window.location.reload(true);
                                       }
                                   }
                                   );
                               },
                               error: function (jqXHR, error, errorThrown) {
                                   bootbox.alert({
                                       title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                       message: "Votre demande a ete refuse,Contcater votre conseiller pedagogique",
                                   });
                               }
                           });
                       }
                       else {
                           $('html,body').animate({scrollTop: $(".glyphicon-remove").offset().top}, "slow");
                       }
                       return false;
                   });
//                   $(":reset").on('click', function () {
//                       $this = $('#create_compte_rendu');
//                       $this.find('[name]').each(function (index, value) {
//                           var $this = $(this);
//                           if ($this.next("#text_erreur").length && $this.prev("#erreur").length) {
//                               $this.prev("#erreur").remove();
//                               $this.next("#text_erreur").remove();
//                           }
//                           if ($this.prev("#glyphicon-ok").length) {
//                               $this.prev("#glyphicon-ok").remove();
//                           }
//                       });
//                   });    
<?php } ?>
<?php if ($action == 'all_view_eleve') { ?>
    <?php if (isset($liste_eleves) && sizeof($liste_eleves) > 0) { ?>
                $('#liste_eleves').dataTable({
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
                    "order": [[0, "desc"]]
                });
    <?php } ?>
<?php } ?>
<?php if ($action == 'view_bilan_prestation_eleve') { ?>
    <?php if (isset($bilan_prestation_eleve) && sizeof($bilan_prestation_eleve) > 0) { ?>
                $('#liste_prestation_eleve').dataTable({
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
                    "order": [[0, "desc"]]
                });
    <?php } ?>

<?php } ?>
<?php if ($action == 'edit_compte_rendu') { ?>
            $("#date_cours").datepicker();
            $("#datetime_picker").timepicker();
            $('#compte_rendu').liveEdit({
                height: 350,
                css: ['bootstrap/css/bootstrap.min.css', 'bootstrap/bootstrap_extend.css'] /* Apply bootstrap css into the editing area */,
                groups: [
                    ["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat"]],
                    ["group2", "", ["Bullets", "Numbering", "Indent", "Outdent"]],
                    ["group3", "", ["Paragraph", "FontSize", /*"FontDialog", "TextDialog"*/]],
                    /* ["group4", "", ["LinkDialog", "ImageDialog", "TableDialog", "Emoticons", "Snippets"]],*/
                    ["group5", "", ["Undo", "Redo"/*, "FullScreen", "SourceDialog"*/]]
                ] /* Toolbar configuration */
            });

            $('#compte_rendu').data('liveEdit').startedit();


            //            //  debut
            //            $('#date_cours').change(function () {
            //                var $this = $(this),
            //                        $date_cours = $this.val();
            //                if ($date_cours != '') {
            //                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
            //                }
            //            });
            //            $('#date_cours').focus(function () {
            //                var $this = $(this);
            //                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                $this.next("#text_erreur").empty();
            //            });
            //            // fin
            //            //  debut
            //            $('#datetime_picker').change(function () {
            //                var $this = $(this),
            //                        $datetime_picker = $this.val();
            //                if ($datetime_picker != '') {
            //                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
            //                }
            //            });
            //            $('#datetime_picker').focus(function () {
            //                var $this = $(this);
            //                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                $this.next("#text_erreur").empty();
            //            });
            //            // fin
            //            //  debut
            //            $('#progression_cours').change(function () {
            //                var $this = $(this),
            //                        $progression_cours = $this.val();
            //                if ($progression_cours != '') {
            //                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
            //                }
            //            });
            //            $('#progression_cours').focus(function () {
            //                var $this = $(this);
            //                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                $this.next("#text_erreur").empty();
            //            });
            //            // fin
            //            //  debut
            //            $('#compte_rendu').change(function () {
            //                var $this = $(this),
            //                        $compte_rendu = $this.val();
            //                if ($compte_rendu != '') {
            //                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
            //                }
            //            });
            //            $('#compte_rendu').focus(function () {
            //                var $this = $(this);
            //                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
            //                $this.next("#text_erreur").empty();
            //            });
            // fin



            $('#update_compte_rendu').on('submit', function (e) {
                var control = true,
                        $this = $(this),
                        data = {};
                e.preventDefault();
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    //                    if (value == '') {
                    //                        control = false;
                    //                        if (!$this.next("#text_erreur").length || !$this.prev("#erreur").length) {
                    //                            $this.parent().remove("form-group");
                    //                            $this.parent().addClass("form-group has-error has-feedback");
                    //                            $this.next("#text_erreur").empty();
                    //                            $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                    //                            $this.after("<span id='text_erreur' style='color:red'> Le champ  est obligatoire</span>");
                    //                        }
                    //                        $('html,body').animate({scrollTop: $("#erreur").offset().top}, "slow");
                    //                    }

                });
                if (control) {
                    $this.find('[name]').each(function (index, value) {
                        var $this = $(this),
                                name = $this.attr('name'),
                                value = $this.val();
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
                            var balise_html = '';
                            if (objet_message.reponse) {
                                balise_html += '<div class="alert alert-dismissable alert-success">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le compte rendu a �t� bien modifi�</strong>';
                                balise_html += '</div>';
                                $("#message").html('').append(balise_html);
                            }
                            else {
                                balise_html += '<div class="alert alert-dismissable alert-danger">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le compte rendu est incomplet</strong>';
                                balise_html += '</div>';
                                $("#message").html('').append(balise_html);
                            }
                            $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                        }
                    });
                }
                return control;
            });
            $(":reset").on('click', function () {
                $this = $('#mod_compte_rendu');
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this);
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.next("#text_erreur").empty();
                });
            });
<?php } ?>
<?php if ($action == 'disponibilite') { ?>
            $('#form_disponibilite').on('submit', function (e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.attr('action'),
                    type: $this.attr('method'),
                    data: $this.serialize(),
                    dataType: 'json',
                    success: function (data) {
                        objet_message = data.message;
                        if (objet_message.reponse == 'oui') {
                            bootbox.alert("Vos disponibilit&eacute;s ont &eacute;t&eacute; bien enregistr&eacute;");
                        }
                        else {
                            bootbox.alert("Il y'a une erreur dans la saisie");
                        }
                    }
                });
            });
<?php } ?>
<?php if ($action == 'edit_bilan_prem_cours') { ?>
            $('#update_bilan_premier_cours').on('submit', function (e) {
                var control = true,
                        $this = $(this),
                        data = {};
                e.preventDefault();
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    if (value == '') {
                        control = false;
                        if (!$this.next("#text_erreur").length || !$this.prev("#erreur").length) {
                            $this.parent().remove("form-group");
                            $this.parent().addClass("form-group has-error has-feedback");
                            $this.next("#text_erreur").empty();
                            $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                            $this.after("<span id='text_erreur' style='color:red'> Le champ  est obligatoire</span>");
                        }

                        $('html,body').animate({scrollTop: $("#erreur").offset().top}, "slow");
                    }
                });
                if (control) {
                    $this.find('[name]').each(function (index, value) {
                        var $this = $(this),
                                name = $this.attr('name'),
                                value = $this.val();
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
                            var balise_html = '';
                            if (objet_message.reponse) {
                                balise_html += '<div class="alert alert-dismissable alert-success">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le bilan a &eacute;t&eacute; bien modifi&eacute;</strong>';
                                balise_html += '</div>';
                                $("#message").html('').append(balise_html);
                            }
                            else {
                                balise_html += '<div class="alert alert-dismissable alert-danger">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le bilan est incomplet</strong>';
                                balise_html += '</div>';
                                $("#message").html('').append(balise_html);
                            }
                            $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                        }
                    });
                }
                return false;
            });
            $(":reset").on('click', function () {
                $this = $('#update_bilan_premier_cours');
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this);
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.next("#text_erreur").empty();
                });
            });
<?php } ?>
<?php if ($action == 'all_view_bilan_prem_cours') { ?>
    <?php if (isset($mes_bilan_prem_cours) && sizeof($mes_bilan_prem_cours) > 0) { ?>
                $('#mes_bilan_prem_cours').dataTable({
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
                    "order": [[0, "desc"]]
                });

                $('#mes_bilan_prem_cours tbody').on('click', 'button[value="cons_mes_bilan_prem_cours"]', function () {
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "controleurs/compte_rendu/view_bilan_prem_cours.php",
                        type: "POST",
                        data: {mod: "consultation_mes",
                            id_bilan: id},
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            if (typeof data.bilan_premier_cours != "undefined") {
                                var popup_generer = popup_generer_mes(data);
                                bootbox.alert(popup_generer);
                            }
                        }
                    });
                });
    <?php } ?>

<?php } ?>
<?php if ($action == 'all_view_compte_rendu') { ?>
        function popup_generer_mes(data) {
        objet_compte_rendu = data.compte_rendu;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>&Eacute;l&egrave;ve</th><td>' + objet_compte_rendu.eleve + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_compte_rendu.date_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Heure</th><td>' + objet_compte_rendu.heure_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>E-coupon</th><td>' + objet_compte_rendu.e_coupon + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Progression-cours</th><td>' + objet_compte_rendu.progression_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Compte-rendu</th><td>' + objet_compte_rendu.resume_cours + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
        }
        function generer_popup_autre(data) {
        objet_compte_rendu = data.compte_rendu;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>El�ve</th><td>' + objet_compte_rendu.eleve + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Date</th><td>' + objet_compte_rendu.date_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Progression </th><td>' + objet_compte_rendu.progression_cours + '</td>';
                table += '</tr>';
                table += '<tr>';
                table += '<th>Compte-rendu </th><td>' + objet_compte_rendu.resume_cours + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
        }
        $('#mes_compte_rendu').dataTable({
          "order": [[0, "desc"]]   
         });
                $('#autres_compte_rendu').dataTable();
                $('#mes_compte_rendu tbody').on('click', 'button[value="cons_mes_compte_rendu"]', function () {
                 var id_compte = $(this).attr('id');
                $.ajax({
                        url: "index.php?module=compte_rendu&action=view_compte_rendu",
                        type: "POST",
                        data: {mod: "consultation_mes",
                                id_compte_rendu: id_compte},
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                        if (typeof data.compte_rendu != "undefined") {
                        var popup_generer = popup_generer_mes(data);
                                bootbox.alert(popup_generer);
                        }
                        }
                });
        });
  $('#autres_compte_rendu tbody').on('click', 'button[value="cons_autre_compte_rendu"]', function () {
               var id_compte = $(this).attr('id');
                $.ajax({
                        url: "index.php?module=compte_rendu&action=view_compte_rendu",
                        type: "POST",
                        data: {mod: "consultation_mes",
                                id_compte_rendu: id_compte},
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                        if (typeof data.compte_rendu != "undefined") {
                        var popup_generer = popup_generer_mes(data);
                                bootbox.alert(popup_generer);
                        }
                        }
                });
        });
<?php } ?>
<?php if ($action == 'view_calendrier') { ?>
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2014-06-12',
                lang: 'fr',
                editable: true,
                events: [
                    {
                        title: 'All Day Event',
                        start: '2014-06-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2014-06-07',
                        end: '2014-06-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2014-06-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2014-06-16T16:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2014-06-12T10:30:00',
                        end: '2014-06-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2014-06-12T12:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2014-06-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2014-06-28'
                    }
                ]
            });
<?php } ?>
<?php if ($action == 'modif_profil') { ?>
            $('#update_profil').on('submit', function (e) {
                e.preventDefault();
                var control = true,
                        $this = $(this),
                        data = {};
                if (control) {
                    $this.find('[name]').each(function (index, value) {
                        var $that = $(this),
                                name = $that.attr('name'),
                                value = $that.val();
                        data[name] = value;
                    });
                    $.ajax({
                        url: $this.attr('action'), // le nom du fichier indiqu� dans le formulaire
                        type: $this.attr('method'), // la m�thode indiqu�e dans le formulaire (get ou post)
                        data: data, // je s�rialise les donn�es (voir plus loin), ici les $_POST
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            if (objet_message.reponse == 'oui') {
                                bootbox.alert("Votre profil a �t� mis � jour");
                            }
                            else {
                                bootbox.alert("Il y'a une erreur dans la saisie");
                            }
                        }
                    });
                }

            });
<?php } ?>
<?php if ($action == 'contact_conseiller') { ?>
            //http://www.dotnetbull.com/2013/04/jquery-scroll-to-top-bottom-and.html
            //  debut
            $('#objet_message').change(function () {
                var $this = $(this),
                        $objet_message = $this.val();
                if ($objet_message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#objet_message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            //  debut
            $('#message').change(function () {
                var $this = $(this),
                        $message = $this.val();
                if ($message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            $('#form_conseiller').on('submit', function (e) {
                var control = true,
                        $this = $(this),
                        data = {};
                e.preventDefault();
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    if (value == '') {
                        control = false;
                        $this.parent().remove("form-group");
                        $this.parent().addClass("form-group has-error has-feedback");
                        $this.prev("#erreur").addClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                        $this.next("#text_erreur").text("Le champ  est obligatoire ").css("color", "red");
                    }
                    else {
                        control = true;
                        data[name] = value;
                    }

                });
                if (control) {
                    $.ajax({
                        url: $this.attr('action'), // le nom du fichier indiqu� dans le formulaire
                        type: $this.attr('method'), // la m�thode indiqu�e dans le formulaire (get ou post)
                        data: data, // je s�rialise les donn�es (voir plus loin), ici les $_POST  
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            var balise_html = '';
                            if (objet_message.reponse == 'oui') {
                                balise_html += '<div class="alert alert-dismissable alert-success">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Vore message a �t� bien enregistr�</strong>';
                                balise_html += '</div>';
                                $("#retour_message").html('').append(balise_html);
                            }
                            else {
                                balise_html += '<div class="alert alert-dismissable alert-danger">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le message est incomplet</strong>';
                                balise_html += '</div>';
                                $("#retour_message").html('').append(balise_html);
                            }
                        }
                    });
                }
                $('html,body').animate({scrollTop: $("#retour_message").offset().top}, "slow");
                return control;
            });
            $(":reset").on('click', function () {
                $this = $('#form_conseiller');
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this);
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.next("#text_erreur").empty();
                });
            });
<?php } ?>
<?php if ($action == 'contact_intervenant') { ?>
            $('#code_distinataire').change(function () {
                var $this = $(this),
                        $code_distinataire = $this.val();
                if ($code_distinataire != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#code_distinataire').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
            });
            //fin
            //  debut
            $('#objet_message').change(function () {
                var $this = $(this),
                        $objet_message = $this.val();
                if ($objet_message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#objet_message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            //  debut
            $('#message').change(function () {
                var $this = $(this),
                        $message = $this.val();
                if ($message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            $('#form_intervenant').on('submit', function (e) {
                var control = true,
                        $this = $(this),
                        data = {};
                e.preventDefault();
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    if (value == '') {
                        control = false;
                        $this.parent().remove("form-group");
                        $this.parent().addClass("form-group has-error has-feedback");
                        $this.prev("#erreur").addClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                        $this.next("#text_erreur").text("Le champ  est obligatoire ").css("color", "red");
                    }
                    else {
                        control = true;
                        data[name] = value;
                    }

                });
                if (control) {
                    $.ajax({
                        url: $this.attr('action'), // le nom du fichier indiqu� dans le formulaire
                        type: $this.attr('method'), // la m�thode indiqu�e dans le formulaire (get ou post)
                        data: data, // je s�rialise les donn�es (voir plus loin), ici les $_POST  
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            objet_message = data.message;
                            var balise_html = '';
                            if (objet_message.reponse == 'oui') {
                                balise_html += '<div class="alert alert-dismissable alert-success">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Vore message a �t� bien enregistr�</strong>';
                                balise_html += '</div>';
                                $("#retour_message").html('').append(balise_html);
                            }
                            else {
                                balise_html += '<div class="alert alert-dismissable alert-danger">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le formulaire est incomplet</strong>';
                                balise_html += '</div>';
                                $("#retour_message").html('').append(balise_html);
                            }
                        }
                    });
                }
                $('html,body').animate({scrollTop: $("#retour_message").offset().top}, "slow");
                return control;
            });
            $(":reset").on('click', function () {
                $this = $('#form_intervenant');
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this);
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.next("#text_erreur").empty();
                });
            });
<?php } ?>
<?php if ($action == 'contact_famille') { ?>
            $('#code_distinataire').change(function () {
                var $this = $(this),
                        $code_distinataire = $this.val();
                if ($code_distinataire != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#code_distinataire').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
            });
            //fin
            //  debut
            $('#objet_message').change(function () {
                var $this = $(this),
                        $objet_message = $this.val();
                if ($objet_message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#objet_message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            //  debut
            $('#message').change(function () {
                var $this = $(this),
                        $message = $this.val();
                if ($message != '') {
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.prev("#erreur").addClass("glyphicon glyphicon-ok form-control-feedback pull-right");
                }
            });
            $('#message').focus(function () {
                var $this = $(this);
                $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                $this.next("#text_erreur").empty();
                $("#retour_message").empty();
            });
            // fin
            $('#form_famille').on('submit', function () {
                var control = true,
                        $this = $(this),
                        wid = $("#form").width(),
                        heig = $("#form").height(),
                        data = {};
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    if (value == '') {
                        control = false;
                        $this.parent().remove("form-group");
                        $this.parent().addClass("form-group has-error has-feedback");
                        $this.prev("#erreur").addClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                        $this.next("#text_erreur").text("Le champ  est obligatoire ").css("color", "red");
                    }
                    else {
                        control = true;
                        data[name] = value;
                    }

                });
                if (control) {
                    $.ajax({
                        url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: data,
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                            //$('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                        },
                        success: function (data) {
                            // $("#load").removeClass("loas_gif");
                            $("#load").hide();
                            $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");

                            objet_message = data.message;
                            objet_message.reponse = Boolean(objet_message.reponse);
                            var balise_html = '';
                            if (objet_message.reponse) {
                                $this[0].reset();
                                balise_html += '<div class="alert alert-dismissable alert-success">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Vore message a &eacute;t&eacute; bien enregistr&eacute;</strong>';
                                balise_html += '</div>';
                            }
                            else {
                                balise_html += '<div class="alert alert-dismissable alert-danger">';
                                balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                                balise_html += '<strong>Le formulaire est incomplet</strong>';
                                balise_html += '</div>';
                            }
                            $("#message").html('').append(balise_html);
                            $("#message").fadeOut(9000);
                        }
                    });
                }
                return false;
            });
            $(":reset").on('click', function () {
                $this = $('#form_famille');
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this);
                    $this.prev("#erreur").removeClass("glyphicon glyphicon-remove form-control-feedback pull-right");
                    $this.next("#text_erreur").empty();
                });
            });
<?php } ?>
<?php if ($action == 'view_all_message') { ?>
            function popup_message_recu(data) {
                objet_message = data.message;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>Expediteur</th><td>' + objet_message.expediteur + '</td>';
                table += '</tr>';
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
                table += '<th>Message</th><td>' + objet_message.message + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }
            $('#mes_messages_recus').dataTable();
            $("button[value='cons_message_recu']").on('click', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "controleurs/membre/view_message.php", // le nom du fichier indiqu� dans le formulaire
                    type: "POST", // la m�thode indiqu�e dans le formulaire (get ou post)
                    data: {mod: "consultation_message_recu",
                        id_message: id}, // je s�rialise les donn�es (voir plus loin), ici les $_POST
                    dataType: 'json',
                    cache: false,
                    success: function (data) { // je r�cup�re la r�ponse du fichier PHP
                        if (typeof data.message != "undefined") {
                            var popup = popup_message_recu(data);
                            bootbox.alert(popup);
                        }
                    }
                });
            });
            function popup_message_envoye(data) {
                objet_message = data.message;
                var table = '<table class="table table-striped table-hover ">';
                table += '<tr>';
                table += '<th>Destinataire</th><td>' + objet_message.destinataire + '</td>';
                table += '</tr>';
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
                table += '<th>Message</th><td>' + objet_message.message + '</td>';
                table += '</tr>';
                table += '</table>';
                return table;
            }
            $('#mes_messages_envoye').dataTable();
            $("button[value='cons_message_envoye']").on('click', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "controleurs/membre/view_message.php", // le nom du fichier indiqu� dans le formulaire
                    type: "POST", // la m�thode indiqu�e dans le formulaire (get ou post)
                    data: {mod: "consultation_message_envoye",
                        id_message: id}, // je s�rialise les donn�es (voir plus loin), ici les $_POST
                    dataType: 'json',
                    cache: false,
                    success: function (data) { // je r�cup�re la r�ponse du fichier PHP
                        if (typeof data.message != "undefined") {
                            var popup = popup_message_envoye(data);
                            bootbox.alert(popup);
                        }
                    }
                });
            });
<?php } ?>
<?php if ($action == 'rep_message') { ?>
            $('#form_rep_message').on('submit', function (e) {
                var $this = $(this),
                        control = true,
                        data = {};
                e.preventDefault();
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    data[name] = value;
                });
                $.ajax({
                    url: $this.attr('action'), // le nom du fichier indiqu� dans le formulaire
                    type: $this.attr('method'), // la m�thode indiqu�e dans le formulaire (get ou post)
                    data: data, // je s�rialise les donn�es (voir plus loin), ici les $_POST  
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        objet_message = data.message;
                        var balise_html = '';
                        if (objet_message.reponse == 'oui') {
                            balise_html += '<div class="alert alert-dismissable alert-success">';
                            balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                            balise_html += '<strong>Vore message a �t� bien enregistr�</strong>';
                            balise_html += '</div>';
                            $("#retour_message").html('').append(balise_html);
                        }
                        else {
                            balise_html += '<div class="alert alert-dismissable alert-danger">';
                            balise_html += '<button type="button" class="close" data-dismiss="alert">�</button>';
                            balise_html += '<strong>Le formulaire est incomplet</strong>';
                            balise_html += '</div>';
                            $("#retour_message").html('').append(balise_html);
                        }
                    }
                });
                $('html,body').animate({scrollTop: $("#retour_message").offset().top}, "slow");
                return control;
            });
            $(":reset").on('click', function () {
                $this = $('#form_rep_message');
            });
<?php } ?>
<?php if ($action == 'saisir_date_premier_cours' || $action == 'saisir_bilan_premier_cours') { ?>
            $("#date_cours").datepicker();
            $("#datetime_picker").timepicker();
            $('#set_date_premier_cours').on('submit', function (e) {
                e.preventDefault();
                var control = true,
                        $this = $(this),
                        data = {};
                if (control) {
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
                                bootbox.alert("Votre date de 1er cours a �t� enregistr� avec succ�es");
                            }
                            else {
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
                                message: "Il ya une erreur interne dans le fichier set_date_premier_cours.php",
                            });
                        }

                    });
                }
                return false;
            });
<?php } ?>
<?php if ($action == 'saisir_bilan_premier_cours') { ?>
            //$( "#notions_travaile" ).ckeditor();
            $('#create_bilan_premier_cours').on('submit', function (e) {
                e.preventDefault();
                var control = true,
                        $this = $(this),
                        data = {};
                $this.find('[name]').each(function (index, value) {
                    var $this = $(this),
                            name = $this.attr('name'),
                            value = $this.val();
                    if (value == '') {
                        control = false;
                        if (!$this.next("#text_erreur").length || !$this.prev("#erreur").length) {
                            $this.parent().remove("form-group");
                            $this.parent().addClass("form-group has-error has-feedback");
                            $this.next("#text_erreur").empty();
                            $this.before("<span id='erreur' class='glyphicon glyphicon-remove form-control-feedback pull-right'></span>");
                            $this.after("<span id='text_erreur' style='color:red'> Le champ  est obligatoire</span>");
                        }
                        $('html,body').animate({scrollTop: $("#erreur").offset().top}, "slow");
                    }

                });
                if (control) {
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
                                bootbox.alert("Votre bilan de 1er cours a &eacute;t&eacute; enregistr&eacute; avec succ&eacute;es");
                            }
                            else {
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
                                message: "Il ya une erreur interne dans le fichier set_bilan_premier_cours.php",
                            });
                        }

                    });
                }
                return false;
            });
<?php } ?>
    });</script>


