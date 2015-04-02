login = function(){
	var username = $('#username').val();
	var password = $('#password').val();
	$.post("resources/php/login.php", {"username": username, "password": password}, function(data){
		var worked = data;
		alert(worked);
		if(worked == 'true'){
			$('#fail').html("success");
		}
		else{
			$('#fail').html("fail");
		}
	});
}

$(document).ready(function(){
	$("#sign-in").click(login);
});