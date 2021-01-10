@extends('Layouts.master')

@section('title','شبكة VIP')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>شبكة VIP</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>شبكة VIP</li>
            </ul>
        </div>
    </div>
    
    <div class="vipPage">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip1.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip2.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip3.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip4.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip5.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ asset('/assets/images/vip6.png') }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.عبدالله بن مساعد</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                مجتمع حيوي كبير انضم الآن لأكبر
                مجموعة من أعضاء الشاب الريادي
            </div>
            <a href="#" class="btnStyle">انضم الينا</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection