<?php
	if (isset($_SESSION["firstname"])) {
		echo lang("Hello");
		echo ", " . $_SESSION["firstname"] . "!";
	} else {
		echo lang("NotLoggedIn");
	}
?>