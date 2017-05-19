
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Mes &eacute;l&egrave;ves</h4></div>
            <div class="panel-body">
               <?php if (isset($liste_clients) && sizeof($liste_clients) > 0) { ?>   
			<table id="liste_clients" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>CODE CLIENT</th>
                                                <th>NOM</th>
						<th>PRENOM</th>						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                            <?php

                                        $tr = '';
                                        foreach ( $liste_clients as $value ) {
                                                $tr .= '<tr>';
                                                $tr .= '<td>' . $value ['code_client'] . '</td>';
                                                $tr .= '<td>' . $value ['nom_client'] . '</td>';
                                                $tr .= '<td>' . $value ['prenom_client'] . '</td>';                                          
                                                $tr .= '<td>';
                                                $tr .= '<div class="btn-group">';
                                                $tr .= '<button type="button" class="btn btn-success"> Action </button>';
                                                $tr .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>';
                                                $tr .= '<ul class="dropdown-menu">';
                                              //  $tr .= '<li><a href="#"><button type="button" class="btn-primary" >' . $key1 . '</button></a></a></li>';
                                                $tr .= '</ul>';
                                                $tr .= '</div>';
                                                $tr .= '</td>';
                                                $tr .= '</tr>';
                                        }
                                        echo $tr;

                                ?>
                        </tbody>
			</table>
                <?php } else { ?> 
                    <h4>Aucun client trouv&eacute;.</h4>       
                <?php } ?> 
            </div>
        </div>
    </div>

</div>
