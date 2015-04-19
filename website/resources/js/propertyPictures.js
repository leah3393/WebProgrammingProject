function getPid(){
	var GET = {};
	var queryString = window.location.search.replace(/^\?/, '');
	queryString.split(/\&/).forEach(function(keyValuePair) {
		var paramName = keyValuePair.replace(/=.*$/, ""); // some decoding is probably necessary
		var paramValue = keyValuePair.replace(/^[^=]*\=/, ""); // some decoding is probably necessary
		GET[paramName] = paramValue;
	});

	return GET["pid"];
}

function runPictureAjax(pid){
	fd = {'pid':pid};

	//alert(JSON.stringify(fd));

	$.ajax({
      type: "POST",
      url: 'resources/php/pictures.php',
      data: fd,
        success: function(data){
            //var pid = data;
            //alert(data);
            var result = jQuery.parseJSON(data);
            var pictures = result["pictures"];

            var html = "";

            for(var p=0; p < pictures.length; p++){
            	var picture = "resources/images/default.jpg";
            	var picture = pictures[p]["path"];
				html += '<div class="col-xs-6 col-md-3"><a class="thumbnail"><img src="'+picture+'" alt="picture"></a></div>';
            }

			$("#picture-pane").html(html);

            //return result;
            //$(location).attr('href','add-property-pictures.html?pid='+pid);
        },
        error: function(err) {
          //var err = JSON.parse(xhr.responseText);
          alert(err.responseText);
        } 
  });
}

function getImages(pid){
	runPictureAjax(pid);
}

$(document).ready(function() {

	var pid = getPid();

	getImages(pid);
    //populate_info();
    //$('#save').click(update);
    $("#pid").val(pid);
    //$("#pid").show();
    //$('#create').click(addProperty);
});