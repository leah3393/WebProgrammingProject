<?php 
	define(HOST, "localhost");
	define(USER, "root");
	define(PW, "root");
	define(DB, "realestate_db");

	$connect = mysql_connect(HOST,USER,PW) or die('Could not connect to mysql server.');

	mysql_select_db(DB, $connect) or die('Could not select database.');

	$query = make_query();

	//echo $query;

	$result = mysql_query($query);

	$json = '{"properties": [';
	$first = True;

	if(mysql_num_rows($result) > 0){
		while($row = mysql_fetch_object($result)){
			$photo = get_photo($row->pid);
			if($first){
				$json .= '{"pid": "'.$row->pid.'", "addr": "'.$row->addr.'", "city": "'.$row->city.'", "state": "'.$row->state.'", "price": "'.$row->price.'", "photo": "'.$photo.'"}';
				$first = False;
			}
			else{
				$json .= ',{"pid": "'.$row->pid.'", "addr": "'.$row->addr.'", "city": "'.$row->city.'", "state": "'.$row->state.'", "price": "'.$row->price.'", "photo": "'.$photo.'"}';
			}
		}
	}

	$json .= ']}';

	echo $json;

	function make_query(){
		$params = array();
		$query = "SELECT * FROM PROPERTY";
		$first = True;

		/*  LOCATION  */
		if(isset($_POST['location'])){
			$location = test_input($_POST["location"]);

			if($location != ""){
				$loc = explode(',', $location);

				if(count($loc) == 1){
					$state = get_state($loc[0]);
					$params['state'] = $state;
				}
				else{
					$state = get_state($loc[1]);
					$params['state'] = $state;
					$params['city'] = $loc[0];
				}

				foreach($params as $key => $value){
					if($first){
						$query .= " WHERE PROPERTY.".$key." = '".$value."'";
						$first = False;
					}
					else{
						$query .= " AND PROPERTY.".$key." = '".$value."'";
					}
				}
			}

		}
		/*  NUMBER OF BEDROOMS  */
		if(isset($_POST['beds'])){
			$beds = test_input($_POST["beds"]);
			if($beds != '0'){
				if($first){
					$query .= " WHERE PROPERTY.beds >= ".$beds;	
					$first = False;	
				}
				else{
					$query .= " AND PROPERTY.beds >= ".$beds;
				}
			}
		}
		/*  SQUARE FOOTAGE  */
		if(isset($_POST['sqftmin'])){
			$sqftmin = test_input($_POST["sqftmin"]);
			if($sqftmin != "0"){
				if($first){
					$query .= " WHERE PROPERTY.homeSize >= ".$sqftmin;	
					$first = False;	
				}
				else{
					$query .= " AND PROPERTY.homeSize >= ".$sqftmin;
				}
			}
		}

		if(isset($_POST['sqftmax'])){
			$sqftmax = test_input($_POST["sqftmax"]);
			if($sqftmax != 'any'){
				if($first){
					$query .= " WHERE PROPERTY.homeSize <= ".$sqftmax;	
					$first = False;	
				}
				else{
					$query .= " AND PROPERTY.homeSize <= ".$sqftmax;
				}
			}
		}

		/*  TYPE  */
		$firstOption = True;
		$propertyType = $_POST['propertyType'];
		if(empty($propertyType)){
			//echo "No PROPERTIES";
		}
		elseif(count($propertyType) == 6){
			//echo "ALL PROPERTIES";
		}
		else{
			$n = count($propertyType);
			//echo $n . " PROPERTIES";
			for($i=0; $i < $n; $i++){
				if($propertyType[$i] == "house"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 0";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 0";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 0";
					}
				}
				if($propertyType[$i] == "condo"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 1";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 1";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 1";
					}
				}
				if($propertyType[$i] == "apartment"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 2";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 2";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 2";
					}
				}
				if($propertyType[$i] == "townhome"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 3";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 3";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 3";
					}
				}
				if($propertyType[$i] == "manufactured"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 4";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 4";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 4";
					}
				}
				if($propertyType[$i] == "lotland"){
					if($first){
						$query .= " WHERE (PROPERTY.typeID = 5";
						$first = False;
						$firstOption = False;
					}
					else if($firstOption){
						$query .= " AND (PROPERTY.typeID = 5";
						$firstOption = False;
					}
					else{
						$query .= " OR PROPERTY.typeID = 5";
					}
				}
			}

			$query .= ")";
		}

		/* PRICE RANGE */
		if(isset($_POST['pricemin'])){
			$pricemin = test_input($_POST["pricemin"]);
			if($pricemin != "0"){
				if($first){
					$query .= " WHERE PROPERTY.price >= ".$pricemin;	
					$first = False;	
				}
				else{
					$query .= " AND PROPERTY.price >= ".$pricemin;
				}
			}
		}

		if(isset($_POST['pricemax'])){
			$pricemax = test_input($_POST["pricemax"]);
			if($pricemax != 'any'){
				if($first){
					$query .= " WHERE PROPERTY.price <= ".$pricemax;	
					$first = False;	
				}
				else{
					$query .= " AND PROPERTY.price <= ".$pricemax;
				}
			}
		}

		return $query;
	}

	function get_state($data){
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

	function get_photo($pid){
		return 'resources/images/property/449344_1.jpg';
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>