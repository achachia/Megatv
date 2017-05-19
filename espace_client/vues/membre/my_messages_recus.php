
    <div class="row">
        <div class="col-md-12 column">         
            <div class="col-md-9 column"> 
                <div class='row'>
                    <div class="page-header">
                        <h3>Messages recus</h3> 
                    </div>
                    <p id='infos'><span class=" glyphicon glyphicon-envelope"></span> :Message non-lu  ||  <span class="glyphicon glyphicon-eye-open"></span> :Message lu.</p>
                    <table id="mes_messages_recus" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>                                
                                <th>Date</th>
                                <th>Heure</th> 
                                <th>Objet</th>
                                <th>Action</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($my_messages_recus)) {
                                $tr = '';
                                foreach ($my_messages_recus as $value) {
                                    $tr .= '<tr>';
                                    $tr .='<td>' . $value['date_message'] . '</td><td>' . $value['heure_message'] . '</td><td>' . $value['objet_message'] . '</td><td><button type="button" class="btn-primary" value="cons_message_recu"  id="' . $value['code_message'] . '">';
                                    if ($value['etat_vue'] == '1') {
                                        $tr .='<span class="glyphicon glyphicon-eye-open"></span>';
                                    } else {
                                        $tr .='<span class=" glyphicon glyphicon-envelope"></span>';
                                    }
                                    $tr .='Consulter</button><a href="'.$url_absolu.$value['token'].'/repondre-message.html"><button type="button" class="btn-success" value="rep_message"  ><span class="glyphicon glyphicon-pencil"></span>Répondre</button></a></td>';
                                    $tr.='</tr>';
                                }
                                echo $tr;
                            }
                            ?>                           
                        </tbody>
                    </table>      
                </div>
            </div>
        </div>
    </div>







