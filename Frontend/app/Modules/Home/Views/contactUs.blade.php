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
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">اتصل بنا</li>
            </ul>
        </div>
    </div>
        
    <div class="contactUs">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block" method="POST" action="{{ URL::current() }}">
                @csrf
                <h2 class="title">ارسال رسالة</h2>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="name" value="{{ old('name') }}" placeholder="الاسم" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" />
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="inputStyle" name="phone" value="{{ old('phone') }}" placeholder="رقم الجوال" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="address" value="{{ old('address') }}" placeholder="عنوان الرسالة" />
                    </div>
                    <div class="col-md-12">
                        <textarea class="textareaStyle" name="message" placeholder="عنوان الرسالة"></textarea>
                    </div>
                </div>
                <button type="submit" class="btnStyle">ارسال رسالة</button>
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
                <a href="#">{{ $data->email }}</a>
            </div>
            <div class="infoDetails">
                <i class="flaticon-phone-call"></i>
                <span>رقم الجوال</span>
                <a href="#">{{ $data->phone }}</a>
            </div>
            <div class="infoDetails">
                <i class="flaticon-place"></i>
                <span>العنوان</span>
                <a>
                    {{ $data->address }}
                </a>
            </div>
        </div>
        <iframe src = "https://maps.google.com/maps?q={{ $data->lat }},{{ $data->lng }}&hl=es;z=14&amp;output=embed" width="600" height="450"></iframe>
    </div>
@endsection

@section('scripts')

@endsection