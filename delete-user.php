<?php include 'header.php' ?>
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-wrap">
					<h2>Delete your user</h2>
					<form action="deleteuserP.php" method="post">
						<div class="form-group">
							<label>Password</label>
							<input type="text" name="parola">
						</div>

						<button type="submit" class="btn btn-primary">Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>     

