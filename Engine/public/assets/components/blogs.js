$(function (){
		
	$('i.flaticon-play').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		if($(this).hasClass('play')){
			$(this).siblings('video').trigger('pause');
			$(this).removeClass('play')
		}else{
			$(this).siblings('video').trigger('play');
			$(this).addClass('play')
		}
	});

});