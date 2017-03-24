<style>
.error {color: #FF0000;}
</style>
<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$uNameErr = $emailErr = $passErr = $rPassErr = "";
$uName    = $email    = $pass    = $rPass    = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["uName"])) {
    $uNameErr = "A name is required";
  } else {
    $name = test_input($_POST["uName"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "An email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["pass"])) {
	  $passErr = "A password is required";
  } else {
	  $pass = test_input($_POST["pass"]);
  }
  
  if (empty($_POST["rPass"])) {
	  $rPassErr = "You need to reenter your password as well";
  } else {
	  $rPass = test_input($_POST["rPass"]);
	  if ($pass != $rPass) {
		  $rPassErr = "the password entered was not the same";
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
		<h2>Pollerina user registration</h2>
		<div class="valError"></div>
		<!--Pane tähele et siin on vale lehekülg action'i jaoks-->
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			<label for="name">User name:</label>
			<input type="text" name="uName" class="form-control" value="<?= isset($_POST['uName']) ? $_POST['uName'] : ''; ?>">
			<span class="error"> <?php echo $uNameErr;?></span>
			<br>
			<br>
			<label for="email">Email:</label>
			<input type="text" name="email" class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
			<span class="error"> <?php echo $emailErr;?></span>
			<br>
			<br>
			<label for="pass">Password:</label>
			<input type="password" name="pass" class="form-control">
			<span class="error"> <?php echo $passErr;?></span>
			<br>
			<br>
			<label for="rPass">Repeat Password:</label>
			<input type="password" name="rPass" class="form-control">
			<span class="error"> <?php echo $rPassErr;?></span>
			<br>
			<br>
			<input name="kasutajatingimus" value="accept" type="checkbox"> <b>I have read and agree to the *nonexistent* Terms and Conditions</b><br>
			<br>
			<br>
			<input value="Complete registration" class="btn btn-primary btn-md" type="submit">
		</form>   
	</div>
	<!--::after-->  
</div>
	