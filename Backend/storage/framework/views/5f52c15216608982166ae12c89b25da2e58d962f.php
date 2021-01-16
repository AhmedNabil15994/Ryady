<?php $__env->startSection('title','بطاقات الاعضاء - تعديل'); ?>


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
                <h3 class="text-dark font-weight-bold my-1 mr-5 m-subheader__title--separator">بطاقات الاعضاء</h3>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/')); ?>" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/userCards')); ?>" class="text-muted">بطاقات الاعضاء</a>
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
                    <?php if(\Helper::checkRules('add-user-card')): ?>
                    <a href="<?php echo e(URL::to('/userCards/add')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('sort-user-card')): ?>
                    <a href="<?php echo e(URL::to('/userCards/arrange')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('charts-user-card')): ?>
                    <a href="<?php echo e(URL::to('/userCards/charts')); ?>" class="dropdown-item">
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
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="<?php echo e(URL::to('/userCards/update/'.$data->data->id)); ?>">  
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">الرقم التسلسلي</label>
                            <input class="form-control mb-5" type="text" name="code" readonly value="<?php echo e($data->data->code); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">المستخدم</label>
                            <select name="user_id" class="form-control select2">
                                <option value="" disabled selected>حدد اختيارك</option>
                                <?php $__currentLoopData = $data->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e($data->data->user_id == $user->id ? 'selected' : ''); ?>><?php echo e($user->username); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>   
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الاسم عربي</label>
                            <input class="form-control mb-5" type="text" name="name_ar" value="<?php echo e($data->data->name_ar); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الاسم انجليزي</label>
                            <input class="form-control mb-5" type="text" name="name_en" value="<?php echo e($data->data->name_en); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">العضوية</label>
                            <select name="membership_id" class="form-control select2">
                                <option value="" disabled selected>حدد اختيارك</option>
                                <?php $__currentLoopData = $data->memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($membership->id); ?>" <?php echo e($data->data->membership_id == $membership->id ? 'selected' : ''); ?>><?php echo e($membership->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>   
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الحالة</label>
                            <select name="status" class="form-control select2">
                                <option value="" disabled>حدد اختيارك</option>
                                <option value="1" <?php echo e($data->data->status == 1 ? 'selected' : ''); ?>>مفعلة</option>
                                <option value="2" <?php echo e($data->data->status == 2 ? 'selected' : ''); ?>>تم ارسال الطلب</option>
                                <option value="3" <?php echo e($data->data->status == 3 ? 'selected' : ''); ?>>تم الرفض</option>
                            </select>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
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
                <input type="reset" class="btn btn-danger Reset" value="مسح الحقول">
                <input name="Add" type="hidden" value="TRUE" id="SaveBTN">
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/UserCard/Views/edit.blade.php ENDPATH**/ ?>