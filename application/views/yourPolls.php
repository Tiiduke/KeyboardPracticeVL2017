<!--
To whom it may concern: this view is intended to show a logged in persons
polls, that they have made. Should you not be logged in, however, it should
redirect you to the login screen
-->

<div id="yourPollsTable">
	<?php
		$email = $_SESSION['email'];
		$language = lang('Language');

		if(!isset($_SESSION)) { 
			session_start();
		}
		include 'dbConnect.php';
		
		if ($email == "") {
			echo '<div id="beLoggedIn1">'.lang("YourPollsLogin").'</div>';
			
		} else {
			if (empty($_GET['delete'])){
			} else {
				$pollid = $_GET['delete'];
				$sqldelquestion = "DELETE FROM Questiontest WHERE PollID = '$pollid'";
				$sqldelpoll = "DELETE FROM Polltest WHERE PollID = '$pollid'";
				$conn->query($sqldelquestion);
				$conn->query($sqldelpoll);
				echo lang('PollDeleteSuccess');
			}

			$sqlpolls = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question FROM Usertest INNER JOIN (Polltest INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Usertest.Email = '$email' AND Usertest.Language = Questiontest.Language ORDER BY Polltest.PollID ASC";
			$pollsresult = $conn->query($sqlpolls);
			if ($pollsresult->num_rows > 0) {
				echo lang("YourPollsIntro");
				echo '<table class="table table-striped table-bordered table-hover">';
				echo "<tr><th>PollID:</th><th>Author:</th><th>Category:</th><th>Question:</th><th>Delete:</th></tr>"; 
				// output data of each row
				while($row = $pollsresult->fetch_assoc()) {
					echo "<tr><td>"; 
					echo $row['PollID'];
					echo "</td><td>";   
					echo $row['Email'];
					echo "</td><td>";    
					echo $row['Category'];
					echo "</td><td>";    
					echo $row['Question'];
					echo "</td><td>";    
					echo '<a href=" ' . base_url() . 'index.php/welcome/yourPolls?delete=' . $row['PollID'] . ' ">' . lang("Delete") . '</a>';
					echo "</td></tr>";  
				}
				echo '</table>';
			}
			

			$sqlanswers = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question, COUNT(Answerstest.Answer) AS Answers, Questiontest.Option1, ROUND(((SUM(CASE WHEN Answerstest.Answer = '1' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers1, Questiontest.Option2, ROUND(((SUM(CASE WHEN Answerstest.Answer = '2' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers2, Questiontest.Option3, ROUND(((SUM(CASE WHEN Answerstest.Answer = '3' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers3, Questiontest.Option4, ROUND(((SUM(CASE WHEN Answerstest.Answer = '4' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers4, Questiontest.Option5, ROUND(((SUM(CASE WHEN Answerstest.Answer = '5' THEN 1 ELSE 0 END))/(COUNT(Answerstest.Answer)))*100,1) AS Answers5 FROM Usertest INNER JOIN ((Polltest INNER JOIN Answerstest ON Polltest.PollID = Answerstest.PollID) INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Usertest.Email = '$email' AND Questiontest.Language = '$language' GROUP BY Answerstest.PollID ORDER BY Polltest.PollID ASC";
			$answersresult = $conn->query($sqlanswers);
			if ($answersresult->num_rows > 0) {
				echo lang("YourPollsAnswers");
				echo '<table class="table table-striped table-bordered table-hover">';
				echo "<tr><th>PollID:</th><th>Author:</th><th>Category:</th><th>Question:</th><th>Answer Count:</th><th>Answers:</th></tr>"; 
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
			} elseif ($pollsresult->num_rows == 0){
				echo lang("YourPollsNone");
			}
			$conn->close();
		}
		?>
</div>
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
	<!--Delete-->
	<input type="hidden" id="delete">
</form>
