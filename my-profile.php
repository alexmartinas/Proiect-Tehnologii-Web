<?php include 'header.php' ?>
<?php include 'parolaP.php' ?>
<?php include 'idtutoreP.php' ?>
<?php include 'emailuserP.php' ?>
<?php include 'numeuserP.php' ?>
<div class="page-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="register-wrap">
					<h2>Your profile</h2>	
					<h4>Update your profile</h4>
					<form action="updateprofileP.php" method="post">
						<div class="form-group row">
							<label class="col-md-4">Name</label>
							<input type="text" name="Name" class="col-md-8" value="<?php echo $name ?>">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Surname</label>
							<input type="text" name="Surname" class="col-md-8" value="<?php echo $surname ?>">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Email</label>
							<input type="email" name="Email" class="col-md-8" value="<?php echo $email ?>">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Old password</label>
							<input type="password" name="Password" class="col-md-8" value="<?php echo $password ?>">
						</div>
						<div class="form-group row">
							<label class="col-md-4">New password</label>
							<input type="password" name="new-Password" class="col-md-8">
						</div>
						<div class="form-group row">
							<label class="col-md-4">Confirm new password</label>
							<input type="password" name="conf-Password" class="col-md-8">
						</div>
						<button type="submit" onClick="location.href='my-profile.php'" class="btn btn-primary">Update</button>
						<?php
							if (isset($_GET["msg"]) && $_GET["msg"] == 'fin') {
							echo 'Account updated';
							}
							if (isset($_GET["msg"]) && $_GET["msg"] == 'email') {
							echo 'Used email.Please choose something else!';
							}
							if (isset($_GET["msg"]) && $_GET["msg"] == 'already') {
							echo 'This user already exists.Please choose something else!';
							}
						?>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>