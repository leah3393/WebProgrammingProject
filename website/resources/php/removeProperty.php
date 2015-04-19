<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	$query = "DELETE FROM FAVORITE WHERE pid = " . $_POST["pid"] . "; ";

	mysqli_query($con, $query);

	$query = "DELETE FROM PICTURE WHERE pid = " . $_POST["pid"] . "; ";

	mysqli_query($con, $query);

	$query = "DELETE FROM PROPERTY WHERE pid = " . $_POST["pid"] . "; ";

	mysqli_query($con, $query);

	echo $query;
?>