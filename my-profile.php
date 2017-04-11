<?php include 'header.php' ?>
<div class="page-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="register-wrap">
					<h2>Your profile</h2>	
					<h4>Update your profile</h4>
					<form>
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
							<label class="col-md-4">Old password</label>
							<input type="password" name="Password" class="col-md-8">
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
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>