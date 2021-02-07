$(function(){

	$('#selectmenu[name="membership_id"]').on('selectmenuchange', function() {
	    $id = $(this).val();
	    var name_ar = $('input[name="name_ar"]').val();
	    var name_en = $('input[name="name_en"]').val();
	    var phone = $('input[name="phone"]').val();
		window.location.href = '/memberships/requestMemberShip/'+$id+'?name_ar='+name_ar+'&name_en='+name_en+'&phone='+phone;
	});

	$('input[name="name_ar"]').on("blur",function(){
		$('h2.titleAr').html($(this).val());
	});

	$('input[name="name_en"]').on("blur",function(){
		$('h2.titleEn').html($(this).val());
	});

	$('input[name="end_date"]').on("change",function(){
		$('span.date').html($(this).val());
	});

	function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();

	    if (month.length < 2) 
	        month = '0' + month;
	    if (day.length < 2) 
	        day = '0' + day;

	    return [month,year].join('/');
	}

	$('#fromDate').datepicker({
	    dateFormat: 'dd/mm/yy',
	    onSelect: function () {
            var dt2 = $('#toDate');
            var startDate = $(this).datepicker('getDate');
            startDate.setDate(startDate.getDate() + 365);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            dt2.datepicker('setDate', startDate);
            dt2.datepicker('option','minDate', startDate);
            var newDate = formatDate(startDate);
        	$('span.date').html(newDate);
        }
    });

	$('#toDate').datepicker({
	    dateFormat: 'dd/mm/yy',		
	    onSelect: function () {
            var dt2 = $('#fromDate');
            var startDate = $(this).datepicker('getDate');
            var myDate = startDate.setDate(startDate.getDate());
            startDate.setDate(startDate.getDate() - 365);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            dt2.datepicker('setDate', startDate);
            var newDate = formatDate(myDate);
        	$('span.date').html(newDate);
        },
	});

	$('#privcy').on('change',function(){
		if($(this).is(":checked")){
			$('#ModalPrivacy').modal('toggle');
		}
	})

});