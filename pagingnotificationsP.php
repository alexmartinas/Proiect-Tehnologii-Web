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
	$stid = oci_parse($connection, 'select id_user from users where username like :v_user_session');
	oci_bind_by_name($stid, ":v_user_session", $user_session);
	oci_execute($stid);
	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   $trololo = 123; 
    	 }
	}

	$id_interest = $data;


	$page = $_GET["page"];

	if($page=="0" || $page=="1")
	{
		$pagev=0;
	}
	else
	{
		$pagev=($page*20)-20;
	}



	$pagevfin=$pagev+20;

	$nrrows = 0;
	$stidl = oci_parse($connection, 'select id_child,date_n,id_interest,distance from (select id_child,date_n,id_interest,distance,ROWNUM r from notifications) where r between :v_page1 and :v_page2 and id_interest=:v_id_interest');
	oci_bind_by_name($stidl, ":v_page1", $pagev);
	oci_bind_by_name($stidl, ":v_page2", $pagevfin);
	oci_bind_by_name($stidl, ":v_id_interest", $id_interest);
	oci_execute($stidl);


	echo "<tr>";
	while ($row = oci_fetch_array ($stidl,OCI_NUM)) {
    foreach($row as $data) 
    	{
    	   echo "<td> $data </td>";
    	   echo "&#160 &#160 &#160 &#160 &#160 &#160 ";
    	 }
    echo "<br>";
    echo "</tr>";

	}

	$stid = oci_parse($connection, 'select * from notifications where id_interest=:v_id_interest');
	oci_bind_by_name($stid, ":v_id_interest", $id_interest);
	oci_execute($stid);

	while ($row = oci_fetch_array ($stid,OCI_NUM)) {
    foreach($row as $data) 
    	{
			$trololol = 123;
    	 }
    $nrrows = $nrrows + 1;

	}

	$x = $nrrows / 20;
	$x = ceil($x);

	$i=0;

	echo "<br>"; echo "<br>";


	oci_free_statement($stid);
	oci_close($connection);



?>