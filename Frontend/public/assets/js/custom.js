$(function(){
	/* WOW Js */
    new WOW().init();

	$(".iconMenu").click(function () {
		
		$("body").addClass("overflowH");
		$(".menuMobile").fadeIn();
		$(".transformPage,.menuMobile .menuContent").addClass("active");
		
	});
	
	$(".closeX,.BgClose").click(function () {
		
		$("body").removeClass("overflowH");
		$(".menuMobile").fadeOut();
		$(".transformPage,.menuMobile .menuContent").removeClass("active");
		
	});
	


	
	if($(this).scrollTop() > 100) {
		$(".header").addClass("headerFixed");			
	}
	
	$(window).scroll(function () {
		
		if($(this).scrollTop() > 100) {
			
			
			$(".header").addClass("headerFixed");
						
		} else {
			
			$(".header").removeClass("headerFixed");
		}
		
	});
	
  	var OwlCards = $('.OwlCards');
	 
	  	OwlCards.owlCarousel({
	      
	      items : 1, //10 items above 1000px browser width
	      itemsDesktop : [1200,1], //5 items between 1000px and 901px
	      itemsDesktopSmall : [979,1], // betweem 900px and 601px
	      itemsTablet: [768,1], //2 items between 600 and 0
	      itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
	      slideSpeed : 500,
	      paginationSpeed : 400,
	      pagination:false,
	      navigation:true,
	      autoPlay:true,
	      navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	  	});

  	var OwlCards2 = $('.OwlCards2');
	OwlCards2.owlCarousel({
	      
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [4], //5 items between 1000px and 901px
      itemsDesktopSmall : [3], // betweem 900px and 601px
      itemsTablet: [2], //2 items between 600 and 0
      itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
      slideSpeed : 500,
      paginationSpeed : 400,
      pagination:false,
      navigation:true,
      autoPlay:true,
      navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
  	});
	  
  	var OwlProj = $('#OwlProj');
	 
	  OwlProj.owlCarousel({
	      
	      items :2, //10 items above 1000px browser width
	      itemsDesktop : [1200,2], //5 items between 1000px and 901px
	      itemsDesktopSmall : [979,2], // betweem 900px and 601px
	      itemsTablet: [768,2], //2 items between 600 and 0
	      itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
	      slideSpeed : 500,
	      paginationSpeed : 400,
	      pagination:false,
	      navigation:false,
	      autoPlay:true,
	  }); 
	  
	$( ".datepicker" ).datepicker();
	
	$( ".selectmenu" ).selectmenu();
	
    $(".iconAdd").click(function () {
        $(".coupons").append("<div class='inputSt'><input type='text' class='inputStyle' name='coupons[]' placeholder='اضف كود اخر'/><i style='cursor: pointer;z-index:3;font-size:16px;top:27px' class='iconLeft fa fa-close remove'></i></div>");
        $(".coupons .inputSt .remove").click(function () {
            $(this).parent().remove();
        });
        
    });
	  
	  
	$(".openShare").click(function () {
		$(this).siblings().slideToggle();
	})
	  
	$('body,html').on('click', function(e) {
		var container = $(".openShare,.listSocial"),
		Sub = $(".listSocial");
		

	    if( !$(e.target).is(container)  ){
	        Sub.slideUp();
	    }
	

	});  
	  
  	var OwlMore = $('#OwlMore');
	 
	  OwlMore.owlCarousel({
	      
	      items :3, //10 items above 1000px browser width
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
	  
  	var OwlLinks = $('#OwlLinks');
	 
	  OwlLinks.owlCarousel({
	      
	      items :5, //10 items above 1000px browser width
	      itemsDesktop : [1200,4], //5 items between 1000px and 901px
	      itemsDesktopSmall : [979,3], // betweem 900px and 601px
	      itemsTablet: [768,2], //2 items between 600 and 0
	      itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
	      slideSpeed : 500,
	      paginationSpeed : 400,
	      pagination:false,
	      navigation:false,
	      autoPlay:true,
	      navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	  }); 
	  
	/****** Start Tabs ******/
	
	$(".btnsTabs li").click(function () {
		
		var myButton = $(this).attr("id"),
			parent = $(this).parent().attr("id");
		
		$(this).addClass("active").siblings().removeClass("active");
		
		$("."+parent+" .tab").hide();
		
		$("."+parent+" ." + myButton).fadeIn();
		
	});
	
	/****** End Tabs ******/
	

  	var OwlImg = $('#carousel-indicators');
	 
	  OwlImg.owlCarousel({
	      items : 5, //10 items above 1000px browser width
	      itemsDesktop : [1200,4], //5 items between 1000px and 901px
	      itemsDesktopSmall : [979,4], // betweem 900px and 601px
	      itemsTablet: [768,3], //2 items between 600 and 0
	      itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
	      slideSpeed : 500,
	      paginationSpeed : 400,
	      pagination:true,
	      navigation:true,
	      autoPlay:true,
	      navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
	  });

  	$('#login .reset').on('click',function(e){
  		e.preventDefault();
    	e.stopPropagation();
    	$('#login').modal('hide');
    	$('#reset').modal('show');
  	});

  	$(document).on('click','#reset .reset',function(e){
        e.preventDefault();
        e.stopPropagation();
        var phone = $('#reset input[name="phone"].inputStyle').val();
        
        if(phone){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: '/profile/sendResetCode',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'phone': phone,
                },
                success:function(data){
                    if(data.status.status == 1){
                        successNotification(data.status.message);
                        $('#reset .hidden').removeClass('hidden');
                        $('#reset .reset').text('التحقق من الكود');
                        $('#reset .reset').addClass('seePasswords').removeClass('reset');
                    }else{
                        errorNotification(data.status.message);
                    }
                },
            });
        }
    });

    $(document).on('click','#reset .seePasswords',function(e){
        e.preventDefault();
        e.stopPropagation();
        var code = $('#reset input[name="code"].inputStyle').val();
        
        if(code){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: '/profile/checkCode',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'code': code,
                },
                success:function(data){
                    if(data.status.status == 1){
                        successNotification(data.status.message);
                        $('#reset input[name="phone"]').addClass('hidden');
                        $('#reset input[name="code"]').addClass('hidden');
                        $('#reset .hiddens').removeClass('hiddens');
                        $('#reset .seePasswords').text('تغيير كلمة المرور');
                        $('#reset .seePasswords').addClass('newPasswords').removeClass('seePasswords');
                    }else{
                        errorNotification(data.status.message);
                    }
                },
            });
        }
    });

    $(document).on('click','#reset .newPasswords',function(e){
        e.preventDefault();
        e.stopPropagation();
        var password = $('#reset input[name="password"].inputStyle').val();
        var password_confirmation = $('#reset input[name="password_confirmation"].inputStyle').val();
        
        if(password && password_confirmation){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: '/profile/resetPassword',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'password': password,
                    'password_confirmation': password_confirmation,
                },
                success:function(data){
                    if(data.status.status == 1){
                        successNotification(data.status.message);
                       	$('#reset').modal('hide')
                        window.location.href = "/profile";
                    }else{
                        errorNotification(data.status.message);
                    }
                },
            });
        }
    });

	$('#login .btnModal.login').on('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        var password = $('#login input[name="password"]').val();
        var phone = $('#login input[name="phone"].inputStyle').val();
        
        if(password && phone){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: '/profile/login',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'password': password,
                    'phone': phone,
                },
                success:function(data){
                    if(data.status.status == 1){
                        successNotification(data.status.message);
                        $('#login').modal('hide')
                        window.location.href = "/profile";
                    }else{
                        errorNotification(data.status.message);
                    }
                },
            });
        }
    });
	

	// Don't open Images
	// $(document).on('contextmenu','img',function(e){
 //        errorNotification("Images you are attempting to download are copyrighted material.");
	//    	e.preventDefault();
	// });

	// // Disable Cut + Copy 
	// $(document).ready(function () {
	//     var ambit = $(document);
	//     ambit.on('copy cut', function (e) {
	//         e.preventDefault();
	//         return false;
	//     });
	// });  

	// // Disable Inspect Element
	// document.addEventListener('contextmenu', function(e) {
	//   e.preventDefault();
	// });

	// document.onkeydown = function(e) {
	//   if(event.keyCode == 123) {
	//      return false;
	//   }
	//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
	//      return false;
	//   }
	//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
	//      return false;
	//   }
	//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
	//      return false;
	//   }
	//   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
	//      return false;
	//   }
	// }

});
