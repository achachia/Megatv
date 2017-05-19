<?php
//vue
?>

<div class="row">
	<div class="col-md-12 column">
		<div class="col-md-3 column">
             <?php  include dirname ( __FILE__ ) . side_bare_gauche;  ?>
            </div>
		<div class="col-md-9 column">
			<div class='row'>
				<div class="page-header">
					<h3>Saisir le bilan de 1er cours (la famille <?php echo $_GET['identite_famille'];?>). </h3>
				</div>
				<div class="col-md-12 column">
					<form class="form-horizontal" id="create_bilan_premier_cours"
						method="POST"
						action="controleurs/action_membre/set_bilan_premier_cours.php">
						<div class='row'>
						   
							<label>Pensez vous que ce rythme est adapt&eacute; aux besoins de
								l'&eacute;l&egrave;ve :</label><br/>
							<div class="col-lg-3">
								<select class="form-control" id="rythme_cours"
									name="rythme_cours">
									<option value=''>votre avis</option>
									<option value='1'>Rythme adapt&eacute;</option>
									<option value='0'>Rythme non adapt&eacute;</option>
								</select>
							</div>
						</div>
						<div class='row'>
							<label>Note obtenue au dernier controle (/20):</label><br />
							<div class="col-lg-4">
								<input type="text" class="form-control" id="note_last_control"
									name="note_last_control">
							</div>
						</div>
						<div class='row'>
							<label>Qu'avez vous travaill&eacute; lors de ce 1er cours:</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="notions_travaile" rows="5"
									name="notions_travaile"></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les points forts(attitude de
								l'&eacute;l&egrave;ve,serieux,motivations):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="points_forts" rows="5"
									name="points_forts"></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les points &aacute; travailler(lacunes,points
								&aacute; travailler,methodes...):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="points_faibles" rows="5"
									name="points_faibles"></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Quels sont les objectifs que vous etes
								fix&eacute;s(lacunes,points &aacute; travailler,methodes...):</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="objectifs_fixe" rows="5"
									name="objectifs_fixe"></textarea>
							</div>
						</div>
						<div class='row'>
							<label>Qu'allez-vous mettre en place pour le faire progresser:</label><br />
							<div class="col-lg-8">
								<textarea class="form-control" id="plan_progression" rows="5"
									name="plan_progression"></textarea>
							</div>
						</div>
						<div class='row'>
							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<input type="hidden" class="form-control"
										id="reference_intervention" name="reference_intervention"
										value="<?php  echo $_GET["reference_mission"];?>">
									<button class="btn btn-default" type="reset">Annuller</button>
									<button type="submit" class="btn btn-primary"
										id="bouton_submit">Enregistrer</button>
								</div>
							</div>
						</div>

					</form>
				</div>

			</div>

		</div>
	</div>
</div>

