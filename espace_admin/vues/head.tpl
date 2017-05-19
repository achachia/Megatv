<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title> 
<meta name="keywords" content="">
<meta name="description" content="">
<link href="{$dir_media}/css/boostrap.min.css?c=943916400" rel="stylesheet" type="text/css"/>
<link href="{$dir_media}/fontawesome/css/font-awesome.min.css?c=943916400"   rel="stylesheet">
<link href="{$dir_media}/css/mega_cours.css?c=943916400"  rel="stylesheet">
<link href="../librairie/jQuery-File-Upload-master/css/style.css" rel="stylesheet" type="text/css"/>
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link href="../librairie/jQuery-File-Upload-master/css/jquery.fileupload.css" rel="stylesheet" type="text/css"/>

<script src="{$dir_media}/js/jquery.js?c=943916400"></script>
<script src="{$dir_media}/js/bootstrap.min.js?c=943916400"></script>

<script src="{$dir_media}/plugin_js/bootbox.min.js" type="text/javascript"></script>
<script src="{$dir_media}/plugin_js/activity-indicator.js" type="text/javascript"></script>
<script src="{$dir_media}/plugin_js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{$dir_media}/js/app.js"></script>

<link href="{$dir_media}/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="{$dir_media}/jquery-ui/jquery-ui.min.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../librairie/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../librairie/jQuery-File-Upload-master/js/jquery.iframe-transport.js" type="text/javascript"></script>
<!-- The basic File Upload plugin -->
<script src="../librairie/jQuery-File-Upload-master/js/jquery.fileupload.js" type="text/javascript"></script>

<!--<link rel="stylesheet" href="{$dir_media}/boostrapValidator/vendor/formvalidation/css/formValidation.min.css"/> 
<script type="text/javascript" src="{$dir_media}/boostrapValidator/vendor/formvalidation/js/formValidation.min.js"></script>
<script type="text/javascript" src="{$dir_media}/boostrapValidator/vendor/formvalidation/js/framework/bootstrap.min.js"></script>-->

<!--<link href="{$dir_media}/boostrapValidator/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="//oss.maxcdn.com/momentjs/2.8.2/moment.min.js"></script>
<script src="{$dir_media}/boostrapValidator/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="{$dir_media}/css/bootstrap-select.min.css" />
<script src="{$dir_media}/plugin_js/bootstrap-select.min.js"></script>-->

<!--<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script

<link rel="stylesheet" href="{$dir_media}/plugin_js/animo/animate+animo.css" />
<script src="{$dir_media}/plugin_js/animo/animo.min.js"></script>



<!--<script src="{$dir_media}/live_editor/scripts/innovaeditor.js"></script>
<script src="{$dir_media}/live_editor/scripts/innovamanager.js"></script>-->

<link href="{$dir_media}/datatable/extensions/datatable-bootstrap/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="{$dir_media}/datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{$dir_media}/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>


{if $action == 'view_calendrier'}
    <link href="{$dir_media}/fullcalendar/css/fullcalendar.css" rel='stylesheet' />
    <link href="{$dir_media}/fullcalendar/css/fullcalendar.print.css" rel='stylesheet' media='print' />
    <script src="{$dir_media}/fullcalendar/js/moment.min.js"></script>
    <script src="{$dir_media}/fullcalendar/js/jquery-ui.custom.min.js"></script>
    <script src="{$dir_media}/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="{$dir_media}/fullcalendar/js/lang-all.js"></script>
{/if}
{if ($action == 'create_compte_rendu' || $action == 'edit_compte_rendu' || $action == 'saisir_bilan_premier_cours' || $action == 'saisir_date_premier_cours')}
    <script src='{$dir_media}/jquery-ui/jquery-ui-timepicker-addon.js'></script>
    <script src='{$dir_media}/jquery-ui/jquery-ui-sliderAccess.js'></script>
{/if}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<style type="text/css">
    {literal} 
        #create_compte_rendu .form-control-feedback {
            top: 0;
            right: -15px;
        }
        #create_compte_rendu .selectContainer .form-control-feedback {   
            right: -15px;
        } 
    {/literal}    

</style> 
<script type="text/javascript"> 
    {*literal*} 
    $(document).ready(function () {
   
        /********* start Objet datatable ***********************/
        if (!$.fn.dataTable)
            return;
        /********* end Objet datatable ***********************/
        {php}
        if($action == 'all_view_compte_rendu'){
      
       function popup_generer_mes(data) 
       {
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
        function generer_popup_autre(data) 
        {
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
     
      }
      {/php}
    });
 {*/literal*} 
     </script>


