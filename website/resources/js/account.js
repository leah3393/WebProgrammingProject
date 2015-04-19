function populate_info(){
	var userid = $.cookie('userid');
	var type = $.cookie('type');
	var ud = {"type": type, "userid": userid};

	$.ajax({
    	type: "POST",
    	url: 'resources/php/accountInfo.php',
    	data: ud,
    	success: function(data){
       		//alert(data);
       		var info = jQuery.parseJSON(data);
       		if(info['bid'] != undefined){
       			//buyer
       			//alert("buyer");
       			if(info['fname'] != null){
       				$("#fname").attr('value', info['fname']);
       			}
       			if(info['lname'] != null){
       				$("#lname").attr('value', info['lname']);
       			}
       			if(info['email'] != null){
       				$("#email1").attr('value', info['email']);
       			}
       			if(info['phone'] != null){
       				$("#phone").attr('value', info['phone']);
       			}
       			if(info['password'] != null){
       				$("#oldpass").attr('value', info['password']);
       			}
       			if(info['pref_city'] != null){
       				$("#city").attr('value', info['pref_city']);
       			}
       			if(info['pref_state'] != null){
       				$("#state").attr('value', info['pref_state']);
       			}
       			if(info['pref_zip'] != null){
       				$("#zip").attr('value', info['pref_zip']);
       			}
       			if(info['pref_homeSize'] != null){
              value = info['pref_homeSize'];
              $('#sqftmin option[value=' + value + ']').attr('selected', true);
       			}
       			if(info['pref_lotSize'] != null){
              value = info['pref_lotSize'];
              $('#lotsize option[value=' + value + ']').attr('selected', true);
       			}
       			if(info['pref_beds'] != null){
              value = info['pref_beds'];
              $('#beds option[value=' + value + ']').attr('selected', true);
       			}
       			if(info['pref_baths'] != null){
              value = info['pref_baths'];
              $('#baths option[value=' + value + ']').attr('selected', true);
       			}
       			if(info['pref_lowPrice'] != null){
              value = info['pref_lowPrice'];
              $('#pricemin option[value=' + value + ']').attr('selected', true);
       			}
       			if(info['pref_highPrice'] != null){
              value = info['pref_highPrice'];
              $('#pricemax option[value=' + value + ']').attr('selected', true);
       			}
       		}
       		else{
       			//seller
       			//alert("seller");
            if(info['fname'] != null){
              $("#fname").attr('value', info['fname']);
            }
            if(info['lname'] != null){
              $("#lname").attr('value', info['lname']);
            }
            if(info['email'] != null){
              $("#email1").attr('value', info['email']);
            }
            if(info['phone'] != null){
              $("#phone").attr('value', info['phone']);
            }
            if(info['password'] != null){
              $("#oldpass").attr('value', info['password']);
            }
            if(info['agency'] != null){
              $("#company").attr('value', info['agency']);
            }
            if(info['addr'] != null){
              $("#addr").attr('value', info['addr']);
            }
            if(info['approved'] == null || info['approved'] == 0){
              $("#notapprove").show();
            }
            else{
              $("#approve").show();
            }
       		}
       	},
       	error: function() {alert("Error");} 
   	});
}

function updateBuyer(userid, type){
  var fd = {
    'userid': userid,
    'type': type,
    'fname': $("#fname").val(),
    'lname': $("#lname").val(),
    'phone': $("#phone").val(),

    'city': $("#city").val(),
    'state': $("#state").val(),
    'zip': $("#zip").val(),
    'beds': $("#beds").val(),
    'baths': $("#baths").val(),
    'sqftmin': $("#sqftmin").val(),
    'lotsize': $("#lotsize").val(),
    'pricemin': $("#pricemin").val(),
    'pricemax': $("#pricemax").val(),
    'propertyType[]': []
  };

  if($("#npassword").val() != ""){
    if(validatePassword($("#oldpass").val(),$("#opassword").val(),$("#npassword").val(),$("#cpassword").val())){
      //Add to fd
      fd["password"] = $("#npassword").val();
      updateAjax(fd);
    }
    else{
      var h = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      h += "<p>Invalid Password.</p>";
      $("#account-update").html(h);
      //$("#account-update").addClassName("alert-success");
      $("#account-update").show();
    }
  }
  else{
    updateAjax(fd);
  }

  //alert("it works!");
}

function updateSeller(userid, type){
  var fd = {
    'userid': userid,
    'type': type,
    'fname': $("#fname").val(),
    'lname': $("#lname").val(),
    'phone': $("#phone").val(),
    'company': $("#company").val(),
    'addr': $("#addr").val(),
  };

  if($("#npassword").val() != ""){
    if(validatePassword($("#oldpass").val(),$("#opassword").val(),$("#npassword").val(),$("#cpassword").val())){
      //Add to fd
      fd["password"] = $("#npassword").val();
      updateAjax(fd);
    }
    else{
      var h = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      h += "<p>Invalid Password.</p>";
      $("#account-update").html(h);
      //$("#account-update").addClassName("alert-success");
      $("#account-update").show();
    }
  }
  else{
    updateAjax(fd);
  }
  
}

update = function(){
	
	var userid = $.cookie('userid');
	var type = $.cookie('type');

  if(type == 'buyer'){
    updateBuyer(userid,type);
  }
  else{
    updateSeller(userid,type);
  }

}

function updateAjax(fd){
  $.ajax({
      type: "POST",
      url: 'resources/php/update.php',
      data: fd,
        success: function(data){
            //var result = jQuery.parseJSON(data);
            //alert(data);
            $("#opassword").val('');
            $("#npassword").val('');
            $("#cpassword").val('');

            var html = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            html += "<p>Your account has been updated</p>";
            $("#account-update").html(html);
            //$("#account-update").addClassName("alert-success");
            $("#account-update").show();
        },
        error: function() {
          var html = "<p>Database Error. Try again later.</p>";
          $("#account-update").html(html);
          //$("#account-update").addClassName("alert-warning");
          $("#account-update").show();
        } 
    });
}

function validatePassword(old, confold, pass, confpass){
  var valid = true;
  var numRegex = /[0-9]/;
  var lowRegex = /[a-z]/;
  var specRegex = /[-+_!@#$%^&*.,?]/;
  var upRegex = /[A-Z]/;

  if(old != confold){
    valid = false;
  }

  if(pass != confpass){
    valid = false;
  }
  if(!numRegex.test(pass)){
    valid = false;
  }
  if(!lowRegex.test(pass)){
    valid = false;
  }
  if(!upRegex.test(pass)){
    valid = false;
  }
  if(!specRegex.test(pass)){
    valid = false;
  }
  if(pass.length < 8){
    valid = false;
  }

  return valid;
}

search = function(e){
  var getParams = {};
  query = "?request=pref"
  if($("#city").val() != ""){
    getParams['city'] = $("#city").val();
    query += "&location="+getParams['city'].replace(/ /g, '+') + "%2C";
  }
  if($("#state").val() != ""){
    getParams['state'] = $("#state").val();
    query += getParams['state'];
  }
  if($("#sqftmin").val() != "0"){
    getParams['sqftmin'] = $("#sqftmin").val();
    query += "&sqftmin="+getParams['sqftmin'];
  }
  if($("#beds").val() != "0"){
    getParams['beds'] = $("#beds").val();
    query += "&beds="+getParams['beds'];
  }
  if($("#pricemin").val() != "0"){
    getParams['pricemin'] = $("#pricemin").val();
    query += "&pricemin="+getParams['pricemin'];
  }
  if($("#pricemax").val() != "any"){
    getParams['pricemax'] = $("#pricemax").val();
    query += "&pricemax="+getParams['pricemax'];
  }

  var url = "search-result.html";

  $(location).attr('href',url+query);

  //window.location = url+query;

  //alert(query);
}

$(document).ready(function() {
  	populate_info();
  	$('#save').click(update);
    $('#prefsearch').click(search);
});