$(function(){

	$('div.method a').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		if($(this).parent('.method').hasClass('master-card')){
			$('input[name="payment_type"]').val(1);
		}

		if($(this).parent('.method').hasClass('visa')){
			$('input[name="payment_type"]').val(2);
		}

		if($(this).parent('.method').hasClass('mada')){
			$('input[name="payment_type"]').val(3);
		}

		$(this).parent('div.method').siblings('.method.active').removeClass('active');
		$(this).parent('div.method').addClass('active');
	});

	$(window).scroll(function () {
		$(".header").addClass("headerFixed");
	});

});