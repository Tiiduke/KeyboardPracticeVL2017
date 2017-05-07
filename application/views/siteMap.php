<?php
if(!isset($_SESSION)) { 
	session_start();
	}
?>
<p class="text-center"><?php echo lang('siteMapIn');?></p>
<div class="container-fluid">
	    <p class="text-center">
		<a href="<?php echo base_url(); ?>index.php/welcome/"><?php echo lang("menu_mainpage"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/findPolls"><?php echo lang("menu_mainFP"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/yourPolls"><?php echo lang("menu_mainYP"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/createPolls"><?php echo lang("menu_mainCP"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/account"><?php echo lang("Account"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/signUp"> <?php echo lang("SignUp"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/about"><?php echo lang("About"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/contactUs"><?php echo lang("Contact"); ?></a>
		<br>
		<a href="<?php echo base_url(); ?>index.php/welcome/siteMap"><?php echo lang("SiteMap"); ?></a>

		</p>
	</div>