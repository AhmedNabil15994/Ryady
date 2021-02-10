@extends('Layouts.master')

@section('title','تفاصيل العضويات')

@section('header-class','headerFixed')

@section('content')
	<div class="payment--component">
        <div class="payment-app">
            <h2>تحديد الدفع</h2>
            <div class="payment-methods">
                <div class="method mada">
                    <a href="#"> <img src="{{ asset('/assets/images/Mada_Logo.svg') }}" alt=""></a>
                </div>
                <div class="method visa">
                    <a href="#"> <img src="{{ asset('/assets/images/visa.jpg') }}" alt=""></a>
                </div>
                <div class="method master-card">
                    <a href="#"> <img src="{{ asset('/assets/images/master.png') }}" alt=""></a>
                </div>
            </div>
            <form action="{{ $data->url }}" method="POST" class="payment-form">
                @csrf
                <input type="hidden" name="payment_type" value="2">
                <input type="text" name="card_holder" placeholder="الاسم علي الكارت">
                <input type="number" name="card_no" placeholder="رقم الكارت">
                <div class="exp-area">
                    <input type="text" name="cvc" placeholder="CVC">
                    <div class="dateStyle">
                        <input type="text" class="data-input" name="expire_date" placeholder="MM / YY" />
                    </div>
                </div>
                <button class="btn" type="submit">ارسال</button>
            </form>
        </div>
    </div>
@endsection

@section('modals')
@include('Partials.privacyModal')
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/payment.js') }}"></script>
@endsection