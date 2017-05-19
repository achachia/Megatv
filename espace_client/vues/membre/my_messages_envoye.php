
    <div class="row">
        <div class="col-md-12 column">         
            <div class="col-md-9 column"> 
                <div class='row'>
                    <div class="page-header">
                        <h3>Messages envoyés</h3> 
                    </div>
                    
                    <table id="mes_messages_envoye" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                            if (isset($my_messages_envoye)) {
                                $tr = '';
                                foreach ($my_messages_envoye as $value) {
                                    $tr .= '<tr>';
                                    $tr .='<td>' . $value['date_message'] . '</td><td>' . $value['heure_message'] . '</td><td>' . $value['objet_message'] . '</td><td><button type="button" class="btn-primary" value="cons_message_envoye"  id="' . $value['code_message'] . '"><span class="glyphicon glyphicon-send"></span> Consulter</button>';          
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





