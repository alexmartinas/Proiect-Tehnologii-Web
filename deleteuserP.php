<?php
	
	$password = $_REQUEST["parola"];

	session_start();
	$user_session=$_SESSION['username'];

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

	$mesaj = 'VAKSNFASKLFNASFASFLASFASLKFASNLKFASNLFKASF';
	$stid = oci_parse($connection, 'call pachetul_meu.delete_user(:v_username,:v_parola,:v_mesaj)');
	oci_bind_by_name($stid, ":v_username", $user_session);
	oci_bind_by_name($stid, ":v_parola", $password);
	oci_bind_by_name($stid, ":v_mesaj", $mesaj);
	if (!$stid) {
	    $e = oci_error($conn);
	    trigger_error(htmlentities($e['message']), E_USER_ERROR);
	}


	oci_execute($stid);

	if( $mesaj == 'Incorrect password') echo $mesaj;
	if( $mesaj == 'Your account has been deleted') header("Location: register.php");


	oci_free_statement($stid);

	// Close connection 
	oci_close($connection);

	}


	?>