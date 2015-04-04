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
            	user = login["buyer"];
            	fname = user["fname"];
				lname = user["lname"];
				bid = user["bid"];
				token = 128;
				createLoginCookies(bid, token, fname);
            	setupPage(fname);
          	}
          	else {
            	$("#fail").html('</br><p style="color: red">Invalid email or password</p>');
            	$("#fail").show();
          	}
       	},
       	error: function() {alert("Error");} 
   	});
}

function setupPage(fname){
	$("#dropdown-login").hide();
	$("#register").hide();

	//[TERRIBLE CODING] I'll fix this later lol.
	userhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '+fname+'<span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="favorites.html">Favorites</a></li><li><a href="account-info.html">Account Information</a></li><li><a id="logout" href="#">Logout</a></li></ul>';
	
	$("#user").html(userhtml);
	$("#user").show();
}

function createLoginCookies(id, token, fname){
	$.cookie('userid', id, { path: '/' });
	$.cookie('fname', fname, { path: '/'});
	$.cookie('token', token, { path: '/'});
}

logout = function(){
	$.removeCookie('userid', { path: '/' });
	$.removeCookie('fname', { path: '/'});
	$.removeCookie('token', { path: '/'});

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

	if(cookie3 != undefined){
		setupPage(cookie3);
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