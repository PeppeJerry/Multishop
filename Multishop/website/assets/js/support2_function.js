$(document).ready(function() {
	
	// Just Pressing A to Z, a to z, 0 to 9
	
	$(".chars").keypress(function(e){
		
		var code = eval(e.which);
		if(nums_chars(code))
			e.preventDefault();
	});
	
	$(".password").keypress(function(e){
		var code = eval(e.which);
		if(special_char(code))
			e.preventDefault();
	});
});

function nums_chars(code){
	code = String.fromCharCode(code);
	if(!code.match(/[A-Za-z0-9]/g))
		return true;
	return false;
}

function space_char(code){
	
	if(code == 32)
		return false;
	return true

}

function special_char(code){
	if(space_char(code)){
		code = String.fromCharCode(code);
		if(!code.match(/[A-Za-z0-9<>!"'$%&/()=#?]/g))
			return true;
	}
	return false;
}