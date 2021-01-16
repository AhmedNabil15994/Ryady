<?php $__env->startSection('title',$data->title); ?>


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
                <h3 class="text-dark font-weight-bold my-1 mr-5 m-subheader__title--separator"><?php echo e($data->title); ?></h3>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/')); ?>" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(URL::to('/'.$data->url)); ?>" class="text-muted"><?php echo e($data->title); ?></a>
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
                    <?php if(\Helper::checkRules('charts-'.$data->name)): ?>
                    <a href="<?php echo e(URL::to('/'.$data->url.'/charts')); ?>" class="dropdown-item">
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
                <i class="menu-icon flaticon-users"></i>
            </span>
            <h3 class="card-label"><?php echo e($data->title); ?></h3>
        </div>
        <div class="card-toolbar">
            <?php if(\Helper::checkRules('edit-'.$data->name)): ?>
            <a href="#" class="btn btn-outline-success quickEdit m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill " data-toggle="tooltip" data-placement="top" data-original-title="تعديل سريع">
                <i class="la la-edit"></i>
            </a>
            <?php endif; ?>
            <a href="#" class="btn btn-outline-danger search-mode m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill " data-toggle="tooltip" data-placement="top" data-original-title="معلومات عن البحث المتقدم">
                <i class="flaticon-questions-circular-button"></i>
            </a>
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الاجراءات</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="nav flex-column nav-hover">
                        <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">خيارات التصدير</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link print-but">
                                <i class="nav-icon la la-print"></i>
                                <span class="nav-text">Print</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link copy-but">
                                <i class="nav-icon la la-copy"></i>
                                <span class="nav-text">Copy</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link excel-but">
                                <i class="nav-icon la la-file-excel-o"></i>
                                <span class="nav-text">Excel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link csv-but">
                                <i class="nav-icon la la-file-text-o"></i>
                                <span class="nav-text">CSV</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link pdf-but">
                                <i class="nav-icon la la-file-pdf-o"></i>
                                <span class="nav-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
    </div>
    <div class="card-body">
        <div class="accordion accordion-solid accordion-toggle-arrow" id="accordionExample6">
            <div class="card ">
                <div class="card-header" id="headingTwo6">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false">
                        <i class="flaticon-search-1"></i>البحث المتقدم
                    </div>
                </div>
                <div id="collapseTwo6" class="collapse" data-parent="#accordionExample6" style="">
                    <div class="card-body">
                        <form class="m-form m-form--fit m--margin-bottom-20" method="get" action="<?php echo e(URL::current()); ?>">
                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>ID:</label>
                                    <input type="text" class="form-control m-input" data-col-index="0" name="id" value="<?php echo e(Request::get('id')); ?>">
                                    <br>
                                </div>  
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>الاسم:</label>
                                    <input type="text" class="form-control m-input" data-col-index="2" name="name" value="<?php echo e(Request::get('name')); ?>">
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>البريد الالكتروني:</label>
                                    <input type="text" class="form-control m-input" data-col-index="3" name="email" value="<?php echo e(Request::get('email')); ?>">
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>رقم الجوال:</label>
                                    <input type="text" class="form-control m-input" data-col-index="4" name="phone" value="<?php echo e(Request::get('phone')); ?>">
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>التصنيف:</label>
                                    <select name="category_id" class="form-control m-input">
                                        <option value="">حدد اختيارك</option>
                                        <?php $__currentLoopData = $data->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <input type="hidden" class="url" value="<?php echo e($data->url); ?>">
                                    <label>الحالة:</label>
                                    <select name="status" class="form-control m-input">
                                        <option value="">حدد اختيارك</option>
                                        <option value="1">طلب جديد</option>
                                        <option value="2">تم الارسال</option>
                                        <option value="3">تأجيل</option>
                                        <option value="4">تم التسليم</option>
                                        <option value="5">عدم الرد</option>
                                        <option value="6">ملغية</option>
                                        <option value="7">المهملات</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <label>تاريخ الارسال:</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control datetimepicker-input" id="kt_datetimepicker_7_1" placeholder="تاريخ الارسال"  name="created_at" value="<?php echo e(Request::get('created_at')); ?>" data-col-index="8" data-toggle="datetimepicker" data-target="#kt_datetimepicker_7_1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-separator m-separator--md m-separator--dashed"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-brand m-btn m-btn--icon" type="submit" id="m_search">
                                        <span>
                                            <i class="la la-search"></i>
                                            <span>البحث</span>
                                        </span>
                                    </button>
                                    &nbsp;&nbsp;
                                    <a href="<?php echo e(URL::to('/'.$data->url)); ?>" class="btn btn-secondary m-btn m-btn--icon" id="m_reset">
                                        <span>
                                            <i class="la la-close"></i>
                                            <span>الغاء</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="data-area" value="<?php echo e(\Helper::checkRules('edit-'.$data->name)); ?>">
        <input type="hidden" name="data-cols" value="<?php echo e(\Helper::checkRules('delete-'.$data->name)); ?>">
        <!--begin: Datatable-->
        <table class="table table-separate table-hover table-bordered table-head-custom table-foot-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>اختيار</th>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>رقم الجوال</th>
                    <th>التصنيف</th>
                    <th>الحالة</th>
                    <th>تاريخ الارسال</th>
                    <th>الاجراءات</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>اختيار</th>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>رقم الجوال</th>
                    <th>التصنيف</th>
                    <th>الحالة</th>
                    <th>تاريخ الارسال</th>
                    <th>الاجراءات</th>
                </tr>
            </tfoot>
        </table>
        <!--end: Datatable-->
        <div class="row mt-5">
            <div class="col-lg-6">
                <button type="button" class="btn btn-block btn-success selectAll">تحديد الكل</button>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-block btn-danger deselectAll">الغاء تحديد الكل</button>
            </div>
        </div>
        <?php if($data->url == 'orders'): ?>
        <div class="row mt-5">
            <div class="col-lg-12">
                <button type="button" class="btn btn-block btn-danger delete">حذف نهائي</button>
            </div>
        </div>
        <?php elseif($data->url == 'trashes'): ?>
        <div class="row mt-5">
            <div class="col-lg-6">
                <button type="button" class="btn btn-block btn-danger delete">حذف نهائي</button>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-block btn-primary backToNew">اخراج من السلة (كطلب جديد)</button>
            </div>
        </div>
        <?php else: ?>
        <div class="row mt-5">
            <div class="col-lg-12">
                <button type="button" class="btn btn-block btn-success delete">حذف</button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!--end::Card-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
<?php echo $__env->make('Partials.search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/components/orders-datatables.js')); ?>"></script>           
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/Order/Views/index.blade.php ENDPATH**/ ?>