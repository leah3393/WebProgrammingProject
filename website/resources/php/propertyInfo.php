<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		echo 
			"<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"utf-8\">
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name=\"description\" content=\"\">
		<meta name=\"author\" content=\"\">
		<link rel=\"icon\" type=\"image/png\" href=\"../images/icon.png\" />

		<title>Online Realtor</title>
		<link href=\"../css/bootstrap.min.css\" rel=\"stylesheet\">
		<link href=\"../css/index.css\" rel=\"stylesheet\">
	</head>
	<body>
	
		<!-- Fixed navbar -->
		<nav class=\"navbar navbar-default navbar-fixed-top\">
			<div class=\"container\">
				<div class=\"navbar-header\">
					<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
						<span class=\"sr-only\">Toggle navigation</span>
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span>
					</button>
					<a class=\"navbar-brand\" href=\"#\">Online Realtor</a>
				</div>
				<div id=\"navbar\" class=\"navbar-collapse collapse\">
					<ul class=\"nav navbar-nav navbar-right\">
						<li class=\"dropdown\" id=\"user\" style=\"display:none\"><a href=\"#\">Username</a></li>
						<li class=\"dropdown\" id=\"dropdown-login\" style=\"display:none\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Login <span class=\"caret\"></span></a>
							<ul class=\"dropdown-menu\" role=\"menu\">
								<form id=\"loginform\" class=\"navbar-form\" method=\"post\">
									<div class=\"form-group\">
									    <label for=\"email\">Email</label>
									    <input type=\"email\" class=\"form-control login-item\" id=\"email\" name=\"email\" placeholder=\"email\">
									</div>
									<div class=\"form-group\">
									    <label for=\"password\">Password</label>
									    <input type=\"password\" class=\"form-control login-item\" id=\"password\" name=\"password\" placeholder=\"password\">
									</div>
									
									<div >
									    <label>
									      <input type=\"checkbox\"> Remember Me
									    </label>
									</div>
									<div>
										<input class=\"btn btn-primary btn-block\" type=\"submit\" id=\"sign-in\" value=\"Sign In\">
									</div>
									<div id=\"fail\"></div>
								</form>
							</ul>
						</li>
						<li id=\"register\" style=\"display:none\"><a href=\"register.html\">Register</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>";
		
		$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
		if(!$con)
		{
			die('Could not connect: ' . mysqli_error($con));
		}		
		mysqli_select_db($con, "realestate_db");
		$sql = "SELECT * FROM property WHERE pid = " . $_POST["propertyID"];
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($result))
		{
			$query = mysqli_query($con, "SELECT * FROM picture WHERE pid = " . $row['pid']);
			while($innerRow = mysqli_fetch_array($query))
			{
				$imageID = $innerRow['pictureID'];
				echo "<img src='image.php?id={$imageID}' />";
			}
			echo "<p>" . $row['addr'] . " " . $row['city'] . " " . $row['state'] . " " . $row['zip'] . "</p>";
			echo "<p>" . $row['description'] . "</p>";
			echo "<p>Price: " . $row['price'] . "</p>";
			echo "<p>Home Size: " . $row['homeSize'] . "</p>";
			if($row['typeID'] == 1 || $row['typeID'] == 4)
				echo "<p>Lot Size: " . $row['lotSize'] . "</p>";
			echo "<p>Year Built: " . $row['yearBuilt'] . "</p>";
			echo "<p>Number of bedrooms: " . $row['beds'] . "</p>";
			echo "<p>Number of bathrooms: " . $row['baths'] . "</p>";
		}
		mysqli_close($con);
		
		echo 
			"<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>
		<script src=\"../js/bootstrap.min.js\"></script>
		<script src=\"../js/cookie/jquery.cookie.js\"></script>
		<script src=\"../js/login.js\"></script>
	</body>
</html>";
	}
?>