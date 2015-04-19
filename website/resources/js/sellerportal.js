$(document).ready(function() 
{
	cookie1 = $.cookie('type');
	cookie2 = $.cookie('userid');
	if(cookie1 == "seller")
	{
		var fd = {'sellerID': cookie2};
		$.ajax({
			type: "POST",
			url: 'resources/php/sellerProperties.php',
			data: fd,
		  success: function(data){
				var result = jQuery.parseJSON(data);
			  var properties = result["properties"];
			  var html = '';
			  for(var p=0; p < properties.length; p++){
				var pid = properties[p]["pid"];
				var addr = properties[p]["addr"];
				var city = properties[p]["city"];
				var state = properties[p]["state"];
				var price = properties[p]["price"];
				var photo = properties[p]["photo"];
				//var photo = "resources/images/property/"+pid+"_1.jpg";
				//if(!ImageExist(photo)){
				  //var photo = "resources/images/default.jpg";
				//}
				var fullAddr = addr + " " + city + ", " + state;

				html += '<div class="row"><div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2"><div class="thumbnail"><img src="'+photo+'" alt="'+fullAddr+'"><div class="caption"><h3>'+fullAddr+'</h3><h4>Price: $'+price+'</h4><form action="resources/php/searchTest.php" method="POST"><input type="hidden" value="'+pid+'" name="pid" id="pid"/><button class="btn btn-real" type="submit">View More Details</button> <button class="btn btn-real" type="button" onclick="remove(this)">Remove Listing</button>';

				var pid = {'sellerID': cookie2};
				$.ajax({
					type: "POST",
					url: 'resources/php/checkVerified.php',
					data: pid,
				  success: function(data){
					  if(data == "1")
					  {
						  html += '<img src="resources/images/verified.png" class="verified" alt="verified" title="Seller has been verified.">';
					  }
					},
					error: function() {alert("Error");} 
				});

				html += '</form></div></div></div></div>';
			  }

			  $("#search-results").html(html);

			  //alert(data);
			},
			error: function() {alert("Error");} 
		});
	}
});

function remove(e){
	//e.hide();

	var pid = $("#pid").val();

	var fd = {'pid':pid};
	$.ajax({
	    type: "POST",
	    url: 'resources/php/removeProperty.php',
	    data: fd,
	    success: function(data){
	          //var result = jQuery.parseJSON(data);
	          //alert(data);
	    },
	    error: function() {alert("Error");} 
	});
    //$(e).parent().parent().parent().parent().hide();
}
