<?php

    //$xml = simplexml_load_file('test3.xml');
	ini_set('max_execution_time', 500); //300 seconds = 5 minutes
	$xml = simplexml_load_string(file_get_contents("http://xml.cdn.betclic.com/odds_en.xml"));

	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");
	$result = pg_query($dbconn3, "SELECT delete_all()");
	pg_close($dbconn3);
								
	$football = getFootball($xml);
	
	//1
	$premierLeague = getPremierLeague($football);
	
	//print_r( $premierLeague );
	
	//2
	$laLiga = getLaLiga($football);
	
	//3
	$primeiraLiga = getPrimeiraLiga($football);
	
	//4
	$serieA = getSerieA($football);
	
	//5
	$bundesliga = getBundesliga($football);
	
	//6
	$ligueOne = getLigueOne($football);
	
	//7
	$championsLeague = getChampionsLeague($football);	
	
	getMatchs($premierLeague, 1);
	getMatchs($laLiga, 2);	
	getMatchs($primeiraLiga, 3);	
	getMatchs($serieA, 4);	
	getMatchs($bundesliga, 5);	
	getMatchs($ligueOne, 6);	
	getMatchs($championsLeague, 7);	
	
 	function getFootball($xml){
		foreach($xml->sport as $sport_) {
			if ($sport_->attributes()->name == 'Football') {
				return $sport_;
			}
	   }
   }
   
    function getPremierLeague($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'Eng. Premier League') {
				return $event_;
			}
	   }
   }
   
    function getLaLiga($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'Spanish Liga Primera') {
				return $event_;
			}
	   }
   }
    
    function getPrimeiraLiga($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'Portuguese Prim. Liga') {
				return $event_;
			}
	   }
   }
   
    function getSerieA($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'Italian Serie A') {
				return $event_;
			}
	   }
   }
   
    function getBundesliga($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'German Bundesliga') {
				return $event_;
			}
	   }
   }
   
   function getLigueOne($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'French Ligue 1') {
				return $event_;
			}
	   }
   }
   
    function getChampionsLeague($football){
		foreach($football->event as $event_) {
			if ($event_->attributes()->name == 'Champions League') {
				return $event_;
			}
	   }
   }
   
   
    function getMatchs($league, $flag){
		$games = [];
		$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");

		foreach($league->match as $match_) {
			$game = (string)$match_->attributes()->name;
			$game_date = (string)$match_->attributes()->start_date;
			
			foreach($match_->bets->bet as $bet_) {
				if($bet_->attributes()->code == 'Ftb_Mr3'){	
					
					
					$teams = explode(" - ", $game);
					$homeTeam = $teams[0];
					$awayTeam = $teams[1];
					$homeOdd = (string)$bet_->choice[0]->attributes()->odd;
					$drawOdd = (string)$bet_->choice[1]->attributes()->odd;
					$awayOdd = (string)$bet_->choice[2]->attributes()->odd;			
	
					switch ($flag) {		
						case 1:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_premier_league_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_premier_league_game');	
							var_dump($count);	
							break;
							
						case 2:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_la_liga_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_la_liga_game');					
							var_dump($count);
							break;
							
						case 3:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_primeira_liga_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_primeira_liga_game');					
							var_dump($count);
							break;
							
						case 4:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_serie_a_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_serie_a_game');					
							var_dump($count);
							break;
							
						case 5:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_bundesliga_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_bundesliga_game');					
							var_dump($count);
							break;
							
						case 6:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_ligue_one_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_ligue_one_game');					
							var_dump($count);
							break;
							
						case 7:
							$_homeTeam = pg_escape_string($homeTeam);
							$_awayTeam = pg_escape_string($awayTeam);
							$result = pg_query($dbconn3, "SELECT add_champions_league_game('$_homeTeam', '$_awayTeam', '$homeOdd', '$drawOdd', '$awayOdd', '$game_date')");
							$count = pg_fetch_result($result, 0, 'add_champions_league_game');					
							var_dump($count);
							break;
					}		
	
				}
			}
	   }
	   
	   	//dump the result object
		

		// Closing connection
		pg_close($dbconn3);
		   
   }
   
?>
