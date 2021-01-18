<?php $__env->startSection('title','مشاريع الاعضاء - تعديل'); ?>


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
                <h3 class="text-dark font-weight-bold my-1 mr-5 m-subheader__title--separator">مشاريع الاعضاء</h3>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/')); ?>" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('projects')); ?>" class="text-muted">مشاريع الاعضاء</a>
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
                    <?php if(\Helper::checkRules('add-project')): ?>
                    <a href="<?php echo e(URL::to('projects/add')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('sort-project')): ?>
                    <a href="<?php echo e(URL::to('projects/arrange')); ?>" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    <?php endif; ?>
                    <?php if(\Helper::checkRules('charts-project')): ?>
                    <a href="<?php echo e(URL::to('projects/charts')); ?>" class="dropdown-item">
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
                <i class="menu-icon fas fa-project-diagram"></i>
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
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="<?php echo e(URL::to('projects/update/'.$data->data->id)); ?>">  
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">اسم المشروع</label>
                            <input class="form-control" type="text" name="title" value="<?php echo e($data->data->title); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>     
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">العنوان</label>
                            <input type="hidden" name="lat" value="<?php echo e($data->data->lat != '' ? $data->data->lat : 24.774265); ?>">
                            <input type="hidden" name="lng" value="<?php echo e($data->data->lng != '' ? $data->data->lng : 46.738586); ?>">
                            <input class="form-control mb-5 m-input" type="text" name="address" value="<?php echo e($data->data->address); ?>" maxlength="" placeholder="">
                            <p class="label label-dark locations label-wide label-inline" data-toggle="modal" data-target=".modal-location">تحديد الموقع</p>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">البريد الالكتروني</label>
                            <input class="form-control mb-5 m-input" type="email" name="email" value="<?php echo e($data->data->email); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رقم الجوال</label>
                            <input class="form-control mb-5 m-input" type="text" name="phone" value="<?php echo e($data->data->phone); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">المدينة</label>
                            <select class="form-control m-input select2" name="city_id">
                                <option value="" disabled selected>حدد اختيارك</option>
                                <?php $__currentLoopData = $data->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($city->id); ?>" <?php echo e($data->data->city_id == $city->id ? 'selected' : ''); ?>><?php echo e($city->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">التصنيف</label>
                            <select class="form-control m-input select2" name="category_id">
                                <option value="" disabled selected>حدد اختيارك</option>
                                <?php $__currentLoopData = $data->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e($data->data->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">كوبونات الخصم</label>
                            <select class="form-control m-input select2" name="coupons[]" multiple>
                                <option value="" disabled>حدد اختيارك</option>
                                <?php $__currentLoopData = $data->coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($coupon->id); ?>" <?php echo e(in_array($coupon->code, $data->data->coupons) ? 'selected' : ''); ?>><?php echo e($coupon->code); ?></option>
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
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">نبذة عن المشروع</label>
                            <textarea class="summernote" id="kt_summernote_1" name="brief"><?php echo $data->data->brief; ?></textarea>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">شعار النشاط</label>
                            <div class="dropzone dropzone-default" id="kt_dropzone_11">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title"><i class="flaticon-upload-1 fa-4x"></i></h3>
                                    <span class="dropzone-msg-desc">اسحب الملفات هنا أو انقر هنا للرفع .</span>
                                </div>
                                <?php if($data->data->logo != ''): ?>
                                <div class="dz-preview dz-image-preview" id="my-preview">  
                                    <div class="dz-image">
                                        <img alt="image" src="<?php echo e($data->data->logo); ?>">
                                    </div>  
                                    <div class="dz-details">
                                        <div class="dz-size">
                                            <span><strong><?php echo e($data->data->logo_size); ?></strong></span>
                                        </div>
                                        <div class="dz-filename">
                                            <span data-dz-name=""><?php echo e($data->data->logo_name); ?></span>
                                        </div>
                                        <div class="PhotoBTNS">
                                            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
                                               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                                                    <a href="<?php echo e($data->data->logo); ?>" itemprop="contentUrl" data-size="555x370"><i class="flaticon-search"></i></a>
                                                    <img src="<?php echo e($data->data->logo); ?>" itemprop="thumbnail" style="display: none;">
                                                </figure>
                                            </div>
                                            <a class="DeletePhoto" data-area="<?php echo e($data->data->id); ?>"><i class="flaticon-delete" data-name="<?php echo e($data->data->logo_name); ?>" data-clname="Photo"></i> </a>                                               
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">صور عن النشاط</label>
                            <div class="dropzone dropzone-default" id="kt_dropzone_11">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title"><i class="flaticon-upload-1 fa-4x"></i></h3>
                                    <span class="dropzone-msg-desc">اسحب الملفات هنا أو انقر هنا للرفع .</span>
                                </div>
                                <?php if($data->data->images != []): ?>
                                <?php $__currentLoopData = $data->data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="dz-preview dz-image-preview">  
                                    <div class="dz-image">
                                        <img alt="image" src="<?php echo e($image->photo); ?>">
                                    </div>  
                                    <div class="dz-details">
                                        <div class="dz-size">
                                            <span><strong><?php echo e($image->photo_size); ?></strong></span>
                                        </div>
                                        <div class="dz-filename">
                                            <span data-dz-name=""><?php echo e($image->photo_name); ?></span>
                                        </div>
                                        <div class="PhotoBTNS">
                                            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
                                               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                                                    <a href="<?php echo e($image->photo); ?>" itemprop="contentUrl" data-size="555x370"><i class="flaticon-search"></i></a>
                                                    <img src="<?php echo e($image->photo); ?>" itemprop="thumbnail" style="display: none;">
                                                </figure>
                                            </div>
                                            <a class="DeletePhotoS" data-area="<?php echo e($data->data->id); ?>" data-name="<?php echo e($image->photo_name); ?>"><i class="flaticon-delete" data-name="<?php echo e($image->photo_name); ?>" data-clname="Photo"></i> </a>                                               
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رابط فيسبوك</label>
                            <input class="form-control mb-5 m-input" type="text" name="facebook_url" value="<?php echo e($data->data->facebook_url); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رابط تويتر</label>
                            <input class="form-control mb-5 m-input" type="text" name="twitter_url" value="<?php echo e($data->data->twitter_url); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رابط يوتيوب</label>
                            <input class="form-control mb-5 m-input" type="text" name="youtube_url" value="<?php echo e($data->data->youtube_url); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رابط سناب شات</label>
                            <input class="form-control mb-5 m-input" type="text" name="snapchat_url" value="<?php echo e($data->data->snapchat_url); ?>" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  <?php echo e($data->data->created_at); ?></span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رابط انستجرام</label>
                            <input class="form-control mb-5 m-input" type="text" name="instagram_url" value="<?php echo e($data->data->instagram_url); ?>" maxlength="" placeholder="">
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
<?php echo $__env->make('Partials.locationModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/js/pages/crud/forms/editors/summernote.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/js/photoswipe.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/js/photoswipe-ui-default.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/components/myPhotoSwipe.js')); ?>"></script>     
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?php echo e(asset('/assets/js/locationpicker.jquery.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/Project/Views/edit.blade.php ENDPATH**/ ?>