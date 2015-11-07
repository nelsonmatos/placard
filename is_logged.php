<?php
	session_start();
	
	if(isset($_SESSION['logged_user'])){
		echo $_SESSION['logged_user'];
	}else{
		echo -1;
	}
?>
