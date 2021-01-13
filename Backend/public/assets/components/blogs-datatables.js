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
			ajax: {
				url: '/blogs',
				type: 'GET',
				data:function(dtParms){
			       	dtParms.category_id = $('select[name="category_id"]').val();
			       	dtParms.status = $('select[name="status"]').val();
			       	dtParms.created_at = $('input[name="created_at"]').val();
			        dtParms.columnsDef= [
						'id', 'photo' ,'title','category','views','statusText','creator','created_at'];
			        return dtParms
			    }
			},
			columns: [
				{data: 'id'},
				{data: 'photo'},
				{data: 'title'},
				{data: 'category'},
				{data: 'views'},
				{data: 'statusText'},
				{data: 'creator'},
				{data: 'created_at', type: 'date'},
				{data: 'id', responsivePriority: -1},
			],
			
			columnDefs: [
				{
					targets:0,
					orderable: false,
				},
				{
					targets: 1,
					title: 'المرفقات',
					render: function(data, type, full, meta) {
						var myElem= '<span class="label label-danger label-pill label-inline">لا يوجد</span>';
						if(data != ''){
							var designElem = '<img src="'+data+'" class="topics-img">';
							if(full.fileType == 'video'){
								designElem = '<video width="100" height="70" controls>'+
		                                          '<source src="'+data+'" type="video/mp4">'+
		                                      '</video>';
							}
							myElem = '<div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">'+
                            		'<figure itemprop="associatedMedia" itemscope="" itemtype="">'+
                               			'<a href="'+data+'" itemprop="contentUrl" data-size="555x370">'+
                                    		designElem+
                                		'</a>'+
                                		'<img src="'+data+'" itemprop="thumbnail" style="display: none;">'+
                            		'</figure>'+
                        		'</div>';
						}
						return myElem;
					},
				},
				{
					targets: 2,
					title: 'العنوان عربي',
					className: 'edits',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="title" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 3,
					title: 'التصنيف',
					className: 'edits selects',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="category_id" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 4,
					title: 'عدد المشاهدات',
					width: 100,
					className: 'edits',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="views" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: 5,
					title: 'الحالة',
					className: 'edits selects',
					render: function(data, type, full, meta) {
						var labelText = '';
						if(full.status == 0){
							labelText = 'dark';
						}else if(full.status == 1){
							labelText = 'success';
						}else if(full.status == 2){
							labelText = 'warning';
						}else if(full.status == 3){
							labelText = 'danger';
						}
						return '<a class="editable" data-col="status" data-id="'+full.id+'"><label class="btn btn-wide btn-inline btn-'+labelText+'">'+data+'</label></a>';
					},
				},
				{
					targets: 6,
					title: 'المنشئ',
				},
				{
					targets: 7,
					title: 'التاريخ',
					className: 'edits dates',
					render: function(data, type, full, meta) {
						return '<a class="editable" data-col="created_at" data-id="'+full.id+'">'+data+'</a>';
					},
				},
				{
					targets: -1,
					title: 'الاجراءات',
					orderable: false,
					render: function(data, type, full, meta) {
						var editButton = '';
						var deleteButton = '';
						if($('input[name="data-area"]').val() == 1){
							editButton = '<a href="/blogs/edit/'+data+'" class="dropdown-item">'+
		                                    '<i class="m-nav__link-icon fa fa-pencil-alt"></i>'+
		                                    '<span class="m-nav__link-text">تعديل</span>'+
		                                '</a>';
						}

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
		                                editButton+
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
		if ($("#m_reset")[0]) {
		    $("#m_reset").on("click", function (t) {
		        t.preventDefault(), $(".m-input").each(function () {
		            $(this).val(""), DataTable.column($(this).data("col-index")).search("", !1, !1);
		        }), DataTable.table().draw();
		    });
		}
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
});
