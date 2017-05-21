<div id="accountDetails">
<?php
	if (isset($_SESSION["firstname"])) {
		echo lang("Hello");
		echo ", " . $_SESSION["firstname"] . "!";
		echo "<br><br>";
		//displays user account details
		echo lang("RegFirstname") . $_SESSION["firstname"];
		echo "<br>";
		echo lang("RegLastname") . $_SESSION["lastname"];
		echo "<br>";
		echo lang("RegGender");
		if ($_SESSION["sex"] == '1') {
			echo lang("RegMale");
		} else {
			echo lang("RegFemale");
		}
		echo "<br>";
		echo lang("RegLanguage");
		if ($_SESSION["language"] == 'Eng') {
			echo lang("English");
		} else {
			echo lang("Estonian");
		}
		echo "<br>";
		echo lang("RegBirthdate") . $_SESSION["birthdate"];
		echo "<br>";
		echo lang("UE") . $_SESSION["email"];
		echo "<br>";
		echo lang("RegPass") . $_SESSION["password"];
		echo "<br>";
		echo "<br>";
		echo '<a href=" ' . base_url() . 'index.php/welcome/delAccount">' . lang("DelAccount") . '</a>';
		echo "<br>";
	} else {
		echo '<br>';
		echo '<div id="beLoggedIn3">';
		echo lang("NotLoggedIn");
		include 'registerLogin.php';
		echo '</div>';
	}
?>
</div>