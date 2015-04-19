$(document).ready(function() 
{
	var buyer_seller;
	var sellerID = 0;
	cookie1 = $.cookie('type');
	cookie2 = $.cookie('userid');
	if(cookie1 != undefined)
	{
		if(cookie1 == "buyer") 
		{
			buyer_seller = "buyer";
			sellerID = cookie2;
		}
		else 
		{
			buyer_seller = "seller";
			sellerID = cookie2;
		}
	}
	else 
	{
		buyer_seller = "nothing";
	}
	
	var pid = {'propertyID': $("#pid").val(), 'buyer_seller': buyer_seller, 'sellerID': sellerID};
	$.ajax({
    	type: "POST",
    	url: 'resources/php/propertyInfo.php',
    	data: pid,
      success: function(data){
		  $("#details").html(data);
		  editProperty();
		  deletePicture();
		  homeSold();
		  favorite(cookie2);
       	},
       	error: function() {alert("Error");} 
   	});
});

function editProperty()
{
	$("#makeChanges").click(function()
	{
		var pid = 
		{
			'propertyID': $("#pid").val(), 
			'newAddress': $("#newAddress").val(),
			'newCity': $("#newCity").val(),
			'newState': $("#newState").val(),
			'newZip': $("#newZip").val(),
			'newDescription': $("#newDescription").val(),
			'newPrice': $("#newPrice").val(),
			'newHomeSize': $("#newHomeSize").val(),
			'newLotSize': $("#newLotSize").val(),
			'newYearBuilt': $("#newYearBuilt").val(),
			'newBedrooms': $("#newBedrooms").val(),
			'newBathrooms': $("#newBathrooms").val()
		};
		$.ajax({
			type: "POST",
			url: 'resources/php/changeAddress.php',
			data: pid,
		  success: function(data){
				location.reload();
			},
			error: function() {alert("Error");} 
		});
	});
}

function deletePicture()
{
	$("#deletePics").click(function()
	{
		$("#deletePics").hide();
		$("#deleteDescription").show();
		$(".images img").click(function()
		{
			var src = $(this).attr("src");
			var id = $(this).attr("id");
			var input = {'pictureID': id};
			$.ajax({
				type: "POST",
				url: 'resources/php/deletePicture.php',
				data: input,
			  success: function(data){
					location.reload();
				},
				error: function() {alert("Error");} 
			});
		});
	});
}

function homeSold()
{
	$("#homeSold").click(function()
	{
		$("#homeSold").hide();
		$("#homeSoldDescription").show();
		var pid = {'propertyID': $("#pid").val()};
		$.ajax({
			type: "POST",
			url: 'resources/php/propertySold.php',
			data: pid,
		  success: function(data){
				//location.href='index.html';
				location.reload();
			},
			error: function() {alert("Error");} 
		});
	});
}

function favorite(cookie2)
{
	$("#favorite").click(function()
	{
		$("favorite").hide();
		$("favoriteDescription").show();
		var input = {'buyerID': cookie2, 'propertyID': $("#propID").text()};
		$.ajax({
			type: "POST",
			url: 'resources/php/favorites.php',
			data: input,
		  success: function(data){
				//location.href='index.html';
				location.reload();
			},
			error: function() {alert("Error");} 
		});
	});
}