
<div class="row">
    <div class="col-md-12 column">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">INTERVENANTS</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 column">                     
                    </div>
                    <figure>
                        <img src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png" alt="" class="img-circle img-responsive" style="width:100px;height:100px"> 
                    </figure>  
                </div>
                <p>
                <ul class="list-group" id="side_bare_droite">
                    <li class="list-group-item">
                        <a href='index.php?module=intervenants&action=all_view_intervenants'><span class="glyphicon glyphicon-list-alt"></span> Liste intervenants</a>                        
                    </li>
                    <li class="list-group-item">
                        <a href='index.php?module=intervenants&action=add_intervenant'><span class="glyphicon glyphicon-saved"></span> Ajouter un intervenant </a>                      
                    </li>              
                </ul>   
                </p>

            </div>  
        </div>
             <?php include  dirname(dirname(dirname(__FILE__) )).chemin_vue.side_bare_messagerie ; ?>

    </div>
</div>
