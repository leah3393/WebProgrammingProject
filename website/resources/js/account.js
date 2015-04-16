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
       			/*if(info['password'] != null){
       				$("#opassword").attr('value', info['password']);
       			}*/
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
       				$("#sqftmin").attr('value', info['pref_homeSize']);
       			}
       			if(info['pref_lotSize'] != null){
       				$("#lotsize").attr('value', info['pref_lotSize']);
       			}
       			if(info['pref_beds'] != null){
       				$("#beds").attr('value', info['pref_beds']);
       			}
       			if(info['pref_baths'] != null){
       				$("#baths").attr('value', info['pref_baths']);
       			}
       			if(info['pref_lowPrice'] != null){
       				$("#pricemin").attr('value', info['pref_lowPrice']);
       			}
       			if(info['pref_highPrice'] != null){
       				$("#pricemax").attr('value', info['pref_highPrice']);
       			}
       		}
       		else{
       			//seller
       			alert("seller");
       		}
       	},
       	error: function() {alert("Error");} 
   	});
}

update = function(){
	
	var userid = $.cookie('userid');
	var type = $.cookie('type');

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
	//alert("it works!");
	$.ajax({
    	type: "POST",
    	url: 'resources/php/update.php',
    	data: fd,
      	success: function(data){
       	  	//var result = jQuery.parseJSON(data);
          	alert(data);
       	},
       	error: function() {alert("Error");} 
   	});
}

$(document).ready(function() {
  	populate_info();
  	$('#save').click(update);
});