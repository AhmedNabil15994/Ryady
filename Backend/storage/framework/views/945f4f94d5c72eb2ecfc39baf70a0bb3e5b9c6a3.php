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
        <!--end::Toolbar-->
    </div>
</div>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="menu-icon far fa-credit-card"></i>
            </span>
            <h3 class="card-label"><?php echo e($data->title); ?></h3>
        </div>
        <div class="card-toolbar">
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
                                    <label>اسم المستخدم:</label>
                                    <input type="text" class="form-control m-input" data-col-index="2" name="name" value="<?php echo e(Request::get('name')); ?>">
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label>كود البطاقة:</label>
                                    <input type="text" class="form-control m-input" data-col-index="3" name="code" value="<?php echo e(Request::get('code')); ?>">
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <input type="hidden" class="url" value="<?php echo e($data->url); ?>">
                                    <label>العضوية:</label>
                                    <select name="membership_id" class="form-control m-input">
                                        <option value="">حدد اختيارك</option>
                                        <?php $__currentLoopData = $data->memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <label>تاريخ البدء:</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control datetimepicker-input" id="kt_datetimepicker_7_1" placeholder="تاريخ البدء"  name="start_date" value="<?php echo e(Request::get('start_date')); ?>" data-toggle="datetimepicker" data-target="#kt_datetimepicker_7_1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <label>تاريخ الانتهاء:</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control datetimepicker-input" id="kt_datetimepicker_7_3" placeholder="تاريخ الانتهاء"  name="start_date" value="<?php echo e(Request::get('start_date')); ?>" data-toggle="datetimepicker" data-target="#kt_datetimepicker_7_3" />
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
        <!--begin: Datatable-->
        <table class="table table-separate table-hover table-bordered table-head-custom table-foot-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>اسم المستخدم</th>
                    <th>كود الطباقة</th>
                    <th>العضوية</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الانتهاء</th>
                    <th>الاجراءات</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>اسم المستخدم</th>
                    <th>كود الطباقة</th>
                    <th>العضوية</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الانتهاء</th>
                    <th>الاجراءات</th>
                </tr>
            </tfoot>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
<?php echo $__env->make('Partials.search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/components/userCertificates-datatables.js')); ?>"></script>           
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/UserCertificate/Views/index.blade.php ENDPATH**/ ?>