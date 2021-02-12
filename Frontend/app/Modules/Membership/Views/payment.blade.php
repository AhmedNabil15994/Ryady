@extends('Layouts.master')

@section('title','تفاصيل العضويات')

@section('header-class','headerFixed')

@section('content')
    <div class="row text-center payment">
        <div class="col-xs-12 col-md-6 col-md-offset-3 payment-app">
            <h2>تحديد الدفع</h2>
            <div class="row">
                <div class="col-xs-12">
                    <div class="payment-methods">
                        <div class="col-xs-4">
                            <div class="method mada">
                                <a href="#"> <img src="{{ asset('/assets/images/Mada_Logo.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="method visa">
                                <a href="#"> <img src="{{ asset('/assets/images/visa.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="method master-card">
                                <a href="#"> <img src="{{ asset('/assets/images/master.svg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form action="{{ $data->url }}" method="POST" class="payment-form">
                        @csrf
                        <input type="hidden" name="payment_type" value="2">
                        <input type="text" name="card_holder" placeholder="الاسم على البطاقة">
                        <input type="number" name="card_no" placeholder="رقم البطاقة">
                        <div class="exp-area">
                            <input type="text" name="cvc" placeholder="CVC">
                            <div class="dateStyle">
                                <input type="text" class="data-input" name="expire_date" placeholder="MM / YY" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <button class="btn" type="submit">ارسال</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@include('Partials.privacyModal')
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/payment.js') }}"></script>
@endsection