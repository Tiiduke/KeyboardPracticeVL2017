<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$questionErr = $option1err = $option2err = $option3err = $option4err = $option5err = "";
$question = $option1 = $option2 = $option3 = $option4 = $option5 = "";

$email = $_SESSION['email'];
$userid = $_SESSION['UserID'];

if ($email == "") {
	echo lang("CreatePollsLogin");
}
include 'dbConnect.php';
ini_set('display_errors','Off');

$sqlselect = "SELECT UserID FROM Usertest WHERE Email='$email' LIMIT 1";
$sqlresult = $conn->query($sqlselect);
if ($sqlresult->num_rows > 0) {
	while($row = $sqlresult->fetch_assoc()) {
		$_SESSION["UserID"] = $row['UserID'];
	}
	$userid = $_SESSION["UserID"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["question"])) {
		$questionErr = lang("CrErr1");
	} else {
		$question = test_input($_POST["question"]);
	}

	if (empty($_POST["option1"]) || empty($_POST["option2"])) {
		$option1err = lang("CrErr2");
	} elseif (test_input($_POST["option1"]) == test_input($_POST["option2"])) {
		$option1err = lang("CrErr3");
	} else {
		$option1 = test_input($_POST["option1"]);
		$option2 = test_input($_POST["option2"]);
	}
}

function test_input($data) {
	$data = trim($data);
	//$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (!empty($userid) && !empty($question) && !empty($option1) && !empty($option2)) {
	echo lang('CreateSuccess');
	
	$type = '1';
	$category = $_POST['category'];
	$privacy = '1';
	$language = lang('Language');
	$openstatus = '1';

	$sqlcreatepoll = "INSERT INTO Polltest (PollID, RegDate, UserID, Type, Category, Privacy, Language, OpenStatus) VALUES (NULL, (SELECT CURDATE()), '$userid', '$type', '$category', '$privacy', '$language', '$openstatus')";
	
	$conn->query($sqlcreatepoll);

	$sqlpollid = "SELECT PollID FROM Polltest WHERE RegDate=(SELECT CURDATE()) AND UserID='$userid' ORDER BY PollID DESC LIMIT 1";

	$sqlpollidresult = $conn->query($sqlpollid);
	if ($sqlpollidresult->num_rows > 0) {
		while($row = $sqlpollidresult->fetch_assoc()) {
			$_SESSION["PollID"] = $row['PollID'];
		}
		$pollid = $_SESSION["PollID"];
	}

	$sqlcreatequestion = "INSERT INTO Questiontest (QuestionID, PollID, Language, Option1, Option2, Option3, Option4, Option5, Question) VALUES (NULL, '$pollid', '$language', '$option1', '$option2', '$option3', '$option4', '$option5', '$question')";
	$conn->query($sqlcreatequestion);
	$conn->close();

	$_POST["option1"] = NULL;
	$_POST["option2"] = NULL;
	$_POST["option3"] = NULL;
	$_POST["option4"] = NULL;
	$_POST["option5"] = NULL;
	$_POST["question"] = NULL;
		
}
?>




<div class="container text-left">
    <!-- before ja after hoiavad javascripti jaoks andmeid?::before-->
	<div class="col-sm-10">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		<fieldset>
		<legend><?php echo lang("CrNewPoll"); ?></legend>
			<div id="lang">
				<label for="questLang"><?php echo lang("QuestLang"); ?></label> 
				<select id="questLang">
				<option value="Eng"><?php echo lang("English"); ?></option>
				<option value="Est"><?php echo lang("Estonian"); ?></option>
				</select>
			</div>
			<div class="valError"></div>
			<br>
			<label for="question"><?php echo lang("CrQuest"); ?></label>
			<input type="text" id="question" name="question" class="form-control" value="<?= isset($_POST['question']) ? $_POST['question'] : ''; ?>">
			<span class="error"> <?php echo $questionErr;?></span>
			<br>
			<label for="category"><?php echo lang("CrCategory"); ?></label>
			<input type="text" id="category" name="category" class="form-control" value="<?= isset($_POST['category']) ? $_POST['category'] : ''; ?>">
			<br>
			<h3><?php echo lang("CrInfo"); ?></h3>
			<br>
			<label for="option1"><?php echo lang("CrAns"); ?>1:</label>
			<input type="text" id="option1" name="option1" class="form-control" value="<?= isset($_POST['option1']) ? $_POST['option1'] : ''; ?>">
			<span class="error"> <?php echo $option1err;?></span>
			<br>
			<label for="option2"><?php echo lang("CrAns"); ?>2:</label>
			<input type="text" id="option2" name="option2" class="form-control" value="<?= isset($_POST['option2']) ? $_POST['option2'] : ''; ?>">
			<span class="error"> <?php echo $option2err;?></span>
			<br>
			<label for="option3"><?php echo lang("CrAns"); ?>3:</label>
			<input type="text" id="option3" name="option3" class="form-control" value="<?= isset($_POST['option3']) ? $_POST['option3'] : ''; ?>">
			<span class="error"> <?php echo $option3err;?></span>
			<br>
			<label for="option4"><?php echo lang("CrAns"); ?>4:</label>
			<input type="text" id="option4" name="option4" class="form-control" value="<?= isset($_POST['option4']) ? $_POST['option4'] : ''; ?>">
			<span class="error"> <?php echo $option4err;?></span>
			<br>
			<label for="option5"><?php echo lang("CrAns"); ?>5:</label>
			<input type="text" id="option5" name="option5" class="form-control" value="<?= isset($_POST['option5']) ? $_POST['option5'] : ''; ?>">
			<span class="error"> <?php echo $option5err;?></span>
			<br>
			</fieldset>

			<input value=<?php echo lang("Create"); ?> class="btn btn-primary btn-md" type="submit">
		</form>   
	</div>
	<!--::after-->  
</div>

<?php
if(empty($questionErr) and empty($option1err))
{
	//echo 'vist nii saab tingimused täidetud saatmiseks';
	//kuidagi nii andmed saata?
	//kuskil ka kontrollib keeleväärtust, et õigesse lahtrisse saata?
	/*
	$sql = mysql_query("insert into __nimi__ values __nimi__");
	$sql = mysql_query("insert into __nimi__ values __nimi__");
	*/
}

?>