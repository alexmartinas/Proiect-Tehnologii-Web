<?php
	
	session_start();
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];

	$contOracle = 'vlad';
	$parolaOracle = 'VLAD';

	$connection_string = 'localhost/xe';

	$connection = oci_connect(
	$contOracle,
	$parolaOracle,
	$connection_string
	);


	If (!$connection)
	echo 'connection failed';
	else
	{

	$stid = oci_parse($connection, 'select LOG_IN(:v_username,:v_password) from dual');

	oci_bind_by_name($stid, ":v_username", $username);
	oci_bind_by_name($stid, ":v_password", $password);
	oci_execute($stid);

	
	 while ($row = oci_fetch_array ($stid,OCI_NUM)) {
	    foreach($row as $data)
			echo $data." ";
	    echo " <br>";
	}

	if($data == 'Logare cu succes') {
		$_SESSION['username'] = $username;
		header("Location: index.php");
	}
	else 
	{
		header("Location: register.php?msg=failed");
	}

	oci_free_statement($stid);

	// Close connection 
	oci_close($connection);

	}



	?>