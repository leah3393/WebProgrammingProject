$(document).ready(function(){
    $('#skip').click(function (e) {
		$(location).attr('href','account-info.html');
	});

    var cookie = $.cookie('userid');

    $('#bid').attr('value', cookie);

});