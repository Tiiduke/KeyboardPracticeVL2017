<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$firstnameErr = $lastnameErr = $genderErr = $emailErr = $birthdateErr = $passErr = $rPassErr = "";
$firstname = $lastname = $gender = $email = $birthdate = $language = $pass = $rPass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["regfirstname"])) {
    $firstnameErr = lang("RegUserErr");
  } else {
    $firstname = test_input($_POST["regfirstname"]);
  }

  if (empty($_POST["reglastname"])) {
    $lastnameErr = lang("RegUserErr");
  } else {
    $lastname = test_input($_POST["reglastname"]);
  }
  
/*  echo '<script type="text/javascript">';
  $gender = echo 'getGender();'
  echo '</script>';
  
  if ($gender() == null) {
    $genderErr = lang("RegGenderErr");
  }*/

  if (empty($_POST["regemail"])) {
    $emailErr = lang("RegEmailErr");
  } else {
    $email = test_input($_POST["regemail"]);
  }
  
  if (empty($_POST["regbirthdate"])) {
	  $birthdateErr = lang("RegBirthdateErr");
  } else {
	  $birthdate = test_input($_POST["regbirthdate"]);
  }
  
  //$language = echo '<script type="text/javascript">', 'getLanguage();', '</script>';
  
  if (empty($_POST["pass"])) {
	  $passErr = lang("RegPassErr");
  } else {
	  $pass = test_input($_POST["pass"]);
  }
  
  if (empty($_POST["rPass"])) {
	  $rPassErr = lang("RegRepPassErr");
  } else {
	  $rPass = test_input($_POST["rPass"]);
	  if ($pass != $rPass) {
		  $rPassErr = lang("RegRepPassErrNotSame");
	  }
	  
  }
   /* 

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
   */
  /*if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($birthdate) && !empty($pass) && !empty($rPass)) {
	include 'dbConnect.php';
	ini_set('display_errors','Off');
	$conn->query("INSERT INTO usertest (firstname, lastname, sex, email, birthdate, language) VALUES ($firstname, $lastname, '1', $email, $birthdate, 'Eng')");
	
	//putting to sleep to allow time for data insertion before next query
	sleep(1);
	$useridquery = mysql_query("SELECT userid FROM Usertest WHERE email='$email' LIMIT 1");
	$userid = mysql_fetch_object($useridquery);
	
	$conn->query("INSERT INTO passwordtest (userpassid, password) VALUES ($userid, $password)");

	$conn->close();
	//echo "$firstname $lastname $email $birthdate $pass $rPass";
	echo "$firstname $lastname $email $birthdate $language $pass $rPass";
	echo '<script type="text/javascript">', 'getLanguage();', '</script>';
  } else {
	echo "Values not set!";
//	echo '<script type="text/javascript">', 'document.getElementById('reglanguage').value;', '</script>';
  }*/
  
}

function test_input($data) {
  $data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container text-left">
    <!-- before ja after hoiavad javascripti jaoks andmeid?::before-->
	<div class="col-sm-10">
		<div class="valError"></div>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
		<fieldset>
		<legend><?php echo lang("RegHeader"); ?></legend>
			<!--First name-->
			<label for="regfirstname"><?php echo lang("RegFirstname"); ?></label>
			<input type="text" id="regfirstname" name="regfirstname" class="form-control" value="<?= isset($_POST['regfirstname']) ? $_POST['regfirstname'] : ''; ?>">
			<span class="error"> <?php echo $firstnameErr;?></span>
			<br>
			<!--Last name-->
			<label for="reglastname"><?php echo lang("RegLastname"); ?></label>
			<input type="text" id="reglastname" name="reglastname" class="form-control" value="<?= isset($_POST['reglastname']) ? $_POST['reglastname'] : ''; ?>">
			<span class="error"> <?php echo $lastnameErr;?></span>
			<br>
			<!--Gender-->
			<?php echo lang("RegGender"); ?> <input type="radio" name="reggender" id="male" value="1" checked>
			<label for="male"><?php echo lang("RegMale"); ?></label>
			<input type="radio" name="reggender" onclick="check();" id="female" value="2">
			<label for="female"><?php echo lang("RegFemale"); ?></label>
			<br>
			<br>
			<!--Birthdate-->
			<label for="regbirthdate"><?php echo lang("RegBirthdate"); ?></label>
			<input type="text" id="regbirthdate" name="regbirthdate" class="form-control" value="<?= isset($_POST['regbirthdate']) ? $_POST['regbirthdate'] : ''; ?>">
			<span class="error"> <?php echo $birthdateErr;?></span>
			<br>
			<!--Language-->
			<label for="reglanguage"><?php echo lang("RegLanguage"); ?></label> 
			<select id="reglanguage">
				<option value="Eng" selected="selected"><?php echo lang("English"); ?></option>
				<option value="Est"><?php echo lang("Estonian"); ?></option>
			</select>
			<br>
			<br>
			<!--Email-->
			<label for="regemail"><?php echo lang("RegEmail"); ?></label>
			<div class="tooltip"> (?)
				<span class="tooltiptext"><?php echo lang("RegEmailTooltip"); ?></span>
			</div>
			<input type="text" id="regemail" name="regemail" class="form-control" value="<?= isset($_POST['regemail']) ? $_POST['regemail'] : ''; ?>">
			<span class="error"> <?php echo $emailErr;?></span>
			<br>
			<!--Password 1-->
			<label for="pass"><?php echo lang("RegPass"); ?></label>
			<div class="tooltip"> (?)
				<span class="tooltiptext"><?php echo lang("RegPassTooltip"); ?></span>
			</div>
			<input type="password" id="pass" name="pass" class="form-control">
			<span class="error"> <?php echo $passErr;?></span>
			<br>
			<br>
			<!--Password 2-->
			<label for="rPass"><?php echo lang("RegRepPass"); ?></label>
			<input type="password" id="rPass" name="rPass" class="form-control">
			<span class="error"> <?php echo $rPassErr;?></span>
			<br>
			<br>
			<!--Terms and conditions-->
			<input name="kasutajatingimus" id="termsCheckbox" value="accept" type="checkbox"> 
			<label for="termsCheckbox"><?php echo lang("RegTerms"); ?></label>
			<br>
			<br>
			</fieldset>
			<input value=<?php echo lang("RegComplete"); ?> class="btn btn-primary btn-md" type="submit">
		</form>   
	</div>
	<!--::after-->  
</div>
	