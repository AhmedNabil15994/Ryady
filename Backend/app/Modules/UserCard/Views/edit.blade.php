{{-- Extends layout --}}
@extends('Layouts.master')
@section('title','العضويات - تعديل')

{{-- Content --}}
@section('sub-header')

@endsection

@section('content')
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
                        <a href="{{ URL::to('/') }}" class="text-muted"><i class="m-nav__link-icon la la-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('/userCards') }}" class="text-muted">العضويات</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ URL::current() }}" class="text-muted">تعديل</a>
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
                    @if(\Helper::checkRules('add-user-card'))
                    <a href="{{ URL::to('/userCards/add') }}" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-plus"></i>
                        <span class="m-nav__link-text">اضافة</span>
                    </a>
                    @endif
                    @if(\Helper::checkRules('sort-user-card'))
                    <a href="{{ URL::to('/userCards/arrange') }}" class="dropdown-item">
                        <i class="m-nav__link-icon fa fa-sort-numeric-up"></i>
                        <span class="m-nav__link-text">ترتيب</span>
                    </a>
                    @endif
                    @if(\Helper::checkRules('charts-user-card'))
                    <a href="{{ URL::to('/userCards/charts') }}" class="dropdown-item">
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
                <i class="menu-icon far fa-credit-card"></i>
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
                <form class="forms m-form m-form--group-seperator-dashed" method="POST" action="{{ URL::to('/userCards/update/'.$data->data->id) }}">  
                    @csrf
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2 mt-15" style="margin-bottom: 20px;">الرقم التسلسلي</label>
                            <input class="form-control mb-5" type="text" name="code" readonly value="{{ $data->data->code }}" maxlength="" placeholder="">
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  {{ $data->data->created_at }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">المستخدم</label>
                            <select name="user_id" class="form-control select2">
                                <option value="" disabled selected>حدد اختيارك</option>
                                @foreach($data->users as $user)
                                <option value="{{ $user->id }}" {{ $data->data->user_id == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                                @endforeach
                            </select>   
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  {{ $data->data->created_at }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">العضوية</label>
                            <select name="membership_id" class="form-control select2">
                                <option value="" disabled selected>حدد اختيارك</option>
                                @foreach($data->memberships as $membership)
                                <option value="{{ $membership->id }}" {{ $data->data->membership_id == $membership->id ? 'selected' : '' }}>{{ $membership->title }}</option>
                                @endforeach
                            </select>   
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  {{ $data->data->created_at }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" style="padding-right: 0;padding-left: 0;padding-bottom: 10px;">
                        <div class="col-lg-12">
                            <label class="label label-danger label-pill label-inline mr-2" style="margin-bottom: 20px;">الحالة</label>
                            <select name="status" class="form-control select2">
                                <option value="" disabled>حدد اختيارك</option>
                                <option value="1" {{ $data->data->status == 1 ? 'selected' : '' }}>مفعلة</option>
                                <option value="2" {{ $data->data->status == 2 ? 'selected' : '' }}>تم ارسال الطلب</option>
                                <option value="3" {{ $data->data->status == 3 ? 'selected' : '' }}>تم الرفض</option>
                            </select>
                            <span class="m-form__help LastUpdate">تم الحفظ فى :  {{ $data->data->created_at }}</span>
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
@endsection
