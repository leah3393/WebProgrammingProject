function runAjax(fd){
  $.ajax({
      type: "POST",
      url: 'resources/php/search.php',
      data: fd,
      success: function(data){
          var result = jQuery.parseJSON(data);
          var properties = result["properties"];
          var html = '<div class="page-header"><h1>Search Results:</h1></div>';
          if(properties.length == 0){
            html += '<p>No results to show. Try a different search.</p>';
          }
          for(var p=0; p < properties.length; p++){
            var pid = properties[p]["pid"];
            var addr = properties[p]["addr"];
            var city = properties[p]["city"];
            var state = properties[p]["state"];
            var price = properties[p]["price"];
            var photo = properties[p]["photo"];
            var favorite = properties[p]["favorite"];
            var verified = properties[p]["verified"];

            //var verified = true;

            var fullAddr = addr + " " + city + ", " + state;

            html += '<div class="row"><div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2"><div class="thumbnail"><img src="'+photo+'" alt="'+fullAddr+'"><div class="caption"><h3>'+fullAddr+'</h3><h4>Price: $'+price+'</h4><form action="resources/php/searchTest.php" method="POST"><input type="hidden" value="'+pid+'" name="pid" /><button class="btn btn-real" type="submit">View More Details</button>';

            if(favorite){
              html += ' <button class="btn btn-real" type="button" onclick="favorite(this)" name="'+pid+'">Remove from Favorites</button>';
            }
            else{
              html += ' <button class="btn btn-real" type="button" onclick="favorite(this)" name="'+pid+'">Add to Favorites</button>';
            }

            if(verified){
              html += '<img src="resources/images/verified.png" class="verified" alt="verified" title="Seller has been verified.">';
            }

            html += '</form></div></div></div></div>';
          }

          $("#search-results").html(html);

          //alert(data);
        },
        error: function() {alert("Error");} 
    });
}

search = function(e) {
  e.preventDefault();
  //var fd = $(this).serialize();
  var fd = {
    'location': $("#location").val(),
    'userid': $.cookie('userid'),
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
  runAjax(fd);
	
}

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}

function checksearch(){
  var GET = {};
  var queryString = window.location.search.replace(/^\?/, '');
  queryString.split(/\&/).forEach(function(keyValuePair) {
     var paramName = keyValuePair.replace(/=.*$/, ""); // some decoding is probably necessary
     var paramValue = keyValuePair.replace(/^[^=]*\=/, ""); // some decoding is probably necessary
     GET[paramName] = paramValue;
  });
  if(GET["request"] != null && GET["request"] != ""){
    var request = GET["request"];
    
    if(request == 'pref'){
      fd = {};
      if(GET["location"] != undefined){
        loc = GET["location"].replace("%2C",",");
        loc = loc.replace(/\+/g," ");
        fd["location"] = loc;
      }
      if(GET["sqftmin"] != undefined){
        fd["sqftmin"] = GET["sqftmin"];
      }
      if(GET["beds"] != undefined){
        fd["beds"] = GET["beds"];
      }
      if(GET["pricemin"] != undefined){
        fd["pricemin"] = GET["pricemin"];
      }
      if(GET["pricemax"] != undefined){
        fd["pricemax"] = GET["pricemax"];
      }

    }
    else{
      request = request.replace("%2C", ",");
      request = request.replace(/\+/g," ");
      fd = {
        'location': request,
        'userid': $.cookie('userid')
      };
    }

    //alert(request);

    runAjax(fd);
  }
}

function favoriteAjax(fd){
  $.ajax({
      type: "POST",
      url: 'resources/php/favorite.php',
      data: fd,
      success: function(data){
          //var result = jQuery.parseJSON(data);
          //alert(data);
        },
      error: function() {alert("Error");} 
    });
}

function favorite(e){
  var text = $(e).text();
  var pid = $(e).attr("name");
  var userCookie = $.cookie('userid');

  if(userCookie != undefined){
    if(text == "Remove from Favorites"){
      //alert("test");
      var data = {'pid':pid,
                  'userid':userCookie,
                  'favorite':"remove"};
      favoriteAjax(data);
      //alert("Removed "+pid+" from favorites.");
      $(e).text("Add to Favorites");
    }
    else if(text == "Add to Favorites"){
      var data = {'pid':pid,
                  'userid':userCookie,
                  'favorite':"add"};
      favoriteAjax(data);
      //alert("Added "+pid+" to favorites.");
      $(e).text("Remove from Favorites");
    }
  }
  else{
    alert("You must login to save to favorites.");
  }
}

$(document).ready(function() {
  	//checkcookie();
    checksearch();
  	$('#searchform').submit(search);

    //$('input[type="button"]').click(function(){alert("hello")});
  	
  	//$('#logout').click(logout);
});