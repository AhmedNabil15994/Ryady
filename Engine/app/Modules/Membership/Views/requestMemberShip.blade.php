@extends('Layouts.master')

@section('title','تفاصيل العضويات')

@section('styles')
<style type="text/css" media="screen">
    label{
        color: #001C54;
        font-size: 18px;
    }
</style>
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
                    <form class="formStyle" method="POST" action="{{ URL::current() }}">
                        @csrf
                        <h2 class="title">نموذج طلب عضوية</h2>
                        <label for="">اسمك على البطاقة بالعربي</label>
                        <input type="text" name="name_ar" value="{{ \Request::get('name_ar') }}" class="inputStyle"/>
                        <label for="">اسمك على البطاقة بالإنجليزي</label>
                        <input type="text" name="name_en" value="{{ \Request::get('name_en') }}" class="inputStyle"/>
                        <label for="">اختر العضوية</label>
                        <div class="selectStyle">
                            <select class="selectmenu" id="selectmenu" name="membership_id">
                                @foreach($data->memberships as $membership)
                                <option value="{{ $membership->id }}" {{ $data->data->id == $membership->id ? 'selected' : '' }}>عضوية {{ $membership->title . ' ' . $membership->price }} ريال</option>
                                @endforeach
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                        <label for="">رقم الجوال</label>
                        <input type="text" class="inputStyle" value="{{ \Request::get('phone') }}" name="phone"/>
                        <label for="">كلمة المرور</label>
                        <input type="password" class="inputStyle" name="password"/>
                        {{-- <input type="text" class="inputStyle hidden" name="code" value="{{ $data->code }}" readonly placeholder="رقم البطاقة" /> --}}
                        {{-- <div class="dateStyle hidden">
                            <input type="text" class="inputStyle" id="fromDate" name="start_date" value="{{ now()->format('d/m/Y') }}" placeholder="بداية من" />
                            <i class="flaticon-school-calendar"></i>
                        </div> --}}
                        {{-- <div class="dateStyle hidden">
                            <input type="text" class="inputStyle" id="toDate" name="end_date" value="{{ $data->end_date }}" placeholder="الانتهاء الي" />
                            <i class="flaticon-school-calendar"></i>
                        </div>
                        <label class="checkStyle hidden">
                            <input type="checkbox" name="user_request" checked />
                            <i></i>
                            بطاقة مطبوعة رسوم اضافية 100 ريال
                        </label> --}}
                        <div class="coupons">
                            <div class="inputSt">
                                <label for="">كوبونات الخصم :</label>
                                <input type="text" class="inputStyle" name="coupons[]" />
                            </div>
                        </div>
                        <label class="checkStyle">
                            <input type="checkbox" id="privcy" />
                            <i></i>
                            الشروط والحكام
                        </label>
                        <button class="btnForm" type="submit">ارسال الطلب</button>
                        
                    </form>

                </div>
                <div class="col-md-7">
                    <div class="details">
                        <div class="cardStyle">
                            @php 
                                $img = '';
                                $class = '';
                                if($data->data->id == 1){
                                    $img = 'Purple_test.png';
                                    $class = 'bgPurple';
                                }else if($data->data->id == 2){
                                    $img = 'green_test.png';
                                    $class = 'bgGreen';
                                }else if($data->data->id == 3){
                                    $img = 'blue_test.png';
                                    $class = 'bgBlue';
                                }
                            @endphp    
                            <img src="{{ asset('/assets/images/'.$img) }}" alt="" class="bg" />
                            <h2 class="titleAr" id="lblValue">{{ \Request::get('name_ar') }}</h2>
                            <h2 class="titleEn" id="lblValue2">{{ \Request::get('name_en') }}</h2>
                            <img class="logo" src="{{ asset('/assets/images/logo.svg') }}" alt="" />
                            <div class="details">
                                {!! $data->qrCode !!}
                                <span class="date">{{ $data->end_date2 }}</span>
                                <span class="code" style="color: {{ $data->data->color }}">{{ $data->code }}</span>
                            </div>
                            <span class="state {{ $class }}">{{ $data->data->title }}</span>
                        </div>
                        <div class="content">
                            <h2 class="titleContent">لإصدار بطاقتك، اتبع الخطوات التالية :</h2>
                            <ul class="listDetails">
                                <li class="active">اختر البطاقة المناسبة لك</li>
                                <li class="active">ادخل معلومات الحقول</li>
                                <li class="active">اختر طريقة الدفع</li>
                                <li class="active">ارسال طلب البطاقة</li>
                            </ul>
                            <div class="memberStyle">
                                <h2 class="titleMem">عضوية {{ $data->data->title }}</h2>
                                <span class="price">{{ $data->data->price }} ريال</span>
                                <span class="time">لمدة {{ $data->data->periodText }}</span>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@include('Partials.privacyModal')
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/requestMembership.js') }}"></script>
@endsection