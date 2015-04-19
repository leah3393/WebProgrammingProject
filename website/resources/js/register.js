buyerRegister = function(e){
	e.preventDefault();
  var pass = $("#buyer-password").val();
  var confpass = $("#buyer-confirm-password").val();
  if(validatePassword(pass,confpass)){
      //alert('Valid Password: '+pass);
      $.ajax({
          type: "POST",
          url: 'resources/php/register.php',
          data: $(this).serialize(),
          success: function(data){
            //alert(data);
            var reg = jQuery.parseJSON(data);
            if(reg["created"]){
              var bid = reg["bid"];
              var token = reg["token"];
              var fname = reg["fname"];
              createLoginCookies(bid, token, fname, "buyer");
              //alert(data);
              $(location).attr('href','register-buyer.html');
            }
            else{
              var html = "<p>An account already exists for this email.</p>";
              $("#buyer-error").html(html);
              $("#buyer-error").show();
            }
          },
          error: function() {
            var html = "<p>Database Error. Try again later.</p>";
            $("#buyer-error").html(html);
            $("#buyer-error").show();
          } 
        });
  }
  else{
    //alert('Invalid password');
    var html = "<p>Password Invalid:</p>";
    html += "<p>Must Include an uppercase and lowercase character, a number, and a special character from the set: -+_!@#$%^&*.,?</p>"
    $("#buyer-error").html(html);
    $("#buyer-error").show();
  }
}

sellerRegister = function(e){
	e.preventDefault();
  var pass = $("#seller-password").val();
  var confpass = $("#seller-confirm-password").val();
  if(validatePassword(pass,confpass)){
  	$.ajax({
      	type: "POST",
      	url: 'resources/php/register.php',
      	data: $(this).serialize(),
      	success: function(data){
          //alert(data);
         	var reg = jQuery.parseJSON(data);
          if(reg["created"]){
            var sid = reg["sid"];
            var token = reg["token"];
            var fname = reg["fname"];
            createLoginCookies(sid, token, fname, "seller");
            //alert(data);
            $(location).attr('href','portal.html');
         	}
          else{
            var html = "<p>An account already exists for this email.</p>";
            $("#seller-error").html(html);
            $("#seller-error").show();
          }
        }, 	
        error: function() {
          var html = "<p>Database Error. Try again later.</p>";
          $("#seller-error").html(html);
          $("#seller-error").show();
        } 
     	});
  }
  else{
    //alert('Invalid password');
    var html = "<p>Password Invalid:</p>";
    html += "<p>Must Include an uppercase and lowercase character, a number, and a special character from the set: -+_!@#$%^&*.,?</p>"
    $("#seller-error").html(html);
    $("#seller-error").show();
  }
}

function validatePassword(pass, confpass){
  var valid = true;
  var numRegex = /[0-9]/;
  var lowRegex = /[a-z]/;
  var specRegex = /[-+_!@#$%^&*.,?]/;
  var upRegex = /[A-Z]/;

  if(pass != confpass){
    valid = false;
  }
  if(!numRegex.test(pass)){
    valid = false;
  }
  if(!lowRegex.test(pass)){
    valid = false;
  }
  if(!upRegex.test(pass)){
    valid = false;
  }
  if(!specRegex.test(pass)){
    valid = false;
  }
  if(pass.length < 8){
    valid = false;
  }

  return valid;
}

function createLoginCookies(id, token, fname, type){
	$.cookie('userid', id, { path: '/' });
	$.cookie('fname', fname, { path: '/'});
	$.cookie('token', token, { path: '/'});
  $.cookie('type', type, { path: '/'});
}

$(document).ready(function(){
  $('#buyer a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#seller a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	$('#buyerform').submit(buyerRegister);
	$('#sellerform').submit(sellerRegister);

});