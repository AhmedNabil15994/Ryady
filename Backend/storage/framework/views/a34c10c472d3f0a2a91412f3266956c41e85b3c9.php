<!--begin::Fonts-->
<?php 
	$dir = DIRECTION == 'rtl' ? '.rtl' : '';
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<link href="https://fonts.googleapis.com/css?family=Tajawal:300,400,500,600,700" rel="stylesheet">
<!--end::Fonts-->
<!--begin::Page Vendors Styles(used by this page)-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/plugins/custom/kanban/kanban.bundle.css')); ?>">
<link href="<?php echo e(asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
<!--begin::Global Theme Styles(used by all pages)-->
<link href="<?php echo e(asset('/assets/plugins/global/plugins.bundle'.$dir.'.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/plugins/custom/prismjs/prismjs.bundle'.$dir.'.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/css/style.bundle'.$dir.'.css')); ?>" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="<?php echo e(asset('/assets/css/themes/layout/header/base/light.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/css/themes/layout/header/menu/light.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/css/themes/layout/brand/dark.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/css/themes/layout/aside/dark.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(asset('/assets/css/touches.css')); ?>" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href="<?php echo e(asset('/assets/images/favicon.ico')); ?>" />
<?php echo $__env->yieldContent('styles'); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/resources/views/Layouts/head.blade.php ENDPATH**/ ?>