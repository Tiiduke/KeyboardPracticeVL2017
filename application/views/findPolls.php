<!--
To whom it may concern:
currently, this screen does not have any kind of error throws, when, for example,
a text box is left unfilled. However, it most certainly would benefit from such
a thing, therefore, this needs to eventually be implemented, using either
JavaScript, or PHP, whichever strikes your fancy more.
-->

<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--Needs an actual separate webpage for this-->
<fieldset>
<legend><?php echo lang("SearchT"); ?></legend>

	<!--
	Võibolla asendada kahe sisendi asemel üks sisend ja dropdown, kus saab valida, kas autor või keyword,
	siis saab teha "FROM __vastavlahter__"  
	-->
	<!--
	<div id="catType">
		<label for="category"><?php echo lang("SearchCate"); ?></label> 
		<select id="category">
		<option value="cat1"><?php echo lang("Category3"); ?></option>
		<option value="cat2"><?php echo lang("Category4"); ?></option>
		</select>
	</div>
	-->
	
	<div id="nameEntry">
		<div class="kwLeft"><label for="keyword"><?php echo lang("SearchKey"); ?></label></div>
		<div class="kwRight"><input type="text" id="keyword" name="keyword" value=""><br></div>
		<div class="aLeft"><label for="author"><?php echo lang("SearchAuth"); ?></label> </div>
		<div class="aRight"><input type="text" id="author" name="author" value=""></div><br><br>
	</div>
	
	

	<!--WHERE __column?__ BETWEEN __date1__ AND __date2__-->
	<div id="ageFilter">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="../../js/datepick.js">
		</script>
		<?php echo lang("SearchFilAge"); ?> <label for="from"><?php echo lang("SearchAgeFr"); ?> </label>
		<input type="text" id="from" name="from">
		<label for="to"><?php echo lang("SearchAgeTo"); ?></label>
		<input type="text" id="to" name="to">
		 
	</div>
	
	<!--ORDER BY __column__ ASC|DESC-->
	<div id="newOrOld">
		<?php echo lang("SearchFilTim"); ?> <input type="radio" name="pollAge" id="newer" value="1" checked="checked">
		<label for="newer"><?php echo lang("SearchTimNew"); ?></label>
		<input type="radio" name="pollAge" id="older" value="2">
		<label for="older"><?php echo lang("SearchTimOld"); ?></label>
	</div>
	
	<!--Pakun et see on ebavajalik-->
	<!--
	<div id="popularityFilter">
		<?php //echo lang("SearchFilPop"); ?> <input type="radio" name="pollPopularity" id="more" value="1" checked="checked">
		<label for="more"><?php //echo lang("SearchPopMor"); ?></label>
		<input type="radio" name="pollPopularity" id="less" value="2">
		<label for="less"><?php //echo lang("SearchPopLes"); ?></label>
	</div>
	-->
	<!--Pakun et selle võiks ka maha võtta-->
	<!--
	<div id="pollActivity">
		<?php //echo lang("SearchFilAct"); ?> <input type="radio" name="pollActivity" id="active" value="1">
		<label for="active"><?php //echo lang("SearchPolAc"); ?></label>
		<input type="radio" name="pollActivity" id="closed" value="2">
		<label for="closed"><?php //echo lang("SearchPolCl"); ?></label>
		<input type="radio" name="pollActivity" id="all" value="3" checked="checked">
		<label for="all"><?php //echo lang("SearchPolAl"); ?></label>
	</div>
	-->
	
	</fieldset>
	
	<input type="submit" value=<?php echo lang("SearchSearch"); ?>>
</form>
<br>
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