
<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-9 column">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-12">
						<h3>Mes disponibilités</h3>
					</div>
				</div>
				<div id="message"></div>
			</div>
			<input type="checkbox" checked="checked" /><label
				for="SheetContentPlaceHolder_disponible"> Je suis disponible</label>
			<form class="form-horizontal" id="form_disponibilite"
				name='form_disponibilite' method="POST"
				action="controleurs/membre/traitement_disponibilite.php ">
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

                            <?php
																												if (isset ( $liste_plannig_intervenant ) && sizeof ( $liste_plannig_intervenant ) > 0) {
																													$i = 1;
																													foreach ( $liste_plannig_intervenant as $key => $value ) {
																														$name = 'periode' . $i . '[]';
																														$j = 1;
																														$tr = '<tr align="center">';
																														$tr .= '<TD>' . $key . '</TD>';
																														foreach ( $value as $key1 => $value1 ) {
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
				<button type='submit' class="btn btn-primary" value='dispo_hebdo'>
					<span class="glyphicon glyphicon-check"></span>Valider mes
					disponibilités
				</button>
			</form>
			<div class="page-header">
				<div class="row">
					<div class="col-lg-12">
						<h3>Disponibilités sur les périodes suivantes :</h3>
					</div>
				</div>
			</div>
			<form class="form-horizontal" id="disponibilite_vacan" method="POST"
				action="controleurs/membre/traitement_disponibilite.php">
				<table class="table table-striped table-hover">
					<tbody>
						<tr>
							<th width="200px">Période</th>
							<th width="35px">Disponible</th>
						</tr>
						<tr>
							<td>Eté du 28/07/2014 au 03/08/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Eté du 04/08/2014 au 10/08/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Eté du 11/08/2014 au 17/08/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Eté du 18/08/2014 au 24/08/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Eté du 25/08/2014 au 31/08/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Toussaint du 21/10/2014 au 25/10/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
						<tr>
							<td>Toussaint du 28/10/2014 au 31/10/2014</td>
							<td><input type="checkbox" /></td>
						</tr>
					</tbody>
				</table>
				<button type='submit' class="btn btn-primary" value='dispo_vacan'>
					<span class="glyphicon glyphicon-check"></span>Valider mes
					disponibilités
				</button>
			</form>
		</div>
	</div>
</div>




