$(function(){
    var OwlClients = $('#OwlClients');
   
    OwlClients.owlCarousel({
        
        items : 4, //10 items above 1000px browser width
        itemsDesktop : [1200,4], //5 items between 1000px and 901px
        itemsDesktopSmall : [979,4], // betweem 900px and 601px
        itemsTablet: [768,3], //2 items between 600 and 0
        itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
        slideSpeed : 500,
        paginationSpeed : 400,
        pagination:false,
        navigation:true,
        autoPlay:true,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
    });
    
    var OwlReviews = $('#OwlReviews');
    OwlReviews.owlCarousel({
        
        items : 1, //10 items above 1000px browser width
        itemsDesktop : [1200,1], //5 items between 1000px and 901px
        itemsDesktopSmall : [979,1], // betweem 900px and 601px
        itemsTablet: [768,1], //2 items between 600 and 0
        itemsMobile : [479,1],// itemsMobile disabled - inherit from itemsTablet option
        slideSpeed : 500,
        paginationSpeed : 400,
        pagination:true,
        navigation:false,
        autoPlay:true,
    });
  
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