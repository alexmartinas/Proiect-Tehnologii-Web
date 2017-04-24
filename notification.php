<?php include 'header.php' ?>

<html>
	
	<head>
		<style>


		body 
		{
 			 overflow-y: scroll;
		}


		table ,th ,td
		{
			border: 1px solid black;
			border-collapse: collapse;
		}

		th, td
		{
			padding: 5px;
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
		
<div class="page-wrap page-wrap-child">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-12" >
				<div class="form-wrap">
		<table style="font-family: sans-serif; font-size: 11pt; position:center; top:-400px; left:100px; margin-bottom:50px;">
			<tr>
				<th>Id</th>
				<th>Data</th>
				<th>Tutore</th>
				<th>Distanta</th>
			</tr>
			<tr>
				<td>10</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>92</td>
			</tr>
			<tr>
				<td>9</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>31</td>
			</tr>
			<tr>
				<td>8</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>45</td>
			</tr>
			<tr>
				<td>1</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>23</td>
			</tr>
			<tr>
				<td>2</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>22</td>
			</tr>
			<tr>
				<td>10</td>
				<td>12-JAN-17</td>
				<td>0</td>
				<td>91</td>
			</tr>

		</table>
	<!--
	<div class="pagination"; style="font-family: sans-serif; font-size: 11pt; position:absolute; left:0px; bottom:800px;">
	<?php

	for($i=1; $i<=$x; $i++)
	{

		/*?> <a href="notification.php?page=<?php echo $i ?>"> </a> <?php  */
	}

	?>
	</div>
	-->

	<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
</div>
</div>
</div>
</div>
</div>
	</body>