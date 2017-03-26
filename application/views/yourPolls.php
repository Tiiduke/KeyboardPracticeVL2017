<!--
To whom it may concern: this view is intended to show a logged in persons
polls, that they have made. Should you not be logged in, however, it should
redirect you to the login screen
-->

<div id="yourPollsTable">
	<?php
		session_start();
		include 'dbConnect.php';
		
		$sql = "SELECT p.pollid, p.category, q.question FROM Polltest AS p INNER JOIN Questiontest AS q WHERE p.pollid=q.pollid AND q.language='Est'";
		$result = $conn->query($sql);
		echo '<table class="table table-striped table-bordered table-hover">';
		echo "<tr><th>PollID:</th><th>User:</th><th>Category:</th></tr>"; 
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>"; 
				echo $row['pollid'];
				echo "</td><td>";   
				echo $row['category'];
				echo "</td><td>";    
				echo $row['question'];
				echo "</td></tr>";  
			}
		} else {
			echo "0 results";
		}
		echo '</table>';
		$conn->close();
		?>
</div>
