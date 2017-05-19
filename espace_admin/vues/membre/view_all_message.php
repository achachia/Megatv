
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
                                <th>Expediteur</th>
                                <th>Date</th>
                                <th>Heure</th>                               
                                <th>Action</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($mes_messages_recus)) {
                                $tr = '';
                                foreach ($mes_messages_recus as $value) {
                                    $tr .= '<tr>';
                                    $tr .='<td>' . $value['expediteur'] . '</td><td>' . $value['date_message'] . '</td><td>' . $value['heure_message'] . '</td><td><button type="button" class="btn-primary" value="cons_message_recu"  id="' . $value['id_message'] . '">';
                                    if ($value['etat_message'] == '1') {
                                        $tr .='<span class="glyphicon glyphicon-eye-open"></span>';
                                    } else {
                                        $tr .='<span class=" glyphicon glyphicon-envelope"></span>';
                                    }
                                    $tr .='Consulter</button><a href="index.php?module=membre&action=rep_message&id_message=' . $value['id_message'] . '"><button type="button" class="btn-success" value="rep_message"  id="' . $value['id_message'] . '"><span class="glyphicon glyphicon-pencil"></span>Répondre</button></a></td>';
                                    $tr.='</tr>';
                                }
                                echo $tr;
                            }
                            ?>                           
                        </tbody>
                    </table>      
                </div>
                <div class='row'>
                    <div class="page-header">
                        <h3>Messages envoyés</h3> 
                    </div>
                    
                    <table id="mes_messages_envoye" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Distinataire</th>
                                <th>Date</th>
                                <th>Heure</th>                               
                                <th>Action</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($mes_messages_envoye)) {
                                $tr = '';
                                foreach ($mes_messages_envoye as $value) {
                                    $tr .= '<tr>';
                                    $tr .='<td>' . $value['destinataire'] . '</td><td>' . $value['date_message'] . '</td><td>' . $value['heure_message'] . '</td><td><button type="button" class="btn-primary" value="cons_message_envoye"  id="' . $value['id_message'] . '"><span class="glyphicon glyphicon-send"></span>Consulter</button>';          
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





