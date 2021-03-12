$(function(){

	var value = $('input[name="cols"]').val();
	if(value == 0){
		$('ul.links li a').attr('href','#');
		setTimeout(function(){
			$('#joinUsModal').modal({
				backdrop: 'static'
			});
		}, 2500);
	}
	
});