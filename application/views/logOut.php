<?php
	if(!isset($_SESSION)) { 
		session_start();
	}
	session_unset();
	header('Location: '. base_url() .'index.php/welcome/');
	exit();
	//header('Location: '.$_SERVER['PHP_SELF']);
	//die;
	?>