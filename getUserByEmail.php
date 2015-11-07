<?php
	session_start();
	
	if(isset($_SESSION['logged_user'])){
		$dbconn3 = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
		$data = json_decode(file_get_contents('php://input'), true);
	
		$email = $data["email"];
		$codedEmail = pg_escape_string($email);	
		
		$result = pg_query($dbconn3, "SELECT * from users where users.email = '$codedEmail'");
	
		$user = [];
		while ($row = pg_fetch_row($result)) {	
			array_push($user, $row);
		}
		
		echo json_encode($user);
		pg_close($dbconn3);		
			
	}else{
		echo -1;
	}
?>
