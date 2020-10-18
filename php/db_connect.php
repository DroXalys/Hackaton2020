<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$db = "hackathon";
	$mysqli = mysqli_connect($server, $username, $password, $db );
	$mysqli->set_charset("utf8")
?>