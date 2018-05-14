$(document).ready(function() {
	
	//Confirm of the name
	$("#settings").submit(function(e){
		var db = document.getElementById("database").value;
		if(!confirm("Are you sure to use [ "+db+" ] as database name?")){
			e.preventDefault();
		}
    });
});
