@extends('Layouts.master')

@section('title','اتصل بنا')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>اتصل بنا</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>اتصل بنا</li>
            </ul>
        </div>
    </div>
        
    <div class="contactUs">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block">
                <h2 class="title">ارسال رسالة</h2>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" placeholder="الاسم" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" placeholder="البريد الالكتروني" />
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="inputStyle" placeholder="رقم الجوال" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" placeholder="عنوان الرسالة" />
                    </div>
                    <div class="col-md-12">
                        <textarea class="textareaStyle" placeholder="عنوان الرسالة"></textarea>
                    </div>
                </div>
                <button class="btnStyle">ارسال رسالة</button>
            </form>
        </div>
        </div>
    </div>
    
    <div class="mapSec">
        <div class="infoMap">
            <h2 class="title">معلومات الاتصال</h2>
            <div class="infoDetails">
                <i class="flaticon-email"></i>
                <span>البريد الإلكتروني</span>
                <a href="#">name@name.com</a>
            </div>
            <div class="infoDetails">
                <i class="flaticon-phone-call"></i>
                <span>رقم الجوال</span>
                <a href="#">012345678912345</a>
            </div>
            <div class="infoDetails">
                <i class="flaticon-place"></i>
                <span>العنوان</span>
                <a>
                    برج المستقبل
                    <br>
                    الصحافة، الرياض 13321 6245،
                    <br>
                    المملكة العربية السعودية
                </a>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.2715939772993!2d39.1750041850587!3d21.536233085725666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d09b97e2fb0d%3A0x3bafaf5c1752cb0c!2z2YXYsdmD2LIg2KfZhNiu2YjYp9iv2YUg2KfZhNix2YLZhdmK2Kk!5e0!3m2!1sar!2seg!4v1609832985587!5m2!1sar!2seg" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
@endsection

@section('scripts')

@endsection