<!DOCTYPE html>
<html>
<head>
	<title>Kimo</title>

	<!-- META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=yes">
	
	<!-- STYLE -->
	<link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    
	<style type="text/css">
		body{
	position: relative;
    background-image: url(image/kids.jpg);
    background-repeat:no-repeat;
    background-size:100% 100vh;
}
	</style>

</head>
<body>
<header class="logged-out" style="height: 82px;padding-top: 11px;">
	<div class="container clearfix">
		<ul class="list-inline unlogged-in">
			<li class="logo-wrap col-md-3 col-xs-3"> <a  class="navbar-brand" href="index.php"><img src="image/logo.png" class="img-circle" alt="" style="position:absolute; top: -110px;width: 300px;height: 280px; left: -7px;"></a></li><!--
		 --><li class="login-wrap col-md-9 col-xs-9">
				<form action="loginP.php" method="post">
					<ul class="list-inline">
						<li>	
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" style="color:black;">
							</div>
						</li>
						<li>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" style="color:black;">
								<p><a href="reset-password.php">Forgot password?</a></p>
							</div>
						</li>
						<li>
							<button type="submit" class="btn btn-primary">Login</button>
						</li>
					</ul>
						<?php
						if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
						echo "<div id=\"greseala\" class=\"alert alert-info\" role=\"alert\" style=\"width:250px; position:relative; display:visible; left:600px;top:7px;\" >Wrong username/password</div";
						}
						?>

				</form>
			</li>
		</ul>
	</div>
</header>

