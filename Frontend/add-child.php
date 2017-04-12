<?php include 'header.php' ?>
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-wrap">
					<h2>Add new child</h2>
					<form>
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="Name">
						</div>
						<div class="form-group">
							<label>Surname</label>
							<input type="text" name="Surname">
						</div>
						<div class="form-group">
							<label>Age</label>
							<input type="number" min="1" max="18" name="Age">
						</div>
						<div class="form-group form-group-gender">
							<label>Gender</label>
							<div class="form-group">
								<p><input type="radio" name="gender" id="male"><label for="male">Male</label></p>
							</div>
							<div class="form-group">
								<p><input type="radio" name="gender" id="female"><label for="female">Female</label></p>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?> 