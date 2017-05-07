<!--
To whom it may concern: this view is intended to show a logged in persons
polls, that they have made. Should you not be logged in, however, it should
redirect you to the login screen
-->

<div id="yourPollsTable">
	<?php
		$email = $_SESSION['email'];
		if(!isset($_SESSION)) { 
			session_start();
		}
		include 'dbConnect.php';
		
		if ($email == "") {
			echo lang("YourPollsLogin");
		} else {
			$sqlpolls = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question FROM Usertest INNER JOIN (Polltest INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Usertest.Email = '$email' AND Usertest.Language = Questiontest.Language ORDER BY Polltest.PollID ASC";
			$pollsresult = $conn->query($sqlpolls);
			echo '<table class="table table-striped table-bordered table-hover">';
			echo "<tr><th>PollID:</th><th>Author:</th><th>Category:</th><th>Question:</th><th>Delete:</th></tr>"; 
			if ($pollsresult->num_rows > 0) {
				echo lang("YourPollsIntro");
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

			}
			$sqlanswers = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question, Answerstest.Answer FROM Usertest INNER JOIN ((Polltest INNER JOIN Answerstest ON Polltest.PollID = Answerstest.PollID) INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Usertest.Email = '$email' AND Usertest.Language = Questiontest.Language ORDER BY Polltest.PollID ASC";
			$answersresult = $conn->query($sqlanswers);
			echo '<table class="table table-striped table-bordered table-hover">';
			echo "<tr><th>PollID:</th><th>Author:</th><th>Category:</th><th>Question:</th><th>Answer:</th></tr>"; 
			if ($answersresult->num_rows > 0) {
				echo lang("YourPollsIntro");
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
					echo $row['Answer'];
					echo "</td></tr>";  
				}
			} elseif ($pollsresult->num_rows == 0){
				echo lang("YourPollsNone");
			}
			echo '</table>';
			$conn->close();
		}
		?>
</div>
