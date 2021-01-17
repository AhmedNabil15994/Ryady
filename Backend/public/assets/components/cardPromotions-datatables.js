"use strict";
var KTDatatablesAdvancedMultipleControls = function() {
	var init = function() {
		var table = $('#kt_datatable');

		// begin first table
		var DataTable = table.DataTable({
			// DOM Layout settings
			dom:'Bfrtip',
			dom:
				"<'row'<'col-xs-12 col-sm-6 col-md-6'l><'col-xs-12 col-sm-6 col-md-6 text-right'Bf>>" +
				"<'row'<'col-xs-6 col-sm-6 col-md-6'i><'col-xs-6 col-sm-6 col-md-6'p>> " +
				"<'row'<'col-sm-12 'tr>>" +
				"<'row'<'col-xs-4 col-sm-6 col-md-6 'l><'col-xs-8 col-sm-6 col-md-6  text-right'f>>" +
				"<'row'<'col-xs-6 col-sm-6 col-md-6 'i><'col-xs-6 col-sm-6 col-md-6 'p>>", // read more: https://datatables.net/examples/basic_init/dom.html
	        buttons: [
	            {
	                extend: 'colvis',
	                columns: ':not(.noVis)',
	                text: "<i class='fa fas fa-angle-down'></i> عرض الأعمدة",
	            },
	            {
	             	extend: 'print',
	             	customize: function (win) {
                       $(win.document.body).css('direction', 'rtl');     
                    },
 					'exportOptions': {
				    	columns: ':not(:last-child)',
				  	},
	         	},
	         	{
	             	extend: 'copy',
 					'exportOptions': {
				    	columns: ':not(:last-child)',
				  	},
	         	},
	         	{
	             	extend: 'excel',
 					'exportOptions': {
				    	columns: ':not(:last-child)',
				  	},
	         	},
	         	{
	             	extend: 'csv',
 					'exportOptions': {
				    	columns: ':not(:last-child)',
				  	},
	         	},
	         	{
	             	extend: 'pdf',
 					'exportOptions': {
				    	columns: ':not(:last-child)',
				  	},
	         	},
	        ],
	        oLanguage: {
				sSearch: "  البحث: ",
				sInfo: 'يتم العرض من  _START_ الي _END_ (العدد الكلي للسجلات _TOTAL_ )',
				sLengthMenu: 'عرض _MENU_ سجلات',
				sEmptyTable: "لا يوجد نتائج مسجلة",
				sProcessing: "جاري التحميل",
				sInfoEmpty: "لا يوجد نتائج مسجلة",
				select:{
					rows: {
                    	_: "لقد قمت باختيار %d عناصر",
	                    0: "",
	                    1: "لقد قمت باختيار عنصر واحد"
	                }
				}
			},
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: true,
			select: {
				style: 'multi',
				selector: 'td:nth-child(2) .checkable',
			},
			ajax: {
				url: '/'+$('input.url').val(),
				type: 'GET',
				data:function(dtParms){
			       	dtParms.created_at = $('#kt_datetimepicker_7_1').val();
			       	dtParms.start_date = $('#kt_datetimepicker_7_3').val();
			       	dtParms.end_date = $('#kt_datetimepicker_7_5').val();
			       	dtParms.status = $('select[name="status"]').val();
			       	dtParms.from_membership_id = $('select[name="from_membership_id"]').val();
			       	dtParms.to_membership_id = $('select[name="to_membership_id"]').val();
			        dtParms.columnsDef= [
						'id', 'username','code','from_membership_name','to_membership_name','start_date','end_date','statusText','created_at'];
			        return dtParms
			    }
			},
			columns: [
				{data: 'id'},
				{data: 'id'},
				{data: 'username'},
				{data: 'code',},
				{data: 'from_membership_name',},
				{data: 'to_membership_name',},
				{data: 'start_date',},
				{data: 'end_date',},
				{data: 'statusText',},
				{data: 'created_at', type: 'date'},
				{data: 'id', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: 0,
					width: 75,
					orderable: false,
				},
				{
					targets: 1,
					width: 40,
					orderable: false,
					render: function(data, type, full, meta) {
						return '<label class="checkbox checkbox-single checkbox-primary mb-0">'+
                            '<input type="checkbox" value="" data-cols="'+full.id+'" class="checkable"/>'+
                            '<span></span>'+
                        '</label>';
					},
				},
				{
					targets: 2,
					title: 'اسم المستخدم',
					className: '',
					render: function(data, type, full, meta) {
						return '<a class="" data-col="" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 3,
					title: 'كود البطاقة',
					className: '',
					render: function(data, type, full, meta) {
						return '<a class="" data-col="" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 4,
					title: 'العضوية القديمة',
					className: 'edits selects',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="from_membership_id" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 5,
					title: 'العضوية الجديدة',
					className: 'edits selects',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="to_membership_id" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 6,
					title: 'تاريخ البدء',
					className: 'edits dates',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="start_date" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 7,
					title: 'تاريخ الانتهاء',
					className: 'edits dates',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="end_date" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 8,
					title: 'الحالة',
					className: 'edits selects',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="status" data-id="'+full.id+'"><div class="btn btn-raised btn-warning waves-effect">'+data+'</div></a>';
					},
				},
				{
					targets: 9,
					title: 'تاريخ الارسال',
					className: 'edits dates',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="created_at" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: -1,
					title: 'الاجراءات',
					width: 100,
					orderable: false,
					render: function(data, type, full, meta) {
						var deleteButton = '';
						if($('input[name="data-cols"]').val() == 1){
							deleteButton = '<a href="#" class="dropdown-item" onclick="deleteItem('+data+')">'+
		                                    '<i class="m-nav__link-icon fa fa-trash"></i>'+
		                                    '<span class="m-nav__link-text">حذف</span>'+
		                                '</a>';
						}
						return '<div class="main-menu dropdown dropdown-inline">'+
		                            '<button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
		                                '<i class="ki ki-bold-more-hor"></i>'+
		                            '</button>'+
		                            '<div class="dropdown-menu" dropdown-toggle="hover">'+
		                                deleteButton+
		                            '</div>'+
		                        '</div>';
					},
				},
			],
		});

		if ($("#m_search")[0]) {
		    $("#m_search").on("click", function (t) {
		        t.preventDefault();
		        var e = {};
		        $(".m-input").each(function () {
		            var a = $(this).data("col-index");
		            e[a] ? e[a] += "|" + $(this).val() : e[a] = $(this).val();
		        }), $.each(e, function (t, e) {
		            DataTable.column(t).search(e || "", !1, !1);
		        }), DataTable.table().draw();
		    });
		}

		$('.selectAll').on('click',function(e){
		    e.preventDefault();
		    e.stopPropagation();
		    DataTable.rows().select();
		    $('table input[type="checkbox"]').attr('checked','checked');
		    $('table input[type="checkbox"]').parents('tr').addClass('selected');
		});

		$('.deselectAll').on('click',function(e){
		    e.preventDefault();
		    e.stopPropagation();
		    DataTable.rows().deselect();
		    $('table input[type="checkbox"]').attr('checked', false);
		    $('input[type="checkbox"]').parents('tr').removeClass('selected');
		});

	};

	return {
		//main function to initiate the module
		init: function() {
			init();
		}
	};

}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedMultipleControls.init();

	$('.moveToTrash').on('click',function(e){
    	e.preventDefault();
	    e.stopPropagation();
	    if($('table tr.selected').length){
	        var myArrs = [];
	        $('table tr.selected').each(function(index,item){
	            myArrs.push($(item).find('input[type="checkbox"]:checked').data('cols'));
	        });
	        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	        $.ajax({
	            type: 'POST',
	            url: myURL+'/changeStatus/7',
	            data:{
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'data': myArrs,
	            },
	            success:function(data){
	                if(data.status.original.status.status == 1){
	                    successNotification(data.status.original.status.message);
	                    setTimeout(function(){
	                        $('#kt_datatable').DataTable().ajax.reload();
	                    },2500)
	                }else{
	                    errorNotification(data.status.original.status.message);
	                }
	            },
	        });
	    }else{
	        errorNotification('من فضلك قم باختيار الطلبات');      
	    }
	});

	$('.delete').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    if($('table tr.selected').length){
	        var myArrs = [];
	        $('table tr.selected').each(function(index,item){
	            myArrs.push($(item).find('input[type="checkbox"]:checked').data('cols'));
	        });
	        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	        $.ajax({
	            type: 'POST',
	            url: myURL+'/delete',
	            data:{
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'data': myArrs,
	            },
	            success:function(data){
	                if(data.status.original.status.status == 1){
	                    successNotification(data.status.original.status.message);
	                    setTimeout(function(){
	                        $('#kt_datatable').DataTable().ajax.reload();
	                    },2500)
	                }else{
	                    errorNotification(data.status.original.status.message);
	                }
	            },
	        });
	    }else{
	        errorNotification('من فضلك قم باختيار الطلبات');      
	    }
	});

	$('.backToNew').on('click',function(e){
	    e.preventDefault();
	    e.stopPropagation();
	    if($('table tr.selected').length){
	        var myArrs = [];
	        $('table tr.selected').each(function(index,item){
	            myArrs.push($(item).find('input[type="checkbox"]:checked').data('cols'));
	        });
	        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	        $.ajax({
	            type: 'POST',
	            url: myURL+'/changeStatus/1',
	            data:{
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'data': myArrs,
	            },
	            success:function(data){
	                if(data.status.original.status.status == 1){
	                    successNotification(data.status.original.status.message);
	                    setTimeout(function(){
	                        $('#kt_datatable').DataTable().ajax.reload();
	                    },2500)
	                }else{
	                    errorNotification(data.status.original.status.message);
	                }
	            },
	        });
	    }else{
	        errorNotification('من فضلك قم باختيار الطلبات');      
	    }
	});

});
