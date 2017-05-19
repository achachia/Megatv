
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <title>Inscription MEGA-TV</title>
        <link href="../media/css/boostrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../media/css/css_login.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

        <script src="../media/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../media/js/jquery.js" type="text/javascript"></script>
        <script src="../media/plugin_js/bootbox.min.js" type="text/javascript"></script>
        <script>

            $(document).ready(function () {
                /**************************** traitement le formulaire de l'inscription ****************/
                $('#inscription').on('submit', function (e) {
                    e.preventDefault();
                    var $this = $(this),
                            object_erreur = [],
                            data = {};
                    $this.find('[name]').each(function (index, value) {
                        var $this = $(this),
                                name = $this.attr('name'),
                                value = $this.val(),
                                drapeau = true;

                        if (name != 'enregistrement') {
                            if (value == '') {
                                drapeau = false;
                                chaine = 'le champ  est obligatoire';

                            } else {
                                if (name == 'email') {

                                    /******** controle format champ e-mail *************/
                                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                                    if (!regex.test(value)) {
                                        chaine = 'le format email est invalide';
                                        drapeau = false;
                                    }
                                }
                                            if (name == 'tel_portable') {
                                                /******** controle format champ e-mail *************/
                                                var filter = /^[0-9-+]+$/;
                                                if (!filter.test(value)) {
                                                    chaine = 'le numero telephone  est invalide';
                                                    drapeau = false;
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
                                    alert(balise);
//                                    bootbox.alert({
//                                        title: "<span class='glyphicon glyphicon-warning-sign'></span> Message d'erreur ",
//                                        message: balise,
//                                    });
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

            });
        </script>    


    </head>
    <body  style="background: url(../media/images/nos_chaines_tv.png)">

        <div class="row" >
            <div class="col-sm-10 col-md-4 col-md-offset-4" style="width :600px;">
                <div class="account-wall">
                    <img class="profile-img" src="../media/images/user.png" alt="">
                    <form class="form-signin" name="inscription" id="inscription"  method="POST" 	action="check_inscription.php">

                        <div class="form-group">
                            <label>NOM</label>
                            <input class="form-control input-lg" name="nom"  type="text"   placeholder="NOM"  tabindex="1" >
                        </div><br>
                        <div class="form-group">
                            <label>PRENOM</label>
                            <input class="form-control input-lg" name="prenom"  type="text"   placeholder="PRENOM"  tabindex="2" >
                        </div><br>
                        <div class="form-group">
                            <label>NUMERO DE TELEPHONE</label>
                            <input class="form-control input-lg" name="tel_portable"  type="text"   placeholder="NUMERO TELEPHONE"   >
                        </div><br>
                        <div class="form-group">
                            <label>ADRESSE EMAIL</label>
                            <input class="form-control input-lg" name="email"  type="text"   placeholder="EMAIL VALIDE"   tabindex="4" >
                        </div><br>
                        <div class="form-group">
                            <label>MOT DE PASSE</label>
                            <input class="form-control input-lg" name="password"  type="password"   placeholder="MOT DE PASSE"  tabindex="5" >
                        </div><br>                      


                        <button class="btn btn-lg btn-primary btn-block"  type="submit" name="enregistrement" id="enregistrement">Enregistrer</button><br>


                    </form>
                    <p style="font-size: 13px;text-align: center;color:#0000FF">Copyright &copy; MEGA-TV  2015</p> 

                </div>

            </div>

        </div>



    </body>
</html>


