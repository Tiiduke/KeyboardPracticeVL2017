<?php
	$servername = "localhost";
	$username = "vl2017r4t1csut_testuser";
	$password = "1234567890";
	$dbname = "vl2017r4t1csut_test";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>