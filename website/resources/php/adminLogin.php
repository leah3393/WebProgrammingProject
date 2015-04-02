<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if(strcasecmp($_POST["name"], "admin") == 0 && $_POST["password"] == "admin123")
		{
			header('location:adminUtility.php');
		}
		else
		{
			header('location:adminLogin.html');
		}
	}
?>