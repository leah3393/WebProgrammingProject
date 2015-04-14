search = function(e) {
  e.preventDefault();
  //var fd = $(this).serialize();
  var fd = {
    'location': $("#location").val(),
    'beds': $("#beds").val(),
    'location': $("#location").val(),
    'sqftmin': $("#sqftmin").val(),
    'sqftmax': $("#sqftmax").val(),
    'pricemin': $("#pricemin").val(),
    'pricemax': $("#pricemax").val(),
    'propertyType[]': []
  };

  //var testArray = [];

  $(":checked").each(function() {
    if($(this).val() != "0" && $(this).val() != "any"){
      fd['propertyType[]'].push($(this).val());
      //testArray.push($(this).val());
    }
  });

  //alert(fd);

	$.ajax({
    	type: "POST",
    	url: 'resources/php/search.php',
    	data: fd,
      success: function(data){
       		var result = jQuery.parseJSON(data);
          var properties = result["properties"];
          var html = '<h3>Search Results:</h3>';
          if(properties.length == 0){
            html += '<p>No results to show. Try a different search.</p>';
          }
          for(var p=0; p < properties.length; p++){
            var pid = properties[p]["pid"];
            var addr = properties[p]["addr"];
            var city = properties[p]["city"];
            var state = properties[p]["state"];
            var price = properties[p]["price"];
            //var photo = properties[p]["photo"];
            var photo = "resources/images/property/"+pid+"_1.jpg";
            if(!ImageExist(photo)){
              photo = "resources/images/default.jpg";
            }
            var fullAddr = addr + " " + city + ", " + state;

            html += '<div class="row"><div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2"><div class="thumbnail"><img src="'+photo+'" alt="'+fullAddr+'"><div class="caption"><h3>'+fullAddr+'</h3><h4>Price: $'+price+'</h4><form action="resources/php/searchTest.php" method="POST"><input type="hidden" value="'+pid+'" name="pid" /><button class="btn btn-real" type="submit">View More Details</button>';

            if(true){
              html += '<img src="resources/images/verified.png" class="verified" alt="verified">';
            }

            html += '</form></div></div></div></div>';
          }

          $("#search-results").html(html);

          //alert(data);
       	},
       	error: function() {alert("Error");} 
   	});
}

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}

$(document).ready(function() {
  	//checkcookie();
  	$('#searchform').submit(search);
  	
  	//$('#logout').click(logout);
});