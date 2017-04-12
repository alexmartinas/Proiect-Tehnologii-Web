<?php include 'header.php' ?>
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="form-wrap">
					<h2>Add new child</h2>
					<form action="nearbychildrenP.php" method="post">
						<div class="form-group">
							<label>Id Device</label>
							<input type="number" name="Iddevice">
						</div>

						<div class="form-group">
							<label>Raza</label>
							<input type="number" min="1" max="1000" name="Raza">
						</div>
						<div class="form-group">
							<label>Varsta</label>
							<input type="number" min="1" max="18" name="Raza">
						</div>
						<button type="submit" class="btn btn-primary">Add</button>
						<?php
								if (isset($_GET["msg"]) && $_GET["msg"] == 'haveit') {
								echo "Deja monitorizati acest copil!";
								}
						?>
						<?php
								if (isset($_GET["msg"]) && $_GET["msg"] == 'done') {
								echo "Copil nou adaugat!";
								}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>     

