$(function(){

	$('img.locations').on('click',function(){
	    var src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27826.0525286967!2d48.04979106123634!3d29.333475770514568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf7621ccb0f409%3A0xd67b8473125207f7!2sSalmiya%2C%20Kuwait!5e0!3m2!1sen!2seg!4v1582183042782!5m2!1sen!2seg";
	    $('.modal-location #somecomponent').removeClass('hidden');
	    $('.modal-location .modal-content button').show();
	    $('.modal-location iframe').addClass('hidden');
	    $('.modal-location #somecomponent').locationpicker({
	        location: {
	            latitude: $('input[name="lat"]').val() ,
	            longitude: $('input[name="lng"]').val()
	        },
	        onchanged: function (currentLocation, radius, isMarkerDropped) {
	            var addressComponents = $(this).locationpicker('map').location.addressComponents;
	            $('input[name="lat"]').val(currentLocation.latitude);
	            $('input[name="lng"]').val(currentLocation.longitude);
	        },
	    });
	    $('input[name="gmaps"]').val( $('input[name="lat"]').val() + ' -- ' + $('input[name="lng"]').val())
	});

    $('select[name="type"]').on('selectmenuchange',function(){
        if($(this).val() == '@'){
            $('input[name="type_text"]').toggleClass('hidden');
        }
    });

	var selecImgs=[];
    $(document).on('click','ul.imgs li i.fa-close',function(){
        var input = $(this).parents('ul.imgs').siblings('label').find('input[name="images[]"]');
        var index = $(this).attr('data-area');
        selecImgs.splice(index,1);
        $(this).parents('li').remove();
        $('ul.imgs li').each(function(index,item){
        	var oldIndex = $(item).children('i.fa-close').data('area');
        	if(oldIndex >= 1){
        		var newIndex = oldIndex-1;
	        	$(item).children('i.fa-close').attr('data-area', newIndex);
        	}
        });
    });

	$('input[name="images[]"]').on('change',function(){
        for (var i = 0; i < $(this)[0].files.length; i++) {
            var imageSrc = window.URL.createObjectURL($(this)[0].files[i]);
            selecImgs.push($(this)[0].files[i]);
        	$('input[name="images[]"]').parent('label').siblings('ul.imgs').append('<li><img src="'+window.URL.createObjectURL($(this)[0].files[0])+'" alt="" /><i class="fa fa-close" data-area="'+(selecImgs.length-1)+'"></i></li>');   
        }
    });
	var logo  = '';
    $('input[name="logo"]').on('change',function(){
        var imageSrc = window.URL.createObjectURL($(this)[0].files[0]);
        logo = $(this)[0].files[0];
    });
	
	$('.perform-btn').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();

		sendData('/profile/addProject');

	});


    $('.update-btn').on('click',function(e){
        e.preventDefault();
        e.stopPropagation();

        sendData('/profile/updateProject/'+$('input[name="areas"]').val());

    });

    function sendData($url){
        var formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('title', $('input[name="title"]').val());
        formData.append('phone', $('input[name="phone"]').val());
        formData.append('email', $('input[name="email"]').val());
        formData.append('type_text', $('input[name="type_text"]').val());
        formData.append('type', $('select[name="type"] option:selected').val());
        formData.append('lat', $('input[name="lat"]').val());
        formData.append('lng', $('input[name="lng"]').val());
        formData.append('logo', logo);
        formData.append('coupons', $('input[name="coupons"]').val());
        formData.append('brief', $('textarea[name="brief"]').val());
        formData.append('category_id', $('select[name="category_id"]').val());
        formData.append('city_id', $('select[name="city_id"]').val());
        if (selecImgs.length > 0) {
            for (var i = 0; i < selecImgs.length; i++) {
                formData.append('images[]', selecImgs[i]);
            }
        }

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type:'POST',
            url: $url,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status.status == 1){
                    successNotification(data.status.message);
                    location.reload();
                    // window.location.href = "/profile";
                }else{
                    errorNotification(data.status.message);
                }
            },
        });
    }
 
});