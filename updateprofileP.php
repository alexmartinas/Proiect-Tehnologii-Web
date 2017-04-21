<?php include 'header.html' ?>
<?php
	
	session_start();
	$nume=$_REQUEST["Name"];
	$prenume=$_REQUEST["Surname"];
	$usernameold=$_SESSION['username'];
	$passwordold=$_REQUEST["Password"];
	$passwordnew=$_REQUEST["new-Password"];
	$passwordconf=$_REQUEST["conf-Password"];
	$email=$_REQUEST["Email"];

	if( $nume!="" && $passwordconf!="" && $passwordnew!="" && $email!="" && $usernameold!="" ) 
	{

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
$stid = oci_parse($connection, 'call pachetul_meu.update_user(:v_nume,:v_prenume,:v_uservechi,:v_usernou,:v_parolaveche,:v_parolanoua,:v_email,:v_mesaj)');
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
oci_bind_by_name($stid, ":v_nume", $nume);
oci_bind_by_name($stid, ":v_prenume", $prenume);
oci_bind_by_name($stid, ":v_uservechi", $usernameold);
oci_bind_by_name($stid, ":v_usernou", $usernameold);
oci_bind_by_name($stid, ":v_parolaveche", $passwordold);
oci_bind_by_name($stid, ":v_parolanoua", $passwordnew);
oci_bind_by_name($stid, ":v_email", $email);
oci_bind_by_name($stid, ":v_mesaj", $mesaj);
oci_execute($stid);


if( $mesaj == 'This user already exists.Please choose something else!' ) header("Location: my-profile.html?msg=already");
if( $mesaj == 'Used email.Please choose something else!' ) header("Location: my-profile.html?msg=email");
if( $mesaj == 'Account updated' ) header("Location: my-profile.html?msg=fin");


//while ($row = oci_fetch_array ($stid,OCI_NUM)) {
 //   foreach($row as $data)
//		echo $data." ";
 //   echo " <br>";
//}
oci_free_statement($stid);

// Close connection 
oci_close($connection);

}

}

else
{
	echo "Nu lasati campuri goale!";
}



?>