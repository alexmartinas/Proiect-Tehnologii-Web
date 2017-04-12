<?php include 'header.php' ?>
<?php
	
	$numecopil = $_REQUEST['numar'];

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


	$stidl = oci_parse($connection, "select * from children where name like $numecopil ");	
	$response = @oci_execute($stidl);
	if ( $response == false ) echo "Puneti numele intre ghilimele!";
	else 
	{

	$nr_rows = "0";
	while ($row = oci_fetch_array ($stidl,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   echo $data."   ";
    	 }
    echo "<br>";
    $nr_rows = "1";
	}
	if( $nr_rows == "0" ) echo "Nu exista acest copil!";

	}
	oci_free_statement($stidl);
	oci_close($connection);




?>