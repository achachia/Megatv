<form class="form-horizontal" id="form_disponibilite" name='form_disponibilite' method="POST" action="controleurs/clients/add_beneficiaire.php ">
    <div class="row">
        <div class="col-lg-4" id='select_liste'></div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover "> 
            <tbody>
                <tr id='css_text'>
                    <th>Horaire</th>
                    <th>lun.</th>
                    <th>mar.</th>
                    <th>mer.</th>
                    <th>jeu.</th>
                    <th>ven.</th>
                    <th>sam.</th>
                    <th>dim.</th>
                </tr>
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
            </tbody>
        </table> 
        <button type='submit' class="btn btn-primary" value='dispo_hebdo' name='dispo_hebdo'><span class="glyphicon glyphicon-check"></span>Valider mes disponibilités</button>
    </div>
</form>
