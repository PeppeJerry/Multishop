$(document).ready(function() {
	
	//Confirm of the database name
	
	$("#settings").submit(function(e){
		e.preventDefault();
		var db = document.getElementById("database").value;
		if(!confirm("Are you sure to use [ "+db+" ] as database name?")){
			return;
		}
		var data = {
			"operation":"CHECK_CONNECTION"
		};
		
		data = $(this).serialize() + "&" + $.param(data);
		alert(data);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "configuration/add_new_db.php",
			data:data,
			success:function(data){
				alert(data['result']);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(jqXHR.status);
				alert(textStatus);
				alert(errorThrown);
				alert(data);
			}
		});
	});
	
	
	
});