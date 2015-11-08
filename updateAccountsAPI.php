<?php

    //$xml = simplexml_load_file('test3.xml');
	ini_set('max_execution_time', 500); 
	
	date_default_timezone_set("UTC");
	$atualDate =  date("Y-m-d H:i:s", time()); 
	
	$dbconn3 = pg_connect("host='$OPENSHIFT_POSTGRESQL_DB_HOST' port='$OPENSHIFT_POSTGRESQL_DB_PORT' dbname=v1 user=adminy5ttxew password=IZdGfGX6kCHl");
	
	//Premier League
	$uri = 'http://api.football-data.org/alpha/soccerseasons/398/fixtures/?matchday=12';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_pl = file_get_contents($uri, false, $stream_context);
	//$response_pl = file_get_contents('http://api.football-data.org/alpha/soccerseasons/398/fixtures/?matchday=12');
	//Champions League
	$uri = 'http://api.football-data.org/alpha/soccerseasons/405/fixtures/?matchday=5';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_cl = file_get_contents($uri, false, $stream_context);
	//$response_cl = file_get_contents('http://api.football-data.org/alpha/soccerseasons/405/fixtures/?matchday=5');
	//Ligue One
	$uri = 'http://api.football-data.org/alpha/soccerseasons/396/fixtures/?matchday=13';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_lo = file_get_contents($uri, false, $stream_context);
	//$response_lo = file_get_contents('http://api.football-data.org/alpha/soccerseasons/396/fixtures/?matchday=13');
	//BundesLiga
	$uri = 'http://api.football-data.org/alpha/soccerseasons/394/fixtures/?matchday=12';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_bl = file_get_contents($uri, false, $stream_context);
	
	//$response_bl = file_get_contents('http://api.football-data.org/alpha/soccerseasons/394/fixtures/?matchday=12');
	//Primeira Liga
	$uri = 'http://api.football-data.org/alpha/soccerseasons/402/fixtures/?matchday=10';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_prl = file_get_contents($uri, false, $stream_context);
	//$response_prl = file_get_contents('http://api.football-data.org/alpha/soccerseasons/402/fixtures/?matchday=10');
	//Serie A
	$uri = 'http://api.football-data.org/alpha/soccerseasons/401/fixtures/?matchday=12';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_sa = file_get_contents($uri, false, $stream_context);
	//$response_sa = file_get_contents('http://api.football-data.org/alpha/soccerseasons/401/fixtures/?matchday=12');

	//La Liga
	$uri = 'http://api.football-data.org/alpha/soccerseasons/399/fixtures/?matchday=11';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 7c11eeda7f02415ab186d3ca340b3966';
    $stream_context = stream_context_create($reqPrefs);
    $response_ll = file_get_contents($uri, false, $stream_context);
	//$response_ll = file_get_contents('http://api.football-data.org/alpha/soccerseasons/399/fixtures/?matchday=11');
	
	
	$win = 'WIN';
	$lost = 'LOST';
	
	$response_pl = json_decode($response_pl, true);
	

	$result_pl = pg_query($dbconn3, "SELECT * from get_premier_league_bets()");
	
	$premierLeagueBets = [];
	while ($row = pg_fetch_row($result_pl)) {	
		array_push($premierLeagueBets, $row);
	}	
	
	//LaLiga
	$response_ll = json_decode($response_ll, true);
	

	$result_ll = pg_query($dbconn3, "SELECT * from get_la_liga_bets()");
	
	$laLigaBets = [];
	while ($row = pg_fetch_row($result_ll)) {	
		array_push($laLigaBets, $row);
	}
	
	//SeriaA
	$response_sa = json_decode($response_sa, true);
	

	$result_sa = pg_query($dbconn3, "SELECT * from get_serie_a_bets()");
	
	$serieABets = [];
	while ($row = pg_fetch_row($result_sa)) {	
		array_push($serieABets, $row);
	}
	

	//Primeira Liga	
	$response_prl = json_decode($response_prl, true);
	
	$result_prl = pg_query($dbconn3, "SELECT * from get_primeira_liga_bets()");
	
	$primeiraLigaBets = [];
	while ($row = pg_fetch_row($result_prl)) {	
		array_push($primeiraLigaBets, $row);
	}

	//Bundesliga
	$response_bl = json_decode($response_bl, true);
	
	$result_bl = pg_query($dbconn3, "SELECT * from get_bundesliga_bets()");
	
	$bundesLigaBets = [];
	while ($row = pg_fetch_row($result_bl)) {	
		array_push($bundesLigaBets, $row);
	}
	
	//Ligue One
	$response_lo = json_decode($response_lo, true);
	

	$result_lo = pg_query($dbconn3, "SELECT * from get_ligue_one_bets()");
	
	$ligueOneBets = [];
	while ($row = pg_fetch_row($result_lo)) {	
		array_push($ligueOneBets, $row);
	}
	
	
	//Champions League
	$response_cl = json_decode($response_cl, true);

	$result_cl = pg_query($dbconn3, "SELECT * from get_champions_league_bets()");
	
	$championsLeagueBets = [];
	while ($row = pg_fetch_row($result_cl)) {	
		array_push($championsLeagueBets, $row);
	}
	

	//Premier League
	for ($k = 0; $k < count($premierLeagueBets); $k++) {
		for ($x = 0; $x < count($response_pl['fixtures']); $x++) {	
			$homeTeam = $response_pl['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_pl['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_pl['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_pl['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $premierLeagueBets[$k][2];
			$betAwayTeam = $premierLeagueBets[$k][3];
			$bet = $premierLeagueBets[$k][4];
			$amount = $premierLeagueBets[$k][8];
			$user_id = $premierLeagueBets[$k][1];
			$odd = $premierLeagueBets[$k][7];
			$id = $premierLeagueBets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translatePremierLeagueTeams($homeTeam), $betHomeTeam) !== false && strpos(translatePremierLeagueTeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}

	
	//La Liga
	for ($k = 0; $k < count($laLigaBets); $k++) {
		for ($x = 0; $x < count($response_ll['fixtures']); $x++) {	
			$homeTeam = $response_ll['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_ll['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_ll['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_ll['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $laLigaBets[$k][2];
			$betAwayTeam = $laLigaBets[$k][3];
			$bet = $laLigaBets[$k][4];
			$amount = $laLigaBets[$k][8];
			$user_id = $laLigaBets[$k][1];
			$odd = $laLigaBets[$k][7];
			$id = $laLigaBets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translateLaLigaTeams($homeTeam), $betHomeTeam) !== false && strpos(translateLaLigaTeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}
	
	
	//Serie A
	for ($k = 0; $k < count($serieABets); $k++) {
		for ($x = 0; $x < count($response_sa['fixtures']); $x++) {	
			$homeTeam = $response_sa['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_sa['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_sa['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_sa['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $serieABets[$k][2];
			$betAwayTeam = $serieABets[$k][3];
			$bet = $serieABets[$k][4];
			$amount = $serieABets[$k][8];
			$user_id = $serieABets[$k][1];
			$odd = $serieABets[$k][7];
			$id = $serieABets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translateSerieATeams($homeTeam), $betHomeTeam) !== false && strpos(translateSerieATeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}
	
	//Primeira Liga
	for ($k = 0; $k < count($primeiraLigaBets); $k++) {
		for ($x = 0; $x < count($response_prl['fixtures']); $x++) {	
			$homeTeam = $response_prl['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_prl['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_prl['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_prl['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $primeiraLigaBets[$k][2];
			$betAwayTeam = $primeiraLigaBets[$k][3];
			$bet = $primeiraLigaBets[$k][4];
			$amount = $primeiraLigaBets[$k][8];
			$user_id = $primeiraLigaBets[$k][1];
			$odd = $primeiraLigaBets[$k][7];
			$id = $primeiraLigaBets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translatePrimeiraLigaTeams($homeTeam), $betHomeTeam) !== false && strpos(translatePrimeiraLigaTeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}



	//BundesLiga
	for ($k = 0; $k < count($bundesLigaBets); $k++) {
		for ($x = 0; $x < count($response_bl['fixtures']); $x++) {	
			$homeTeam = $response_bl['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_bl['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_bl['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_bl['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $bundesLigaBets[$k][2];
			$betAwayTeam = $bundesLigaBets[$k][3];
			$bet = $bundesLigaBets[$k][4];
			$amount = $bundesLigaBets[$k][8];
			$user_id = $bundesLigaBets[$k][1];
			$odd = $bundesLigaBets[$k][7];
			$id = $bundesLigaBets[$k][0];
	
			
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){				
				if(strpos(translateBundesligaTeams($homeTeam), $betHomeTeam) !== false && strpos(translateBundesligaTeams($awayTeam), $betAwayTeam) !== false){
						
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}

	

	
	
	//Ligue One
	for ($k = 0; $k < count($ligueOneBets); $k++) {
		for ($x = 0; $x < count($response_lo['fixtures']); $x++) {	
			$homeTeam = $response_lo['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_lo['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_lo['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_lo['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $ligueOneBets[$k][2];
			$betAwayTeam = $ligueOneBets[$k][3];
			$bet = $ligueOneBets[$k][4];
			$amount = $ligueOneBets[$k][8];
			$user_id = $ligueOneBets[$k][1];
			$odd = $ligueOneBets[$k][7];
			$id = $ligueOneBets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translateLigueOneTeams($homeTeam), $betHomeTeam) !== false && strpos(translateLigueOneTeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}

	//Champions League
	for ($k = 0; $k < count($championsLeagueBets); $k++) {
		for ($x = 0; $x < count($response_cl['fixtures']); $x++) {	
			$homeTeam = $response_cl['fixtures'][$x]['homeTeamName'];
			$awayTeam = $response_cl['fixtures'][$x]['awayTeamName'];
			$homeTeamGoals = (int)$response_cl['fixtures'][$x]['result']['goalsHomeTeam'];
			$awayTeamGoals = (int)$response_cl['fixtures'][$x]['result']['goalsAwayTeam'];
			
			$betHomeTeam = $championsLeagueBets[$k][2];
			$betAwayTeam = $championsLeagueBets[$k][3];
			$bet = $championsLeagueBets[$k][4];
			$amount = $championsLeagueBets[$k][8];
			$user_id = $championsLeagueBets[$k][1];
			$odd = $championsLeagueBets[$k][7];
			$id = $championsLeagueBets[$k][0];
			
			(float)$profit = (float)$odd * (int) $amount;
			//resolved
			if($homeTeamGoals != '-1' && $awayTeamGoals != '-1'){
				if(strpos(translateChampionsLeagueTeams($homeTeam), $betHomeTeam) !== false && strpos(translateChampionsLeagueTeams($awayTeam), $betAwayTeam) !== false){
					if($homeTeamGoals > $awayTeamGoals){
						if($bet == '1'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else if ($homeTeamGoals == $awayTeamGoals){
						if($bet == '0'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}else{
						if($bet == '2'){
							//Ganhou
							//Update Aposta Resolved
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$win' where id = '$id';");
							//Devolver Dinheiro
							$updateUser = pg_query($dbconn3, "update users set money = (money + '$profit') where id = '$user_id';");
						}else{
							//Perdeu
							$updateBet = pg_query($dbconn3, "update bets set resolved = true, resolved_date = '$atualDate', result = '$lost' where id = '$id';");
						}
					}
				}	
			}			
		}
	}

	function translatePremierLeagueTeams($team){
		return $team;
	}
	
	
	function translateLaLigaTeams($team){	
		switch ($team) {
			case "RC Celta de Vigo":
				return "Celta Vigo";				
			case "RC Deportivo La Coruna":
				return "Deportivo La Corunya";
			case "Málaga CF":
				return "Malaga";
			case "Athletic Club":
				return "Athletic Bilbao";
			case "Club Atlético de Madrid":
				return "Atletico Madrid";
			case "Sporting Gijón":
				return "Sporting Gijon";
			case "Sevilla FC":
				return "Seville";
			default:
				return $team;
		}
	}
	
	function translateSerieATeams($team){	
		switch ($team) {
			case "Hellas Verona FC":
				return "Verona";				
			case "FC Internazionale Milano":
				return "Inter Milan";			
			default:
				return $team;
		}
	}

	function translatePrimeiraLigaTeams($team){	
		switch ($team) {
			case "Nacional Funchal":
				return "Nacional Madeira";				
			case "FC Paços de Ferreira":
				return "Pacos Ferreira";			
			case "FC Porto":
				return "Porto";
			case "União Madeira":
				return "Uniao Madeira";
			case "Académica de Coimbra":
				return "Academica";
			default:
				return $team;
		}
	}

	function translateBundesligaTeams($team){	
		switch ($team) {
			case "Bor. Mönchengladbach":
				return "Borussia M'gladbach";				
			case "1. FC Köln":
				return "Cologne";			
			case "FC Bayern München":
				return "Bayern Munich";
			case "Hamburger SV":
				return "Hamburg";
			case "Hertha BSC":
				return "Hertha Berlin";
			default:
				return $team;
		}
	}
	
	function translateLigueOneTeams($team){	
		switch ($team) {
			case "Gazélec Ajaccio":
				return "Ajaccio GFCO";				
			case "Olympique Lyonnais":
				return "Lyon";			
			case "AS Saint-Étienne":
				return "Saint-Etienne";
			case "Stade de Reims":
				return "Rennes";			
			default:
				return $team;
		}
	}
	
	
	function translateChampionsLeagueTeams($team){	
		switch ($team) {
			case "FK BATE Baryssau":
				return "BATE Borisov";				
			case "FC Zenit St. Petersburg":
				return "Zenit St Petersburg";			
			case "FC Bayern München":
				return "Bayern Munich";
			case "Olympiacos F.C.":
				return "Olympiakos";
			case "Dynamo Kyiv":
				return "Dynamo Kiev";	
			case "Olympique Lyonnais":
				return "Lyon";	
			case "Maccabi Tel Aviv":
				return "Maccabi Tel-Aviv";	
			case "Club Atlético de Madrid":
				return "Atletico Madrid";	
			case "Bor. Mönchengladbach":
				return "Borussia M'gladbach";	
			case "Sevilla FC":
				return "Seville";				
			default:
				return $team;
		}
	}
	
	
   
?>
