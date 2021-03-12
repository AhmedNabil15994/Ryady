$(function(){
	$('select[name="type"]').on('change',function(){
        if($(this).val() == '@'){
            $('input[name="type_text"]').toggleClass('hidden');
        }
    });
});