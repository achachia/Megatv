
<!DOCTYPE html>
<html lang="fr">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="IE=edge" http-equiv="X-UA-Compatible" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<title>MEG@COURS Soutien scolaire</title>
<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="http://mega-cours.fr/media/css/bootstrap.css" media="screen">
<!-- Custom CSS -->
<link href="http://mega-cours.fr/media/css/css_login.css" rel="stylesheet" />
<!-- Custom Fonts -->
<link href="http://mega-cours.fr/media/fontawesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic"
	rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700"
	rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery Version 1.11.0 -->
<script src="http://mega-cours.fr/media/js/jquery.js"></script>
<script src="http://mega-cours.fr/media/js/bootstrap.min.js"></script>

</head>
<body data-spy="scroll" data-target=".navbar-fixed-top" id="page-top" style="background: url(../media/images/photo.jpg) no-repeat scroll;">
		<div class="intro-body" >
			<div class="container">
				<div class="row">
					<div class="col-md-12 ">
						<div class="container">
							<div class="row">
                       <?php   if(isset($_GET['message_deconnection'])){ ?>
                  <div class="row">
									<div class="col-sm-8 col-md-6 col-md-offset-4"
										style="margin-left: 24%;">
										<div class="alert alert-dismissable alert-warning"
											style="background-color: #FFFFFF;text-align: center">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<h4 style="color: #0000FF;">Confirmation</h4>
											<p style="color: #0000FF;">Déconnection effectuée avec
												succes.</p>
										</div>
									</div>
								</div> 
<?php }  ?>
                    <div class="col-sm-6 col-md-4 col-md-offset-4" style="margin-top:2% ">
									<div class="account-wall">
										<img class="profile-img"
											src="./../media/images/user.png"
											alt="">
					<form name="identification" id="identification" class="form-signin" method="POST" action="traitement_login_admin.php">
								 <?php   if(isset($_GET['message_erreur'])){ ?>			
											<div id="message">
												<div class="alert alert-dismissable alert-danger">
													<button type="button" class="close" data-dismiss="alert">�</button>
													<strong>Valeur incorrecte d'identifiant ou/et de mot de
														passe.</strong>
												</div>
											</div>
					    		<?php }  ?>	
					    	
											<input type="text" class="form-control" placeholder="Adresse email" required autofocus name="email">
											
											<input type="password" class="form-control"
												placeholder="Mot de passe" required name="password">
											<button class="btn btn-lg btn-primary btn-block"
												type="submit" name="identification" id="identification">Identification</button>
											<span class="clearfix"></span>
										</form>
									</div>

								</div>
							</div>
						</div>
						<p class="intro-text" style="font-size: 20px;text-align: center">Copyright &copy;
							MEG&#64;Tv 2015-2016</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container text-center"></div>
</body>
</html>


