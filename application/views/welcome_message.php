<div id="container">
	<h1 id = "WelcomeT"><?php echo lang("WelcomeToPollerina"); ?></h1>
	<p id="Welcome1"><?php echo lang("WelcomeText1"); ?></p>
	<p id ="Welcome2"><?php echo lang("WelcomeText2"); ?></p>

<div id="registrations">
<?php	
	include 'dbConnect.php';
	ini_set('display_errors','Off');
	$sqlusercount = "SELECT COUNT(userid) AS usercount FROM Usertest";
	$sqluserresult = $conn->query($sqlusercount);
	if ($sqluserresult->num_rows > 0) {
		while($row = $sqluserresult->fetch_assoc()) {
			$_SESSION["usercount"] = $row['usercount'];
		}
	}
	
	$sqlpollcount = "SELECT COUNT(pollid) AS pollcount FROM Polltest";
	$sqlpollresult = $conn->query($sqlpollcount);
	if ($sqlpollresult->num_rows > 0) {
		while($row = $sqlpollresult->fetch_assoc()) {
			$_SESSION["pollcount"] = $row['pollcount'];
		}
	}
	$registeredResults = lang('UsercountText') . $_SESSION["usercount"] . lang('PollcountText') . $_SESSION["pollcount"] . ".";
	echo $registeredResults;
	$conn->close();
?>
</div>
</div>
