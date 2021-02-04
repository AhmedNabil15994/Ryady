$(function(){

	var value = $('input[name="cols"]').val();
	if(value == 0){
		setTimeout(function(){
			$('#joinUsModal').modal({
				backdrop: 'static'
			});
		}, 2500);
	}
	
});