<?php include 'header.php' ?>

<div class="page-wrap page-wrap-home">
	<aside class="col-md-4">
		<h2>
		<a>Welcome</a>
				<a>
				<?php
  					session_start();
 						 echo $_SESSION['username'];
				?> 
				</a>
		</h2>
		<h3>Subtitlu</h3>
		<br>
		<ul>
			<li><a href="#">Copil 1</a></li>
			<li><a href="#">Copil 2</a></li>
			<li><a href="#">Copil 3</a></li>
			<li><a href="#">Copil 4</a></li>
		</ul>
		<br>
		<br>
		<p><a href="add-child.php">Add new child</a></p>
	</aside>
	<main class="col-md-8">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86818.84040605382!2d27.51693108661042!3d47.15611595628339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb7cf639ddbb%3A0x7ccb80da5426f53c!2zSWHImWk!5e0!3m2!1sro!2sro!4v1491854598709" frameborder="0" style="border:0" allowfullscreen></iframe>
	</main>
</div>
<?php include 'footer.php' ?>
