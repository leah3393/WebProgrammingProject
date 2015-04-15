function setupPage(fname, type){
	$("#dropdown-login").hide();
	$("#register").hide();

	//[TERRIBLE CODING] I'll fix this later lol.
	if(type == "buyer"){
		var userhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '+fname+'<span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="favorites.html">Favorites</a></li><li><a href="account-info.html">Account Information</a></li><li><a id="logout" href="#">Logout</a></li></ul>';
	
		$("#user").html(userhtml);
		$("#user").show();
		var first = $.cookie('fname');
		$("#name").html(first);
	}
	else{
		var userhtml = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, '+fname+'<span class="caret"></span></a><ul class="dropdown-menu" role="menu"><li><a href="portal.html">Seller Portal</a></li><li><a href="sales-account-info.html">Account Information</a></li><li><a id="logout" href="#">Logout</a></li></ul>';
	
		$("#user").html(userhtml);
		$("#user").show();
		var first = $.cookie('fname');
		$("#name").html(first);
	}
	
}

logout = function(){
	$.removeCookie('userid', { path: '/' });
	$.removeCookie('fname', { path: '/'});
	$.removeCookie('token', { path: '/'});
	$.removeCookie('type', { path: '/'});

	$(location).attr('href','index.html');
}

function checkcookie(){
	var cookie1 = $.cookie('userid');
	var cookie2 = $.cookie('token');
	var cookie3 = $.cookie('fname');
	var cookie4 = $.cookie('type');

	if(cookie3 != undefined){
		setupPage(cookie3, cookie4);
	}
	else{
		alert("You are not authorized to view this page.");
		$(location).attr('href','index.html');
	}
}

$(document).ready(function() {
  	checkcookie();
  	
  	$('#signout').click(logout);
  	$('#logout').click(logout);
});