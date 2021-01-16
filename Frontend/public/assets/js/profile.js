$(function(){

	$('a[data-target="#profile"]').on('click',function(e){
		e.preventDefault();
		e.stopPropagation();
		var user_id = $(this).data('area');
		
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		$.get('/getUserData/' + user_id,function(data) {
            if(data != ''){
                  if(data.show_details == 0){
                        $('#profile .data').addClass('hidden');
                        $('#profile .notFound').removeClass('hidden');
                  }else{
                        $('#profile .notFound').addClass('hidden');
                        $('#profile .data').removeClass('hidden');
                        $('#profile img').attr('src',data.photo);
                        $('#profile a.email').html(data.email);
                        $('#profile a.email').attr('href','mailto:'+data.email);
                        $('#profile a.phone').html(data.phone);
                        $('#profile a.phone').attr('href','tel:'+data.phone);
                        $('#profile h2.name').html('أ.'+data.name_ar);
                        $('#profile div.desc').html(data.brief);
                  }
                  $('#profile').modal('show');
            }
        });

	});

});