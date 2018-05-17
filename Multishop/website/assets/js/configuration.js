$(document).ready(function() {
	
	
	$("#settings").submit(function(e){
		e.preventDefault();
		var db = document.getElementById("database").value;
		if(!confirm("Are you sure to use [ "+db+" ] as database name?")){
			return;
		}
		var loading = '<img src="website/assets/img/loading.gif" width="30px""/>';
		var l = loading;
		$("#Display").html('<div class="container" style="text-align:center">'+l+l+l+l+l+l+'</div>');
		data = $(this).serialize();
		alert(data);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "website/assets/php/creationDB_ajax.php",
			data:data,
			success:function(data){
				alert(data['result']);
			},
			error:
			function(){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">Submit goes wrong</h1></div>');
			}
				/*	Remove comment for show errors from AJAX
					function(ts) { var x = $('body')[0];
					x.html(ts.responseText); 
					x.css('background','white');}
				*/
		});
	});
	
	$("#connection").click(function(e){
		e.preventDefault();
		var loading = '<img src="website/assets/img/loading.gif" width="30px""/>';
		var l = loading;
		$("#Display").html('<div class="container" style="text-align:center">'+l+l+l+l+l+l+'</div>');
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "website/assets/php/connection_ajax.php",
			success:function(data){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">'+data['result']+'</h1></div>');
				if(data['connect'])
					$("#settings-submit").css("visibility","visible");
			},
			error:function(){
				$("#Display").html('<div class="container"><h1  style="text-align:center;">Error during connection</h1></div>');
			}
		});
	});
	
	
});