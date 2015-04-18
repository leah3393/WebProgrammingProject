<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	mysqli_query($con, "UPDATE property SET sold = 1 WHERE pid = " . $_POST["propertyID"]);
?>