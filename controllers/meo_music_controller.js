angular
  .module('MyApp', ['md.data.table', 'ngMaterial', 'angularXml2json', 'naif.base64'])
  .controller('DemoCtrl', function($scope, $http, $mdToast, ngXml2json) {
  
   $scope.premierLeagueGames = []; //1
   $scope.laLigaGames = []; //5
   $scope.serieAGames = [];  //4
   $scope.bundesLigaGames = [];  //3
   $scope.ligueOneGames = [];  //2
   $scope.primeiraLigaGames = [];  //15
   $scope.championsLeagueGames = [];  //6
   $scope.selectedAmount = null;
   $scope.auth = null;
   
   $scope.selectedGames = [];
   $scope.totalCost = "0.0";
   $scope.betValues = [{'value': 1, 'display':'1\u20AC'},
					  {'value': 2, 'display':'2\u20AC'},
					  {'value': 5, 'display':'5\u20AC'},
					  {'value': 10, 'display':'10\u20AC'},
					  {'value': 20, 'display':'20\u20AC'},
					  {'value': 50, 'display':'50\u20AC'}];
	
   
   $scope.photo = null;
   $scope.username = null;
   $scope.user_id = null;
   
   $scope.visibleScreen = null;
   $scope.register_email = null;
   $scope.register_username = null;
   $scope.register_password = null;
   $scope.register_confpassword = null;
   $scope.register_photo = null;
   
   $scope.login_email = null;
   $scope.login_password = null;
 
 	$scope.getUserInfo = function(email, msgFunction){
		$http({
		  method: 'POST',
		  url: '../getUserByEmail.php',
		  data: {"email": email}
		}).then(function successCallback(response2) {	

				$scope.photo = response2.data[0][4];
				$scope.username = response2.data[0][2];
				$scope.user_id = response2.data[0][0];
				if(msgFunction){
					msgFunction();
				}
				$scope.visibleScreen = 3;		
		  }, function errorCallback(response2) {
		});
	 }
	 
	 $scope.submitBets = function(){
	 
	 	$scope.selectedGames.forEach(function(game) {
			var x = new Date();
			var bet = {
				'user_id': $scope.user_id,
				'home_team': game.home,
				'away_team': game.away,
				'odd': game.selectedOdd,
				'pick': game.pick,
				'league': game.league,
				'amount': $scope.selectedAmount,
				'bet_date': (x.getUTCDay()<9?'0':'') + (x.getUTCDay() + 1) + "-" + (x.getUTCMonth()<9?'0':'') + (x.getUTCMonth() + 1)  + "-" + x.getFullYear() + " " + (x.getUTCHours()<10?'0':'') + (x.getUTCHours()) + ":" + (x.getUTCMinutes()<10?'0':'') + (x.getUTCMinutes()) + ":" + (x.getUTCSeconds()<10?'0':'') + (x.getUTCSeconds()),
				'game_date': game.day + ' ' + game.hour
			};
			
			
			$http({
			  method: 'POST',
			  url: '../bet.php',
			  data: bet
			}).then(function successCallback(response2) {						
					debugger;
					//$scope.visibleScreen = 3;		
			  }, function errorCallback(response2) {
			});
			console.log(bet);
		});	

	 }
	 
	 
	$scope.logout = function(){
	 				
		$http({
		  method: 'GET',
		  url: '../logout.php'
		}).then(function successCallback(response) {			
					$scope.visibleScreen = 0;		
		  }, function errorCallback(response) {
		  });
	 }
      
	$http({
	  method: 'GET',
	  url: '../is_logged.php'
	}).then(function successCallback(response) {			
			if(response.data == "-1"){
				$scope.visibleScreen = 0;
			}else{				
				$scope.getUserInfo(response.data);				
			}				
	  }, function errorCallback(response) {
	  });
   
   
   
	$http({
	  method: 'GET',
	  url: '../getPremierLeagueGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.premierLeagueGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	 

	  
	$http({
	  method: 'GET',
	  url: '../getBundesligaGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.bundesLigaGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	  
	$http({
	  method: 'GET',
	  url: '../getPrimeiraLigaGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.primeiraLigaGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	  
	$http({
	  method: 'GET',
	  url: '../getSerieAGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.serieAGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	  
	$http({
	  method: 'GET',
	  url: '../getLigueOneGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.ligueOneGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	  
	$http({
	  method: 'GET',
	  url: '../getChampionsLeagueGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.championsLeagueGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	  
	$http({
	  method: 'GET',
	  url: '../getLaLigaGames.php'
	}).then(function successCallback(response) {
		response.data.forEach(function(result) {
			var gameDate = result[6].split('T');
			var game = {
				'home': result[1],
				'away': result[2],
				'homeOdd': result[3],
				'drawOdd': result[4],
				'awayOdd': result[5],
				'day': gameDate[0],
				'hour': gameDate[1],
				'visible': true
			}
			
			$scope.laLigaGames.push(game);
		});							
	  }, function errorCallback(response) {
	  });
	 	

	$scope.changeScreen = function (_screen) {		
		$scope.visibleScreen = _screen;
      };
	  
	  function showToast(message, theme){
		var toast = $mdToast.simple()
			  .content(message)
			  .theme(theme)
			  .action('x')		  
			  .highlightAction(false)
			  .hideDelay(3000)
			  .position('top right');
			
			$mdToast.show(toast).then(function(response) {
				  if ( response == 'ok' ) {					
				  }
			});
	  }
	  
	$scope.login = function () {	
		if(!$scope.login_email){
			showToast('Preencha o campo E-mail !', 'error-toast');
			return;
		}
		
		if(!$scope.login_password){
			showToast('Preencha o campo Palavra passe!', 'error-toast');							
			return;
		}
		
		$http({
		  method: 'POST',
		  url: '../login.php',
		  data: {"email": $scope.login_email, "password": $scope.login_password}
		}).then(function successCallback(response) {			
			if(response.data == "1"){				
				$scope.getUserInfo($scope.login_email, showToast('Bem Vindo!', 'success-toast'));
				//$scope.visibleScreen = 3;
			}else{
				showToast('Email ou palavra passe incorreto(s)!', 'error-toast');
				return;							
			}
		  }, function errorCallback(response) {
		});		
	}

	$scope.register = function () {		
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		
		if(!$scope.register_email){
			showToast('Preencha o campo E-mail !', 'error-toast');
			return;
		}
		
		if(!$scope.register_username){
			showToast('Preencha o campo Username !', 'error-toast');
			return;
		}
		
		if(!$scope.register_password){
			showToast('Preencha o campo Palavra passe!', 'error-toast');							
			return;
		}
		
		if(!$scope.register_confpassword){
			showToast('Preencha o campo Confirmar palavra passe!', 'error-toast');							
			return;
		}
		
		if(re.test($scope.register_email)){
				if($scope.register_password === $scope.register_confpassword){
				
					$http({
					  method: 'POST',
					  url: '../register.php',
					  data: {"email": $scope.register_email, "username": $scope.register_username, "password": $scope.register_password, 'confpassword': $scope.register_confpassword, 'photo': $scope.register_photo.base64}
					}).then(function successCallback(response) {
						
						if(response.data == "1"){							
							showToast('Registo efetuado com sucesso!', 'success-toast');
							$scope.register_password = '';
							$scope.register_confpassword = '';
							$scope.register_email = '';
							$scope.visibleScreen = 0;
						}else if(response.data == "-1"){
							showToast('Email j\xE1 se encontra utilizado!', 'error-toast');		
							return;							
						}else if(response.data == "-2"){
							showToast('Username j\xE1 se encontra utilizado!', 'error-toast');		
							return;							
						}else if(response.data == "-3"){
							showToast('Palavra passe e Confirma\xE7\xE3o de palavra passe diferentes!', 'error-toast');
							return;							
						}else if(response.data == "0"){
							showToast('Erro! Tente novamente mais tarde!', 'error-toast');
							return;							
						}
					  }, function errorCallback(response) {
					  });
				
				}
				else{			
					showToast('Palavra passe e Confirma\xE7\xE3o de palavra passe diferentes!', 'error-toast');
					return;
				}
		}else{			
			showToast('Email inv\xE1lido!', 'error-toast');			
			return;
		}
      };	  
						  
	  $scope.addGame = function (home, away, homeOdd, drawOdd, awayOdd, league, pick, day, hour) {
		
		var selectedOdd;
		if(pick == 1){
			selectedOdd = homeOdd;	
			selectedTeam = home;				
		}else if (pick == 0){
			selectedOdd = drawOdd;
			selectedTeam = 'Draw';
		}else{
			selectedOdd = awayOdd;
			selectedTeam = away;
		}
		
		$scope.totalCost = (parseFloat($scope.totalCost) + parseFloat(selectedOdd)).toFixed(2);
		if($scope.selectedAmount)
			$scope.totalCostFinal = (parseFloat($scope.totalCost) * $scope.selectedAmount).toFixed(2) + '\u20AC';

		
		$scope.selectedGames.push({'home': home, 
								   'away': away,
								   'homeOdd': homeOdd,
								   'drawOdd': drawOdd,
								   'awayOdd': awayOdd,
								   'league': league,
								   'pick': pick,
								   'selectedOdd':selectedOdd,
								   'selectedTeam':selectedTeam,
								   'day':day,
								   'hour':hour});
      };
	  
	  $scope.removeSelection = function(home, away, selection, selectedOdd){
		
		for(var i = 0; i<$scope.selectedGames.length; i++){
			if($scope.selectedGames[i].home == home && $scope.selectedGames[i].away == away && $scope.selectedGames[i].selectedTeam == selection){
			
				$scope.totalCost = (parseFloat($scope.totalCost) - parseFloat(selectedOdd)).toFixed(2);
				if($scope.selectedAmount)
					$scope.totalCostFinal = (parseFloat($scope.totalCost) * $scope.selectedAmount).toFixed(2) + '\u20AC';
					
				$scope.selectedGames.splice(i, 1);		
			}
		}	
	  }
	  
	  $scope.updateTotalCostFinal = function(){

			if($scope.selectedAmount)
				$scope.totalCostFinal = (parseFloat($scope.totalCost) *$scope.selectedAmount).toFixed(2) + '\u20AC';
	  }
	  	
	  $scope.gotSelected = function (index, value){		
		$scope.selectedGames.forEach(function(entry) {
			if(entry.cell == index && entry.value == value){
				return true;
			}else{
				return false;
			}
		});
	  };
	
	  
	  //Search Premier League
	  
	  $scope.searchPremierLeague = function (){		
	
		for(var i = 0; i<$scope.premierLeagueGames.length; i++){
			if($scope.premierLeagueGames[i].home.toLowerCase().indexOf($scope.premierLeagueSearch.toLowerCase()) > -1 || $scope.premierLeagueGames[i].away.toLowerCase().indexOf($scope.premierLeagueSearch.toLowerCase()) > -1){
				$scope.premierLeagueGames[i].visible = true;
			}else{
				$scope.premierLeagueGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanPremierLeague = function (){		
		$scope.premierLeagueSearch = '';
		$scope.searchPremierLeague();
	  };
	  
	  
	 //Search La Liga
	  
	 $scope.searchLaLiga = function (){		
		for(var i = 0; i<$scope.laLigaGames.length; i++){
			if($scope.laLigaGames[i].home.toLowerCase().indexOf($scope.laLigaSearch.toLowerCase()) > -1 || $scope.laLigaGames[i].away.toLowerCase().indexOf($scope.laLigaSearch.toLowerCase()) > -1){
				$scope.laLigaGames[i].visible = true;
			}else{
				$scope.laLigaGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanLaLiga = function (){		
		$scope.laLigaSearch = '';
		$scope.searchLaLiga();
	  };
	  
	  
	$scope.searchSerieA = function (){		
	
		for(var i = 0; i<$scope.serieAGames.length; i++){
			if($scope.serieAGames[i].home.toLowerCase().indexOf($scope.serieASearch.toLowerCase()) > -1 || $scope.serieAGames[i].away.toLowerCase().indexOf($scope.serieASearch.toLowerCase()) > -1){
				$scope.serieAGames[i].visible = true;
			}else{
				$scope.serieAGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanSerieA = function (){		
		$scope.serieASearch = '';
		$scope.searchSerieA();
	  };
	  
	  
	 $scope.searchPrimeiraLiga = function (){		
	
		for(var i = 0; i<$scope.primeiraLigaGames.length; i++){
			if($scope.primeiraLigaGames[i].home.toLowerCase().indexOf($scope.primeiraLigaSearch.toLowerCase()) > -1 || $scope.primeiraLigaGames[i].away.toLowerCase().indexOf($scope.primeiraLigaSearch.toLowerCase()) > -1){
				$scope.primeiraLigaGames[i].visible = true;
			}else{
				$scope.primeiraLigaGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanPrimeiraLiga = function (){		
		$scope.primeiraLigaSearch = '';
		$scope.searchPrimeiraLiga();
	  };
	  
	  
	 $scope.searchBundesLiga = function (){		
	
		for(var i = 0; i<$scope.bundesLigaGames.length; i++){
			if($scope.bundesLigaGames[i].home.toLowerCase().indexOf($scope.bundesligaSearch.toLowerCase()) > -1 || $scope.bundesLigaGames[i].away.toLowerCase().indexOf($scope.bundesligaSearch.toLowerCase()) > -1){
				$scope.bundesLigaGames[i].visible = true;
			}else{
				$scope.bundesLigaGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanBundesliga = function (){		
		$scope.bundesligaSearch = '';
		$scope.searchBundesLiga();
	  };
	  
	  
	  
	$scope.searchLigueOne = function (){		

		for(var i = 0; i<$scope.ligueOneGames.length; i++){
			if($scope.ligueOneGames[i].home.toLowerCase().indexOf($scope.ligueOneSearch.toLowerCase()) > -1 || $scope.ligueOneGames[i].away.toLowerCase().indexOf($scope.ligueOneSearch.toLowerCase()) > -1){
				$scope.ligueOneGames[i].visible = true;
			}else{
				$scope.ligueOneGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanLigueOne = function (){		
		$scope.ligueOneSearch = '';
		$scope.searchLigueOne();
	  };
	  
	  
	 $scope.searchChampionsLeague = function (){		
	
		for(var i = 0; i<$scope.championsLeagueGames.length; i++){
			if($scope.championsLeagueGames[i].home.toLowerCase().indexOf($scope.championsLeagueSearch.toLowerCase()) > -1 || $scope.championsLeagueGames[i].away.toLowerCase().indexOf($scope.championsLeagueSearch.toLowerCase()) > -1){
				$scope.championsLeagueGames[i].visible = true;
			}else{
				$scope.championsLeagueGames[i].visible = false;
			}
		}
	  };
	  
	 $scope.cleanChampionsLeague = function (){		
		$scope.championsLeagueSearch = '';
		$scope.searchChampionsLeague();
	  };
	  
	  
	  
	  
	  
	  
  })
  .controller('MenuCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.toggleLeft = buildDelayedToggler('left');
    $scope.toggleRight = buildToggler('right');
    $scope.isOpenRight = function(){
      return $mdSidenav('right').isOpen();
    };
    /**
     * Supplies a function that will continue to operate until the
     * time is up.
     */
    function debounce(func, wait, context) {
      var timer;
      return function debounced() {
        var context = $scope,
            args = Array.prototype.slice.call(arguments);
        $timeout.cancel(timer);
        timer = $timeout(function() {
          timer = undefined;
          func.apply(context, args);
        }, wait || 10);
      };
    }
    /**
     * Build handler to open/close a SideNav; when animation finishes
     * report completion in console
     */
    function buildDelayedToggler(navID) {
      return debounce(function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }, 200);
    }
    function buildToggler(navID) {
      return function() {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }
    }
  })
  .controller('LeftCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      $mdSidenav('left').close()
        .then(function () {
          $log.debug("close LEFT is done");
        });
    };
  })
  .controller('RightCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      $mdSidenav('right').close()
        .then(function () {
          $log.debug("close RIGHT is done");
        });
    };
  })