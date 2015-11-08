<?php

	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");
	$result = pg_query($dbconn3, "SELECT * from la_liga");
	
	$games = [];
	while ($row = pg_fetch_row($result)) {	
		array_push($games, $row);
	}
	

	echo json_encode($games);
	pg_close($dbconn3);									
   
?>
