<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	mysqli_query($con, "DELETE FROM picture WHERE pictureID = " . $_POST["pictureID"]);
?>