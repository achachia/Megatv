<?php
// vue
?>

<div class="row">
	<div class="col-md-12 column">

		<div class="col-md-7 column">
			<div class='row'>
				<div class="page-header">
					<h3>Modifier le bilan de 1er cours .[<?php echo $infos_bilan_prem_cours['eleve'];?>]</h3>
				</div>
				<div class="col-md-12 column">
					<form class="form-horizontal" id="update_bilan_premier_cours"
						method="POST"
						action="controleurs/compte_rendu/update_bilan_premier_cours.php">
						<div id="message"></div>
						<div class='row'>

							<label>Pensez vous que ce rythme est adapt&eacute; aux besoins de
								l'&eacute;l&egrave;ve :</label><br />
							<div class="col-lg-4">
								<select class="form-control" id="rythme_cours"
									name="rythme_cours">
									<option value=''>votre avis</option>
									<option value='1'
										<?php if($infos_bilan_prem_cours['rythme_cours']=='1') { echo "selected"; }?>>Rythme
										adapt&eacute;</option>
									<option value='0'
										<?php if($infos_bilan_prem_cours['rythme_cours']=='0') { echo "selected"; }?>>Rythme
										non adapt&eacute;</option>
								</select>
							</div>
						</div>
						<div class='row'>
							<label>Note obtenue au dernier controle (/20):</label><br />
							<div class="col-lg-4">
								<input type="text" class="form-control" id="note_last_control"
									name="note_last_control"
									value="<?php echo $infos_bilan_prem_cours['dernier_note'];?>">
							</div>
						</div>
						<div class='row'>
							<label>Qu'avez vous travaill&eacute; lors de ce 1er cours:</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="notions_travaile" rows="5"
									name="notions_travaile"><?php echo $infos_bilan_prem_cours['notions_travaille'];?></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les points forts(attitude de
								l'&eacute;l&egrave;ve,serieux,motivations):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="points_forts" rows="5"
									name="points_forts"><?php echo $infos_bilan_prem_cours['points_forts'];?></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les points &aacute; travailler(lacunes,points
								&aacute; travailler,methodes...):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="points_faibles" rows="5"
									name="points_faibles"><?php echo $infos_bilan_prem_cours['points_faibles'];?></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les objectifs que vous etes
								fix&eacute;s(lacunes,points &aacute; travailler,methodes...):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="objectifs_fixe" rows="5"
									name="objectifs_fixe"><?php echo $infos_bilan_prem_cours['objectifs_fixe'];?></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Qu'allez-vous mettre en place pour le faire progresser:</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="plan_progression" name="plan_progression" rows="5"
									name="plan_progression"><?php echo $infos_bilan_prem_cours['plan_progression'];?></textarea>
							</div>
						</div>
						<div class='row'>
							<div class="form-group">
								<div class="col-lg-4">
									<input type="hidden" class="form-control" id="id_bilan"
										name="id_bilan" value="<?php  echo $_GET["id_bilan"];?>">
									<button class="btn btn-default" type="reset">Annuller</button>
									<button type="submit" class="btn btn-primary"
										id="bouton_submit">Modifier</button>
								</div>
							</div>
						</div>

					</form>
				</div>

			</div>

		</div>
	</div>
</div>

