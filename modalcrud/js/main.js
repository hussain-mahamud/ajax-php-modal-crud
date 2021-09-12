$(document).ready(function(){
	$('#load_btn').on('click',function(e){
		$.ajax({
			url : "load_data.php",
			type : "POST",
			success : function(data){
				$('#show_table').html(data);
			}
		});
	});
});