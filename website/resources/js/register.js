$(document).ready(function(){
    $('#buyer a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#seller a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
});