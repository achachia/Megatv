
<div class="row">
	<div class="col-md-12 column">
		<!-- ----------------------------- -->
	<?php
	
if (($module == 'clients') && ($action == 'view_fiche_client')) {
	include dirname ( __FILE__ ) . '/side_bare_clients.php';
	}
	?>
	<!-- ----------------------------- -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<span class="glyphicon glyphicon-user"> </span><span
						class="glyphicon glyphicon-user"> </span> CLIENTS
				</h3>
			</div>

			<div class="panel-body">
				<div class="row"
					style="width: 1050px; margin-left: 1cm; margin-bottom: 0.5cm;">
					<figure>
						<img
							src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png"
							alt="" class="img-circle img-responsive"
							style="width: 100px; height: 100px">
					</figure>
				</div>
				<div class="container" style="width: 1050px; margin-left: -1cm;">
					<div class="row">
						<div class="col-sm-3 col-md-3">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default"  style="width:230px;margin-left:-0.01cm">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseOne"><span class="glyphicon glyphicon-user">
											</span> CLIENTS</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<table class="table">
												<tr>
													<td><span class="glyphicon glyphicon-list-alt text-success"></span><a
														href='index.php?module=clients&action=all_view_clients'>
															Liste des clients</a></td>
												</tr>
												<tr>
													<td><span class="glyphicon glyphicon-plus text-success"></span><a
														href='index.php?module=clients&action=add_client'>
															Cr&eacute;er une fiche client</a></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default"  style="width:230px;margin-left:-0.01cm">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseTwo"><span class="glyphicon glyphicon-user">
											</span><span class="glyphicon glyphicon-user"> </span>
												B&Eacute;N&Eacute;FICIAIRES</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table">
												<tr>
													<td><span class="glyphicon glyphicon-plus text-success"></span><a
														href='#'> Cr&eacute;rer une fiche benificiaire</a></td>
												</tr>
												<tr>
													<td><span class=" glyphicon glyphicon-pencil text-success"></span><a
														href='#'> Modifier une fiche beneficaire</a></td>
												</tr>
												<tr>
													<td><span class="glyphicon glyphicon-list-alt text-success"></span><a
														href='#'> Liste des benificiaires</a></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default"  style="width:230px;margin-left:-0.01cm">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseThree"><span
												class="glyphicon glyphicon-calendar"> </span>
												DISPONIBILIT&Eacute;</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table">
												<tr>
													<td><a href="#"><span
															class="glyphicon glyphicon-plus text-success"></span>
															Ajouter une disponibilit&eacute;</a></td>
												</tr>
												<tr>
													<td><a href="#"><span
															class=" glyphicon glyphicon-pencil text-success"></span>
															Modifier une disponibilit&eacute;</a></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="panel panel-default"  style="width:230px;margin-left:-0.01cm">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseFour"><span class="glyphicon glyphicon-stats">
											</span> STATISTIQUES</a>
										</h4>
									</div>
									<div id="collapseFour" class="panel-collapse collapse">
										<div class="panel-body">
											<table class="table">

											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ----------------------------- -->
        <?php include  dirname(dirname(dirname(__FILE__) )).chemin_vue.side_bare_messagerie ; ?>

    </div>
</div>
