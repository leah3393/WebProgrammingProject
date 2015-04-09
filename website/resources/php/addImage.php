<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<form action="addImage.php" method="post" enctype="multipart/form-data">
			<input type="file" name="image"><input type="submit" name="submit" value="Upload">
		</form>
		
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
				mysqli_query($con, "INSERT INTO picture VALUES(1, '{$imageData}', 1, true)");
			}
		}
	?>
	</body>
</html>