<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title text-center"><span class="glyphicon glyphicon-envelope"></span> Messagerie</h3>
    </div>
    <div class="panel-body">             
        <ul class="list-group"  id="side_bare_droite">
            <li class="list-group-item">
                <a href='index.php?module=membre&action=view_all_message'><span class="glyphicon glyphicon-envelope"></span> Mes messages <span class="badge" id='nbre_messages'><?php if (isset($badge)) {
    echo $badge;
} ?></span></a>                          
            </li>
            <li class="list-group-item">
                <a href='index.php?module=membre&action=contact_intervenant'><span class="glyphicon glyphicon-pencil"></span> Contacter un intervenant</a>                      
            </li>
            <li class="list-group-item">
                <a href='index.php?module=membre&action=contact_conseiller'><span class="glyphicon glyphicon-pencil"></span> Contacter un conseiller</a>                      
            </li>

        </ul>
    </div>  
</div>
