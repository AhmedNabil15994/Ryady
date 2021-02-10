<style type="text/css" media="screen">
    div.toast-title{
        color: #FFF !important;
    }
</style>
<script>
    <?php if(Session::has('success')): ?>
        setTimeout(function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": false,
                "newestOnTop": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "400",
                "hideDuration": "1000",
                "timeOut": "1000",
                // "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "icon" : false,
            };
            toastr.success('', "<?php echo e(Session::get('success')); ?>" );
        }, 1300);
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
     setTimeout(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "newestOnTop": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "1000",
            // "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "icon" : false,
        };
        toastr.error('', "<?php echo e(Session::get('error')); ?>" );
    }, 1300);
    <?php endif; ?>
</script>
<?php /**PATH /var/www/Server/Projects/Ryady/Backend/resources/views/Partials/notf_messages.blade.php ENDPATH**/ ?>