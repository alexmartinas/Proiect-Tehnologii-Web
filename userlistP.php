<?php
	
	//Oracle DB user name
	$contOracle = 'vlad';

	// Oracle DB user password
	$parolaOracle = 'VLAD';

	// Oracle DB connection string
	$connection_string = 'localhost/xe';

	//Connect to an Oracle database
	$connection = oci_connect(
	$contOracle,
	$parolaOracle,
	$connection_string
	);


	$page = $_GET["page"];

	if($page=="0" || $page=="1")
	{
		$pagev=0;
	}
	else
	{
		$pagev=($page*20)-20;
	}



	$pagevfin=$pagev+20;

	$nrrows = 0;
	$stidl = oci_parse($connection, 'select username,name,email from (select username,name,email,ROWNUM r from users) where r between :v_page1 and :v_page2');
	oci_bind_by_name($stidl, ":v_page1", $pagev);
	oci_bind_by_name($stidl, ":v_page2", $pagevfin);
	oci_execute($stidl);

	echo "Username &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160  &#160 &#160&#160 Name &#160 &#160 &#160 &#160 &#160  &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160 &#160  Email <br>";


	while ($row = oci_fetch_array ($stidl,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	  echo $data;
    	  echo "&#160 &#160 &#160 &#160 &#160 &#160 ";
    	}
    echo "<br>";


	}

	$stid = oci_parse($connection, 'select * from users');
	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
			$trololol = 123;
    	 }
    $nrrows = $nrrows + 1;

	}

	$x = $nrrows / 100;
	$x = ceil($x);

	$i=0;

	echo "<br>"; echo "<br>";
	for($i=1; $i<=$x; $i++)
	{

		?> <a href="user-list.php?page=<?php echo $i ?>" style="text-decoration: none"> <?php echo $i." "; ?> </a> <?php 
	}
	oci_free_statement($stid);
	oci_close($connection);



?>