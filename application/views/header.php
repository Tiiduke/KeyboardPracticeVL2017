<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<?php 
    if(isset($title)){
    echo "<title>" . $title . "</title>";
    } else {
    	echo "<title>Tiitli muutuja t�hi</title>";
	}
    ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css"  type="text/css" />
	<!-- Siia saab lisada bootstrap theme ka n�iteks
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/navbar-theme2.css"  type="text/css" /> 
	-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	
</head>
<body>

	<nav class="navbar navbar-default">
	    <div class="container-fluid">
	
	        <!--Menu Items-->
	        <div>
	            <ul class="nav navbar-nav">
	            	<li><a href="" class="navbar-brand">Pollerina</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/none">Home</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/none2">Find Polls</a></li>
	                <li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/none3">Your Polls</a></li>
					<li class="all"><a href="<?php echo base_url(); ?>index.php/welcome/none4">Account</a></li>
	            </ul>
	        </div>
	    </div>
	</nav>

