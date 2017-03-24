<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	
	<!--HOIATUS
	SIIN OLEV SKRIPT
	TULEB HILJEM EEMALDADA
	JA PANNA ERALDI FAILI SISSE
	-->
	<script>
	$(document).ready(function(){
	$('#login-trigger').click(function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
      else $(this).find('span').html('&#x25BC;')
    })
});
	</script>
	
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	
	        <!--Menu Items-->
	        
			<ul class="nav navbar-nav">
				<li><a href="" class="navbar-brand">Pollerina</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/">Home</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/findPolls">Find Polls</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/yourPolls">Your Polls</a></li>
				<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/account">Account</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id="login">
					<a id="login-trigger" href="#">
						Log in 
					</a>
					<div id="login-content">
						<form>
							<fieldset id="inputs">
								<input id="username" type="email" name="Email" placeholder="Your email address" required>   
								<input id="password" type="password" name="Password" placeholder="Password" required>
							</fieldset>
							<fieldset id="actions">
								<input type="submit" id="submit" value="Log in">
								<label><input type="checkbox" checked="checked"> Keep me signed in</label>
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
	
<!--To whom it may concern, maybe the login can be implemented with AJAX, instead of going to a separate screen, 
http://red-team-design.com/simple-and-effective-dropdown-login-box/-->