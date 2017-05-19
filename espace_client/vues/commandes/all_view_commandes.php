<div class='row'>
    <div class="col-md-9 column">
        <div>
            <h3 style="color:blue"><i class="fa fa-list"></i> MES COMMANDES</h3>
             <div class="sepreater"></div>

        </div><br><br><br>
        <table id="mes_commandes" class="table table-striped table-bordered" cellspacing="0"   width="100%">
            <thead>
                <tr>
                    <th style="color:blue">R&Eacute;F&Eacute;RENCE</th>
                    <th style="color:blue">DATE</th>
                    <th style="color:blue">&Eacute;TAT COMMANDE</th>             
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($liste_commandes)) {
                    $tr = '';
                    foreach ($liste_commandes as $value) {
                        $tr .= '<tr>';
                        $tr .= '<td>' . $value ['code_commande'] . '</td><td>' . $value ['date_commande'] . '</td><td>' . $value ['etat'] . '</td>';
                        $tr .= '</tr>';
                    }
                    echo $tr;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



