<div id="answerPollsTable">
	<?php
		$email = $_SESSION['email'];
		$userid = $_SESSION["userid"];
		$pollid = $_GET['pollid'];
		$language = lang('Language');

		if(!isset($_SESSION)) { 
			session_start();
		}
		
		include 'dbConnect.php';
		
		$sqlcheckifanswered = "SELECT PollID, UserID, Answer FROM Answerstest WHERE PollID = '$pollid' AND UserID = '$userid'";
		$getcheckresult = $conn->query($sqlcheckifanswered);
		if ($getcheckresult->num_rows > 0) {
			echo "<br>";
			echo lang("AlreadyAnswered");
			echo "<br><br>";
			$sqlanswers = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question, COUNT(Answerstest.Answer) AS Answers, Questiontest.Option1, ROUND(((SUM(CASE WHEN Answerstest.Answer = '1' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers1, Questiontest.Option2, ROUND(((SUM(CASE WHEN Answerstest.Answer = '2' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers2, Questiontest.Option3, ROUND(((SUM(CASE WHEN Answerstest.Answer = '3' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers3, Questiontest.Option4, ROUND(((SUM(CASE WHEN Answerstest.Answer = '4' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers4, Questiontest.Option5, ROUND(((SUM(CASE WHEN Answerstest.Answer = '5' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers5 FROM Usertest INNER JOIN ((Polltest INNER JOIN Answerstest ON Polltest.PollID = Answerstest.PollID) INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Polltest.PollID = '$pollid' AND Questiontest.Language = '$language' GROUP BY Answerstest.PollID ORDER BY Polltest.PollID ASC";
			$answersresult = $conn->query($sqlanswers);
			if ($answersresult->num_rows > 0) {
				echo '<table class="table table-striped table-bordered table-hover">';
				echo "<tr><th>";
				echo lang("PollID");
				echo ":</th><th>";
				echo lang("Author");
				echo ":</th><th>";
				echo lang("Category");
				echo ":</th><th>";
				echo lang("Question");
				echo ":</th><th>";
				echo lang("AnswerCount");
				echo ":</th><th>";
				echo lang("Answers");
				echo ":</th></tr>"; 
				// output data of each row
				while($row = $answersresult->fetch_assoc()) {
					echo "<tr><td>"; 
					echo $row['PollID'];
					echo "</td><td>";   
					echo $row['Email'];
					echo "</td><td>";    
					echo $row['Category'];
					echo "</td><td>";    
					echo $row['Question'];
					echo "</td><td>";    
					echo $row['Answers'];
					echo "</td><td>";    
					echo $row['Answers1'];
					echo "%: ";    
					echo $row['Option1'];
					echo "<br>";    
					echo $row['Answers2'];
					echo "%: ";    
					echo $row['Option2'];
					if (!empty($row['Option3'])){
						echo "<br>";    
						echo $row['Answers3'];
						echo "%: ";    
						echo $row['Option3'];
						if (!empty($row['Option4'])){
							echo "<br>";    
							echo $row['Answers4'];
							echo "%: ";    
							echo $row['Option4'];
							if (!empty($row['Option5'])){
								echo "<br>";    
								echo $row['Answers5'];
								echo "%: ";    
								echo $row['Option5'];
								echo "</td></tr>";
							}
						}
					}
				}
				echo '</table>';
			}
		} elseif ($email == "") {
			echo '<br>';
			echo lang("AnswerPollsLogin");
			include 'registerLogin.php';
		} else {
			if (empty($_GET['pollid'])){
				//enter code to display available polls or suggest a random poll
			} elseif (empty($_GET['option'])) {
				$pollid = $_GET['pollid'];
				$language = lang('Language');
				$sqlgetquestion = "SELECT Question, PollID, Option1, Option2, Option3, Option4, Option5 FROM Questiontest WHERE PollID = '$pollid' AND Language = '$language'";
				$getpollsresult = $conn->query($sqlgetquestion);
				if ($getpollsresult->num_rows > 0) {
					echo '<table class="table table-hover">';
					echo "<tr><th>PollID:</th><th>Question:</th><th>Options:</th></tr>"; 
					// output data of each row
					while($row = $getpollsresult->fetch_assoc()) {
						echo "<tr><td>";
						echo $row['PollID'];
						echo "</td><td>";
						echo $row['Question'];
						echo "</td><td>";
						echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . '&option=1">' . $row['Option1'] . '</a>';
						echo '<br>';
						echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . '&option=2">' . $row['Option2'] . '</a>';
						echo '<br>';
						echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . '&option=3">' . $row['Option3'] . '</a>';
						echo '<br>';
						echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . '&option=4">' . $row['Option4'] . '</a>';
						echo '<br>';
						echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . '&option=5">' . $row['Option5'] . '</a>';
						echo "</td></tr>";  
					}
					echo '</table>';
				}
			} else {
				echo lang('AnswerThanks');
				
				$pollid = $_GET['pollid'];
				$language = lang('Language');
				$answer = $_GET['option'];
				$sqlsaveanswer = "INSERT INTO Answerstest (AnswerID, UserID, PollID, Language, Answer) VALUES (NULL, '$userid', '$pollid', '$language', '$answer')";
				$conn->query($sqlsaveanswer);

			}

			$conn->close();
		}
		?>
</div>
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
	<!--Poll options-->
	<input type="hidden" id="pollid">
	<input type="hidden" id="option">
</form>
