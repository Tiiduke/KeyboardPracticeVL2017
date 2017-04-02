<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	
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
	<!-- Siia saab lisada bootstrap theme ka nt
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/navbar-theme2.css"  type="text/css" /> 
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/logIn.js"></script>
	</head>
<body>
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	
	        <!--Menu Items-->
	        
			<ul class="nav navbar-nav">
				<li><a href="" class="navbar-brand">Pollerina</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/">Home</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/findPolls">Find Polls</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/yourPolls">Your Polls</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/createPolls">Create Polls</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/account">Account</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id="login">
					<a id="login-trigger" href="#">
						Log in 
					</a>
					<div id="login-content">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<fieldset id="inputs">
								<label for="username">Username/e-mail:</label>
								<input id="username" type="email" name="Email" placeholder="Your email address" required>   
								<label for="password">Password:</label>
								<input id="password" type="password" name="Password" placeholder="Password" required>
							</fieldset>
							<fieldset id="actions">
								<input type="submit" id="submit" value="Log in">
								<label for="checkbox">Keep me signed in</label>
								<input id="checkbox" type="checkbox" checked="checked">
							</fieldset>
						</form>
					</div>                     
				</li>
				<li id="signup">
					<a href="<?php echo base_url(); ?>index.php/welcome/signUp">Sign up FREE</a>
				</li>
			</ul>
				
	        
	    </div>
	</nav>
	
	<?php 
		include 'dbConnect.php';
		
		ini_set('display_errors','Off');
		
		$email = $_POST["Email"];
		$password = $_POST["Password"];
		
		$loginSuccess = "SELECT COUNT( u.userid ) AS counter, u.firstname AS fname FROM Usertest AS u INNER JOIN Passwordtest AS p WHERE u.email = '$email' AND u.userid = p.userpassid AND p.password = '$password'";
		$result1 = $conn->query($loginSuccess);

		$firstname = "SELECT u.firstname AS fname FROM Usertest AS u INNER JOIN Passwordtest AS p WHERE u.email = '$email' AND u.userid = p.userpassid AND p.password = '$password'";
		$result2 = $conn->query($loginSuccess);

		$counter = $result1->fetch_assoc()['counter'];
		$fname = $result2->fetch_assoc()['fname'];
		
		if ($counter > 0) {
			echo "Login successful!<br> Hello, $fname!";
			$_SESSION["email"] = $email;
			$_SESSION["password"] = $password;
			$_SESSION["firstname"] = $fname;		
		}
		else {
			if ($email == "" && $password == "") {
				echo "Login required.";
			}
			else {
				echo "Login failed!<br>";
				echo "Email ($email) or password ($password) is wrong.";
			}
		}

		$conn->close();

	?>
<!--To whom it may concern, maybe the login can be implemented with AJAX, instead of going to a separate screen, 
http://red-team-design.com/simple-and-effective-dropdown-login-box/-->
