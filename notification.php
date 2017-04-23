<?php include 'header.php' ?>

<html>
	
	<head>
		<style>

		body 
		{
 			 overflow-y: scroll;
		}

		table
		{
			width: 30%;
			padding-bottom: 100px;
		}

		table ,th ,td
		{
			border: 1px solid black;
			border-collapse: collapse;
		}

		th, td
		{
			padding: 10px;
			text-align: center;

		}

		th
		{
			background-color: #a70000;
			color: white;
		}

		tr:nth-child(even)
		{
			background-color: #e8e8e8;
		}

		tr:nth-child(odd)
		{
			background-color: white;
		}

		</style>

	</head>


	<body>
		

		<table style="font-family: sans-serif; font-size: 11pt; position:absolute; top:100px; left:600px; margin-bottom:50px;">
			<tr>

			</tr>
			<tr>
				<th>Id</th>
				<th>Data</th>
				<th>Tutore</th>
				<th>Distanta</th>
			</tr>
			<?php include 'pagingnotificationsP.php' ?>

		</table>


	<div style="font-family: sans-serif; font-size: 11pt; position:absolute; left:0px; bottom:800px;">
	<?php

	for($i=1; $i<=$x; $i++)
	{

		?> <a href="notification.php?page=<?php echo $i ?>" style="text-decoration: none"> <?php echo $i." "; ?> </a> <?php 
	}

	?>
	</div>

	</body>