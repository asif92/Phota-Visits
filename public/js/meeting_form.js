$(document).ready(function() {

	var base_url =  window.location.origin;

	$("#booking_fail_error").hide();
	$( "#add_meeting_btn" ).click(function(e) {
		e.preventDefault(); 
	    var url = base_url + "/addEvent"; // the script where you handle the form input.
	    $.ajax({
	    	type: "POST",
	    	url: url,
	           data: $("#meeting_add_form").serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	           	console.log(JSON.stringify(data));
	           	if (data == "no slot") {
	           		$("#booking_fail_error").show();
	           	}else{	
	           		$('#add_new_meeting').modal("hide");
	           		$("#meeting_add_form") [0].reset();
	           		location.reload();

	           	}
	           	
	           	
	           	
	           }
	       });

	    

	    

	  // $("#subscribe_success").show();



	});

});

