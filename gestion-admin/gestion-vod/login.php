<?php 
include './connection/config.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>IDENTIFICATION-VOD</title> 
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="IE=edge" http-equiv="X-UA-Compatible" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="<?= dir_media; ?>/css/boostrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= dir_media; ?>/css/css_login.css" rel="stylesheet" type="text/css"/>
<link href="<?= dir_media; ?>/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery Version 1.11.0 -->
<script src="<?= dir_media; ?>/js/jquery.js?c=943916400"></script>
<script src="<?= dir_media; ?>/js/bootstrap.min.js?c=943916400"></script>

</head>
<body  style="background: url(<?= dir_media; ?>/images/nos_chaines_tv.png)">
    
                  <?php   if(isset($_GET['message_deconnection'])){ ?>
                       <div class="row">
			  <div class="col-sm-8 col-md-6 col-md-offset-4" style="margin-left: 24%;">
				<div class="alert alert-dismissable alert-warning" style="background-color: #F7F7F7;text-align: center">
				  <button type="button" class="close" data-dismiss="alert">×</button>
			          <h4 style="color: #0000FF;">Confirmation</h4>
				  <p style="color: #0000FF;">Déconnection effectuée avec succes.</p>
				</div>
			  </div>
			</div> 
               <?php } ?>
                    <div class="row">
                          <div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="account-wall">
					  <img class="profile-img" src=".<?= dir_media; ?>/images/user.png" alt="">
					  <form class="form-signin" name="identification" id="identification"  method="POST" 	action="traitement_login_client.php">
						    <?php   if(isset($_GET['message_erreur'])){ ?>			
							<div id="message">
								<div class="alert alert-dismissable alert-danger">
						         		<button type="button" class="close" data-dismiss="alert">�</button>
									<strong>Valeur incorrecte d'identifiant ou/et de mot de passe.</strong>
								</div>
							</div>
					    	    <?php }  ?>	
					    	<input type="text" class="form-control" placeholder="Adresse email" required autofocus name="email">
						<input type="password" class="form-control"  placeholder="Mot de passe" required name="password">
                                                <button class="btn btn-lg btn-primary btn-block"  type="submit" name="identification" id="identification">IDENTIFICATION</button><br>
                                                <p style="font-size: 20px;text-align: center;color:#FFFFFF"><a href="http://megatv.fr"><i class="fa fa-hand-o-left"></i> Retour &agrave; l'accueil</a></p> 
						
					  </form>
                                           <p style="font-size: 20px;text-align: center;color:#0000FF">Copyright &copy; MEGA TV  2015</p> 
                                    
				</div>

			   </div>
                                                                 
		</div>
          
		
		
</body>
</html>
