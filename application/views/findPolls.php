<!--
To whom it may concern:
currently, this screen does not have any kind of error throws, when, for example,
a text box is left unfilled. However, it most certainly would benefit from such
a thing, therefore, this needs to eventually be implemented, using either
JavaScript, or PHP, whichever strikes your fancy more.
-->

<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--Needs an actual separate webpage for this-->
<fieldset>
<legend id = "SearchT"><?php echo lang("SearchT"); ?></legend>

	<div id="nameEntry">
		<div class="kwLeft"><label for="keyword"><?php echo lang("SearchKey"); ?></label></div>
		<div class="kwRight"><input type="text" id="keyword" name="keyword" value=""><br></div>
		<div class="aLeft"><label for="author"><?php echo lang("SearchAuth"); ?></label> </div>
		<div class="aRight"><input type="text" id="author" name="author" value=""></div><br>
	</div>
	
	<!--ORDER BY __column__ ASC|DESC-->
	<div id="newOrOld">
		<div id="separate"><?php echo lang("SearchFilTim"); ?> </div>
		<input type="radio" name="pollAge" id="newer" value="1" checked="checked">
		<label for="newer"><?php echo lang("SearchTimNew"); ?></label>
		<input type="radio" name="pollAge" id="older" value="2">
		<label for="older"><?php echo lang("SearchTimOld"); ?></label>
	</div>
	<br>
	
	</fieldset>
	
	<input id = "searchB" type="submit" class="btn btn-primary btn-md" value=<?php echo lang("SearchSearch"); ?>>
</form>
<br>
<div id="fullTable">
<?php
	include 'dbConnect.php';
	$searchword = $_GET["keyword"];
	$searchauthor = $_GET["author"];
	if ($_GET["pollAge"] == '1') {
		$searchpollage = 'DESC';
	} else {
		$searchpollage = 'ASC';
	}
	$searchlanguage = lang('Language');
	
	$sqlsearch = "SELECT Polltest.PollID, Usertest.Email, Questiontest.Question, Polltest.RegDate
FROM Usertest INNER JOIN (Polltest INNER JOIN Questiontest ON Polltest.PollID = Questiontest.PollID) ON Usertest.UserID = Polltest.UserID WHERE Questiontest.Language = '$searchlanguage' AND LOWER(Question) LIKE LOWER('%$searchword%') AND LOWER(Email) LIKE LOWER('%$searchauthor%') ORDER BY RegDate $searchpollage";
	$searchresult = $conn->query($sqlsearch);
	if ($searchresult->num_rows > 0) {
		echo lang('Results');
		echo '<table class="table table-striped table-bordered table-hover">';
		echo "<tr><th>PollID:</th><th>Email:</th><th>Question:</th><th>RegDate:</th></tr>"; 
		// output data of each row
		while($row = $searchresult->fetch_assoc()) {
			echo "<tr><td>"; 
			echo $row['PollID'];
			echo "</td><td>";   
			echo $row['Email'];
			echo "</td><td>";    
			echo '<a href=" ' . base_url() . 'index.php/welcome/answerPolls?pollid=' . $row['PollID'] . ' ">' . $row['Question'] . '</a>';
			echo "</td><td>";    
			echo $row['RegDate'];
			echo "</td></tr>";  
		}
		echo '</table>';
	} elseif ($searchresult->num_rows == 0){
		echo lang('NoResults');
	}
	$conn->close();
	
?>
</div>