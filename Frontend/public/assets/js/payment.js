$(function(){

	$('div.method a').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.payment-form').slideDown(250);
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

	$('input[name="expire_date"]').on('keyup',function(e){
		var myLength = $(this).val().length;
		if(e.which != 8) {
			if(myLength >= 2 && myLength < 5){
				$(this).val($(this).val() + ' / ');
			}
		}
	});

});