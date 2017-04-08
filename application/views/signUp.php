<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$uNameErr = $emailErr = $passErr = $rPassErr = "";
$uName    = $email    = $pass    = $rPass    = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["uName"])) {
    $uNameErr = lang("RegUserErr");
  } else {
    $name = test_input($_POST["uName"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = lang("RegEmailErr");
  } else {
    $email = test_input($_POST["email"]);
  }
  
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
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
   
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  */
}

function test_input($data) {
  //$data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container text-left">
    <!-- before ja after hoiavad javascripti jaoks andmeid?::before-->
	<div class="col-sm-10">
		<h2><?php echo lang("RegHeader"); ?></h2>
		<div class="valError"></div>
		<!--Pane tähele et siin on vale lehekülg action'i jaoks-->
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			<label for="name"><?php echo lang("RegUser"); ?></label>
			<input type="text" id="name" name="uName" class="form-control" value="<?= isset($_POST['uName']) ? $_POST['uName'] : ''; ?>">
			<span class="error"> <?php echo $uNameErr;?></span>
			<br>
			<br>
			<label for="email"><?php echo lang("RegEmail"); ?></label>
			<input type="text" id="email" name="email" class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
			<span class="error"> <?php echo $emailErr;?></span>
			<br>
			<br>
			<label for="pass"><?php echo lang("RegPass"); ?></label>
			<input type="password" id="pass" name="pass" class="form-control">
			<span class="error"> <?php echo $passErr;?></span>
			<br>
			<br>
			<label for="rPass"><?php echo lang("RegRepPass"); ?></label>
			<input type="password" id="rPass" name="rPass" class="form-control">
			<span class="error"> <?php echo $rPassErr;?></span>
			<br>
			<br>
			<input name="kasutajatingimus" id="termsCheckbox" value="accept" type="checkbox"> 
			<label for="termsCheckbox"><?php echo lang("RegTerms"); ?></label>
			<br>
			<br>
			<input value=<?php echo lang("RegComplete"); ?> class="btn btn-primary btn-md" type="submit">
		</form>   
	</div>
	<!--::after-->  
</div>
	