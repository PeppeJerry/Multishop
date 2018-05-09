$(document).ready(function() {
	
	//Confirm of the name
	$("#settings").submit(function(e){
		var db = document.getElementById("database").value();
		if(!confirm("Sei sicuro di voler usare [ "+db+" ] come nome del database?")){
			e.preventDefault();
		}
    });
	
	//Just Pressing A to Z, a to z, 0 to 9
	$(".chars").keypress(function(e){
		var c = String.fromCharCode(e.which);
		if(!c.match(/[A-Za-z0-9]/g))
			e.preventDefault();
	});
	
});
