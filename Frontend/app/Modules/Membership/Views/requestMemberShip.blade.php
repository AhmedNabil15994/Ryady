@extends('Layouts.master')

@section('title','تفاصيل العضويات')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>العضويات</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>العضويات</li>
            </ul>
        </div>
    </div>
    
    <div class="formMembers">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <form class="formStyle">
                        <h2 class="title">نموذج طلب عضوية</h2>
                        <input type="text" class="inputStyle" placeholder="اسمك على البطاقة بالعربي" />
                        <input type="text" class="inputStyle" placeholder="اسمك على البطاقة بالإنجليزي" />
                        <div class="selectStyle">
                            <select class="selectmenu" id="selectmenu">
                                <option>نوع العضوية منتسب 175 ريال</option>
                                <option>نوع العضوية منتسب 175 ريال</option>
                                <option>نوع العضوية منتسب 175 ريال</option>
                                <option>نوع العضوية منتسب 175 ريال</option>
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                        <input type="text" class="inputStyle" placeholder="رقم الجوال" />
                        <input type="text" class="inputStyle " placeholder="رقم البطاقة" />
                        <div class="dateStyle">
                            <input type="text" class="inputStyle datepicker" placeholder="بداية من" />
                            <i class="flaticon-school-calendar"></i>
                        </div>
                        <div class="dateStyle">
                            <input type="text" class="inputStyle datepicker" placeholder="الانتهاء الي" />
                            <i class="flaticon-school-calendar"></i>
                        </div>
                        <label class="checkStyle">
                            <input type="checkbox" checked />
                            <i></i>
                            بطاقة مطبوعة رسوم اضافية 100 ريال
                        </label>
                        <label class="checkStyle">
                            <input type="checkbox" checked />
                            <i></i>
                            الشروط والحكام
                        </label>
                        <button class="btnForm">ارسال الطلب</button>
                        
                    </form>

                </div>
                <div class="col-md-7">
                    <div class="details">
                        <img src="{{ asset('/assets/images/card1.png') }}" alt="" />
                        <div class="content">
                            <h2 class="titleContent">لإصدار بطاقتك، اتبع الخطوات التالية :</h2>
                            <ul class="listDetails">
                                <li class="active">اختر البطاقة المناسبة لك</li>
                                <li class="active">ادخل معلومات الحقول</li>
                                <li>اختر طريقة الدفع</li>
                                <li>ارسال طلب البطاقة</li>
                            </ul>
                            <div class="memberStyle">
                                <h2 class="titleMem">عضوية منتسب</h2>
                                <span class="price">175 ريال</span>
                                <span class="time">لمدة سنة</span>
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