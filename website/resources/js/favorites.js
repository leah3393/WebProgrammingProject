function runAjax(fd){
  $.ajax({
      type: "POST",
      url: 'resources/php/favorite.php',
      data: fd,
      success: function(data){
          //alert(data);
          var result = jQuery.parseJSON(data);
          var properties = result["properties"];
          var html = '<div class="page-header"><h1>Favorites</h1></div>';
          html += '<a class="btn btn-real" href="search-result.html">Add More Favorites</a></br></br>';
          if(properties.length == 0){
            html += "<p>You don't have any favorites, yet.</p>";
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
            var fullAddr = addr + " " + city + ", " + state;

            html += '<div class="row"><div class="col-md-6 col-md-offset-2 col-lg-6 col-lg-offset-2"><div class="thumbnail"><img src="'+photo+'" alt="'+fullAddr+'"><div class="caption"><h3>'+fullAddr+'</h3><h4>Price: $'+price+'</h4><form action="resources/php/searchTest.php" method="POST"><input type="hidden" value="'+pid+'" name="pid" /><button class="btn btn-real" type="submit">View More Details</button>';

            if(favorite){
              html += ' <button class="btn btn-real" type="button" onclick="favorite(this)" name="'+pid+'">Remove from Favorites</button>';
            }
            else{
              html += ' <button class="btn btn-real" type="button" onclick="favorite(this)" name="'+pid+'">Add to Favorites</button>';
            }

            if(verified){
              html += ' <img src="resources/images/verified.png" class="verified" alt="verified" title="Seller has been verified.">';
            }

            html += '</form></div></div></div></div>';
          }

          $("#favorites-pane").html(html);
        },
        error: function() {alert("Error");} 
    });
}

function getFavorites(){
  var fd = {
    'userid': $.cookie('userid'),
    'favorite':"get"
  };

  runAjax(fd);
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
      var data = {'pid':pid,
                  'userid':userCookie,
                  'favorite':"remove"};
      favoriteAjax(data);
      $(e).parent().parent().parent().parent().hide(); // <-- I should figure out how to do this correctly...
      $(e).text("Add to Favorites");
    }
    else if(text == "Add to Favorites"){
      var data = {'pid':pid,
                  'userid':userCookie,
                  'favorite':"add"};
      favoriteAjax(data);
      $(e).text("Remove from Favorites");
    }
  }
  else{
    alert("You must login to save to favorites.");
  }
}

$(document).ready(function() {
    getFavorites();
});