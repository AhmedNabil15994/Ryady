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
           <div class="card" style="background-image: url('{{ asset('/assets/images/'.$img) }}')">  
               <div class="card-logo">
                   <img src="{{ asset('/assets/images/logo.svg') }}" alt="">
               </div>
               <h2 class="ar-name titleAr" id="outputAr">{{ \Request::get('name_ar') }}</h2>
               <h2 class="en-name titleEn" id="outputEn">{{ \Request::get('name_en') }}</h2>
               <div class="qr-code">
                   {!! $data->qrCode !!}
               </div>
               <h2 class="card-num" style="color: {{ $data->data->color }}">{{ $data->code }}</h2>
               <p class="card-exp">{{ $data->end_date2 }}</p>
               <p class="member-lvl"> <span class="{{ $class }}">|</span> {{ $data->data->title }}</p>
           </div>
           <div class="card-price">
               <p class="price-value">{{ $data->data->price }} ريال</p>
               <p class="price-exp">لمده {{ $data->data->periodText }}</p>
           </div>
        </div>
        <div class="card-form">
            <div class="container">
                <form class="information-form"  method="POST" action="{{ URL::current() }}">
                    @csrf
                    <h2 class="text-center main__theme"> بيانات الشخصيه</h2>
                    <input name="name_ar" type="text" value="{{ \Request::get('name_ar') }}" placeholder="اسمك علي البطاقه بالعربي">
                    <input name="name_en" type="text" value="{{ \Request::get('name_en') }}" placeholder="اسمك علي البطاقه بالانجليزي">
                    <div class="selectStyle marg-0">
                        <select class="selectmenu" id="selectmenu" name="membership_id">
                            @foreach($data->memberships as $membership)
                            <option value="{{ $membership->id }}" {{ $data->data->id == $membership->id ? 'selected' : '' }}>عضوية {{ $membership->title . ' ' . $membership->price }} ريال</option>
                            @endforeach
                        </select>
                        <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                    </div>
                    <input type="email" value="{{ \Request::get('email') }}" name="email" placeholder="البريد الالكتروني" />
                    <input type="number" value="{{ \Request::get('phone') }}" name="phone" placeholder="رقم الجوال" />
                    <input type="password" name="password" placeholder="كلمة المرور" />
                    <div class="coupons">
                        <div class="inputSt">
                            <label for="">كود الخصم :</label>
                            <input type="text" name="coupons[]" placeholder="كود الخصم" />
                        </div>
                    </div>
                    @if(\App\Models\Variable::getVar('PRINTED_CARDS') == 1)
                    <label class="checkStyle">
                        بطاقة مطبوعة رسوم اضافية 100 ريال
                        <input type="checkbox" name="user_request"/>
                    </label>
                    @endif
                    <label class="checkStyle">
                        الشروط والاحكام
                        <input type="checkbox" id="privacy"/>
                    </label>
                    <button type="submit" class="btn btn__dark--theme">حفظ التغييرات</button>
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