<?php $__env->startSection('title','كوبونات الخصم - تعديل'); ?>


<?php $__env->startSection('sub-header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-2 py-lg-6 subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h3 class="text-dark font-weight-bold my-1 mr-5 m-subheader__title--separator">كوبونات الخصم</h3>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/')); ?>" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/coupons')); ?>" class="text-muted">كوبونات الخصم</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::current()); ?>" class="text-muted">تعديل</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Dropdown-->
            <div class="main-menu dropdown dropdown-inline">
                <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-hor"></i>
                </button>
                <div class="dropdown-menu" dropdown-toggle="hover">
                    <?php if(\Helper::checkRules('add-coupon')): ?>
                    <a href="<?php echo e(URL::to('/coupons/add')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('sort-coupon')): ?>
                    <a href="<?php echo e(URL::to('/coupons/arrange')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('charts-coupon')): ?>
                    <a href="<?php echo e(URL::to('/coupons/charts')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon flaticon-graph"></i>
                        <span class="m-nav__link-text">الاحصائيات</span>
                    </a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <div href="#" class="dropdown-item">
                        <a href="<?php echo e(URL::to('/logout')); ?>" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">تسجيل الخروج</a>
                    </div>
                </div>
            </div>
            <!--end::Dropdown-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="menu-icon flaticon-menu-1"></i>
            </span>
            <h3 class="card-label">تعديل</h3>
        </div>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs  m-tabs-line" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#AddTabs" role="tab"><i class="la la-refresh"></i>تعديل</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="AddTabs" role="tabpanel">
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="<?php echo e(URL::to('/coupons/update/'.$data->data->id)); ?>">  
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">الكود</label>
                            <input class="form-control" type="text" name="code" value="<?php echo e($data->data->code); ?>" maxlength="" placeholder="">
                            <input type="hidden" name="status" value="<?php echo e($data->data->status); ?>">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>      
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">نوع الخصم</label>
                            <select name="discount_type" class="form-control">
                                <option value="1" <?php echo e($data->data->discount_type == 1 ? 'selected' : ''); ?>>قيمة محددة</option>
                                <option value="2" <?php echo e($data->data->discount_type == 2 ? 'selected' : ''); ?>>نسبة مئوية</option>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">قيمة الخصم</label>
                            <input class="form-control mb-5" type="text" name="discount_value" value="<?php echo e($data->data->discount_value); ?>" maxlength="" placeholder="">
                        </div>
                    </div>     
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">نوع المدة المتاحة</label>
                            <select name="valid_type" class="form-control">
                                <option value="1" <?php echo e($data->data->valid_type == 1 ? 'selected' : ''); ?>>عدد مرات استخدام</option>
                                <option value="2" <?php echo e($data->data->valid_type == 2 ? 'selected' : ''); ?>>لتاريخ معين</option>
                            </select>
                        </div>
                    </div>     
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">متاح ل</label>
                            <input class="form-control mb-5" data-toggle="<?php echo e($data->data->valid_type == 2 ? 'datetimepicker' : ''); ?>" id="<?php echo e($data->data->valid_type == 2 ? 'kt_datetimepicker_7_1' : ''); ?>" data-target="#kt_datetimepicker_7_1" type="text" name="valid_value" value="<?php echo e($data->data->valid_value); ?>" maxlength="" placeholder="">
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <input name="Submit" type="submit" class="btn btn-success AddBTN " value="حفظ" id="SubmitBTN">
                <input name="Submit" type="submit" class="btn btn-primary AddBTN " value="حفظ كمسودة" id="SaveBTN">
                <input type="reset" class="btn btn-danger Reset" value="مسح الحقول">
                <input name="Add" type="hidden" value="TRUE" id="SaveBTN">
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/Coupon/Views/edit.blade.php ENDPATH**/ ?>