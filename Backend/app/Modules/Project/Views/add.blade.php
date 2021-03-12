{{-- Extends layout --}}
@extends('Layouts.master')
@section('title','مشاريع الاعضاء - اضافة')

{{-- Content --}}
@section('styles')
<style type="text/css" media="screen">
    body{
        overflow-x: hidden;
    }
</style>
@endsection

@section('content')
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
                        <a href="{{ URL::to('/') }}" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('/projects') }}" class="text-muted">مشاريع الاعضاء</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('/projects/add') }}" class="text-muted">اضافة</a>
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
                    @if(\Helper::checkRules('add-project'))
                    <a href="{{ URL::to('/projects/add') }}" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    @endif
                    @if(\Helper::checkRules('sort-project'))
                    <a href="{{ URL::to('/projects/arrange') }}" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    @endif
                    @if(\Helper::checkRules('charts-project'))
                    <a href="{{ URL::to('/projects/charts') }}" class="dropdown-item">
                        <i class="m-nav__link-icon flaticon-graph"></i>
                        <span class="m-nav__link-text">الاحصائيات</span>
                    </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <div href="#" class="dropdown-item">
                        <a href="{{ URL::to('/logout') }}" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">تسجيل الخروج</a>
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
            <h3 class="card-label">اضافة</h3>
        </div>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs  m-tabs-line" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#AddTabs" role="tab"><i class="fa fa-plus"></i>اضافة</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="AddTabs" role="tabpanel">
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="{{ URL::to('/projects/create') }}">  
                    @csrf
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">اسم المشروع</label>
                            <input class="form-control mb-5" type="text" name="title" value="{{ old('title') }}" maxlength="" placeholder="">
                        </div>
                    </div>  
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">حالة المشروع</label>
                            <select class="form-control m-input select2" name="type">
                                <option value="" disabled selected>حدد اختيارك</option>
                                <option value="تحت التأسيس" {{ old('type') == 'تحت التأسيس' ? 'selected' : '' }}>تحت التأسيس</option>
                                <option value="قائم" {{ old('type') == 'قائم' ? 'selected' : '' }}>قائم</option>
                                <option value="متعثر" {{ old('type') == 'متعثر' ? 'selected' : '' }}>متعثر</option>
                                <option value="@" {{ old('type') == '@' ? 'selected' : '' }}>أخري</option>
                            </select>
                            <input type="text" class="form-control mt-5 hidden" value="{{ old('type_text') }}" name="type_text" placeholder="أخري :" />
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الموقع الجغرافي</label>
                            <br>
                            <p class="label label-dark locations label-wide label-inline" data-toggle="modal" data-target=".modal-location">تحديد الموقع</p>
                            <input type="hidden" name="lat" value="{{ Request::has('lat') ? Request::get('lat') : 24.774265 }}">
                            <input type="hidden" name="lng" value="{{ Request::has('lng') ? Request::get('lng') : 46.738586 }}">
                            <input type="hidden" name="status" value="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">البريد الالكتروني</label>
                            <input class="form-control mb-5 m-input" type="email" name="email" value="{{ old('email') }}" maxlength="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رقم الجوال</label>
                            <input class="form-control mb-5 m-input" type="text" name="phone" value="{{ old('phone') }}" maxlength="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">المدينة</label>
                            <select class="form-control m-input select2" name="city_id">
                                <option value="" disabled selected>حدد اختيارك</option>
                                @foreach($data->cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">التصنيف</label>
                            <select class="form-control m-input select2" name="category_id">
                                <option value="" disabled selected>حدد اختيارك</option>
                                @foreach($data->categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">اظهار الصور: </label>
                            <select name="show_images" class="form-control mb-5 select2" id="kt_select2_12">
                                <option value="0" {{ old('show_images') == 0 ? 'selected' : '' }}>لا</option>
                                <option value="1" {{ old('show_images') == 1 ? 'selected' : '' }}>نعم</option>
                            </select>
                        </div>
                    </div>     
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">رأس مال المشروع</label>
                            <input class="form-control mb-5 m-input" type="text" name="coupons" value="{{ old('coupons') }}" maxlength="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">نبذة عن المشروع</label>
                            <textarea class="summernote mb-5" id="kt_summernote_1" name="brief">{{ old('brief') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">شعار النشاط</label>
                            <div class="dropzone dropzone-default mb-5" id="kt_dropzone_1">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title"><i class="flaticon-upload-1 fa-4x"></i></h3>
                                    <span class="dropzone-msg-desc">اسحب الملفات هنا أو انقر هنا للرفع .</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">صور عن النشاط</label>
                            <div class="dropzone dropzone-default mb-5" id="kt_dropzone_100">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title"><i class="flaticon-upload-1 fa-4x"></i></h3>
                                    <span class="dropzone-msg-desc">اسحب الملفات هنا أو انقر هنا للرفع .</span>
                                </div>
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
                <input name="Submit" type="submit" class="btn btn-success AddBTN " value="اضافة" id="SubmitBTN">
                <input name="Submit" type="submit" class="btn btn-primary AddBTN " value="حفظ كمسودة" id="SaveBTN">
                <input type="reset" class="btn btn-danger Reset pageReset" value="مسح الحقول">
                <input name="Add" type="hidden" value="TRUE" id="SaveBTN">
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
@endsection

@section('modals')
@include('Partials.locationModal')
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('/assets/js/pages/crud/forms/editors/summernote.js') }}"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="{{ asset('/assets/js/locationpicker.jquery.js') }}"></script>
<script src="{{ asset('/assets/components/projects.js') }}"></script>
@endsection
