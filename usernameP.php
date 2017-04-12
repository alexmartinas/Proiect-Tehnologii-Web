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

	session_start();
 	$user_session=$_SESSION['username'];

	$stid = oci_parse($connection, 'select username from users where username like :v_user_session');
	if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
	oci_bind_by_name($stid, ":v_user_session", $user_session);
	oci_execute($stid);
	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trololo = 123; 
    	 }
	}

	$username = $data;


	oci_free_statement($stid);
	oci_close($connection);

?>