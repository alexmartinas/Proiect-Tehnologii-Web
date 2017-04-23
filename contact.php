<?php include 'header.php' ?>
<div class="page-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="register-wrap">
					<h2>Contact</h2>	
						<form action="mailto:alex_martynas@yahoo.com" method="post" enctype="text/plain">
							Name:<br>
							<input type="text" name="name"><br>
							E-mail:<br>
							<input type="text" name="mail"><br>
							Message:<br>
							<textarea rows="5" cols="50" name="message">Enter message here ...</textarea><br>
							<input type="submit" value="Send">
							<input type="reset" value="Reset">
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>