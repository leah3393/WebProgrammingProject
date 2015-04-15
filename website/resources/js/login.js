login = function(e) {
	e.preventDefault();
	$.ajax({
    	type: "POST",
    	url: 'resources/php/login.php',
    	data: $(this).serialize(),
    	success: function(data){
       		var login = jQuery.parseJSON(data);
        	if (login["login"]) {
        		$("#fail").hide();
        		var type = "";
        		if(login["buyer"] != undefined){
        			user = login["buyer"];
	            	fname = user["fname"];
					lname = user["lname"];
					bid = user["bid"];
					token = 128;
					type = "buyer";
					createLoginCookies(bid, token, fname,"buyer");
        		}
        		else if(login["seller"] != undefined){
        			user = login["seller"];
	            	fname = user["fname"];
					lname = user["lname"];
					sid = user["sid"];
					token = 128;
					type = "seller";
					createLoginCookies(sid, token, fname,"seller");
        		}
            	
            	setupPage(fname, type);
          	}
          	else {
            	$("#fail").html('</br><p style="color: red">Invalid email or password</p>');
            	$("#fail").show();
          	}
       	},
       	error: function() {alert("Error");} 
   	});
}

function setupPage(fname, type){
	$("#dropdown-login").hide();
	$("#register").hide();

	//[TERRIBLE CODING] I'll fix this later lol.
	if(type == "buyer"){
		userhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '+fname+'<span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="favorites.html">Favorites</a></li><li><a href="account-info.html">Account Information</a></li><li><a id="logout" href="#">Logout</a></li></ul>';
	
		$("#user").html(userhtml);
		$("#user").show();
	}
	else{
		userhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '+fname+'<span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="properties.html">Seller Portal</a></li><li><a href="account-info.html">Account Information</a></li><li><a id="logout" href="#">Logout</a></li></ul>';
	
		$("#user").html(userhtml);
		$("#user").show();
	}
	
}

function createLoginCookies(id, token, fname, type){
	$.cookie('userid', id, { path: '/' });
	$.cookie('fname', fname, { path: '/'});
	$.cookie('token', token, { path: '/'});
	$.cookie('type', type, { path: '/'});
}

logout = function(){
	$.removeCookie('userid', { path: '/' });
	$.removeCookie('fname', { path: '/'});
	$.removeCookie('token', { path: '/'});
	$.removeCookie('type', { path: '/'});
	showLogin();

	$(location).attr('href','index.html');
}

function showLogin(){
	$("#user").hide();
	$("#dropdown-login").show();
	$("#register").show();
}

function checkcookie(){
	cookie1 = $.cookie('userid');
	cookie2 = $.cookie('token');
	cookie3 = $.cookie('fname');
	cookie4 = $.cookie('type');

	if(cookie3 != undefined){
		setupPage(cookie3, cookie4);
	}
	else{
		showLogin();
	}
}

$(document).ready(function() {
  	checkcookie();
  	$('#loginform').submit(login);
  	
  	$('#logout').click(logout);
});