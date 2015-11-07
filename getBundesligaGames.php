<?php

	$dbconn3 = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
	$result = pg_query($dbconn3, "SELECT * from bundesliga");
	
	$games = [];
	while ($row = pg_fetch_row($result)) {	
		array_push($games, $row);
	}
	

	echo json_encode($games);
	pg_close($dbconn3);									
   
?>
