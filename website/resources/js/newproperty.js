addProperty = function(e){
  //alert("Test");
  var fd = {
    'addr': $("#addr").val(),
    'city': $("#city").val(),
    'state': $("#state").val(),
    'sid': $.cookie("userid")
  };

  if($("#zip").val() != ""){
    fd["zip"] = $("#zip").val();
  }
  if($("#homeSize").val() != ""){
    fd["homeSize"] = $("#homeSize").val();
  }
  if($("#lotSize").val() != ""){
    fd["lotSize"] = $("#lotSize").val();
  }
  if($("#beds").val() != ""){
    fd["beds"] = $("#beds").val();
  }
  if($("#baths").val() != ""){
    fd["baths"] = $("#baths").val();
  }
  if($("#yearBuilt").val() != ""){
    fd["yearBuilt"] = $("#yearBuilt").val();
  }
  if($("#price").val() != ""){
    fd["price"] = $("#price").val();
  }
  if($("#description").val() != ""){
    fd["description"] = $("#description").val();
  }
  if($("#typeID").val() != ""){
    fd["typeID"] = $("#typeID").val();
  }

  //alert(JSON.stringify(fd));

  //alert("test");

  $.ajax({
      type: "POST",
      url: 'resources/php/newProperty.php',
      data: fd,
        success: function(data){
            var pid = data;
            //alert(data);
            $(location).attr('href','add-property-pictures.html?pid='+pid);
        },
        error: function(err) {
          //var err = JSON.parse(xhr.responseText);
          alert(err.responseText);
        } 
  });

}

$(document).ready(function() {
    //populate_info();
    //$('#save').click(update);
    $("#sid").val($.cookie('userid'));
    $('#create').click(addProperty);
});