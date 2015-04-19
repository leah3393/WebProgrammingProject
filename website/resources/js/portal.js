addProperty = function(e){
  //alert("Add Property");
  $(location).attr('href','add-property.html');
}

function updateAjax(fd){
  $.ajax({
      type: "POST",
      url: 'resources/php/update.php',
      data: fd,
        success: function(data){
            //var result = jQuery.parseJSON(data);
            //alert(data);
            $("#opassword").val('');
            $("#npassword").val('');
            $("#cpassword").val('');

            var html = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            html += "<p>Your account has been updated</p>";
            $("#account-update").html(html);
            //$("#account-update").addClassName("alert-success");
            $("#account-update").show();
        },
        error: function() {
          var html = "<p>Database Error. Try again later.</p>";
          $("#account-update").html(html);
          //$("#account-update").addClassName("alert-warning");
          $("#account-update").show();
        } 
    });
}

$(document).ready(function() {
  	//populate_info();
  	//$('#save').click(update);
    $('#newProperty').click(addProperty);
});