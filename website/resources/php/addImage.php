<?php
		//$con = mysqli_connect('localhost', 'root', '', 'realestate_db');
		$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
		mysqli_select_db($con, "realestate_db");
		
		//echo "It worked";

		$pid = $_POST['pid'];

		$imageName = mysqli_real_escape_string($con, $_FILES["image"]["name"]);
		$imageData = mysqli_real_escape_string($con, file_get_contents($_FILES["image"]["tmp_name"]));
		$imageType = mysqli_real_escape_string($con, $_FILES["image"]["type"]);

		
		if(substr($imageType,0,5) == "image")
		{
			$numRows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM Picture WHERE pid = " . $_POST['pid']));
			$pictureNum = $numRows + 1;
			$resultPID = mysqli_query($con, "SELECT MAX(pictureID) FROM PICTURE;");

			//echo "It worked";

			$newPictureID = mysqli_fetch_array($resultPID)[0] + 1; //Check

			//echo $newPictureID;

			$filename = $pid."_".$pictureNum.".jpg";

			//echo $filename;

			$filepath = "resources/images/property/". $filename;

			$target_dir = "../images/property/".$filename; //From the PHP file

			move_uploaded_file($_FILES['image']['tmp_name'], $target_dir);


			$isPrimary = '0'; //Fix later
			if($numRows == 0){
				$isPrimary = '1';
			}

			$query = "INSERT INTO picture VALUES({$newPictureID}, '{$filepath}', " . $pid . ", {$isPrimary})";

			//echo $query;

			mysqli_query($con, $query);
			
			//echo "It worked";

			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
?>