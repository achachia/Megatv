<!-- Espace Conseiller -->
<meta charset="utf-8">
<title><?php echo $title_page; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Fichier CSS -->
<link rel="stylesheet" href="./../media/css/bootstrap.css"
      media="screen">
<link href="../../media/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./../media/css/style_perso.css" rel="stylesheet">
<!--<link rel="stylesheet"  href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />-->
<link href="../../media/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="./../media/plugin_js/chosen/chosen.css" rel="stylesheet">
<link href="./../media/css/demo.css" rel="stylesheet">
<link href="./../media/css/yamm.css" rel="stylesheet">
<!-- end -->
<!-- Fichier JS -->
<!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script src="../../media/js/jquery.min.js" type="text/javascript"></script>
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
<!--<link href="./../media/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="./../media/js/jquery.dataTables.js"></script>-->

<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->


<script type="text/javascript" src="./../media/js/app.js"></script>
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
<?php if ($action == 'all_view_beneficiaires') { ?>
        dtInstance1 = $('#liste_beneficiaires').dataTable({
        'paging': true, // Table pagination
                'ordering': true, // Column ordering 
                'info': true, // Bottom left status text
                // Text translation options
                // Note the required keywords between underscores (e.g _MENU_)
                oLanguage: {
                sSearch: 'Rechercher tous les colonnes:',
                        sLengthMenu: '_MENU_ enregistrements par page',
                        sInfo: 'Showing _START_ to _END_ of _TOTAL_ entrie',
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
<?php if ($action == 'view_fiche_beneficiaire') { ?>
        $("#retour").on('click', function () {
        document.location.href = 'index.php?module=beneficiaires&action=all_view_beneficiaires';
        });
<?php } ?>
<?php if ($action == 'edit_fiche_beneficiaire') { ?>
        $("#date_naissance,#date_adhesion").datepicker({
        maxDate: strDate,
                changeMonth: true,
                changeYear: true
        });
                $("#retour").on('click', function () {
        document.location.href = 'index.php?module=beneficiaires&action=all_view_beneficiaires';
        });
                $('#update_fiche_beneficiaire').on('submit', function () {
        var wid = $("#form").width(),
                heig = $("#form").height(),
                $this = $(this);
                $.ajax({
                url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: $this.serialize(),
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                        },
                        success: function (data) {
                        objet_message = data.message;
                                objet_message.reponse = Boolean(objet_message.reponse);
                                var balise_html = '';
                                if (objet_message.reponse) {
                        //$this[0].reset();                          
                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de beneficiare à été bien enregistré.";
                                balise_html += "</div>";
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-ok'></span> Message de confirmation ",
                                        message: balise_html,
                                });
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
                        var balise_html = 'Il ya une erreur interne dans le fichier set_client.php';
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                        message: balise_html,
                                });
                        },
                        complete: function () {
                        $("#load").hide();
                        }

                });
                return false;
        });
<?php } ?>
<?php if ($action == 'view_fiche_intervenant') { ?>
        $("#retour").on('click', function () {
        document.location.href = 'index.php?module=intervenants&action=all_view_intervenants';
        });
<?php } ?>
<?php if ($action == 'edit_fiche_intervenant') { ?>
        $("#date_naissance,#date_adhesion").datepicker({
        maxDate: strDate,
                changeMonth: true,
                changeYear: true
        });
                //$("#date_adhesion").datepicker({maxDate: strDate});

                jQuery(".matiere").chosen();
                jQuery(".niveau").chosen();
                jQuery(".niveau_etude").chosen();
                jQuery(".zone_interv").chosen();
                /***********************************************/
                $("#add_matiere").on('click', function () {
        $.ajax({
        url: 'controleurs/intervenants/liste_niveau_peda.php',
                type: 'POST',
                data: {liste: 'liste_niveaux_matiere'},
                dataType: 'json',
                cache: false,
                success: function (data) {
                niveau_json = data.liste_niveau;
                        matiere_json = data.liste_matiere;
                        nb_mt = $(".matiere").length;
                        //nb_mt=1;
                        nb_mt = nb_mt + 1;
                        matiere = 'matiere' + nb_mt;
                        niveau = 'niveau' + nb_mt;
                        contenu = '<div class="row">';
                        contenu += '<div class="col-lg-12">';
                        contenu += '<div class="col-lg-4">';
                        contenu += '<select class="matiere" style="width:220px;" data-placeholder="Selectionnez une matiere"  id="' + matiere + '"  name="' + matiere + '">';
                        contenu_niveau = '<option value=""></option>';
                        contenu_matiere = '<option value=""></option>';
                        $.each(niveau_json, function (index, field) {
                        contenu_niveau += '<option  value="' + field.id + '">' + field.nom + '</option>';
                        });
                        $.each(matiere_json, function (index, field) {
                        contenu_matiere += '<option  value="' + field.id + '">' + field.nom + '</option>';
                        });
                        contenu += contenu_matiere;
                        contenu += '</select>';
                        contenu += '</div>';
                        contenu += '<div class="col-lg-4">';
                        contenu += '<select class="niveau" multiple="true" data-placeholder=" Selectionnez les niveaux"  style="width:400px;" id="' + niveau + '"  name="' + niveau + '[]" >';
                        contenu += contenu_niveau;
                        contenu += '</select>';
                        contenu += '</div>';
                        contenu += '<div class="col-lg-4" style="color:red;padding-left:100px ">';
                        contenu += '<button class="remove"><span class="glyphicon glyphicon-remove" "></span>Supprimer</button>';
                        contenu += '</div>';
                        contenu += '</div><br/>';
                        contenu += '</div>';
                        // alert(contenu);
                        $("#liste_matiere").append(contenu);
                        jQuery(".matiere").chosen();
                        jQuery(".niveau").chosen();
                        $("button.remove").on('click', function () {
                $(this).closest("div.row").remove();
                        alert($(".matiere").length);
                        return false;
                });
                }
        });
        });
                /***********************************************/
                $("button.remove").on('click', function () {
        $(this).closest("div.row").remove();
                alert($(".matiere").length);
                return false;
        });
                /***********************************************/
                $(".retour").on('click', function () {
        document.location.href = 'index.php?module=intervenants&action=all_view_intervenants';
        });
                $('#update_fiche_intervenant').on('submit', function () {

        var wid = $("#form").width(),
                heig = $("#form").height(),
                $this = $(this);
                console.log($this);
                $.ajax({
                url: $this.attr('action'),
                        type: $this.attr('method'),
                        data: $this.serialize(),
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                        },
                        success: function (data) {
                        objet_message = data.message;
                                objet_message.reponse = Boolean(objet_message.reponse);
                                var balise_html = '';
                                if (objet_message.reponse) {
                        //$this[0].reset();                          
                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de beneficiare à été bien enregistré.";
                                balise_html += "</div>";
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-ok'></span> Message de confirmation ",
                                        message: balise_html,
                                });
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
                        var balise_html = 'Il ya une erreur interne dans le fichier set_client.php';
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                        message: balise_html,
                                });
                        },
                        complete: function () {
                        $("#load").hide();
                        }

                });
                return false;
        });
<?php } ?>

<?php if ($action == 'all_view_factures') { ?>
        $('#cocheTout').click(function () {
        if (this.checked) {
        $('#liste_factures tbody').find(':checkbox').each(function (index, value) {

        $(this).prop("checked", true);
        });
        }
        else {
        $('#liste_factures tbody').find(':checkbox').each(function (index, value) {

        $(this).prop("checked", false);
        });
        }
        });
                /******************************************************************/
                dtInstance1 = $('#liste_factures').dataTable({
        'bAutoWidth': false,
                "aoColumns": [
                {sWidth: '5%'},
                {sWidth: '100px'},
                {sWidth: '12px'},
                {sWidth: '30px'},
                {sWidth: '10px'},
                {sWidth: '12px'},
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
                $('#all_imprim_facture').on('click', function () {
        var data = {};
                $('#liste_factures tbody').find(':checkbox').each(function (index, value) {
        var $that = $(this);
                if (this.checked) {
        name = $that.attr('name');
                value = $that.val();
                data[name] = value;
        }
        });
                data_json = JSON.stringify(data);
                javascript:window.open('/librairie/Html2pdf/generer_pdf/facture.php?mode=print_all_factures&N_facture=' + data_json);
        });
<?php } ?>
<?php if ($action == 'rapport_heures' || $action == 'rapport_e_coupon' || $action == 'rapport_recettes') { ?>
        // $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );

        $(function () {
        $("#from").datepicker({
        changeMonth: true,
                numberOfMonths: 3,
                onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
                }
        });
                $("#to").datepicker({
        changeMonth: true,
                numberOfMonths: 3,
                onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
                }
        });
        });
<?php } ?>
<?php if ($action == 'rapport_heures') { ?>
        jQuery("#choix_famille").chosen();
                $('#rapport_H_factures').dataTable();
                //             $('#example').dataTable({
                        //                 "ajax": "controleurs/rapports/infos_rapport_heure.php?code_famille=CF29"
                                //             });
                                        function  requette_ajax(data) {
                                        $.ajax({
                                        url: 'controleurs/rapports/infos_rapport_heure.php',
                                                type: 'POST',
                                                data: data,
                                                dataType: 'json',
                                                cache: false,
                                                success: function (reponse) {
                                                if (reponse.identite_client) {
                                                objet_json_identite = reponse.identite_client;
                                                        $("#rapport_client").show(function () {
                                                $("#identite_client").text(objet_json_identite.nom_client);
                                                        $("#Nbre_H_restant").text(objet_json_identite.Nbre_H_restant);
                                                });
                                                }
                                                objet_json_rapport = reponse.rapport_heures;
                                                        var tr = '';
                                                        $.each(objet_json_rapport, function (index, field) {
                                                        tr += '<tr><td>' + field.N_facture + '</td><td>' + field.date_facture + '</td><td>' + field.nbre_h_vendue + '</td><td>' + field.nbre_h_effec + '</td><td>' + field.nbre_h_restant + '</td></tr>';
                                                        }
                                                        );
                                                        $("#rapport_heures").html('').append(tr);
                                                        $('#rapport_H_factures').dataTable();
                                                }
                                        });
                                        }
                                /*********************************************/

                                $("#choix_famille,#month,#from,#to").on('change', function () {
                                var data = {},
                                        periode = $('#month').val(),
                                        code_famille = $('#choix_famille').val();
                                        if (this.name == 'month') {
                                if ($('#month').val() == 'perso') {
                                $("#choix_periode").show();
                                        $("#hr").show();
                                }
                                else {
                                $("#choix_periode").hide();
                                        $("#hr").hide();
                                }
                                }
                                if (this.name == 'from') {
                                if (($('#from').val() > $('#to').val()) && ($('#to').val() != '')) {
                                msg_erreur = 'Vous devez choisir une date debut  inferieur a la date de fin';
                                }
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                        message: msg_erreur,
                                });
                                }
                                if (this.name == 'to') {
                                if (($('#from').val() > $('#to').val()) && ($('#from').val() != '')) {
                                msg_erreur = 'Vous devez choisir une date debut  inferieur a la date de fin';
                                        bootbox.alert({
                                        title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                message: msg_erreur,
                                        });
                                }
                                }
                                if (this.name == 'choix_famille') {
                                if ($('#choix_famille').val() == '') {
                                $("#rapport_client").hide();
                                }
                                }
                                if (code_famille != '' || periode != '') {
                                if (code_famille != '') {
                                data['code_famille'] = code_famille;
                                }
                                if (periode != '') {
                                data['month'] = periode;
                                        if (periode == 'perso' && $('#from').val() != '' && $('#to').val() != '') {
                                data['from'] = $('#from').val();
                                        data['to'] = $('#to').val();
                                }
                                }
                                requette_ajax(data);
                                }
                                });
<?php } ?>
<?php if ($action == 'rapport_e_coupon') { ?>

                                jQuery("#choix_famille").chosen();
                                        $('#rapport_e_coupons').dataTable();
                                        function  requette_ajax(data) {
                                        $.ajax({
                                        url: 'controleurs/rapports/infos_rapport_e_coupon.php',
                                                type: 'POST',
                                                data: data,
                                                dataType: 'json',
                                                cache: false,
                                                success: function (reponse) {
                                                if (reponse.identite_client) {

                                                objet_json_identite = reponse.identite_client;
                                                        $("#rapport_client").show(function () {
                                                $("#identite_client").text(objet_json_identite.nom_client);
                                                        $("#nbre_coupon_valide").text(objet_json_identite.nbre_coupon_valide);
                                                        $("#nbre_coupon_attente").text(objet_json_identite.nbre_coupon_attente);
                                                        $("#nbre_coupon_annule").text(objet_json_identite.nbre_coupon_annule);
                                                });
                                                }
                                                objet_json_rapport = reponse.rapport_e_coupons;
                                                        var tr = '';
                                                        $.each(objet_json_rapport, function (index, field) {
                                                        tr += '<tr>';
                                                                tr += '<td>' + field.code_coupon + '</td><td>' + field.statut_coupon + '</td><td>' + field.N_facture + '</td><td>' + field.nom_client + '</td><td>' + field.code_client + '</td>';
                                                                tr += '<td>';
                                                                tr += '<div class="btn-group">';
                                                                tr += '<button type="button" class="btn btn-success"> Action </button>';
                                                                tr += '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                                                tr += '<ul class="dropdown-menu">';
                                                                tr += '<li><a href="#"><button type="button" class="btn-primary" >Modifier etat-coupon</button></a></li>';
                                                                tr += '<li><a href="#"><button type="button" class="btn-primary" >Consulter Modele-coupon</button></a></li>';
                                                                tr += '</ul>';
                                                                tr += '</div>';
                                                                tr += '</td>';
                                                                tr += '</tr>';
                                                        }
                                                        );
                                                        $("#liste_e_coupon").html('').append(tr);
                                                        $('#rapport_e_coupons').dataTable();
                                                }
                                        });
                                        }
                                /*********************************************/

                                $("#choix_famille,#month,#from,#to").on('change', function () {
                                var data = {},
                                        periode = $('#month').val(),
                                        code_famille = $('#choix_famille').val();
                                        if (this.name == 'month') {
                                if ($('#month').val() == 'perso') {
                                $("#choix_periode").show();
                                        $("#hr").show();
                                }
                                else {
                                $("#choix_periode").hide();
                                        $("#hr").hide();
                                }
                                }
                                if (this.name == 'from') {
                                if (($('#from').val() > $('#to').val()) && ($('#to').val() != '')) {
                                msg_erreur = 'Vous devez choisir une date debut  inferieur a la date de fin';
                                }
                                bootbox.alert({
                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                        message: msg_erreur,
                                });
                                }
                                if (this.name == 'to') {
                                if (($('#from').val() > $('#to').val()) && ($('#from').val() != '')) {
                                msg_erreur = 'Vous devez choisir une date debut  inferieur a la date de fin';
                                        bootbox.alert({
                                        title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                message: msg_erreur,
                                        });
                                }
                                }
                                if (this.name == 'choix_famille') {
                                if ($('#choix_famille').val() == '') {
                                $("#rapport_client").hide();
                                }
                                }
                                if (code_famille != '' || periode != '') {
                                if (code_famille != '') {
                                data['code_famille'] = code_famille;
                                }
                                if (periode != '') {
                                data['month'] = periode;
                                        if (periode == 'perso' && $('#from').val() != '' && $('#to').val() != '') {
                                data['from'] = $('#from').val();
                                        data['to'] = $('#to').val();
                                }
                                }
                                requette_ajax(data);
                                }
                                });
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
                                        $('#liste_benef').dataTable();
                                        $('#liste_filleules').dataTable();
                                        $("#send_nv_email").on('click', function () {
                                var code_client = $(this).val();
                                        $.ajax({
                                        url: 'controleurs/clients/generer_nv_passe.php',
                                                type: 'POST',
                                                data: {code_client: code_client},
                                                dataType: 'json',
                                                cache: false,
                                                success: function (data) {
                                                objet_message = data.message;
                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                        var balise_html = '';
                                                        if (objet_message.reponse) {
                                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  L'envoi de nouveau mot de passe a &eacute;t&eacute; &eacute;ffetu&eacute; avec succ&eacute;es.</div>";
                                                        $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                        $("#message").html('').append(balise_html);
                                                        $("#message").fadeOut(8000, function () {
                                                $(this).html('');
                                                });
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
                                                        message: "Il ya une erreur interne dans le traitement de votre demande",
                                                });
                                                }
                                        });
                                });
<?php } ?>
<?php
if ($action == 'add_client') {
    ?>

                                $("#date_adhesion").datepicker({maxDate: strDate});
                                        jQuery("#liste_clients").chosen({width: "250px"});
                                        ///////////////////////////

                                        $('#tel_domicile').keyup(function () {
                                var $that = $(this),
                                        $chaine_string = $that.val(),
                                        taille = $chaine_string.length,
                                        substrings = $chaine_string.split('-');
                                        ///////////////////////recuperer le dernier caractere de chaine de caractere ////
                                        var last_caract = $chaine_string.charAt($chaine_string.length - 1);
                                        ///////////////on verifier est ce que le caracctere saisie est un entier ////
                                        if (!parseInt(last_caract) && last_caract != 0 || taille > 14) {
                                var message = '';
                                        if (taille > 14) {
                                message += 'Il ne faut pas depasser 10 chiffres';
                                }
                                if (!parseInt(last_caract) && last_caract != 0) {
                                message += 'Il faut saisir un nombre entier';
                                }
                                alert(message);
                                        ///////////on supprime le caractere saisi de la chaine ////////
                                        $chaine_string = $chaine_string.substring(0, $chaine_string.length - 1);
                                        $that.val($chaine_string);
                                }
                                else {
                                substrings.length--;
                                        taille = taille - substrings.length;
                                        mod = (taille) % 2;
                                        if (mod == 0 && taille > 0 && taille <= 8) {
                                $chaine_string = $that.val();
                                        $chaine_string += '-';
                                        $that.val($chaine_string);
                                        //                     	   //chemin = chemin.substring(0,chemin.length-1);                	           	  
                                }
                                }

                                ///////////////////



                                });
                                        ///////////////////////////
                                        $('#add_beneficiaire').on('click', function () {
                                $.ajax({
                                url: 'controleurs/clients/liste_niveau.php',
                                        type: 'POST',
                                        data: {liste: 'niveau'},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (reponse) {
                                        objet_json = reponse.liste;
                                                var liste_option = '<option value="">Choisir son niveau scolaire</option>';
                                                $.each(objet_json, function (index, field) {
                                                liste_option += '<option  value="' + field.id_option + '">' + field.nom_option + '</option>';
                                                });
                                                var form_add_bene = '<form class="form-horizontal" id="form_add_bene" name="form_add_bene" method="POST" action="controleurs/clients/add_beneficiare.php"> ';
                                                form_add_bene += '<div class="form-group"><label for="nom" class="control-label">NOM</label><input type="text" class="form-control" id="nom" name="nom"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="prenom" class="control-label">PRENOM</label><input type="text" class="form-control" id="prenom" name="prenom"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="date_naissance" class="control-label">DATE NAISSANCE </label><input type="text" class="form-control" id="date_naissance" name="date_naissance"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="date_inscription" class="control-label">DATE INSCRIPTION</label><input type="text" class="form-control" id="date_inscription" name="date_inscription"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="email" class="control-label">EMAIL</label><input type="text" class="form-control" id="email" name="email"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="tel_portable" class="control-label">N° TEL PORTABLE</label><input type="text" class="form-control" id="tel_portable" name="tel_portable"></div> ';
                                                form_add_bene += '<div class="form-group"><label for="niveau_sco" class="control-label">NIVEAU SCOLAIRE</label><select class="form-control" id="niveau_sco" name="niveau_sco">' + liste_option + '</select></div>';
                                                form_add_bene += '</form>';
                                                bootbox.dialog({
                                                message: form_add_bene,
                                                        title: "Creation la fiche du bénéficiaire",
                                                        buttons: {
                                                        success: {
                                                        label: "Enregistrer",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                var data = {};
                                                                        $("#form_add_bene").find('[name]').each(function (index, value) {
                                                                var $this = $(this),
                                                                        name = $this.attr('name'),
                                                                        value = $this.val();
                                                                        data[name] = value;
                                                                });
                                                                        $.ajax({
                                                                        url: $("#form_add_bene").attr('action'), // le nom du fichier indiqué dans le formulaire
                                                                                type: $("#form_add_bene").attr('method'), // la méthode indiquée dans le formulaire (get ou post)
                                                                                data: data, // je sérialise les données (voir plus loin), ici les $_POST
                                                                                dataType: 'json',
                                                                                cache: false,
                                                                                success: function (reponse) {
                                                                                objet_json = reponse.infos_beneficiaire;
                                                                                        balise = '<table class="table table-striped table-hover " id="liste_beneficiaire"><thead><tr><th>Nom</th><th>Prenom</th><th>Telephone</th><th>email</th><th>Supprimer</th></tr></thead>';
                                                                                        balise += '<tbody>';
                                                                                        $.each(objet_json, function (index, field) {
                                                                                        balise += '<tr><td>' + field.nom + '</td><td>' + field.prenom + '</td><td>' + field.tel_portable + '</td><td>' + field.email + '</td><td></td></tr>';
                                                                                        }
                                                                                        );
                                                                                        balise += '</tbody>';
                                                                                        balise += '</table>';
                                                                                        $("#liste_beneficiaire").html(balise);
                                                                                }
                                                                        });
                                                                }
                                                        }
                                                        }
                                                });
                                                $("#date_naissance").datepicker({maxDate: strDate});
                                                $("#date_inscription").datepicker({maxDate: strDate});
                                        }
                                });
                                });
                                        ////////////////////////////////////////////////    
                                        $('#set_client').on('submit', function (e) {
                                e.preventDefault();
                                        var $this = $(this),
                                        data = {};
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
                                                        etape_creation = data.etapes_creation;
                                                        var balise_html = '';
                                                        if (objet_message.reponse) {
                                                //$this[0].reset();                          
                                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de client à été bien enregistré.";
                                                        balise_html += "<ul>";
                                                        $.each(etape_creation, function (index, field) {
                                                        balise_html += "<li>" + field + "</li>";
                                                        });
                                                        balise_html += "</ul>";
                                                        balise_html += "</div>";
                                                        $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                        $("#message").html('').append(balise_html);
                                                        $("#message").fadeOut(12000, function () {
                                                $(this).html('');
                                                }
                                                );
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
                                                //etape_creation = error.etapes_creation;
                                                var balise_html = 'Il ya une erreur interne dans le fichier set_client.php';
                                                        //balise_html += "<ul>";
                                                        //$.each(etape_creation, function(index, field) {
                                                        //balise_html += "<li>" + field + "</li>";
                                                        //});
                                                        // balise_html += "</ul>";
                                                        bootbox.alert({
                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                message: balise_html,
                                                        });
                                                }

                                        });
                                        $('#bouton_submit').html('').text("Enregistrer");
                                        return false;
                                });
<?php } ?>
<?php if ($action == 'edit_fiche_client') { ?>
                                $("#retour").on('click', function () {
                                document.location.href = 'index.php?module=clients&action=all_view_clients';
                                });
                                        var wid = $("#etat_civil").width(),
                                        heig = $("#etat_civil").height();
                                        $("#myTabContent").height(heig);
                                        $('#modifier_fiche_client').on('submit', function (e) {
                                e.preventDefault();
                                        var $this = $(this);
                                        $.ajax({
                                        url: $this.attr('action'),
                                                type: $this.attr('method'),
                                                data: $this.serialize(),
                                                dataType: 'json',
                                                cache: false,
                                                beforeSend: function () {
                                                wid = $("#formulaire").width();
                                                        heig = $("#formulaire").height();
                                                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                        $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                                },
                                                success: function (data) {
                                                objet_message = data.message;
                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                        if (objet_message.reponse) {
                                                var balise_html = '';
                                                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La modification de profil de client &aacute; &eacute;t&eacute; avec succ&eacute;es.</div>";
                                                        $("#load").hide();
                                                        $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                        $("#message").html('').append(balise_html);
                                                        $("#message").fadeOut(8000, function () {
                                                $(this).html('');
                                                        window.location.reload(true);
                                                }
                                                );
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
                                                        $("#load").hide();
                                                }

                                                },
                                                error: function (jqXHR, error, errorThrown) {
                                                bootbox.alert({
                                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                        message: "Il ya une erreur interne dans le traitement de la demande",
                                                });
                                                        $("#load").hide();
                                                }

                                        });
                                        return false;
                                });
<?php } ?>
<?php if ($action == 'add_beneficiaire') { ?>
                                jQuery("#choix_famille").chosen({width: "250px"});
                                        $("#date_naissance,#date_adhesion").datepicker({
                                changeMonth: true,
                                        changeYear: true
                                });
                                        $('#set_beneficiaire').on('submit', function (e) {
                                e.preventDefault();
                                        var wid = $("#form").width(),
                                        heig = $("#form").height(),
                                        $this = $(this);
                                        $.ajax({
                                        url: $this.attr('action'),
                                                type: $this.attr('method'),
                                                data: $this.serialize(),
                                                dataType: 'json',
                                                cache: false,
                                                beforeSend: function () {
                                                $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                        $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                                },
                                                success: function (data) {
                                                objet_message = data.message;
                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                        var balise_html = '';
                                                        if (objet_message.reponse) {
                                                //$this[0].reset();                          
                                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de beneficiare à été bien enregistré.";
                                                        balise_html += "</div>";
                                                        bootbox.alert({
                                                        title: "<span class='glyphicon glyphicon-ok'></span> Message de confirmation ",
                                                                message: balise_html,
                                                        });
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
                                                var balise_html = 'Il ya une erreur interne dans le fichier set_client.php';
                                                        bootbox.alert({
                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                message: balise_html,
                                                        });
                                                },
                                                complete: function () {
                                                $("#load").hide();
                                                }

                                        });
                                        return false;
                                });
                                        //   $('#infos_interne').liveEdit({
                                        //       css: ['./../media/css/bootstrap.css', './../media/css/bootstrap.css'] /* Apply bootstrap css into the editing area */ ,            
                                        //       groups: [
                                        //               ["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat"]],
                                        //               ["group2", "", ["Bullets", "Numbering", "Indent", "Outdent"]],
                                        //               ["group3", "", ["Paragraph", "FontSize", "FontDialog", "TextDialog"]],
                                        //               ["group4", "", ["LinkDialog", "ImageDialog", "TableDialog", "Emoticons", "Snippets"]],
                                        //               ["group5", "", ["Undo", "Redo", "FullScreen", "SourceDialog"]]
                                        //               ] /* Toolbar configuration */
                                        //   });
                                        //   $('#infos_interne').data('liveEdit').startedit(); /* Run the Editor */

<?php } ?>
<?php if ($action == 'all_view_intervenants') { ?>

                                dtInstance1 = $('#liste_intervenants').dataTable({
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
<?php if ($action == 'add_intervenant') { ?>
                                $("#date_naissance,#date_adhesion").datepicker({
                                maxDate: strDate,
                                        changeMonth: true,
                                        changeYear: true
                                });
                                        //$("#date_adhesion").datepicker({maxDate: strDate});
                                        jQuery(".niveau_etude").chosen();
                                        jQuery(".matiere").chosen();
                                        jQuery(".niveau").chosen();
                                        jQuery(".zone_interv").chosen();
                                        $("#niveau_etude").on('change', function () {
                                var niveau = $(this).val();
                                        $.ajax({
                                        url: 'controleurs/intervenants/liste_diplomes.php',
                                                type: 'POST',
                                                data: {type_niveau: niveau},
                                                dataType: 'json',
                                                cache: false,
                                                success: function (reponse) {
                                                objet_json = reponse.liste_diplomes;
                                                        balise = '<select class="diplome" style="width:250px;" data-placeholder="Selectionnez un diplome" id="id_niveau_diplome" name="id_niveau_diplome">';
                                                        balise += '<option value="">Choisissez votre diplome</option>';
                                                        $.each(objet_json, function (index, field) {
                                                        balise += '<option value="' + field.id_liaison + '">' + field.nom_diplome + '</option>';
                                                        }
                                                        );
                                                        balise += '</select>';
                                                        $("#diplomes").append(balise);
                                                        jQuery(".diplome").chosen();
                                                }
                                        });
                                });
                                        $("#add_matiere").on('click', function () {
                                $.ajax({
                                url: 'controleurs/intervenants/liste_niveau_peda.php',
                                        type: 'POST',
                                        data: {liste: 'liste_niveaux_matiere'},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {
                                        niveau_json = data.liste_niveau;
                                                matiere_json = data.liste_matiere;
                                                nb_mt = $(".matiere").length;
                                                nb_mt = nb_mt + 1;
                                                matiere = 'matiere' + nb_mt;
                                                nb_nv = $(".matiere").length;
                                                nb_nv = nb_nv + 1;
                                                niveau = 'niveau' + nb_nv;
                                                var contenu = '<hr>';
                                                contenu += '<div class="row">';
                                                contenu += '<div class="col-lg-4">';
                                                contenu += '<select class="matiere" style="width:220px;" data-placeholder="Selectionnez une matiere"  id="' + matiere + '"  name="' + matiere + '">';
                                                contenu_niveau = '<option value=""></option>';
                                                contenu_matiere = '<option value=""></option>';
                                                $.each(niveau_json, function (index, field) {
                                                contenu_niveau += '<option  value="' + field.id + '">' + field.nom + '</option>';
                                                });
                                                $.each(matiere_json, function (index, field) {
                                                contenu_matiere += '<option  value="' + field.id + '">' + field.nom + '</option>';
                                                });
                                                contenu += contenu_matiere;
                                                contenu += '</select>';
                                                contenu += '</div>';
                                                contenu += '<div class="col-lg-4 offset1">';
                                                contenu += '<select class="niveau" multiple="true" data-placeholder="Selectionnez les niveaux"  style="width:400px;" id="' + niveau + '"  name="' + niveau + '[]" >';
                                                contenu += contenu_niveau;
                                                contenu += '</select>';
                                                contenu += '</div>';
                                                contenu += '</div>';
                                                jQuery(".matiere").chosen();
                                                jQuery(".niveau").chosen();
                                                $("#matiere").append(contenu);
                                                jQuery(".matiere").chosen();
                                                jQuery(".niveau").chosen();
                                        }
                                });
                                });
                                        $('#set_intervenant').on('submit', function (e) {
                                e.preventDefault();
                                        var $this = $(this);
                                        $.ajax({
                                        url: $this.attr('action'),
                                                type: $this.attr('method'),
                                                data: $this.serialize(),
                                                dataType: 'json',
                                                cache: false,
                                                beforeSend: function () {
                                                $('#bouton_submit').html("<img src='./../img/ajax-loader_1.gif' />");
                                                },
                                                success: function (data) {
                                                objet_message = data.message;
                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                        var balise_html = '';
                                                        if (objet_message.reponse) {
                                                $this[0].reset();
                                                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de l'intervenant  à été bien enregistré.</div>";
                                                        $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                        $("#message").html('').append(balise_html);
                                                        $("#message").fadeOut(8000, function () {
                                                $(this).html('');
                                                }
                                                );
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
                                                        message: "Il ya une erreur interne dans le fichier set_intervenant.php",
                                                });
                                                }

                                        });
                                        $('#bouton_submit').html('').text("Enregistrer");
                                        return false;
                                });
<?php } ?>
<?php if ($action == 'all_view_interventions') { ?>
                                $("#effect2").hide();
                                        $("#effect3").hide();
                                        $("#effect4").hide();
                                        $("#effect5").hide();
                                        $("#effect6").hide();
                                        $('#liste_interventions_traitement_ss_intervenant').dataTable();
                                        $('#liste_interventions_traitement_avec_intervenant').dataTable();
                                        $("#liste_interv_traitement_avec_intervenant").click(function () {
                                $("#effect2").toggle("clip", 500);
                                        return false;
                                });
                                        $('#liste_interventions_confirme').dataTable();
                                        $("#liste_interv_confirme").click(function () {
                                $("#effect3").toggle("clip", 500);
                                        return false;
                                });
                                        $('#liste_interventions_termine').dataTable();
                                        $("#liste_interv_termine").click(function () {
                                $("#effect4").toggle("clip", 500);
                                        return false;
                                });
                                        $('#liste_interventions_annule_sans_choix_intervenant').dataTable();
                                        $("#liste_interv_annule_sans_choix_intervenant").click(function () {
                                $("#effect5").toggle("clip", 500);
                                        return false;
                                });
                                        $('#liste_interventions_annule_avec_choix_intervenant').dataTable();
                                        $("#liste_interv_annule_avec_choix_intervenant").click(function () {
                                $("#effect6").toggle("clip", 500);
                                        return false;
                                });
<?php } ?>
<?php if ($action == 'view_fiche_intervention') { ?>
                                $("#retour").on('click', function () {
                                document.location.href = 'index.php?module=interventions&action=all_view_interventions';
                                });
                                        $("#consultation_bilan").on('click', function () {
                                var id_bilan_premier_cours = $(this).val();
                                        $.ajax({
                                        url: 'controleurs/interventions/consultation_bilan_premier_cours.php',
                                                type: 'POST',
                                                data: {id_bilan: id_bilan_premier_cours},
                                                dataType: 'json',
                                                cache: false,
                                                success: function (data) {
                                                objet_message = data.message;
                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                        if (objet_message.reponse) {
                                                objet_bilan = data.bilan;
                                                        balise = "<table class='table table-striped table-hover '>";
                                                        balise += "<tr><th>Intervenant</th><td>" + objet_bilan.intervenant + "</td></tr>";
                                                        balise += "<tr><th>Le rythme de cours</th><td>" + objet_bilan.rythme_cours + "</td></tr>";
                                                        balise += "<tr><th>Note obtenue au dernier controle</th><td>" + objet_bilan.last_note_controle + "/20</td></tr>";
                                                        balise += "<tr><th>Les notions travaill&eacute;</th><td>" + objet_bilan.notions_travaille + "</td></tr>";
                                                        balise += "<tr><th>Les points forts</th><td>" + objet_bilan.points_forts + "</td></tr>";
                                                        balise += "<tr><th>Les points &aacute; travailler</th><td>" + objet_bilan.points_faibles + "</td></tr>";
                                                        balise += "<tr><th>Les objectifs</th><td>" + objet_bilan.objectifs_fixe + "</td></tr>";
                                                        balise += "<tr><th>Le plan de progression</th><td>" + objet_bilan.plan_progression + "</td></tr>";
                                                        balise += "</table>";
                                                        title_balise = "LE BILAN de l'&eacute;l&egrave;ve [" + objet_bilan.eleve + "] ";
                                                        bootbox.alert({
                                                        title: title_balise,
                                                                message: balise,
                                                        });
                                                }
                                                else {
                                                bootbox.alert({
                                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                        message: "Nous somme desol&eacute; .la demande de changement n'a pas &eacute;t&eacute; &eacute;ffectu&eacute;.Contacter l'adminstrateur de site",
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
                                        $("#changer_etat_intervention").on('change', function () {
                                var etat_intervention = $(this).val(),
                                        reference_intervention = $("#reference_intervention").val();
                                        if (etat_intervention != '') {
                                bootbox.confirm("Vous confirme votre modification ?", function (result) {
                                if (result) {
                                $.ajax({
                                url: 'controleurs/interventions/update_etat_intervention.php',
                                        type: 'POST',
                                        data: {etat: etat_intervention,
                                                reference: reference_intervention},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {
                                        objet_message = data.message;
                                                objet_message.reponse = Boolean(objet_message.reponse);
                                                if (objet_message.reponse) {
                                        bootbox.alert({
                                        title: "<span class='glyphicon glyphicon-ok'></span> Confirmation operation ",
                                                message: " Votre modification a &eacute;t&eacute; effectut&eacute; avec succ&egrave;s",
                                        });
                                        }
                                        else {
                                        bootbox.alert({
                                        title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                message: "Nous somme desol&eacute; .la demande de changement n'a pas &eacute;t&eacute; �ffectu&eacute;.Contacter l'adminstrateur de site",
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
                                }
                                });
                                }
                                });
<?php } ?>
<?php if ($action == 'add_intervention') { ?>

                                jQuery("#choix_famille").chosen();
                                        jQuery("#choix_eleve").chosen();
                                        jQuery("#matiere").chosen();
                                        $("#debut_mission").datepicker({
                                showOn: "button",
                                        buttonImage: "../img/calendar.gif",
                                        buttonImageOnly: true,
                                        buttonText: "Choisir une date"
                                });
                                        /*************  liste des beneficaires  ***************/
                                        $("#choix_famille").on('change', function () {
                                var code_famille = $(this).val();
                                        $.ajax({
                                        url: 'controleurs/interventions/liste_eleve.php',
                                                type: 'POST',
                                                data: {code_famille: code_famille},
                                                dataType: 'json',
                                                cache: false,
                                                success: function (reponse) {
                                                objet_json = reponse.liste_eleve;
                                                        balise = '<select class="choix_eleve" style="width: 100%;" data-placeholder="Selectionnez un eleve" id="choix_eleve"	name="choix_eleve">';
                                                        balise += '<option value="">Choisir le beneficiaire</option>';
                                                        $.each(objet_json, function (index, field) {
                                                        balise += '<option value="' + field.code_eleve + '">' + field.identite_eleve + '</option>';
                                                        }
                                                        );
                                                        balise += '</select>';
                                                        $("#liste_eleve").html('').append(balise);
                                                        jQuery(".choix_eleve").chosen();
                                                }
                                        });
                                });
                                        /************** les champs de date [type_intervention=ponctuelle] *****************/
                                        $("#type_intervention").on('change', function () {
                                var valeur_type = $(this).val();
                                        if (valeur_type == 'ponctuelle') {
                                balise = '<td><label for="fin_mission" class="control-label" >Fin mission :</label></td>';
                                        balise += '<td><input type="text" class="form-control" id="fin_mission" name="fin_mission"></td>';
                                        $("#fin_interv").html('').append(balise);
                                        // $("#fin_mission").datepicker();
                                        $("#fin_mission").datepicker();
                                }
                                else {
                                $("#fin_interv").html('');
                                }

                                });
                                        /////////////////////////////////////////////////           
                                        $("#type_intervention").on('change', function () {
                                var type_intervention = $(this).val();
                                        balise = '';
                                        balise_1 = '';
                                        if (type_intervention == 'regulier') {
                                balise += '<tr id="choix_bilan_1_cours" style="height: 60px;"><td COLSPAN="2"><label for="option_bilan_1_cours" class="control-label">Exiger &aacute; l\'intervenant le bilan de 1er cours :&nbsp; </label>';
                                        balise += '<input type="checkbox" name="option_bilan_1_cours" checked value="1"></td></tr>';
                                        balise += '<tr style="height: 60px;" id="choix_bilan_trims"><td COLSPAN="2"><label for="option_bilan_trims" class="control-label">Exiger &aacute; l\'intervenant le bilan trimestrielle :&nbsp; </label>';
                                        balise += '<input type="checkbox" name="option_bilan_trims" checked value="1"></td></tr>';
                                        $("#table_form").append(balise);
                                }
                                else {
                                $("#choix_bilan_1_cours").remove();
                                        $("#choix_bilan_trims").remove();
                                }
                                });
                                        /*************** envoyer l formulaire ****************/
                                        $('#choix_interv').on('click', function () {
                                choix_interv = 'oui';
                                });
                                        $('#set_sans_choix').on('click', function () {
                                choix_interv = 'non';
                                });
                                        ////////// envoi le formulaire ////////////

                                        $('#set_intervention').on('submit', function (e) {
                                e.preventDefault();
                                        var $this = $(this),
                                        wid = $("#form").width(),
                                        heig = $("#form").height(),
                                        data = {};
                                        $this.find('[name]').each(function (index, value) {
                                var $that = $(this),
                                        name = $that.attr('name'),
                                        value = $that.val();
                                        data[name] = value;
                                });
                                        data['choix_interv'] = choix_interv;
                                        if ($('input[name=option_date_1_cours]').is(':checked')) {
                                data['option_date_1_cours'] = '1';
                                } else {
                                data['option_date_1_cours'] = '0';
                                }
                                if ($('input[name=option_bilan_1_cours]').is(':checked')) {
                                data['option_bilan_1_cours'] = '1';
                                } else {
                                data['option_bilan_1_cours'] = '0';
                                }
                                if ($('input[name=option_bilan_trims]').is(':checked')) {
                                data['option_bilan_trims'] = '1';
                                } else {
                                data['option_bilan_trims'] = '0';
                                }
                                $.ajax({
                                url: $this.attr('action'),
                                        type: $this.attr('method'),
                                        data: data,
                                        dataType: 'json',
                                        cache: false,
                                        beforeSend: function () {
                                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                        },
                                        success: function (data) {
                                        objet_message = data.message;
                                                objet_message.reponse = Boolean(objet_message.reponse);
                                                if (objet_message.reponse) {
                                        if (objet_message.lien_choix_interv) {
                                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 10, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                                document.location.href = objet_message.lien_choix_interv;
                                        }
                                        else {
                                        var balise_html = '';
                                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La fiche de l'intervention  à été bien enregistré.</div>";
                                                $("#load").hide();
                                                $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                $("#message").html('').append(balise_html);
                                                $("#message").fadeOut(8000, function () {
                                        $(this).html('');
                                                window.location.reload(true);
                                        }
                                        );
                                        }


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
                                                $("#load").hide();
                                        }

                                        },
                                        error: function (jqXHR, error, errorThrown) {
                                        bootbox.alert({
                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                message: "Il ya une erreur interne dans le fichier set_intervention.php",
                                        });
                                                $("#load").hide();
                                        }

                                });
                                        return false;
                                });
                                        /*******************************************************/
<?php } ?>
<?php if ($action == 'choix_intervenant') { ?>
                                jQuery("#liste_intervenants").chosen();
                                        $("#date_affectation").datepicker();
                                        $('#liste_intervenant').dataTable({
                                "order": [[2, "desc"]]
                                });
                                        /**********************************************************/







                                                ///////// ouverture popup-fonction //////////////////////
                                                        function generer_fiche_intervenant(data) {
                                                        objet_fiche_intervenant = data.fiche_intervenant;
                                                                var table = '<table class="table table-striped table-hover ">';
                                                                table += '<tr>';
                                                                table += '<th>Nom intervenant :</th><td>' + objet_fiche_intervenant.identite_intervenant + '</td>';
                                                                table += '</tr>';
                                                                table += '<tr>';
                                                                table += '<th>Telephone Fixe</th><td>' + objet_fiche_intervenant.tel_fixe + '</td>';
                                                                table += '</tr>';
                                                                table += '<tr>';
                                                                table += '<th>Telephone portable</th><td>' + objet_fiche_intervenant.tel_portable + '</td>';
                                                                table += '</tr>';
                                                                table += '<tr>';
                                                                table += '<th>Email</th><td>' + objet_fiche_intervenant.email + '</td>';
                                                                table += '</tr>';
                                                                table += '<tr>';
                                                                table += '<th>Statut</th><td>' + objet_fiche_intervenant.statut + '</td>';
                                                                table += '</tr>';
                                                                table += '</table>';
                                                                return table;
                                                        }
                                                /***********************************************************/
                                                /****************************************/
                                                $('#liste_intervenant tbody').on('click', 'button[name="view_fiche_intervenant"]', function () {
                                                var code_intervenant = $(this).attr('id');
                                                        $.ajax({
                                                        url: "controleurs/intervenants/view_fiche_intervenant.php",
                                                                type: "POST",
                                                                data: {code_intervenant: code_intervenant},
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (data) {
                                                                var html_generer = generer_fiche_intervenant(data);
                                                                        $('#bloc_infos').show(function ()
                                                                {
                                                                $('#fiche_detaille_intervenant').html(html_generer);
                                                                }
                                                                );
                                                                },
                                                                error: function (jqXHR, error, errorThrown) {
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                        message: "Il ya une erreur interne dans le traitement dans votre demande.Contacter l'adminstrateur de site",
                                                                });
                                                                }
                                                        });
                                                });
                                                        /*************************************************************/
                                                        ////////// mon code ajax ///////////
                                                        //            $("button[value='view_fiche_intervenant']").on('click', function () {
                                                        //                var code_intervenant = $(this).attr('id');
                                                        //                $.ajax({
                                                        //                    url: "controleurs/intervenants/view_fiche_intervenant.php",
                                                        //                    type: "POST",
                                                        //                    data: {code_intervenant: code_intervenant},
                                                        //                    dataType: 'json',
                                                        //                    cache: false,
                                                        //                    success: function (data) {
                                                        //                        var html_generer = generer_fiche_intervenant(data);
                                                        //                        $('#fiche_detaille_intervenant').html(html_generer);
                                                        //                    }
                                                        //                });
                                                        //            });
                                                        //////////////// formulaire ////////////////////
                                                        $('#choix_intervenant').on('submit', function (e) {
                                                e.preventDefault();
                                                        var $this = $(this);
                                                        $.ajax({
                                                        url: $this.attr('action'),
                                                                type: $this.attr('method'),
                                                                data: $this.serialize(),
                                                                dataType: 'json',
                                                                cache: false,
                                                                beforeSend: function () {
                                                                $('#bouton_submit').html("<img src='./../img/ajax-loader_1.gif' />");
                                                                },
                                                                success: function (data) {
                                                                objet_message = data.message;
                                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                                        var balise_html = '';
                                                                        if (objet_message.reponse) {
                                                                $this[0].reset();
                                                                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  L'intervention a ete bien enregistré avec succes.</div>";
                                                                        $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                                        $("#message").html('').append(balise_html);
                                                                        $("#message").fadeOut(8000, function () {
                                                                $(this).html('');
                                                                }
                                                                );
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
                                                                        message: "Il ya une erreur interne dans le fichier validation_intervenant.php",
                                                                });
                                                                }

                                                        });
                                                        $('#bouton_submit').html('').text("Enregistrer");
                                                        return false;
                                                });
<?php } ?>
<?php if ($action == 'add_model_facture') { ?>
                                                jQuery("#choix_famille").chosen();
                                                        /**************************************/
                                                        $("#choix_famille").on('change', function () {
                                                var code_famille = $(this).val();
                                                        $.ajax({
                                                        url: 'controleurs/interventions/liste_eleve.php', // le nom du fichier indiqué dans le formulaire
                                                                type: 'POST', // la méthode indiquée dans le formulaire (get ou post)
                                                                data: {code_famille: code_famille}, // je sérialise les données (voir plus loin), ici les $_POST
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (reponse) {
                                                                objet_json = reponse.liste_eleve;
                                                                        balise = '<td>Choisissez votre eleve :</td>';
                                                                        balise += '<td><select class="choix_eleve" style="width:250px;" data-placeholder="Selectionnez un eleve" id="choix_eleve" name="choix_eleve">';
                                                                        balise += '<option value="">Choisir votre eleve</option>';
                                                                        $.each(objet_json, function (index, field) {
                                                                        balise += '<option value="' + field.code_eleve + '">' + field.identite_eleve + '</option>';
                                                                        }
                                                                        );
                                                                        balise += '</select></td>';
                                                                        $("#code_eleve").html('').append(balise);
                                                                        jQuery(".choix_eleve").chosen();
                                                                }
                                                        });
                                                });
                                                        ////////////////////////////////////
                                                        $("#application_remise").on('change', function () {
                                                var app_remise = $(this).val();
                                                        balise_type = '';
                                                        balise_valeur = '';
                                                        if (app_remise == '1') {
                                                balise_type += '<td>Type remise</td>';
                                                        balise_type += '<td><select class="form-control" id="type_remise" name="type_remise">';
                                                        balise_type += '<option value="">Choisir le type de remise</option>';
                                                        balise_type += '<option value="espece">Espece(EUR)</option>';
                                                        balise_type += '<option value="pourcentage">Pourcentage(%)</option>';
                                                        balise_type += '</select>';
                                                        balise_type += '</td>';
                                                        balise_valeur += '<td>Valeur remise :</td>';
                                                        balise_valeur += '<td><input type="text" class="form-control" id="valeur_remise" name="valeur_remise" value="0"></td>';
                                                        $("#tr_type_remise").css("height", "60px").html(balise_type);
                                                        $("#tr_type_valeur").css("height", "60px").html(balise_valeur);
                                                        $('#valeur_remise').on('change', function () {
                                                var type_remise = $("#type_remise").val();
                                                        if (type_remise == '') {
                                                bootbox.alert({
                                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                        message: 'Vous devez choisir le type de remise '});
                                                        $("#valeur_remise").val(0);
                                                }
                                                })
                                                        $('#valeur_remise').on('keyup', total_facture);
                                                }
                                                else {
                                                $("#tr_type_remise,#tr_type_valeur").css("height", "0px").html('');
                                                        $("#total_HT").val($('#prix_heure_HT').val() * $("#nb_heure").val());
                                                }

                                                });
                                                        ////////////////////////////////////////////////////
                                                        $('#nb_heure,#prix_heure_HT').on('keyup', total_facture);
                                                        /////////////////////// envoi le formulaire 
                                                        $('#set_model_facture').on('submit', function (e) {
                                                e.preventDefault();
                                                        var $this = $(this),
                                                        wid = $("#form").width(),
                                                        heig = $("#form").height(),
                                                        data = {};
                                                        $this.find('[name]').each(function (index, value) {
                                                var $that = $(this),
                                                        name = $that.attr('name'),
                                                        value = $that.val();
                                                        data[name] = value;
                                                });
                                                        if ($('input[name=paiement_cpt_rec_facture]').is(':checked')) {
                                                data['paiement_cpt_rec_facture'] = '1';
                                                }
                                                $.ajax({
                                                url: $this.attr('action'),
                                                        type: $this.attr('method'),
                                                        data: data,
                                                        dataType: 'json',
                                                        cache: false,
                                                        beforeSend: function () {
                                                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                                        },
                                                        success: function (data) {
                                                        $("#load").hide();
                                                                objet_message = data.message;
                                                                objet_message.reponse = Boolean(objet_message.reponse);
                                                                var balise_html = '';
                                                                if (objet_message.reponse) {
                                                        balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  Le modele de la facture a ete enregistré avec succes.</div>";
                                                                $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-ok'></span> Message de Confirmation ",
                                                                        message: balise_html
                                                                });
                                                                $this[0].reset();
                                                                //                            $("#message").html('').append(balise_html);
                                                                //                            $("#message").fadeOut(8000, function () {
                                                                //                                $(this).html('');
                                                                //                              }
                                                                //                            );
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
                                                                        message: balise});
                                                                $("#load").hide();
                                                        }

                                                        },
                                                        error: function (jqXHR, error, errorThrown) {
                                                        $("#load").hide();
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                        message: "Il ya une erreur interne dans le fichier set_model_facture.php",
                                                                });
                                                        }

                                                });
                                                        return false;
                                                });
<?php } ?>
<?php if ($action == 'all_view_model_facture') { ?>
                                                $('#liste_model_facture').dataTable();
<?php } ?>
<?php if ($action == 'add_facture') { ?>
                                                jQuery("#choix_famille").chosen();
                                                $(function() {
                                                    $("#date_facture,#date_excusion").datepicker({
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
                                                       
                                                        /////////////////////////////////
                                                        $('#section_acompte').on('change', view_section_acompte);
                                                        /////////////////////////////
                                                                function initialisation() {
                                                                $('#date_facture').val('');
                                                                        $('#nb_heure').val('0');
                                                                        $('#modele_coupon').val('');
                                                                        $('#type_prestation').val('');
                                                                        $('#mod_paiement').val('');
                                                                        $('#application_remise').val('');
                                                                        $('#designation_facture').val('');
                                                                        $('#objet_facture').val('');
                                                                        $("#prix_heure_HT").val('0');
                                                                        $("#total_HT").val('0');
                                                                        $('#paiement_cpt_rec_facture').prop("checked", false);
                                                                        if ($("#tr_type_remise").length && $("#tr_valeur_remise").length) {
                                                                $("#tr_type_remise").remove();
                                                                        $("#tr_valeur_remise").remove();
                                                                }
                                                                }
                                                        /************************************/
                                                        $(".choix_famille").on('change', function () {
                                                        initialisation();
                                                                var code_famille = $(this).val(),
                                                                balise = '';
                                                                /**************** Debut Appel la requette Ajax pour charger la liste des beneficiaires********************/
                                                                $.ajax({
                                                                url: 'controleurs/facturation/liste_famille.php',
                                                                        type: 'POST',
                                                                        data: {code_famille: code_famille},
                                                                        dataType: 'json',
                                                                        cache: false,
                                                                        success: function (reponse) {
                                                                        objet_json = reponse.liste_eleve;
                                                                                balise += '<option value="">Choisir un eleve</option>';
                                                                                $.each(objet_json, function (index, field) {
                                                                                balise += '<option value="' + field.code_eleve + '">' + field.identite_eleve + '</option>';
                                                                                });
                                                                                $("#choix_eleve").html('').append(balise);
                                                                        }
                                                                });
                                                        });
                                                                /************************************/
                                                                $("#choix_eleve").on('change', function () {
                                                        var code_eleve = $("#choix_eleve").val();
                                                                if (code_eleve != '') {
                                                        $.ajax({
                                                        url: 'controleurs/facturation/liste_famille.php',
                                                                type: 'POST',
                                                                data: {code_eleve: code_eleve},
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (reponse) {
                                                                $("#prix_heure_HT").val(reponse.prix_heure);
                                                                }
                                                        });
                                                        }
                                                        else {
                                                        $("#prix_heure_HT").val(0);
                                                        }


                                                        });
                                                                /************************************/
                                          $("#application_remise").on('change', function () {
                                                        var app_remise = $(this).val(),
                                                          balise = '';
                                                          if (app_remise == '1') {
                                                                balise += '<tr style="height: 60px;" id="tr_type_remise">';
                                                                balise += '<td style="width: 50%">Type remise</td>';
                                                                balise += '<td style="width: 50%"><select class="form-control" id="type_remise" name="type_remise">';
                                                                balise += '<option value="">Choisir le type de remise</option>';
                                                                balise += '<option value="espece">Espece(EUR)</option>';
                                                                balise += '<option value="pourcentage">Pourcentage(%)</option>';
                                                                balise += '</select></td>';
                                                                balise += '</tr>';
                                                                balise += '<tr style="height: 60px;" id="tr_valeur_remise">';
                                                                balise += '<td style="width: 50%">Valeur remise :</td>';
                                                                balise += '<td style="width: 50%"><input type="text" class="form-control" id="valeur_remise" name="valeur_remise" value="0"></td>';
                                                                balise += '</tr>';
                                                                $("#app_remise").after(balise);
                                                                $('#valeur_remise').on('change', function () {
                                                                        var type_remise = $("#type_remise").val();
                                                                                if (type_remise == '') {
                                                                        bootbox.alert({
                                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                                                message: 'Vous devez choisir le type de remise '});
                                                                                $("#valeur_remise").val(0);
                                                                        }
                                                                })
                                                                $('#valeur_remise').on('keyup', total_facture);
                                                        }
                                                        else if (app_remise == '0' || app_remise == '') {
                                                        if ($("#tr_type_remise").length && $("#tr_valeur_remise").length) {
                                                        $("#tr_type_remise").remove();
                                                                $("#tr_valeur_remise").remove();
                                                                $("#total_HT").val($('#prix_heure_HT').val() * $("#nb_heure").val());
                                                        }
                                                        }


                                                        });
                                                                /************************************/
                                                       $('#nb_heure,#prix_heure_HT').on('keyup', total_facture);
                                                       $('#valeur_remise').on('keyup', total_facture);
                                                                /*************** envoyer l formulaire ****************/

                                           $('#set_facture').on('submit', function (e) {
                                                                e.preventDefault();
                                                                var wid = $("#form").width(),
                                                                heig = $("#form").height(),
                                                                $this = $(this);
                                                                $.ajax({
                                                                url: $this.attr('action'),
                                                                        type: $this.attr('method'),
                                                                        data: $this.serialize(),
                                                                        dataType: 'json',
                                                                        cache: false,
                                                                        beforeSend: function () {
                                                                        $("#load").width(wid).height(heig).addClass("load_gif").activity({segments: 8, steps: 3, opacity: 0.1, width: 15, space: 0, length: 5, color: '#fff', speed: 1.5});
                                                                                $('html,body').animate({scrollTop: $("#load").offset().top}, "slow");
                                                                        },
                                                                        success: function (data) {
                                                                        objet_message = data.message;
                                                                                objet_message.reponse = Boolean(objet_message.reponse);
                                                                                if (objet_message.reponse) {
                                                                        var balise_html = '';
                                                                                balise_html += "<div class='well' style=' background-color: #AEEE00;'><span class='glyphicon glyphicon-ok'></span>  La facture  à été bien enregistré.</div>";
                                                                                $('html,body').animate({scrollTop: $("#message").offset().top}, "slow");
                                                                                $("#message").html('').append(balise_html);
                                                                                $("#message").fadeOut(8000, function () {
                                                                        $(this).html('');
                                                                                if (objet_message.lien_generer_facture) {
                                                                                     document.location.href = objet_message.lien_generer_facture;
                                                                        }
                                                                        }
                                                                        );
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
                                                                                message: "Il ya une erreur interne dans le fichier set_facture.php",
                                                                        });
                                                                        },
                                                                        complete: function () {
                                                                        $("#load").hide();
                                                                        }

                                                                });
                                                                return false;
                                                        });
<?php } ?>
<?php if ($action == 'view_fiche_facture') { ?>
                                                        $('#liste_encaissements_facture').dataTable();
                                                                /***************************/
                                                        $("#view_facture").on('click', function (event) {
                                                               event.preventDefault();
                                                                /**************requette ajax *********/
                                                                $.ajax({
                                                                url: 'controleurs/facturation/generer_lien_facture.php',
                                                                        type: 'POST',
                                                                        data: {id_facture: <?php echo $_GET['N_facture']; ?>},
                                                                        dataType: 'json',
                                                                        cache: false,
                                                                        success: function (data) {
                                                                        var iframe = '<iframe src="' + data.lien_pdf + '" width="100%" height="780" style="border: none;"></iframe>';
                                                                                bootbox.alert({
                                                                                title: " Consultation la facture N°<?php echo $_GET['N_facture']; ?> ",
                                                                                        message:iframe,
                                                                                });
                                                                        },
                                                                        error: function (jqXHR, error, errorThrown) {
                                                                        bootbox.alert({
                                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                                message: "Il ya une erreur interne dans le traitement dans votre demande.Contacter l'adminstrateur de site",
                                                                        });
                                                                        }
                                                                });
                                                                /*************************************/

                                                        });
                                                             /***************************/
                                                        $("#view_liste_coupons").on('click', function (event) {
                                                               event.preventDefault();
                                                                /**************requette ajax *********/
                                                                $.ajax({
                                                                url: 'controleurs/facturation/generer_lien_coupons.php',
                                                                        type: 'POST',
                                                                        data: {id_facture: <?php echo $_GET['N_facture']; ?>},
                                                                        dataType: 'json',
                                                                        cache: false,
                                                                        success: function (data) {
                                                                        var iframe = '<iframe src="' + data.lien_pdf + '" width="100%" height="780" style="border: none;"></iframe>';
                                                                                bootbox.alert({
                                                                                title: " Consultation les coupons de  facture N°<?php echo $_GET['N_facture']; ?> ",
                                                                                        message:iframe,
                                                                                });
                                                                        },
                                                                        error: function (jqXHR, error, errorThrown) {
                                                                        bootbox.alert({
                                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                                message: "Il ya une erreur interne dans le traitement dans votre demande.Contacter l'adminstrateur de site",
                                                                        });
                                                                        }
                                                                });
                                                                /*************************************/

                                                        });
                                                                /***************************/
                                                                $("#retour").on('click', function () {
                                                        document.location.href = 'index.php?module=facturation&action=all_view_factures';
                                                        });
                                                                /***************************/
                                                                $("#changer_etat_facture").on('change', function () {
                                                        var etat_facture = $(this).val(),
                                                                reference_facture = $("#reference_facture").val();
                                                                if (etat_facture != '') {
                                                        bootbox.confirm("Vous confirme votre modification ?", function (result) {
                                                        if (result) {
                                                        $.ajax({
                                                        url: 'controleurs/facturation/update_etat_facture.php',
                                                                type: 'POST',
                                                                data: {etat: etat_facture,
                                                                        reference: reference_facture},
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (data) {
                                                                objet_message = data.message;
                                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                                        if (objet_message.reponse) {
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-ok'></span> Confirmation operation ",
                                                                        message: " Votre modification a &eacute;t&eacute; effectut&eacute; avec succ&egrave;s",
                                                                });
                                                                        var etat_button = '';
                                                                        if (etat_facture == 'reglé') {
                                                                etat_button = 'btn-success';
                                                                } else if (etat_facture == 'non_reglé') {
                                                                etat_button = 'btn-danger';
                                                                } else if (etat_facture == 'attente') {
                                                                etat_button = 'btn-warning';
                                                                } else if (etat_facture == 'annule') {
                                                                etat_button = 'btn-info';
                                                                }
                                                                var html_button = '<button type="button" class="btn ' + etat_button + '">' + etat_facture + '</button>';
                                                                        $('#etat_facture').html(html_button);
                                                                        $('#liste_etat_facture').remove();
                                                                }
                                                                else {
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                                        message: "Nous somme desol&eacute; .la demande de changement n'a pas &eacute;t&eacute; �ffectu&eacute;.Contacter l'adminstrateur de site",
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
                                                        }
                                                        });
                                                        }
                                                        });
                                                                /****************************************/
                                                                $('#liste_encaissements_facture tbody').on('change', 'select[name="changer_etat_encaissement"]', function () {
                                                        var etat_encaissement = $(this).val(),
                                                                reference_facture = $("#reference_facture").val();
                                                                if (etat_encaissement != '') {
                                                        bootbox.confirm("Vous confirme votre modification ?", function (result) {
                                                        if (result) {
                                                        $.ajax({
                                                        url: 'controleurs/facturation/update_etat_encaissement.php',
                                                                type: 'POST',
                                                                data: {etat: etat_encaissement,
                                                                        reference: reference_facture},
                                                                dataType: 'json',
                                                                cache: false,
                                                                success: function (data) {
                                                                objet_message = data.message;
                                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                                        if (objet_message.reponse) {
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-ok'></span> Confirmation operation ",
                                                                        message: " Votre modification a &eacute;t&eacute; effectut&eacute; avec succ&egrave;s",
                                                                });
                                                                        window.location.reload(true);
                                                                }
                                                                else {
                                                                bootbox.alert({
                                                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                                        message: "Nous somme desol&eacute; .la demande de changement n'a pas &eacute;t&eacute; �ffectu&eacute;.Contacter l'adminstrateur de site",
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
                                                        }
                                                        });
                                                        }

                                                        });
                                                                /****************************************/
                                                                        function   mondal_form_encaiss(data_valeur = {}) {
                                                                        var code_client = $("#code_client").val();
                                                                                if (data_valeur == {}){
                                                                        liste_compte(code_client);
                                                                        } else{
                                                                        liste_compte(code_client, data_valeur);
                                                                        }



                                                                        }

                                                                        /****************************************/
                                                                        function liste_compte(code_client, data_valeur = {}){
                                                                        $.ajax({
                                                                        url: 'controleurs/facturation/liste_compte_bancaire.php',
                                                                                type: 'POST',
                                                                                data: {code_client: code_client},
                                                                                dataType: 'json',
                                                                                cache: false,
                                                                                success: function (data) {
                                                                                objet_message = data.message;
                                                                                        objet_message.reponse = Boolean(objet_message.reponse);
                                                                                        if (objet_message.reponse) {
                                                                                var html_liste_compte = '',
                                                                                        array_liste = objet_message.liste_comptes;
                                                                                        html_liste_compte = '<select class="form-control" name="liste_compte" id="liste_compte">';
                                                                                        $.each(array_liste, function (index, field) {
                                                                                        html_liste_compte += '<option value="' + field.val1 + '">' + field.val2 + '</option>';
                                                                                        });
                                                                                        html_liste_compte += '</select>';
                                                                                        /************************************/
                                                                                        if (data_valeur == {}){
                                                                                table = mondal_formulaire(html_liste_compte);
                                                                                } else{
                                                                                table = mondal_formulaire(html_liste_compte, data_valeur);
                                                                                }

                                                                                sauvegarde_encaissement(table);
                                                                                        $("#date_encaiss,#date_execution,#date_enregistrement").datepicker();
                                                                                        /************************************/
                                                                                }
                                                                                else {
                                                                                bootbox.alert({
                                                                                title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
                                                                                        message: "Nous somme desol&eacute; .la demande  n'a pas &eacute;t&eacute; �ffectu&eacute;.Contacter l'adminstrateur de site",
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
                                                                        }
                                                                        /***********************************************/
                                                                        function mondal_formulaire(html_liste_compte, data_valeur = {}) {

                                                                        var table = '';
                                                                                if (data_valeur != {}){
                                                                        table += '<div>' + data_valeur['balise_erreur'] + '</div>';
                                                                        }
                                                                        table += '<table class="table table-striped table-hover ">';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="date">Date enregistrement :</label></th><td><input type="text" class="form-control" id="date_enregistrement" name="date_enregistrement" placeholder="Entrer date enregistrement" ></td>';
                                                                                table += '</tr>';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="date">Date execution :</label></th><td><input type="text" class="form-control" id="date_execution" name="date_execution" placeholder="Entrer date execution"></td>';
                                                                                table += '</tr>';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="date">Date encaissement :</label></th><td><input type="text" class="form-control" id="date_encaiss" name="date_encaiss" placeholder="Entrer date encaissement"></td>';
                                                                                table += '</tr>';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="num_cheque">Numero cheque :</label></th><td><input type="text" class="form-control" id="num_cheque" name="num_cheque" placeholder="Entrer numero cheque"></td>';
                                                                                table += '</tr>';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="numero_compte">Numero compte :</label></th><td>' + html_liste_compte + '</td>';
                                                                                table += '</tr>';
                                                                                table += '<tr>';
                                                                                table += '<th><label for="montant_cheque">Montant cheque :</label></th><td><input type="text" class="form-control" id="montant_cheque" name="montant_cheque" placeholder="Entrer montant cheque"></td>';
                                                                                table += '</tr>';
                                                                                table += '</table>';
                                                                                return table;
                                                                        }
                                                                        /***********************************************/
                                                                        function sauvegarde_encaissement(data){
                                                                        bootbox.dialog({
                                                                        message: data,
                                                                                title: "Formulaire",
                                                                                buttons: {
                                                                                success: {
                                                                                label: "Enregistrer",
                                                                                        className: "btn-success",
                                                                                        callback: function (result) {
                                                                                        if (result != null) {
                                                                                        var data_encaiss = {};
                                                                                                data_encaiss['date_enregistrement'] = $("#date_enregistrement").val();
                                                                                                data_encaiss['date_execution'] = $("#date_execution").val();
                                                                                                data_encaiss['date_encaiss'] = $("#date_encaiss").val();
                                                                                                data_encaiss['num_cheque'] = $("#num_cheque").val();
                                                                                                data_encaiss['num_compte'] = $("#liste_compte").val();
                                                                                                data_encaiss['montant_cheque'] = $("#montant_cheque").val();
                                                                                                data_encaiss['N_facture'] = <?php echo $_GET['N_facture']; ?>;
                                                                                                $.ajax({
                                                                                                url: 'controleurs/facturation/add_encaissement.php',
                                                                                                        type: 'POST',
                                                                                                        data: data_encaiss,
                                                                                                        dataType: 'json',
                                                                                                        cache: false,
                                                                                                        success: function (data) {
                                                                                                        objet_message = data.message;
                                                                                                                objet_message.reponse = Boolean(objet_message.reponse);
                                                                                                                if (objet_message.reponse) {
                                                                                                        bootbox.alert({
                                                                                                        title: "<span class='glyphicon glyphicon-ok'></span> Confirmation operation ",
                                                                                                                message: " Votre enregistrement a &eacute;t&eacute; effectut&eacute; avec succ&egrave;s",
                                                                                                        });
                                                                                                                window.location.reload(true);
                                                                                                        }
                                                                                                        else {
                                                                                                        objet_message_erreur = data.message_erreur;
                                                                objet_valeur_saisi = data.valeur_saisi;
                                                                                                                balise_erreur = "<h3 style='color:red'>Liste des erreurs</h3>";
                                                                                                                balise_erreur += "<ul>";
                                                                                                                $.each(objet_message_erreur, function (index, field) {
                                                                                                                balise_erreur += "<li style='color:red'>" + field + "</li>";
                                                                                                                });
                                                                                                                balise_erreur += "</ul><hr/>";
                                                                                                                var data_valeur = {};
                                                                                                                data_valeur['balise_erreur'] = balise_erreur;
                                                                data_valeur['valeur_saisi'] = {};
                                                                                                                mondal_form_encaiss(data_valeur);
                                                                                                        }
                                                                                                        },
                                                                                                        error: function (jqXHR, error, errorThrown) {
                                                                                                        bootbox.alert({
                                                                                                        title: "<span class='glyphicon glyphicon-warning-sign'></span>Erreur interne ",
                                                                                                                message: "Il ya une erreur interne dans le traitement dans votre demande.Contacter l'adminstrateur de site",
                                                                                                        });
                                                                                                        }
                                                                                                }); //fin apel requette Ajax
                                                                                        }
                                                                                        } // Fin apel Callback
                                                                                } // Fin condition Succes
                                                                                }
                                                                        }); // Fin apel Bootbox.alert    
                                                                        }
                                                                        /***********************************************/
                                                                        $("button[value='add_encaissement']").on('click', function () {

                                                                        mondal_form_encaiss();
                                                                   });
<?php } ?>
                                                                    });</script>
<script type="text/javascript">
                                                                    var auto_refresh = setInterval(
                                                                            function () {
                                                                            $('#nbre_messages').load('./vues/membre/record_count_message.php').fadeIn("slow");
                                                                            }, 1000000);

</script>

