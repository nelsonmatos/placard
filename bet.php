<?php
	session_start();
	
	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");

	
	$data = json_decode(file_get_contents('php://input'), true);
	
	if(isset($_SESSION['logged_user'])){
		$user_id = $data["user_id"];
		$home_team = $data["home_team"];
		$away_team = $data["away_team"];
		$league = $data["league"];
		$pick = $data["pick"];
		$odd = $data["odd"];
		$amount = $data["amount"];
		$bet_date = $data["bet_date"];
		$game_date = $data["game_date"];
		
		$codedUserId = (int)pg_escape_string($user_id);
		$codedHomeTeam = pg_escape_string($home_team);
		$codedAwayTeam = pg_escape_string($away_team);
		$codedLeague = pg_escape_string($league);
		$codedPick = (int)pg_escape_string($pick);
		$codedOdd = pg_escape_string($odd);
		$codedAmount = pg_escape_string($amount);
		$codedBetDate = pg_escape_string($bet_date);
		$codedGameDate = pg_escape_string($game_date);
	
		$result = pg_query($dbconn3, "SELECT add_bet('$codedUserId', '$codedHomeTeam', '$codedAwayTeam', '$codedPick', '$codedBetDate', '$codedGameDate', '$codedOdd', '$codedAmount', '$codedLeague')");		
		
		echo 1;
	}else{
		echo -1;
	}

	pg_close($dbconn3);									
   
?>
