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
	
	$('.select2').select2();

	var OwlAdvisors = $('#OwlAdvisors');
    OwlAdvisors.owlCarousel({
        
        items : 4, //10 items above 1000px browser width
        itemsDesktop : [1200,3], //5 items between 1000px and 901px
        itemsDesktopSmall : [979,2], // betweem 900px and 601px
        itemsTablet: [768,1], //2 items between 600 and 0
        itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
        slideSpeed : 500,
        paginationSpeed : 400,
        pagination:false,
        navigation:true,
        autoPlay:true,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
    });

});