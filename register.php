<?php include 'header2.php' ?>
<div class="page-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="register-wrap">
					<h2>Register</h2>	
					<form action="signupP.php" method="post">
						<div class="form-group row">
							<label class="col-md-4">Name</label>
							<input type="text" name="Name" class="col-md-8">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Surname</label>
							<input type="text" name="Surname" class="col-md-8">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Email</label>
							<input type="email" name="Email" class="col-md-8">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Username</label>
							<input type="text" name="Username" class="col-md-8">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Password</label>
							<input type="password" name="Password" class="col-md-8">
						</div>
						<button type="submit" class="btn btn-primary">Register</button>
						<?php
							if (isset($_GET["msg"]) && $_GET["msg"] == 'usedemail') {
							echo "Used email";
							}
						?>
						<?php
							if (isset($_GET["msg"]) && $_GET["msg"] == 'done') {
							echo "Registration succesful";
							}
						?>
						<?php
							if (isset($_GET["msg"]) && $_GET["msg"] == 'invalidedmail') {
							echo "Invalid email";
							}
						?>
						<?php
							if (isset($_GET["msg"]) && $_GET["msg"] == 'userexists') {
							echo "User already exists!";
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
