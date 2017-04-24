
<?php include 'header.php' ?>

<div class="row affix-row">
    <div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">
  <div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <span class="visible-xs navbar-brand"></span>
    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav navbar-nav" id="sidenav01">
        <li >
          <a href="index.php" >
          	<h4>
          		Children
          		<br>
          	</h4>
          </a>
        </li>
        <?php include 'kidsP.php' ?>
      </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
	</div>
	<div class="col-sm-9 col-md-10 affix-content">
		<div class="container">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-map-marker"></span> Location</h3>
			</div>
		</div>
		<iframe class="embed-responsive-item" id="map_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86818.84040605382!2d27.51693108661042!3d47.15611595628339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb7cf639ddbb%3A0x7ccb80da5426f53c!2zSWHImWk!5e0!3m2!1sro!2sro!4v1491854598709" style="border:0;position:relative;" allowfullscreen></iframe>
	</div>
	</div>
	
<?php include 'footer.php' ?>
