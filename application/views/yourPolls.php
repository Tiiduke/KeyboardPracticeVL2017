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
			$sql = "SELECT Polltest.PollID, Usertest.Email, Polltest.Category, Questiontest.Question, Answerstest.Answer FROM Usertest INNER JOIN ((Polltest INNER JOIN Answerstest ON Polltest.PollID = Answerstest.PollID) INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Usertest.Email = '$email' AND Usertest.Language = Questiontest.Language";
			$result = $conn->query($sql);
			echo '<table class="table table-striped table-bordered table-hover">';
			echo "<tr><th>PollID:</th><th>Author:</th><th>Category:</th><th>Question:</th><th>Answer:</th></tr>"; 
			if ($result->num_rows > 0) {
				echo lang("YourPollsIntro");
				// output data of each row
				while($row = $result->fetch_assoc()) {
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
			} elseif ($result->num_rows == 0){
				echo lang("YourPollsNone");
			}
			echo '</table>';
			$conn->close();
		}
		?>
</div>
