<?php include 'header.php' ?>
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-wrap">
					<h2>Number of notifications</h2>
					<form action="lastyearP.php" method="post">
						<div class="form-group">
							<label>Age</label>
							<input type="number" min="1" max="18" name="age">
						</div>
						<div class="form-group">
							<label>Notifications</label>
							<input type="number" min="1" max="1000" name="notifications">
						</div>
						<button type="submit" class="btn btn-primary">Check</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>     

