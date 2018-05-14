//Just Pressing A to Z, a to z, 0 to 9
$(".chars").keypress(function(e){
		var c = String.fromCharCode(e.which);
		if(!c.match(/[A-Za-z0-9]/g))
			e.preventDefault();
});


	