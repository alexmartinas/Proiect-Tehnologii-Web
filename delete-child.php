<?php include 'header.php' ?>
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-wrap">
					<h2>Delete child</h2>
					<form action="deletecopilP.php" method="post">
						<div class="form-group">
							<label>Id Device</label>
							<input type="number" name="Iddevice">
						</div>
						<button type="submit" class="btn btn-primary">Delete</button>
						<?php
								if (isset($_GET["msg"]) && $_GET["msg"] == 'noexist') {
								echo 'Copil inexistent';
								}
						?>
						<?php
								if (isset($_GET["msg"]) && $_GET["msg"] == 'nocopil') {
								echo 'Nu monitorizati acest copil';
								}
						?>
						<?php
								if (isset($_GET["msg"]) && $_GET["msg"] == 'done') {
								echo 'Stergere efectuata cu succes';
								}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>     

