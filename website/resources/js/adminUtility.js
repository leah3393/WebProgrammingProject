window.onload = function()
{
	var theButton;
	var counter = 1;
	do
	{
		theButton = document.getElementById("theButton" + counter);
		if(theButton != null && theButton != undefined)
		{
			theButton.onclick = scopepreserver(counter);
		}
		counter++;
	}while(theButton != null && theButton != undefined);	
	var logoutButton = document.getElementById("logoutButton");
	logoutButton.onclick = logoutFunction;
};

function logoutFunction()
{
	window.location = 'adminLogin.html';
}

function scopepreserver(counter)
{
	return function()
	{
		var r = window.confirm("Are you sure you want to verify this seller?");
		if(r == true)
		{
			var text = document.getElementById("paragraph" + counter).innerHTML;
			var sid = text.substring(0, text.indexOf(" "));
			if(window.XMLHttpRequest)
			{
				xmlhttp = new XMLHttpRequest();
			}
			else
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function()
			{
				location.reload();
			}
			xmlhttp.open("GET", "adminUtility2.php?q=" + sid, true);
			xmlhttp.send();
		}
	};
}