@extends('Layouts.master')

@section('title','تفاصيل العضويات')

@section('styles')
@endsection

@section('content')    
    <section class="requestCard--section">
        <div class="container">
            <div class="request-inst">
                <p> لاصدار بطاقتك, اتبع الخطوات التاليه:</p>
            </div>
            <div class="request-progress">
                <div class="row ">
                    <div class="col-xs-3 request-step active">
                        <div class="step ">
                            <i class="fa fa-check"></i>
                        </div>
                        <p>حدد البطاقه</p>
                    </div>
                    <div class="col-xs-3 request-step active">
                        <div class="step">
                            <i class="fa fa-check"></i>
                        </div>
                        <p>بيانات الشخصيه</p>
                    </div>
                    <div class="col-xs-3 request-step">
                        <div class="step">
                            <i class="fa fa-check"></i>
                        </div>
                        <p>طريقه الدفع</p>
                    </div>
                    <div class="col-xs-3 request-step">
                        <div class="step">
                            <i class="fa fa-check"></i>
                        </div>
                        <p>ارسل الطلب</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-shape">
           <div class="card">
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
               <div class="card-logo">
                   <img src="{{ asset('/assets/images/'.$img) }}" alt="">
               </div>
               <h2 class="ar-name" id="outputAr">خالد بن محمد</h2>
               <h2 class="en-name" id="outputEn">khalid bin mohamed</h2>
               <div class="qr-code">
                   <img src="./images/qr.png" alt="">
               </div>
               <h2 class="card-num">0008694</h2>
               <p class="card-exp">09/2012</p>
               <p class="member-lvl"> | منتسب</p>
           </div>
           <div class="card-price">
               <p class="price-value">157 ريال</p>
               <p class="price-exp">لمده سنه</p>
           </div>
        </div>
        <div class="card-form">
            <div class="container">
                <form action="" class="information-form">
                    <h2 class="text-center main__theme"> بيانات الشخصيه</h2>
                    <input id="inputAr" type="text" onInput="fetchArInput()" placeholder="اسمك علي البطاقه بالعربي">
                    <input id="inputEn" type="text" onInput="fetchEnInput()" placeholder="اسمك علي البطاقه بالانجليزي">
                    <div class="selectStyle marg-0">
                        <select class="selectmenu" id="selectmenu">
                            <option>نوع العضوية منتسب 175 ريال</option>
                            <option>نوع العضوية منتسب 175 ريال</option>
                            <option>نوع العضوية منتسب 175 ريال</option>
                            <option>نوع العضوية منتسب 175 ريال</option>
                        </select>
                        <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                    </div>
                    <input type="number" placeholder="رقم الجوال">
                    <input type="number" placeholder="رقم البطاقه">
                    <div class="dateStyle">
                        <input type="text" class="datepicker" placeholder="بدايه من" />
                        <i class="flaticon-school-calendar"></i>
                    </div>
                    <div class="dateStyle">
                        <input type="text" class="datepicker" placeholder="الانتهاء الي" />
                        <i class="flaticon-school-calendar"></i>
                    </div>
                    <label class="checkStyle">
                        الشروط والحكام
                        <input type="checkbox" checked />

                    </label>
                    <label class="checkStyle">

                        بطاقة مطبوعة رسوم اضافية 100 ريال
                        <input type="checkbox" checked />
                    </label>

                    <button type="button" class="btn btn__dark--theme" data-toggle="modal" data-target="#exampleModal">حفظ التغييرات</button>

                </form>

            </div>
        </div>
    </section>
@endsection

@section('modals')
@include('Partials.privacyModal')
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/requestMembership.js') }}"></script>
@endsection