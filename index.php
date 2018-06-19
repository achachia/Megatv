<?php
require_once './connection/config.php';


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">     
        <title>Mega-Tv</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="theme/css/normal.css">
        <link rel="stylesheet" type="text/css" href="theme/css/style.css">
        <link rel="stylesheet" href="theme/css/animation.css">
        <link href="media/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
        <script>
            if (/mobile/i.test(navigator.userAgent))
                document.documentElement.className += ' w-mobile';
        </script>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script><![endif]-->
    </head>
    <body>
        <div class="fix-header" id="home">
            <div class="w-container">
                <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400"></div>
            </div>
        </div>
        <div class="fixed-header">
            <div class="w-container container"> 
                <div class="w-row">

                    <!--///////////////////////////////////////////////////////
                    // Logo section 
                    //////////////////////////////////////////////////////////-->


                    <div class="w-col w-col-3 logo">
                        <img  src="theme/images/logo.png" alt="Mega-tv" style="width:130px;height:55px">
                    </div>

                    <!--///////////////////////////////////////////////////////
                   // End Logo section 
                   //////////////////////////////////////////////////////////-->

                    <div class="w-col w-col-11">

                        <!--///////////////////////////////////////////////////////
                        // Menu section 
                        //////////////////////////////////////////////////////////-->


                        <div class="w-nav navbar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
                            <div class="w-container nav">
                                <nav class="w-nav-menu nav-menu" role="navigation">

                                    <a class="w-nav-link menu-li" href="#home">ACCUEIL</a>
                                    <a class="w-nav-link menu-li" href="#my_chaines">NOS CHAINES TV</a>
                                    <a class="w-nav-link menu-li" href="#my_abonnements">NOS ABONNEMENTS</a>
                                    <a class="w-nav-link menu-li" href="<?= $url_espace_client;?>/login.php">ESPACE CLIENTS</a>
                                    <!--   <a class="w-nav-link menu-li" href="#portfolio">PORTFOLIO</a>
                                       <a class="w-nav-link menu-li"href="#team">TEAM</a>-->
                                    <a class="w-nav-link menu-li" href="#contact">NOUS CONTACTER</a>
                                </nav>
                                <div class="w-nav-button">
                                    <div class="w-icon-nav-menu"></div>
                                </div>
                            </div>
                        </div>


                        <!--///////////////////////////////////////////////////////
                     // End Menu section 
                     //////////////////////////////////////////////////////////-->


                    </div>
                </div>
            </div>
        </div>

        <!--///////////////////////////////////////////////////////
             //  Slider section 
             //////////////////////////////////////////////////////////-->


        <div class="slidersection" style="text-align:center">
            <img src="theme/images/abonnement-cccam-mgcamd.jpg" alt="image01" />
        </div>


        <div class="about-parlex" id="my_chaines">
            <section class="parlex7-back">
                <div class="w-container">
                    <div id="about-animation">
                        <div class="wrap">
                            <div class="about">
                                <h1 class="about-heading">Liste des chaines IPTV disponibles00</h1>            
                                <div class="sepreater"></div>
                            </div>
                            <p class="about-des">Découvrez notre catalogue de chaines Françaises et étrangères…<br/>
                                À consommer sans modération !
                            </p>
                            <a href="http://megatv.fr/librairie/Html2pdf/generer_pdf/liste_chaines_iptv.php" target="_blank"><h1 class="about-heading">Consulter la liste complete des bouquets IPTV <i class="fa fa-download"></i>
</h1></a>
                            </p>
                            <img class="about-img" src="theme/images/nos_chaines_tv.png"    alt="52de15aa5d3566c14300015e_about.png" />
                        </div>
                    </div>
                </div>
            </section>
        </div>



        <section class="service-parlex" id="my_abonnements">
            <section class="parlex-back">
                <div class="w-container">
                    <div class="wrap">
                        <div class="service-combo">
                            <div class="services">
                                <h1 class="service-heading">NOS ABONNEMENTS IPTV</h1>             
                                <div class="sepreater service"></div>
                            </div> 
                            <div class="w-row">
                                <div class="w-col w-col-3 services-column">
                                    <div class="service-icon">
                                        <img src="theme/images/abo_iptv_12_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">70 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=1" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>
                                <div class="w-col w-col-3 services-column">
                                    <div class="service-icon">
                                        <img src="theme/images/abo_iptv_6_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">45 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=2" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>
                                <div class="w-col w-col-3 services-column">
                                    <div class="service-icon">
                                        <img src="theme/images/abo_iptv_3_mois.png" style="height:300px">
                                    </div>
                                    <h4 class="service-head" style="font-size:30px">32 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=3" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>


                            </div>
                        </div>
                        <div class="service-combo">
                            <div class="services">
                                <h1 class="service-heading">NOS ABONNEMENTS CCCAM</h1>             
                                <div class="sepreater service"></div>
                            </div> 
                            <div class="w-row" style="text-align:center">
                                <div class="w-col w-col-2 services-column">

                                </div>
                                <div class="w-col w-col-3 services-column">
                                    <div class="service-icon">
                                        <img src="theme/images/abo_cccam_12_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">30 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=4" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>
                                <div class="w-col w-col-3 services-column">
                                    <div class="service-icon">
                                        <img src="theme/images/abo_cccam_6_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">20 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=5" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>                          

                            </div>
                        </div>
                        <div class="service-combo">
                            <div class="services">

                            </div> 
                            <div class="w-row">
                                <div class="w-col w-col-6 services-column">
                                    <h1 class="service-heading"> VOD</h1>             
                                    <div class="sepreater service"></div>
                                    <div class="service-icon">
                                        <img src="theme/images/abo_vod_12_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">75 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=6" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div>
                                <div class="w-col w-col-5 services-column">
                                    <h1 class="service-heading">SMART IPTV</h1>             
                                    <div class="sepreater service"></div>
                                    <div class="service-icon">
                                        <img src="theme/images/abo_smart_tv_12_mois.png" style="height:300px">
                                    </div>              
                                    <h4 class="service-head" style="font-size:30px">90 euros</h4>
                                    <h4 class="service-head" style="font-size:25px;color:blue" ><a href="http://mega-cours.fr/iptv/espace_client/index.php?module=commandes&action=add_commande&id_abo=7" style="color:#FFFFFF">COMMANDER</a></h4>
                                </div> 


                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </section>


        <div class="contact-parlex" id="contact">
            <div class="parlex8-back">
                <div class="w-container">
                    <div class="wrap">
                        <div class="contact-div">
                            <h1 class="contact-heading">FORMULAIRE DE CONTACT</h1>
                            <div class="sepreater"></div>
                        </div>
                        <!--       <p class="contact-para">Thanks for taking the time to contact us!
                                   <br>We do our best to respond to quickly, it could take us 1-2 business days to get back to you. Feel free to say hello!</p>-->
                        <div class="w-form">
                            <div id="message"  class="w-row call-row" style="background-color:#FFFFFF;display :none"></div>
                            <form id="form_contact"  action="contact.php" method="post">





                                <label for="name">Nom:</label>
                                <input class="w-input" type="text" placeholder="Entrer votre nom ici" name="cf_name" required="required">
                                <label for="email">Email :</label>
                                <input class="w-input" placeholder="Entrer votre adresse E-mail ici" type="email" name="cf_email" required="required">
                                <label for="email">Objet-message :</label>
                                <input class="w-input" placeholder="Entrer votre objet message ici" type="text" name="cf_objet" required="required">
                                <label for="email">Votre Message:</label>
                                <textarea class="w-input message" placeholder="Entrer votre message ici" name="cf_message" required="required"></textarea><br>
                                <input class="w-button" type="submit" value="Envoyer">
                            </form>

                        </div>
                    </div>
                </div>
                 <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0"    marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=69003+lyon&amp;aq=4&amp;oq=light&amp;sll=45.764043,4.835659&amp;sspn=0.001391,0.00206&amp;g=69003+lyon&amp;ie=UTF8&amp;hq=&amp;hnear=69003+lyon,+Rh%C3%B4ne,+Rh%C3%B4ne-Alpes&amp;t=m&amp;ll=45.764043,4.835659&amp;spn=0.007488,0.012832&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe><br />
                    <small><a href="http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=69003+lyon&amp;aq=&amp;sll=45.764043,4.835659&amp;sspn=0.001391,0.00206&amp;g=61+Cours+de+la+Liberté+69003+lyon&amp;ie=UTF8&amp;hq=&amp;hnear=69003+lyon+Rh%C3%B4ne,+Rh%C3%B4ne-Alpes&amp;t=m&amp;ll=45.764043,4.835659&amp;spn=0.007488,0.012832&amp;z=15&amp;iwloc=A" target="_blank">Zoom</a></small>
               
                <div class="w-container">
                    <div class="w-row contact-col">
                        <div class="w-col w-col-2 contact-col1">
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="footer-parlex">
            <div class="parlex9-back">
                <div class="w-container">
                    <div class="wrap">

                        <div>
                            <div class="fotter-text">
                                <img  src="theme/images/logo.png" alt="Mega-tv"  style="height:80px;margin-top: 10px;width: 180px;">
                                <p class="copyright-area" style="color:#FFFFFF">Copyright &copy; MEGA TV  2015</p>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--///////////////////////////////////////////////////////
        // End Footer section 
        //////////////////////////////////////////////////////////-->

        <script type="text/javascript" src="theme/js/jquery.js"></script>
        <script type="text/javascript" src="theme/js/normal.js"></script>
        <script type="text/javascript" src="theme/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="theme/js/carousels.js"></script>
        <script type="text/javascript" src="theme/js/slider-modernizr.js"></script>
        <script src="theme/js/classie.js"></script>
        <script src="theme/js/portfolio-effects.js"></script>
        <script src="theme/js/toucheffects.js"></script>
        <script src="theme/js/modernizr.js"></script>
        <script src="theme/js/animation.js"></script>
        <script src="media/plugin_js/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="theme/js/my_scripts.js" type="text/javascript"></script>

    </body>
</html>

