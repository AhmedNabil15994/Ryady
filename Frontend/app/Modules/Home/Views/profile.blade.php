@extends('Layouts.master')

@section('title','الملف الشخصي')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>الملف الشخصي</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>الملف الشخصي</li>
            </ul>
        </div>
    </div>
    
    <div class="profile">
        <h2 class="titleStyle">محمد بن خالد</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="userProfile">
                        <center>
                            <form class="userImg">
                                <label>
                                    <img src="{{ asset('/assets/images/memb1.png') }}" class="img" alt="" />
                                    <i class="camera"><img src="{{ asset('/assets/images/photo-camera.svg') }}" /></i>
                                    <input type="file" />
                                </label>
                            </form>
                        </center>
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <span>ريادي</span>
                        <ul class="listProfile">
                            <li><a href="#">العضوية 
                                <img src="{{ asset('/assets/images/024-name.svg') }}" />
                                </a></li>
                            <li><a href="#">اضف مقالة 
                                <img src="{{ asset('/assets/images/025-content-writing.svg') }}" />
                            </a></li>
                            <li><a href="#">شهادة العضوية 
                                <img src="{{ asset('/assets/images/026-document.svg') }}" />
                            </a></li>
                            <li><a href="#">اضف مشروعك 
                                <img src="{{ asset('/assets/images/027-add.svg') }}" />
                            </a></li>
                            <li><a href="#">اطلب خدمة 
                                <img src="{{ asset('/assets/images/028-support.svg') }}" />    
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabsHead">
                            <ul class="btnsTabs clearfix" id="tabs">
                                <li id="tab1" class="active">ترقية البطاقة</li>
                                <li id="tab2">تفعيل البطاقة</li>
                                <li id="tab3">مميزات العضوية</li>
                            </ul>
                        </div>
                        <div class="tabs">
                            <div class="tab1 tab">
                                <div class="cardHead">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <img src="{{ asset('/assets/images/card3.png') }}" alt="" />
                                        </div>
                                        <div class="col-md-5">
                                            <center>
                                                <div class="memberStyle">
                                                    <h2 class="titleMem">عضوية منتسب</h2>
                                                    <span class="price">175 ريال</span>
                                                    <span class="time">لمدة سنة</span>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                
                                <form class="formStyle">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="inputStyle" placeholder="اسمك على البطاقة بالعربي" />
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="inputStyle" placeholder="رقم الجوال" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="inputStyle" placeholder="اسمك على البطاقة بالإنجليزي" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="inputStyle" placeholder="رقم البطاقة" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dateStyle">
                                                <input type="text" class="inputStyle datepicker" placeholder="بداية من" />
                                                <i class="flaticon-school-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dateStyle">
                                                <input type="text" class="inputStyle datepicker" placeholder="الانتهاء الي" />
                                                <i class="flaticon-school-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="checkStyle">
                                                <input type="checkbox" checked />
                                                <i></i>
                                                بطاقة مطبوعة رسوم اضافية 100 ريال
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="checkStyle">
                                                <input type="checkbox" checked />
                                                <i></i>
                                                الشروط والحكام
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btnForm">ارسال الطلب</button>
                                    
                                </form>

                            </div>
                            <div class="tab2 tab">
                                test
                            </div>
                            <div class="tab3 tab">
                                test
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

        </div>
    </div> 
@endsection

@section('scripts')

@endsection