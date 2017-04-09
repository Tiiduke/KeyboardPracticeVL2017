<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION)) { 
	session_start();
	}
$this->lang->load('myappl', $this->session->userdata('site_lang'));
$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="253143165319-8ghrtm4aikjrhvd51oev2fl2of6pi7vl.apps.googleusercontent.com">

	<?php 
    if(isset($title)){
    echo "<title>" . $title . "</title>";
    } else {
    	echo "<title>Tiitli muutuja tühi</title>";
	}
    ?>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css"  type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/footer.css"  type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/headerImg.css" type="text/css" />
	<!-- Siia saab lisada bootstrap theme ka nt
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/navbar-theme2.css"  type="text/css" /> 
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/logIn.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	</head>
<body>
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	
	        <!--Menu Items-->
	        
			<ul class="nav navbar-nav">
				<li><a href="" class="navbar-brand">Pollerina</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/"><?php echo lang("menu_mainpage"); ?></a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/findPolls"><?php echo lang("menu_mainFP"); ?></a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/yourPolls"><?php echo lang("menu_mainYP"); ?></a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/createPolls"><?php echo lang("menu_mainCP"); ?></a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/account"><?php echo lang("Account"); ?></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo base_url(); ?>index.php/welcome/vahetaKeelt/estonian"><img class="img" alt="estonian flag" src="<?php echo base_url(); ?>images/est.png"/></a></li>
				<li><a href="<?php echo base_url(); ?>index.php/welcome/vahetaKeelt/english"><img class="img" alt="union jack" src="<?php echo base_url(); ?>images/gb.png"/></a></li>
				
				<li id="login">
					<a id="login-trigger" href="#">
						<?php echo lang("Login"); ?>
					</a>
					<div id="login-content">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<fieldset id="inputs">
								<label for="username"><?php echo lang("UE"); ?></label>
								<input id="username" type="email" name="Email" placeholder=<?php echo lang("UEIn"); ?> required>   
								<label for="password"><?php echo lang("Par"); ?></label>
								<input id="password" type="password" name="Password" placeholder=<?php echo lang("ParIn"); ?> required>
							</fieldset>
							<fieldset id="actions">
								<input type="submit" id="submit" value="Log in">
								<label for="checkbox"><?php echo lang("keepLog"); ?></label>
								<input id="checkbox" type="checkbox" checked="checked">
							</fieldset>
						</form>
					</div>                     
				</li>
				<li id="signup">
					<a href="<?php echo base_url(); ?>index.php/welcome/signUp"><?php echo lang("SignUp"); ?></a>
					
				</li>
<!-- Google login, currently not working
			<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
				<script>
				function onSignIn(googleUser) {
					// Useful data for your client-side scripts:
					var profile = googleUser.getBasicProfile();

					
					console.log("ID: " + profile.getId()); // Don't send this directly to your server!
					console.log('Full Name: ' + profile.getName());
					console.log('Given Name: ' + profile.getGivenName());
					console.log('Family Name: ' + profile.getFamilyName());
					console.log("Image URL: " + profile.getImageUrl());
					console.log("Email: " + profile.getEmail());

					// The ID token you need to pass to your backend:
					var id_token = googleUser.getAuthResponse().id_token;
					console.log("ID Token: " + id_token);
				  };
				</script>
				<a href="#" onclick="signOut();">Sign out</a>
				<script>
					function signOut() {
						var auth2 = gapi.auth2.getAuthInstance();
						auth2.signOut().then(function () {
						  console.log('User signed out.');
						});
					}
				</script>
-->
				</ul>
			</div>
	</nav>
	
	<?php 
		include 'dbConnect.php';
		
		ini_set('display_errors','Off');
		
		$email = $_POST["Email"];
		$password = $_POST["Password"];
		
		/* Collecting user data from database to be used during the session */
		$userdata = "SELECT u.userid, u.firstname, u.lastname, u.sex, u.birthdate, u.language, u.fb FROM Usertest AS u INNER JOIN Passwordtest AS p WHERE u.email = '$email' AND u.userid = p.userpassid AND p.password = '$password'";
		$result = $conn->query($userdata);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$_SESSION["userid"] = $row['userid'];
				$_SESSION["firstname"] = $row['firstname'];
				$_SESSION["lastname"] = $row['lastname'];
				$_SESSION["sex"] = $row['sex'];
				$_SESSION["birthdate"] = $row['birthdate'];
				$_SESSION["language"] = $row['language'];
				$_SESSION["fb"] = $row['fb'];
			}
			$_SESSION["password"] = $password;
			$_SESSION["email"] = $email;
			if ($_SESSION["language"] == 'Est'){
				$this->session->set_userdata('site_lang', "estonian");
				header("Location: ". $_SESSION['current_page']);
			} else {
				$this->session->set_userdata('site_lang', "english");
				header("Location: ". $_SESSION['current_page']);
			}
		} else {
			if ($email == "" && $password == "") {
				/*echo "Login required.";*/
			}
			else {
				echo "Login failed!<br>";
				echo "Email ($email) or password ($password) is wrong.";
				session_unset();
				session_start();
				$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
			}
		}

		$conn->close();

		if (isset($_SESSION["firstname"])) {
			echo "Hello, " . $_SESSION["firstname"] . "!";
		}
	?>
<!--To whom it may concern, maybe the login can be implemented with AJAX, instead of going to a separate screen, 
http://red-team-design.com/simple-and-effective-dropdown-login-box/-->
