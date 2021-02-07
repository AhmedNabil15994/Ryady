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
                <div class="method visa active">
                    <a href="#"> <img src="{{ asset('/assets/images/visa.svg') }}" alt=""></a>
                </div>
                <div class="method master-card">
                    <a href="#"> <img src="{{ asset('/assets/images/mastercard.svg') }}" alt=""></a>
                </div>
            </div>
            <form action="{{ $data->url }}" method="POST" class="payment-form">
                @csrf
                <input type="hidden" name="payment_type" value="2">
                <input type="number" name="card_no" placeholder="Card number">
                <input type="text" name="card_holder" placeholder="Card holder">
                <div class="exp-area">
                    <input type="text" name="year" placeholder="Year">
                    <div class="dateStyle">
                        <input type="text" class="data-input" name="expire_date" placeholder="Expiration Month" />
                    </div>
                </div>
                <input type="text" name="cvc" placeholder="CVC">
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