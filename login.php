<?php
	session_start();

	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");

	$data = json_decode(file_get_contents('php://input'), true);
	
	
	$email = $data["email"];
	$password = $data["password"];

							
	$md5Password = md5($password);				
	$codedEmail = pg_escape_string($email);	
	$codedPassword = pg_escape_string($md5Password);			

	$exists = pg_query($dbconn3, "SELECT login('$codedEmail', '$codedPassword')");

	$count = pg_fetch_result($exists, 0, 'login');				
	
	if($count == 1){
		// Store Session Data
		$_SESSION['logged_user'] = $email;
		echo 1;
	}else{
		echo -1;
	}
	
	pg_close($dbconn3);									
   
?>
