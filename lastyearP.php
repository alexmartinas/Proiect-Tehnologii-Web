<?php include 'header.php' ?>
<?php
	
	$age = $_REQUEST['age'];
	$notifications = $_REQUEST['notifications'];


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


	$stidl = oci_parse($connection, "select functie(:v_age,:v_notifications) from dual");
	oci_bind_by_name($stidl, ":v_age", $age);
	oci_bind_by_name($stidl, ":v_notifications", $notifications);
	if (!$stidl) {
    $e = oci_error($connection);
    echo "Nu ati introdus un format corect!";
	}	
	else
	{
	$response = oci_execute($stidl);
	if ( $response == false ) echo "Nu ati introdus un format corect!";
	else 
	{

	$nr_rows = "0";
	while ($row = oci_fetch_array ($stidl,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   echo "Copilul cu distanta maxima din notificari:".$data."   ";
    	 }
    echo "<br>";
    $nr_rows = "1";
	}
	if( $nr_rows == "0" ) echo "Nu exista copil!";

	}
	oci_free_statement($stidl);

	}
	oci_close($connection);





?>