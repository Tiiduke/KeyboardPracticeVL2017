<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION)) { 
	session_start();
	}
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
	<script type="text/javascript" src="../../js/checker.js"></script>
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
				<?php
					if (!isset($_SESSION["firstname"])) {
						echo '<li id="login">';
						echo '<a id="login-trigger" href="#">';
							echo lang("Login");
							
						echo '</a>';
						echo '<div id="login-content">';
							echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
								echo '<fieldset id="inputs">';
									echo '<label for="username">' . lang("UE") . '</label>';
									echo '<input id="username" type="email" name="Email" placeholder=' . lang("UEIn") . ' required> ';  
									echo '<label for="password">' . lang("Par") . '</label>';
									echo '<input id="password" type="password" name="Password" placeholder=' . lang("ParIn") . ' required>';
								echo '</fieldset>';
								echo '<fieldset id="actions">';
									echo '<input type="submit" id="submit" value="Log in">';
									echo '<label for="checkbox">' . lang("keepLog") . '</label>';
									echo '<input id="checkbox" type="checkbox" checked="checked">';
								echo '</fieldset>';
							echo '</form>';
						echo '</div>';                     
					echo '</li>';
					echo '<li id="signup">';
						echo '<a href="'. base_url() . 'index.php/welcome/signUp">'. lang("SignUp") . '</a>';
					}
					if (isset($_SESSION["firstname"])) {
						//echo '<li id="logout">';
						//echo '<input type="submit" id="logout" value=' . lang("LogOut") . '>';
						//echo '<a id="login-trigger" href="#">';
						echo '<li><a href=" ' . base_url() . 'index.php/welcome/logOut">' . lang("LogOut") . '</a></li>';
							//echo lang("LogOut");
						//echo '</a>';
						
					}
				?>
				

				</li>
				</ul>
			</div>
	</nav>
	
	<?php
		/*		SOMETHING LIKE THIS NEEDS TO BE IMPLEMENTED SOMEWHERE TO LOG OUT				
		//log out code
						if (isset($_POST['logout'])) {
							session_unset();
							session_start();
						}
		*/
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

	?>
<!--To whom it may concern, maybe the login can be implemented with AJAX, instead of going to a separate screen, 
http://red-team-design.com/simple-and-effective-dropdown-login-box/-->
