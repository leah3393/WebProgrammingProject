<?php
	if(isset($_POST['submit']))
	{
		$con = mysqli_connect('localhost', 'root', '', 'realestate_db');
		mysqli_select_db($con, "realestate_db");
		
		$imageName = mysqli_real_escape_string($con, $_FILES["image"]["name"]);
		$imageData = mysqli_real_escape_string($con, file_get_contents($_FILES["image"]["tmp_name"]));
		$imageType = mysqli_real_escape_string($con, $_FILES["image"]["type"]);
		
		if(substr($imageType,0,5) == "image")
		{
			$numRows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM Picture WHERE pid = " . $_POST['pid']));
			mysqli_query($con, "INSERT INTO picture VALUES({$numRows} + 1, '{$imageData}', " . $_POST['pid'] . ", false)");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
?>