<?php
	if(!isset($_SESSION)) { 
		session_start();
	}

	include 'dbConnect.php';
	ini_set('display_errors','Off');
	
	$userid = $_SESSION["UserID"];
	echo $userid;
	/* Collecting user data from database to be used during the session */
	$delaccount = "DELETE FROM Usertest WHERE UserID = '$userid'";
	$delpass = "DELETE FROM Passwordtest WHERE UserPassID = '$userid'";
	if ($conn->query($delpass) === TRUE) {
		$delpasssuccess = lang("Success");
	} else {
		$delpasssuccess = lang("Fail");
	}
	if ($conn->query($delaccount) === TRUE) {
		$delaccountsuccess = lang("Success");
	} else {
		$delaccountsuccess = lang("Fail");
	}

	echo lang("AccountDel");
	echo $delaccountsuccess;
	echo lang("PassDel");
	echo $delpasssuccess;
	

	$conn->close();
	session_unset();
	header('Location: '. base_url() .'index.php/welcome/');
	exit();
?>
<!--To whom it may concern, maybe the login can be implemented with AJAX, instead of going to a separate screen, 
http://red-team-design.com/simple-and-effective-dropdown-login-box/-->
