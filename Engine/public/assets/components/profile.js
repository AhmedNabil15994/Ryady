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

      // $('input[name="name_ar"]').on("blur",function(){
      //       $('h2.titleAr').html($(this).val());
      // });

      // $('input[name="name_en"]').on("blur",function(){
      //       $('h2.titleEn').html($(this).val());
      // });

      // $('input[name="end_date"]').on("change",function(){
      //       $('span.date').html($(this).val());
      // });

      // function formatDate(date) {
      //     var d = new Date(date),
      //         month = '' + (d.getMonth() + 1),
      //         day = '' + d.getDate(),
      //         year = d.getFullYear();

      //     if (month.length < 2) 
      //         month = '0' + month;
      //     if (day.length < 2) 
      //         day = '0' + day;

      //     return [month,year].join('/');
      // }

      // $('#fromDate').datepicker({
      //       dateFormat: 'dd/mm/yy',
      //       onSelect: function () {
      //             var dt2 = $('#toDate');
      //             var startDate = $(this).datepicker('getDate');
      //             startDate.setDate(startDate.getDate() + 365);
      //             var minDate = $(this).datepicker('getDate');
      //             var dt2Date = dt2.datepicker('getDate');
      //             dt2.datepicker('setDate', startDate);
      //             dt2.datepicker('option','minDate', startDate);
      //             var newDate = formatDate(startDate);
      //             $('span.date').html(newDate);
      //       }
      // });

      // $('#toDate').datepicker({
      //       dateFormat: 'dd/mm/yy',         
      //       onSelect: function () {
      //             var dt2 = $('#fromDate');
      //             var startDate = $(this).datepicker('getDate');
      //             var myDate = startDate.setDate(startDate.getDate());
      //             startDate.setDate(startDate.getDate() - 365);
      //             var minDate = $(this).datepicker('getDate');
      //             var dt2Date = dt2.datepicker('getDate');
      //             dt2.datepicker('setDate', startDate);
      //             var newDate = formatDate(myDate);
      //             $('span.date').html(newDate);
      //       },
      // });

      // var logo = '';
      // $('input[name="image"]').on('change',function(){
      //       var imageSrc = window.URL.createObjectURL($(this)[0].files[0]);
      //       logo = $(this)[0].files[0];

      //       var formData = new FormData();
      //       formData.append('image', logo);
            
      //       $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //       $.ajax({
      //             type:'POST',
      //             url: '/profile/uploadLogo',
      //             data:formData,
      //             cache:false,
      //             contentType: false,
      //             processData: false,
      //             success:function(data){
      //                   if(data.status.status == 1){
      //                         successNotification(data.status.message);
      //                         $('img.img.main').attr('src',imageSrc);
      //                   }else{
      //                         errorNotification(data.status.message);
      //                   }
      //             },
      //       });
      // });

      // var file = '';
      // $('.addBlog').on('click',function(e){
      //       e.preventDefault();
      //       e.stopPropagation();
      //       file = $('input[name="file"]')[0].files[0];

      //       var formData = new FormData();
      //       formData.append('file', file);
      //       formData.append('title', $('input[name="title"]').val());
      //       formData.append('description', $('textarea[name="description"]').val());
      //       formData.append('category_id', $('select[name="order_category_id"] option:selected').val());
            
      //       $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //       $.ajax({
      //             type:'POST',
      //             url: '/profile/addBlog',
      //             data:formData,
      //             cache:false,
      //             contentType: false,
      //             processData: false,
      //             success:function(data){
      //                   if(data.status.status == 1){
      //                         successNotification(data.status.message);
      //                   }else{
      //                         errorNotification(data.status.message);
      //                   }
      //             },
      //       });
      // });

});