<?php
	if (isset($_SESSION["firstname"])) {
		echo lang("Hello");", " . $_SESSION["firstname"] . "!";
	} else {
		echo lang("NotLoggedIn");
	}
?>