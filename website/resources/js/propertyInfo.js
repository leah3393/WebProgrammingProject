$(document).ready(function() 
{
	var buyer_seller;
	var sellerID = 0;
	cookie1 = $.cookie('isBuyer');
	cookie2 = $.cookie('userid');
	if(cookie1 != undefined)
	{
		if(cookie1 == "true") buyer_seller = "buyer";
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
       	},
       	error: function() {alert("Error");} 
   	});
});