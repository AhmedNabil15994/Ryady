@extends('Layouts.master')

@section('title','طلب خدمة')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>طلب خدمة</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>طلب خدمة</li>
            </ul>
        </div>
    </div>
    
    <div class="addProject">
        <div class="container">
            <div class="clearfix hidden-sm hidden-xs wow bounceIn">
                <a href="#" class="itemProject">
                    <i class="flaticon-professor-consultation"></i>
                    <h2 class="titleItem">جلسات استشارية</h2>
                </a>
                <a href="#" class="itemProject">
                    <i class="flaticon-consultation"></i>
                    <h2 class="titleItem">زيارات استشارية للمشاريع</h2>
                </a>
                <a href="#" class="itemProject">
                    <i class="flaticon-sketch"></i>
                    <h2 class="titleItem">دراسة جدوى</h2>
                </a>
                <a href="#" class="itemProject">
                    <i class="flaticon-adaptive"></i>
                    <h2 class="titleItem">تصميم مواقع وتطبيقات</h2>
                </a>
                <a href="#" class="itemProject">
                    <i class="flaticon-analytics"></i>
                    <h2 class="titleItem">تقييم القيمة السوقية</h2>
                </a>
            </div>
            
            <div id="OwlProj" class="OwlProj visible-sm visible-xs Owl wow zoomIn">
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-professor-consultation"></i>
                        <h2 class="titleItem">جلسات استشارية</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-consultation"></i>
                        <h2 class="titleItem">زيارات استشارية للمشاريع</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-sketch"></i>
                        <h2 class="titleItem">دراسة جدوى</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-adaptive"></i>
                        <h2 class="titleItem">تصميم مواقع وتطبيقات</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-analytics"></i>
                        <h2 class="titleItem">تقييم القيمة السوقية</h2>
                    </a>
                </div>
            </div>


        </div>
    </div>

    
    <div class="orderPage">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block">
                <h2 class="title">نموذج طلب خدمة</h2>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" placeholder="الاسم :" />
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="inputStyle" placeholder="رقم الجوال :" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" placeholder="البريد الالكتروني :" />
                    </div>
                    <div class="col-md-6">
                        <div class="selectStyle">
                            <select class="selectmenu" id="selectmenu">
                                <option>حدد نوع الخدمة :</option>
                                <option>حدد نوع الخدمة :</option>
                                <option>حدد نوع الخدمة :</option>
                                <option>حدد نوع الخدمة :</option>
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                    </div>
                </div>
                <button class="btnStyle">ارسل الآن</button>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection