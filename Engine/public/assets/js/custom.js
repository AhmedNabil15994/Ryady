$(function(){

	/* WOW Js */
	new WOW().init();

	$(window).load(function () {
		
		$(".splash").fadeOut(1000,function () {
				
			$(this).remove();
			
		});
		
	});
	
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
	
	
	  var Owlusers = $('#Owlusers');
	 
	  Owlusers.owlCarousel({
	    stagePadding:15,
	    loop:true,
	    rtl:true,
	    margin:0,
	    nav:false,
	    autoplay:true,
	    responsive:{
	        0:{
	            items:2,
	            stagePadding: 55,
	            margin:5
	        },
	        480:{
	            items:4,
	            stagePadding: 60,
	            margin:15
	        },
	        767:{
	            items:6,
	            stagePadding: 60,
	            margin:15
	        },
	        1000:{
	            items:7,
	            stagePadding:15
	        }
	    }
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
	    stagePadding:0,
	    loop:false,
	    rtl:true,
	    margin:0,
	    nav:true,
	    autoplay:true,
	    responsive:{
	        0:{
	            items:4,
	            stagePadding: 0,
	            margin:0
	        },
	        480:{
	            items:5,
	            stagePadding: 0,
	            margin:0
	        },
	        767:{
	            items:8,
	            stagePadding: 0,
	            margin:0
	        },
	        1000:{
	            items:10,
	            stagePadding:0
	        }
	    }
	  });
	
	
	$( ".datepicker" ).datepicker();
	
	$( ".selectmenu" ).selectmenu();
	
	
  	var OwlLinks = $('#OwlLinks');
	 
	  OwlLinks.owlCarousel({
	    stagePadding:0,
	    loop:true,
	    rtl:true,
	    margin:0,
	    nav:false,
	    autoplay:true,
	    responsive:{
	        0:{
	            items:1,
	            stagePadding: 50,
	            margin:0
	        },
	        480:{
	            items:2,
	            stagePadding: 0,
	            margin:0
	        },
	        767:{
	            items:3,
	            stagePadding: 0,
	            margin:0
	        },
	        1000:{
	            items:5,
	            stagePadding:0
	        }
	    }
	  });
	
	
	

	
	
});
var Owlblogs = $('#Owlblogs');
	 
Owlblogs.owlCarousel({
  stagePadding:0,
  loop:true,
  center: true,
  rtl:true,
  margin:14,
  nav:false,
  dots: false,
  responsive:{
	  0:{
		  items:1,
	  },
	  414:{
		  items:2,
	  },
	  767:{
		  items:3,
	  },
	  973:{
		items:4,
	}
	  
  }
});

function fetchArInput() {
    var inputAr = document.getElementById("inputAr");
    var inputValue = inputAr.value;
	
	if(inputAr.value.length === 0) {
		inputValue = "خالد بن محمد";
	}
	
    var outputAr = document.getElementById("outputAr");
    outputAr.innerText = inputValue;
}

	
function fetchEnInput() {
    var inputEn = document.getElementById("inputEn");
    var inputValue = inputEn.value;
	
	if(inputEn.value.length === 0) {
		inputValue = "Khalid bin Mohammed";
	}
	
    var outputEn = document.getElementById("outputEn");
    outputEn.innerText = inputValue;
};


$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});