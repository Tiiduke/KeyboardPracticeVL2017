<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" />
	
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<code>application/controllers/Welcome.php</code>
		

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		<p>If you want to search for templates: try searching "W3Schools theme" or such, for example, here is a template: <a href="<?php echo base_url(); ?>index.php/welcome/template1">'webpage'</a>.</p>
		<p>Of course, there are more pages to sample through: <a href="<?php echo base_url(); ?>index.php/welcome/template2">How about 'blog'?</a>.</p>
		<p>Here is a webpage where you can learn to make a custom theme: <a href="https://www.w3schools.com/bootstrap/bootstrap_templates.asp">Just be careful with it</a>.</p>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>