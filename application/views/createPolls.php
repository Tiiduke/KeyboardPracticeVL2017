<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$questionErr = $option1err = $option2err = $option3err = $option4err = $option5err = "";
$question = $option1 = $option2 = $option3 = $option4 = $option5 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["question"])) {
		$questionErr = lang("CrErr1");
	} else {
		$name = test_input($_POST["question"]);
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
?>

<div class="container text-left">
    <!-- before ja after hoiavad javascripti jaoks andmeid?::before-->
	<div class="col-sm-10">
		<h2><?php echo lang("CrNewPoll"); ?></h2>
		<div id="lang">
			<label for="questLang"><?php echo lang("QuestLang"); ?></label> 
			<select id="questLang">
			<option value="Eng"><?php echo lang("English"); ?></option>
			<option value="Est"><?php echo lang("Estonian"); ?></option>
			</select>
		</div>
		<div class="valError"></div>
		<!--Pane tähele et siin on vale lehekülg action'i jaoks-->
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			<label for="question"><?php echo lang("CrQuest"); ?></label>
			<input type="text" id="question" name="question" class="form-control" value="<?= isset($_POST['question']) ? $_POST['question'] : ''; ?>">
			<span class="error"> <?php echo $questionErr;?></span>
			<br>
			<h3><?php echo lang("CrInfo"); ?></h3>
			<br>
			<label for="option1"><?php echo lang("CrAns"); ?>1:</label>
			<input type="text" id="option2" name="option1" class="form-control" value="<?= isset($_POST['option1']) ? $_POST['option1'] : ''; ?>">
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
			<input value=<?php echo lang("Create"); ?> class="btn btn-primary btn-md" type="Submit">
		</form>   
	</div>
	<!--::after-->  
</div>
