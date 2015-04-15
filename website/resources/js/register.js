buyerRegister = function(e){
	e.preventDefault();
	$.ajax({
    	type: "POST",
    	url: 'resources/php/register.php',
    	data: $(this).serialize(),
    	success: function(data){
    		//alert(data);
    		var reg = jQuery.parseJSON(data);
    		if(reg["created"]){
    			var bid = reg["bid"];
    			var token = reg["token"];
    			var fname = reg["fname"];
    			createLoginCookies(bid, token, fname, "buyer");
    			//alert(data);
       		$(location).attr('href','register-buyer.html');
    		}
    		else{
    			alert('Account already created for email.');
    		}
      },
      error: function() {alert("Error");} 
   	});
}

sellerRegister = function(e){
	e.preventDefault();
	$.ajax({
    	type: "POST",
    	url: 'resources/php/register.php',
    	data: $(this).serialize(),
    	success: function(data){
        //alert(data);
       	var reg = jQuery.parseJSON(data);
        if(reg["created"]){
          var sid = reg["sid"];
          var token = reg["token"];
          var fname = reg["fname"];
          createLoginCookies(sid, token, fname, "seller");
          //alert(data);
          $(location).attr('href','register-seller.html');
       	}
        else{
          alert('Account already created for email.');
        }
      }, 	
      error: function() {alert("Error");} 
   	});
}

function createLoginCookies(id, token, fname, type){
	$.cookie('userid', id, { path: '/' });
	$.cookie('fname', fname, { path: '/'});
	$.cookie('token', token, { path: '/'});
  $.cookie('type', type, { path: '/'});
}

$(document).ready(function(){
    $('#buyer a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#seller a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#buyerform').submit(buyerRegister);
	$('#sellerform').submit(sellerRegister);

});