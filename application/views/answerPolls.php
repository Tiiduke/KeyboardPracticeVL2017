<div id="answerPollsTable">
	<?php
		$email = $_SESSION['email'];
		$userid = $_SESSION["userid"];
		
		if(!isset($_SESSION)) { 
			session_start();
		}
		
		include 'dbConnect.php';
		
		if ($email == "") {
			echo lang("AnswerPollsLogin");
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
