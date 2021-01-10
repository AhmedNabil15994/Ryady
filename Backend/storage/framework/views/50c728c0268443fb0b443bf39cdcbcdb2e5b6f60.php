<!DOCTYPE html>
<html lang="en" dir="<?php echo e(DIRECTION); ?>">
	<head>
		<meta charset="utf-8" />
		<title><?php echo e(\App\Models\Variable::getVar('العنوان عربي')); ?> | <?php echo $__env->yieldContent('title'); ?></title>
		<meta name="description" content="#" />
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<?php echo $__env->make('Layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<?php echo $__env->make('Layouts.header-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<?php echo $__env->make('Layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<?php echo $__env->make('Layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<?php echo $__env->yieldContent('sub-header'); ?>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Dashboard-->
								<?php echo $__env->yieldContent('content'); ?>
								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<?php echo $__env->make('Layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<?php echo $__env->yieldContent('modals'); ?>
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<i class="la la-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->

		<?php echo $__env->make('Layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Partials.notf_messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</body>
	<!--end::Body-->
</html><?php /**PATH /var/www/Server/Projects/Ryady/Backend/resources/views/Layouts/master.blade.php ENDPATH**/ ?>