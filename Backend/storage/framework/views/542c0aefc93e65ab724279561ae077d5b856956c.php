<?php $__env->startSection('title','العضويات - تعديل'); ?>


<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/default-skin.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/photoswipe.css')); ?>">
<style type="text/css" media="screen">
    body{
        overflow-x: hidden;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-2 py-lg-6 subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h3 class="text-dark font-weight-bold my-1 mr-5 m-subheader__title--separator">العضويات</h3>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/')); ?>" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/memberships')); ?>" class="text-muted">العضويات</a>
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
                    <?php if(\Helper::checkRules('add-membership')): ?>
                    <a href="<?php echo e(URL::to('/memberships/add')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('sort-membership')): ?>
                    <a href="<?php echo e(URL::to('/memberships/arrange')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('charts-membership')): ?>
                    <a href="<?php echo e(URL::to('/memberships/charts')); ?>" class="dropdown-item">
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
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="<?php echo e(URL::to('/memberships/update/'.$data->data->id)); ?>">  
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">العنوان عربي</label>
                            <input class="form-control" type="text" name="title" value="<?php echo e($data->data->title); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>     
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">السعر</label>
                            <input class="form-control" type="text" name="price" value="<?php echo e($data->data->price); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">المدة (مثال: 1 = سنة)</label>
                            <input class="form-control m-input" type="number" name="period" value="<?php echo e($data->data->period); ?>" maxlength="" placeholder="">
                            <input type="hidden" name="status" value="<?php echo e($data->data->status); ?>">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">المميزات</label>
                            <div class="row">
                                <?php $__currentLoopData = $data->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $oneFeature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6 col-sm-6">
                                    <label class="checkbox checkbox-success">
                                    <input type="checkbox" <?php echo e($data->data->features != '' && in_array($oneFeature->id,$data->data->features) ? 'checked' : ''); ?> name="features[]" value="<?php echo e($oneFeature->id); ?>" />
                                    <span></span><?php echo e($oneFeature->title); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <br>
                                            <button type="button" style="width:100%;" class="btn btn-success btn-lg btn-block SelectAllCheckBox">اختيار الكل</button>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <br>
                                            <button type="button" style="width:100%;" class="btn btn-danger btn-lg btn-block UnSelectAllCheckBox">عدم اختيار الكل</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div> 
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الصورة</label>
                            <div class="dropzone dropzone-default" id="kt_dropzone_11">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title"><i class="flaticon-upload-1 fa-4x"></i></h3>
                                    <span class="dropzone-msg-desc">اسحب الملفات هنا أو انقر هنا للرفع .</span>
                                </div>
                                <?php if($data->data->photo != ''): ?>
                                <div class="dz-preview dz-image-preview" id="my-preview">  
                                    <div class="dz-image">
                                        <img alt="image" src="<?php echo e($data->data->photo); ?>">
                                    </div>  
                                    <div class="dz-details">
                                        <div class="dz-size">
                                            <span><strong><?php echo e($data->data->photo_size); ?></strong></span>
                                        </div>
                                        <div class="dz-filename">
                                            <span data-dz-name=""><?php echo e($data->data->photo_name); ?></span>
                                        </div>
                                        <div class="PhotoBTNS">
                                            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
                                               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                                                    <a href="<?php echo e($data->data->photo); ?>" itemprop="contentUrl" data-size="555x370"><i class="flaticon-search"></i></a>
                                                    <img src="<?php echo e($data->data->photo); ?>" itemprop="thumbnail" style="display: none;">
                                                </figure>
                                            </div>
                                            <a class="DeletePhoto" data-area="<?php echo e($data->data->id); ?>"><i class="flaticon-delete" data-name="<?php echo e($data->data->photo_name); ?>" data-clname="Photo"></i> </a>                                               
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
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
                <input type="reset" class="btn btn-danger Reset pageReset" value="مسح الحقول">
                <input name="Add" type="hidden" value="TRUE" id="SaveBTN">
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
<?php echo $__env->make('Partials.photoswipe_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/js/photoswipe.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/js/photoswipe-ui-default.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/components/myPhotoSwipe.js')); ?>"></script>     
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/Membership/Views/edit.blade.php ENDPATH**/ ?>