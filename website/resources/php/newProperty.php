<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = 'root'; // <-- Toggle
	//$pass = ''; // <-- Toggle
	$dbname = 'realestate_db';

	$db = new mysqli($host,$user,$pass,$dbname);

	$maxQuery = "SELECT MAX(pid) FROM PROPERTY;";

	$maxResult = $db->query($maxQuery);

	$row = $maxResult->fetch_assoc();

	$pid = implode(",", $row) + 1;

	$maxResult->free();

	$userid = $_POST['sid'];

	//$db->close();

	//echo $pid;

	//echo "It works";

	$query = getQuery($userid, $pid);

	//$connection = mysqli_connect($host,$user,$pass,$dbname);
	//$result = mysql_query($connection,$query);

	$result = $db->query($query); //uncomment
	//$db->close();
	//$result->close();

	//echo $query;
	echo $pid;

	function getQuery($sid, $pid){
		global $db;

		$first = true;
		
		$attributes = "";
		$values = "";

		if(isset($_POST["addr"])){
			$addr = $_POST["addr"];
			if($addr != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$addr."'";
				$attributes .= "addr";
			}
		}
		if(isset($_POST["city"])){
			$city = $_POST["city"];
			if($city != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$city."'";
				$attributes .= "city";
			}
		}
		if(isset($_POST["state"])){
			$state = $_POST["state"];
			if($state != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$better = getState($state);
				$values .= "'".$better."'";
				$attributes .= "state";
			}
		}
		if(isset($_POST["zip"])){
			$zip = $_POST["zip"];
			if($zip != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$zip."'";
				$attributes .= "zip";
			}
		}
		if(isset($_POST["homeSize"])){
			$homeSize = $_POST["homeSize"];
			if($homeSize != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$homeSize."'";
				$attributes .= "homeSize";
			}
		}
		if(isset($_POST["lotSize"])){
			$lotSize = $_POST["lotSize"];
			if($lotSize != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$lotSize."'";
				$attributes .= "lotSize";
			}
		}
		if(isset($_POST["beds"])){
			$beds = $_POST["beds"];
			if($beds != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$beds."'";
				$attributes .= "beds";
			}
		}
		if(isset($_POST["baths"])){
			$baths = $_POST["baths"];
			if($baths != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$baths."'";
				$attributes .= "baths";
			}
		}
		if(isset($_POST["yearBuilt"])){
			$yearBuilt = $_POST["yearBuilt"];
			if($yearBuilt != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$yearBuilt."'";
				$attributes .= "yearBuilt";
			}
		}
		if(isset($_POST["price"])){
			$price = $_POST["price"];
			if($price != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$price."'";
				$attributes .= "price";
			}
		}
		if(isset($_POST["description"])){
			$description = $_POST["description"];
			if($description != ""){
				if(!$first){
					$values .= ", ";
					$attributes .= ", ";
				}
				else{
					$first = false;
				}
				$values .= "'".$description."'";
				$attributes .= "description";
			}
		}

		//$maxPid = $maxResult->fetch_assoc()["MAX(pid)"];


		//$pid = $maxPid + 1;
		$attributes .= ", sellerID, pid";
		$values .= ", " . $sid . ", " . $pid;

		$query = "INSERT INTO PROPERTY ({$attributes}) VALUES ({$values});";

		return $query;
		//return $maxPid;
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function getState($data){
		$state = "";

		switch (strtoupper($data)) {
		    case "ALABAMA":
		        $state = "AL";
		        break;
		    case "ALASKA":
		        $state = "AK";
		        break;
		    case "ARIZONA":
		        $state = "AZ";
		        break;
		    case "ARKANSAS":
		        $state = "AR";
		        break;
		    case "CALIFORNIA":
		        $state = "CA";
		        break;
		    case "COLORADO":
		        $state = "CO";
		        break;
		    case "CONNECTICUT":
		        $state = "CT";
		        break;
		    case "DELAWARE":
		        $state = "DE";
		        break;
		    case "FLORIDA":
		        $state = "FL";
		        break;
		    case "GEORGIA":
		        $state = "GA";
		        break;
		    case "HAWAII":
		        $state = "HI";
		        break;
		    case "IDAHO":
		        $state = "ID";
		        break;
		    case "ILLINOIS":
		        $state = "IL";
		        break;
		    case "INDIANA":
		        $state = "IN";
		        break;
		    case "IOWA":
		        $state = "IA";
		        break;
		    case "KANSAS":
		        $state = "KS";
		        break;
		    case "KENTUCKY":
		        $state = "KY";
		        break;
		    case "LOUISIANA":
		        $state = "LA";
		        break;
		    case "MAINE":
		        $state = "ME";
		        break;
		    case "MARYLAND":
		        $state = "MD";
		        break;
		    case "MASSACHUSETTS":
		        $state = "MA";
		        break;
		    case "MICHIGAN":
		        $state = "MI";
		        break;
		    case "MINNESOTA":
		        $state = "MN";
		        break;
		    case "MISSISSIPPI":
		        $state = "MS";
		        break;
		    case "MISSOURI":
		        $state = "MO";
		        break;
		    case "MONTANA":
		        $state = "MT";
		        break;
		    case "NEBRASKA":
		        $state = "NE";
		        break;
		    case "NEVADA":
		        $state = "NV";
		        break;
		    case "NEW HAMPSHIRE":
		        $state = "NH";
		        break;
		    case "NEW JERSEY":
		        $state = "NJ";
		        break;
		    case "NEW MEXICO":
		        $state = "NM";
		        break;
		    case "NEW YORK":
		        $state = "NY";
		        break;
		    case "NORTH CAROLINA":
		        $state = "NC";
		        break;
		    case "NORTH DAKOTA":
		        $state = "ND";
		        break;
		    case "OHIO":
		        $state = "OH";
		        break;
		    case "OKLAHOMA":
		        $state = "OK";
		        break;
		    case "OREGON":
		    	$state = "OR";
		    	break;
		    case "PENNSYLVANIA":
		        $state = "PA";
		        break;
		    case "RHODE ISLAND":
		        $state = "RI";
		        break;
		    case "SOUTH CAROLINA":
		        $state = "SC";
		        break;
		    case "SOUTH DAKOTA":
		        $state = "SD";
		        break;
		    case "TENNESSEE":
		        $state = "TN";
		        break;
		    case "TEXAS":
		        $state = "TX";
		        break;
		    case "UTAH":
		        $state = "UT";
		        break;
		    case "VERMONT":
		        $state = "VT";
		        break;
		    case "VIRGINIA":
		        $state = "VA";
		        break;
		    case "WASHINGTON":
		        $state = "WA";
		        break;
		    case "WEST VIRGINIA":
		        $state = "WV";
		        break;
		    case "WISCONSIN":
		        $state = "WI";
		        break;
		    case "WYOMING":
		        $state = "WY";
		        break;
		    default:
		    	$state = $data;
		    	break;
		}

		return $state;
	}
?>