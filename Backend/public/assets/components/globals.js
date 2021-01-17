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
                var selectName = $(this).children('a.editable').data('col');
                var elem = $("select[name='"+selectName+"'] option");
                elem.each(function(){
                    var selected = '';
                    if($(this).text() == myText){
                        selected = ' selected';
                    }
                    if($(this).val() >= 0){
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
            i++;
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
                    $('#kt_datatable').DataTable().ajax.reload();
                }else{
                    errorNotification(data.status.message);
                    $('#kt_datatable').DataTable().ajax.reload();
                }
            },
        });
    }
});

$('#kt_dropzone_1').dropzone({
    url: myURL + "/uploadImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 10, // MB
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

$('#kt_dropzone_100').dropzone({
    url: myURL + "/uploadImage", // Set the url for your upload script location
    paramName: "photos", // The name that will be used to transfer the file
    maxFiles: 10,
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
    maxFilesize: 10, // MB
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

$('.select2').select2({
  placeholder: {
    id: '-1', // the value of the option
    text: 'حدد اختيارك'
  }
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

$('a.DeletePhotoS').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    var elemParent = $(this).parents('.dz-preview');
    var id = $(this).data('area');
    var name = $(this).data('name');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: 'POST',
        url: myURL+'/deleteImages',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': id,
            'name': name,
        },
        success:function(data){
            if(data.status.status == 1){
                successNotification(data.status.message);
                elemParent.remove();
            }else{
                errorNotification(data.status.message);
            }
        },
    });
});

$('p.locations').on('click',function(){
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

$('#kt_datetimepicker_7_5').datetimepicker({
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

$('select[name="valid_type"]').on('change',function(){
    $('input[name="valid_value"]').val('');
    if($(this).val() == 1){
        $('input[name="valid_value"]').attr('data-toggle','');
        $('input[name="valid_value"]').removeClass('datetimepicker-input');
    }else{
        $('input[name="valid_value"]').addClass('datetimepicker-input');
        $('input[name="valid_value"]').attr('data-toggle','datetimepicker');
    }
});