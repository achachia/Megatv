
<page style="font-size:14px" backtop="15mm">
        <?php
                $total_enregistrements = count($liste_chaines);
                $reste = $total_enregistrements % 4;
                $nbre_colone=4;
                $td = '';
                $tr = '';
        ?>
    <H3 style="text-align: center">
        <b>LA LISTE COMPLETE DES BOUQUETS MEGA-TV 2015 </b><br><br/>
        <b> Le nombre de chaines de bouquet MEGA-TV est : 
        <H2 style="text-align: center;color:red"><?= $total_enregistrements; ?><br>
            [dernier mise a jour la liste : 23/09/2015]</H2></b><br><br>
        
    </H3>
    <br>
    <br>
    <br> 


    <!---------------------------------------------------->

    <div style="margin-left:60px">
    <table CELLPADDING="10"   border="1px" style="width: 100%; text-align: center; font-size: 14px">
        <tr style="background-color: red"> <th COLSPAN=<?= $nbre_colone; ?>> Liste des chaines</th></tr> 

       <?php              

                for ($j = 0; $j <= $total_enregistrements; $j++) {

                    if ($j % $nbre_colone != 0) {
                        $td.='<td>' . $liste_chaines[$j]['nom'] .'</td>';
                    } else {
                        $tr.='<tr>' . $td . '</tr>';
                        $td = '<td>' . $liste_chaines[$j]['nom'] . '</td>';
                    }
                }

                if ($reste > 0) {
                    $quotient = floor($total_enregistrements / $nbre_colone);
                    $diff = $nbre_colone - $reste;

                    $tr.='<tr>';
                    for ($j = 0;$j <= $reste;$j++) {
                         $k=$quotient * $nbre_colone + $j;
                         $tr.= '<td>' . $liste_chaines[$k]['nom'] .'</td>';     
                    }
                    for ($j = 1; $j <$diff; $j++) {
                       $tr.='<td></td>';
                    }
                      $tr.='</tr>';
                }


     echo $tr;
?> 

    </table>
        
    </div>

</page>


