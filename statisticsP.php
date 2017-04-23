<?php include 'header.php' ?>
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


	If (!$connection)
	echo 'connection failed';
	else
	{

	$stid = oci_parse($connection, "select count(n.id_child) from notifications n join children c on n.id_child=c.id_child where gender='male'");

	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trolololo="123";
    	}
	}

	$nrbaieti = $data;
	oci_free_statement($stid);



	$stid = oci_parse($connection, "select count(n.id_child) from notifications n join children c on n.id_child=c.id_child where gender='female'");

	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trolololo="123";
    	}
	}

	$nrfete = $data;
	oci_free_statement($stid);


	$stid = oci_parse($connection, "select proportie() from dual");

	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trolololo="123";
    	}
	}

	$proportie = $data;
	oci_free_statement($stid);

	// Close connection 
	oci_close($connection);

	echo "Statistica actuala notificari(update continuu)<br><br>";
	echo "Nr baieti:".$nrbaieti."<br>";
	echo "Nr fete:".$nrfete."<br>";
	echo "Proportie baieti:fete : ".$proportie."<br>";
	}


	?>