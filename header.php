<!DOCTYPE html>
<html>
<head>
	<title>Kimo</title>

	<!-- META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=no">
	
	<!-- STYLE -->
	<link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

</head>
<body>
<header>
	<div class="container clearfix">
		<ul class="list-inline unlogged-in hidden">
			<li class="logo-wrap col-md-3 col-xs-3"><h4><a href="index.php">Kimo</a></h4></li><!--
		 --><li class="login-wrap col-md-9 col-xs-9">
				<form>
					<ul class="list-inline">
						<li>	
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username">
							</div>
						</li>
						<li>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password">
								<p><a href="reset-password.php">Forgot password?</a></p>
							</div>
						</li>
						<li>
							<button type="submit" class="btn btn-primary">Login</button>
						</li>
					</ul>
				</form>
			</li>
		</ul>
		<ul class="list-inline logged-in clearfix">
			<li class="logo-wrap col-md-3 col-xs-3"><h4><a href="index.php">Kimo</a></h4></li><!--
		 --><li class="logo-wrap col-md-9 col-xs-9">
		 		<form>
					<ul class="list-inline">
						<li>	
							<a href="add-child.php">Add child</a>
						</li>
						<li>
							<a href="#">Petrica</a>
						</li>
					</ul>
				</form>
		 	</li>
		</ul>
	</div>
</header>
<div class="alert alert-warning" role="alert">Child 1 is few feets outside of the area.</div>
<div class="alert alert-danger" role="alert">Child 2 is over than 50 feets outside of the area.</div>
