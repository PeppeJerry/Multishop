$(document).ready(function() {
	
	//Database creation BETA
	
	$("#settings").submit(function(e){
		e.preventDefault();
		var db = document.getElementById("database").value;
		if(!confirm("Are you sure to use [ "+db+" ] as database name?")){
			return;
		}
		var data = {
			"action":"CHECK_CONNECTION"
		};
		
		data = $(this).serialize() + "&" + $.param(data);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "configuration/add_new_db.php",
			data:data,
			success:function(data){
				$("#Display").html('<div class="container"><h1>'+data['result']+'</h1></div>');
			}
		});
	});
	
	
	
});