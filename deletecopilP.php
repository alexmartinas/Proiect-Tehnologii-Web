<?php
	

	$idDevice=$_REQUEST["Iddevice"];

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

	session_start();
 	$user_session=$_SESSION['username'];

	$stid = oci_parse($connection, 'select id_user from users where username like :v_user_session');
	oci_bind_by_name($stid, ":v_user_session", $user_session);
	oci_execute($stid);
	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trololo = 123; 
    	 }
	}

	$id_tutore = $data;

	echo $id_tutore;

	oci_free_statement($stid);


	If (!$connection)
	echo 'connection failed';
	else
	{

	$mesaj = 'VAKSNFASKLFNASFASFLASFASLKFASNLKFASNLFKASF';
	$stid = oci_parse($connection, 'call delete_child(:v_id_tutore,:v_iddevice,:v_mesaj)');
	oci_bind_by_name($stid, ":v_id_tutore", $id_tutore);
	oci_bind_by_name($stid, ":v_iddevice", $idDevice);
	oci_bind_by_name($stid, ":v_mesaj", $mesaj);
	oci_execute($stid);

	echo $mesaj;


	if ($mesaj == 'Copil inexistent') header("Location: delete-child.php?msg=noexist");
	if ($mesaj == 'Nu monitorizati acest copil') header("Location: delete-child.php?msg=nocopil");
	if ($mesaj == 'Stergere efectuata cu succes') header("Location: delete-child.php?msg=done");


	//while ($row = oci_fetch_array ($stid,OCI_NUM)) {
	 //   foreach($row as $data)
	//		echo $data." ";
	 //   echo " <br>";
	//}
	oci_free_statement($stid);

	// Close connection 
	oci_close($connection);

	}


?>