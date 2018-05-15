$(document).ready(function() {
	
	//Database creation BETA
	
	$("#settings").submit(function(e){
		e.preventDefault();
		var db = document.getElementById("database").value;
		if(!confirm("Are you sure to use [ "+db+" ] as database name?")){
			return;
		}
		var data = {
			"action":"CREATE_DB"
		};
		var loading = '<img src="website/assets/img/loading.gif" width="30px""/>';
		var l = loading;
		$("#Display").html('<div class="container" style="text-align:center">'+l+l+l+l+l+l+'</div>');
		data = $(this).serialize() + "&" + $.param(data);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "configuration/add_new_db.php",
			data:data,
			success:function(data){
				alert("ok");
			},
			error:function(){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">Connection aborted</h1></div>');
			}
		});
	});
	
	$("#connection").click(function(e){
		e.preventDefault();
		var data = {
			"action":"CHECK_CONNECTION"
		};
		var loading = '<img src="website/assets/img/loading.gif" width="30px""/>';
		var l = loading;
		$("#Display").html('<div class="container" style="text-align:center">'+l+l+l+l+l+l+'</div>');
		data = $.param(data);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "configuration/add_new_db.php",
			data:data,
			success:function(data){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">'+data['result']+'</h1></div>');
				$("#settings-submit").css("visibility","visible");
			},
			error:function(){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">Connection aborted</h1></div>');
			}
		});
	});
	
	
});