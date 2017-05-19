<table class="table table-striped table-hover table-bordered">
    <tbody>
        <tr>
            <th style="text-align:center;">Horaire</th>
            <th style="text-align:center;">lun.</th>
            <th style="text-align:center;">mar.</th>
            <th style="text-align:center;">mer.</th>
            <th style="text-align:center;">jeu.</th>
            <th style="text-align:center;">ven.</th>
            <th style="text-align:center;">sam.</th>
            <th style="text-align:center;">dim.</th>
        </tr>

        <?php
        if (isset($infos_benef['diponibilite']) && sizeof($infos_benef['diponibilite']) > 0) {
            $i = 1;
            foreach ($infos_benef['diponibilite'] as $key => $value) {
                $name = 'periode' . $i . '[]';
                $j = 1;
                $tr = '<tr align="center">';
                $tr .= '<TD>' . $key . '</TD>';
                foreach ($value as $key1 => $value1) {
                    $tr .= '<TD><input type="checkbox"  name="' . $name . '"  value="' . $j . '" ';
                    if ($value1 == '1') {
                        $tr .= 'checked="checked" ';
                    }
                    $tr .= '/></TD>';
                    $j ++;
                }
                $tr .= '</tr>';
                $i ++;
                echo $tr;
            }
        } else {
            ?>
            <tr>
                <TD>Matin</TD>
                <TD><input type="checkbox" name='periode1[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode1[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>13h-14h</TD>
                <TD><input type="checkbox" name='periode2[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode2[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>14h-15h</TD>
                <TD><input type="checkbox" name='periode3[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode3[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>15h-16h</TD>
                <TD><input type="checkbox" name='periode4[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode4[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>16h-17h</TD>
                <TD><input type="checkbox" name='periode5[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode5[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>17h-18h</TD>
                <TD><input type="checkbox" name='periode6[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode6[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>18h-19h</TD>
                <TD><input type="checkbox" name='periode7[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode7[]' value='7' /></TD>
            </tr>
            <tr>
                <TD>19h-20h</TD>
                <TD><input type="checkbox" name='periode8[]' value='1' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='2' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='3' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='4' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='5' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='6' /></TD>
                <TD><input type="checkbox" name='periode8[]' value='7' /></TD>
            </tr>	
        <?php } ?>	



    </tbody>
</table>
