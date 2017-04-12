<?php include 'header.php' ?>
<?php
	
	$idcopil = $_REQUEST['Iddevice'];
	$raza = $_REQUEST['Raza'];

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


	$stidl = @oci_parse($connection, "select nr_copii(:v_id_copil,:v_raza) from dual ");
	oci_bind_by_name($stidl, ":v_id_copil", $idcopil);
	oci_bind_by_name($stidl, ":v_raza", $raza);

	oci_execute($stidl);

	$nr_rows = "0";
	while ($row = oci_fetch_array ($stidl,OCI_NUM)) {   
    foreach($row as $data) 
    	{
    	   $trolololo = "123";
    	 }
    echo "<br>";
    $nr_rows = "1";  //verificare daca oci_fetch_arrays e empty sau nu
	}

	if($nr_rows=="0") echo "Nu exista acest id!"; 
	else echo "Numar copii in vecinatate cu aceeasi varsta:".$data;

	oci_free_statement($stidl);
	oci_close($connection);





?>