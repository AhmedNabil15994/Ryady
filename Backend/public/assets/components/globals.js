var myURL = window.location.href;
if(myURL.indexOf("#") != -1){
    myURL = myURL.replace('#','');
}

function deleteItem($id) {
    Swal.fire({
        title: "هل متأكد من هذا الحذف ؟",
        text: "لا يمكنك التراجع عن هذه الخطوة!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "تأكيد",
        cancelButtonText: "الغاء",
        closeOnConfirm: false
    }).then(function(result){
        if (result.value) {
            Swal.fire("تم الحذف بنجاح!", "تم العملية بنجاح.", "success");
            $.get(myURL+'/delete/' + $id,function(data) {
                if (data.status.original.status.status == 1) {
                    successNotification(data.status.original.status.message);
                    setTimeout(function(){
                        $('#kt_datatable').DataTable().ajax.reload();
                    },2500)
                } else {
                    errorNotification(data.status.original.status.message);
                }
            });
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "تم الالغاء",
                "تم الالغاء بنجاح :)",
                "error"
            )
        }
    });
}

$('.quickEdit').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();

    $(this).toggleClass('opened');
    var myDataObjs = [];
    var i = 190;
    $(document).find('table tbody tr td.edits').each(function(index,item){
        var oldText = '';
        if($('.quickEdit').hasClass('opened')){
            var myText = $(item).find('a.editable').text();
            $(item).find('a.editable').hide();
            var myElem = '<span qe="scope">'+
                            '<span>'+
                                '<input type="text" class="form-control" qe="input" value="'+myText+'"/>'+
                            '</span>'+
                        '</span>';
            if($(this).hasClass('selects')){
                var selectOptions = '';
                $("select[name='status'] option").each(function(){
                    var selected = '';
                    if($(this).text() == myText){
                        selected = ' selected';
                    }
                    if($(this).val() > 0){
                        selectOptions+= '<option value="'+$(this).val()+'" '+selected+'>'+$(this).text()+'</option>';
                    }
                });
                myElem = '<span qe="scope">'+
                            '<span>'+
                                '<select class="form-control">'+
                                    selectOptions+
                                '</select>'+
                            '</span>'+
                        '</span>';
            }
            if($(this).hasClass('dates')){
                myElem = '<span qe="scope">'+
                            '<span>'+
                                '<input type="text" class="form-control datetimepicker-input" id="kt_datetimepicker_'+i+'" value="'+myText+'" data-toggle="datetimepicker" data-target="#kt_datetimepicker_'+i+'"'+
                            '</span>'+
                        '</span>';
            }
            $(item).append(myElem);
            oldText = myText;
        }else{
            var myText = '';
            var newVal = 0;
            if($(this).hasClass('selects')){
                myText = $(item).find('select option:selected').text();
                newVal = $(item).find('select option:selected').val();
            }else{
                myText = $(item).find('input.form-control').val();
            }
            $(item).children('span').remove();
            oldText = $(item).find('a.editable').text();
            $(item).find('a.editable').text(myText);
            $(item).find('a.editable').show();

            if(myText != oldText){
                var myCol = $(item).find('a.editable').data('col');
                if($(this).hasClass('selects')){
                    var myValue = newVal;
                }else{
                    var myValue = myText;
                }
                var myId = $(item).find('a.editable').data('id');
                myDataObjs.push([myId,myCol,myValue]);
            }

        }
    });

    $('td.dates span span input.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD H:m:s',
    });
    
    if(myDataObjs[0] != null){
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url: myURL+'/fastEdit',
            data:{
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'data': myDataObjs,
            },
            success:function(data){
                if(data.status.status == 1){
                    successNotification(data.status.message);
                }else{
                    errorNotification(data.status.message);
                }
            },
        });
    }
});

$('#kt_dropzone_1').dropzone({
    url: myURL + "/uploadImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    success:function(file,data){
        if(data){
            if(data.status.status != 1){
                errorNotification(data.status.message);
            }
        }
    },
});


$('#kt_dropzone_11').dropzone({
    url: myURL + "/editImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    success:function(file,data){
        if(data){
            if(data.status.status != 1){
                errorNotification(data.status.message);
            }
        }
    },
});

$('a.DeletePhoto').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).data('area');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: 'POST',
        url: myURL+'/deleteImage',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': id,
        },
        success:function(data){
            if(data.status.status == 1){
                successNotification(data.status.message);
                $('#my-preview').remove();
            }else{
                errorNotification(data.status.message);
            }
        },
    });
});

$('.print-but').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.buttons-print')[0].click();
});

$('.copy-but').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.buttons-copy')[0].click();
});

$('.excel-but').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.buttons-excel')[0].click();
});

$('.csv-but').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.buttons-csv')[0].click();
});

$('.pdf-but').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.buttons-pdf')[0].click();
});

$('#SubmitBTN').on('click',function(){
    $('input[name="status"]').val(1);
    $('form').submit();
});
$('#SaveBTN').on('click',function(){
    $('input[name="status"]').val(0);
    $('form').submit();
});
$('.Reset').on('click',function(){
    $('form input').val('');
    $('#kt_summernote_1').summernote('code', '');
    $('form textarea').val('');
});
$('.pageReset').on('click',function(){
    location.reload();
});

$('#kt_datetimepicker_7_1').datetimepicker({
    format: 'YYYY-MM-DD'
});
$('#kt_datetimepicker_7_2').datetimepicker({
    useCurrent: false,
    format: 'YYYY-MM-DD'
});

$('#kt_datetimepicker_7_1').on('change.datetimepicker', function (e) {
    $('#kt_datetimepicker_7_2').datetimepicker('minDate', e.date);
});
$('#kt_datetimepicker_7_2').on('change.datetimepicker', function (e) {
    $('#kt_datetimepicker_7_1').datetimepicker('maxDate', e.date);
});

$('#kt_datetimepicker_7_3').datetimepicker({
    format: 'YYYY-MM-DD'
});
$('#kt_datetimepicker_7_4').datetimepicker({
    useCurrent: false,
    format: 'YYYY-MM-DD'
});

$('#kt_datetimepicker_7_3').on('change.datetimepicker', function (e) {
    $('#kt_datetimepicker_7_4').datetimepicker('minDate', e.date);
});
$('#kt_datetimepicker_7_4').on('change.datetimepicker', function (e) {
    $('#kt_datetimepicker_7_3').datetimepicker('maxDate', e.date);
});