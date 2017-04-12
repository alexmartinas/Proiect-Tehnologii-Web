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

 	$user_session=$_SESSION['username'];

	$stid = oci_parse($connection, 'select email from users where username like :v_user_session');
	oci_bind_by_name($stid, ":v_user_session", $user_session);
	oci_execute($stid);
	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trololo = 123; 
    	 }
	}

	$email = $data;


	oci_free_statement($stid);
	oci_close($connection);

?>