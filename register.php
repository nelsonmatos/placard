<?php

	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");


	//$result = pg_query($dbconn3, "SELECT * from serie_a");
	
	
	$data = json_decode(file_get_contents('php://input'), true);
	$re = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
	
	$email = $data["email"];
	$username = $data["username"];
	$password = $data["password"];
	$confpassword = $data["confpassword"];
	$photo = $data["photo"];

	if (preg_match($re, $email) === 1) {
			if($password == $confpassword){						
				$md5Password = md5($password);				
				$codedEmail = pg_escape_string($email);
				$codedUsername = pg_escape_string($username);
				$codedPassword = pg_escape_string($md5Password);

				$exists_email = pg_query($dbconn3, "SELECT user_email_exists('$codedEmail')");
				$exists_username = pg_query($dbconn3, "SELECT user_username_exists('$codedUsername')");
			
				//$count = mysql_result($exists, 0, 0);
				$count_email = pg_fetch_result($exists_email, 0, 'user_email_exists');
				$count_username = pg_fetch_result($exists_username, 0, 'user_username_exists');				
				
				if($count_email != 0){
					echo -1;
				}else if($count_username != 0){
					echo -2;
				}else if($count_email == 0 && $count_username == 0){
					$result = pg_query($dbconn3, "SELECT add_user('$codedEmail', '$codedUsername', '$codedPassword', '$photo')");
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo -3;
			}
	}
	pg_close($dbconn3);									
   
?>
