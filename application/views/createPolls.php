<?php 
//build up variables for showing errors in case some data is incorrect or not filled
$questionErr = $option1err = $option2err = $option3err = $option4err = $option5err = "";
$question = $option1 = $option2 = $option3 = $option4 = $option5 = "";

$email = $_SESSION['email'];
$userid = $_SESSION['UserID'];

include 'dbConnect.php';
ini_set('display_errors','Off');

if ($email == "") {
	echo '<div id="beLoggedIn2">'.lang("CreatePollsLogin").'</div>';
} else {
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




	//displaying html in php for the sake of checking login status and restricting content
	echo '<div class="container text-left">';
		echo '<div class="col-sm-10">';
			echo '<form method="POST" action="';
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo '">';
			echo '<fieldset>';
			echo '<legend>';
			echo lang("CrNewPoll");
			echo '</legend>';
				echo '<label for="question">';
				echo lang("CrQuest");
				echo '</label>';
				echo '<input type="text" id="question" name="question" class="form-control" value="';
				isset($_POST["question"]) ? $_POST["question"] : '';
				echo '">';
				echo '<span class="error">';
				echo $questionErr;
				echo '</span>';
				echo '<br>';
				echo '<label for="category">';
				echo lang("CrCategory");
				echo '</label>';
				echo '<input type="text" id="category" name="category" class="form-control" value="';
				isset($_POST["category"]) ? $_POST["category"] : '';
				echo '">';
				echo '<br>';
				echo '<h3>';
				echo lang("CrInfo");
				echo '</h3>';
				echo '<br>';
				echo '<label for="option1">';
				echo lang("CrAns");
				echo '1:</label>';
				echo '<input type="text" id="option1" name="option1" class="form-control" value="';
				isset($_POST["option1"]) ? $_POST["option1"] : '';
				echo '">';
				echo '<span class="error">';
				echo $option1err;
				echo '</span>';
				echo '<br>';
				echo '<label for="option2">';
				echo lang("CrAns");
				echo '2:</label>';
				echo '<input type="text" id="option2" name="option2" class="form-control" value="';
				isset($_POST["option2"]) ? $_POST["option2"] : '';
				echo '">';
				echo '<span class="error">';
				echo $option2err;
				echo '</span>';
				echo '<br>';
				echo '<label for="option3">';
				echo lang("CrAns");
				echo '3:</label>';
				echo '<input type="text" id="option3" name="option3" class="form-control" value="';
				isset($_POST["option3"]) ? $_POST["option3"] : '';
				echo '">';
				echo '<span class="error">';
				echo $option3err;
				echo '</span>';
				echo '<br>';
				echo '<label for="option4">';
				echo lang("CrAns");
				echo '4:</label>';
				echo '<input type="text" id="option4" name="option4" class="form-control" value="';
				isset($_POST["option4"]) ? $_POST["option4"] : '';
				echo '">';
				echo '<span class="error">';
				echo $option4err;
				echo '</span>';
				echo '<br>';
				echo '<label for="option5">';
				echo lang("CrAns");
				echo '5:</label>';
				echo '<input type="text" id="option5" name="option5" class="form-control" value="';
				isset($_POST["option5"]) ? $_POST["option5"] : '';
				echo '">';
				echo '<span class="error">';
				echo $option5err;
				echo '</span>';
				echo '<br>';
				echo '</fieldset>';
				echo '<input value=';
				echo lang("Create");
				echo 'class="btn btn-primary btn-md" type="submit">';
			echo '</form>';
		echo '</div>';
	echo '</div>';
}
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