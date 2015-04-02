login = function(){
	var username = $('#username').val();
	var password = $('#password').val();
	//alert(username + password);
	$.post("./../php/login.php", {"username": username}, function(data){
		alert(data);
	});
}

$(document).ready(function(){
	$("#sign-in").click(login);
});