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


	oci_free_statement($stid);

	$stid = oci_parse($connection, 'select c.name from monitoring m join children c on c.id_child=m.id_child where m.id_user=:v_id_tutore');
	oci_bind_by_name($stid, ":v_id_tutore", $id_tutore);
	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   echo $data." ";
    	   echo " <br>";
    	}
	}

?>