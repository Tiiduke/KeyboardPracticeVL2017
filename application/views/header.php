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
	<!-- Siia saab lisada bootstrap theme ka nt
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/navbar-theme2.css"  type="text/css" /> 
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	
	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	
	        <!--Menu Items-->
	        <div>
	            <ul class="nav navbar-nav">
	            	<li><a href="" class="navbar-brand">Pollerina</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/">Home</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/findPolls">Find Polls</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/yourPolls">Your Polls</a></li>
					<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/account">Account</a></li>
	            </ul>
	        </div>
	    </div>
	</nav>