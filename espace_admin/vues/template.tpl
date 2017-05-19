<!DOCTYPE html>
<html lang="fr">
    <head>
       {$head}
    </head>    
    <body> 
        <p>&nbsp;</p>
        <div id="page" class="container">

            <header id="header" class="row"  style="height: 200px;background: url(./../media/images/nos_chaines_tv.png)"></header>

            <!-- inclusion le fichier nav -->
            <nav id="menu" class="navbar navbar-default" role="navigation">
                {include  file="vues/nav_menu.tpl"}
            </nav>    
            <ul class="breadcrumb">
                {include  file="vues/breadcrumb.tpl"}
            </ul>
           
            <div id="contenu">
                 {$contenu}                
            </div>

            <div class="clearfix">&nbsp;</div>
            <footer id="footer" class="row">
               {include  file="vues/footer.tpl"}
            </footer>
        </div>  
        <p>&nbsp;</p>
       <!-- <script type="text/javascript">
            var auto_refresh = setInterval(
                    function () {
                        $('#nbre_messages').load('./vues/membre/record_count_message.php').fadeIn("slow");
                    }, 1000000);

        </script>-->
    </body>
</html>

